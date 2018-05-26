<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Srmklive\PayPal\Services\ExpressCheckout;
use PayPal;
use App\Invoice;
use App\BusinessListing;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Session;
use App\Pricing;
 

class PaymentController extends Controller
{

    /**
     * @var ExpressCheckout
     */
    protected $provider;
    public function __construct()
    {
        $this->provider = new ExpressCheckout();
    }


    public function index()
    {
        return view('owner.payments.index');    
    }

    public function process_payment(Request $request)
    {
        $explodedPlan = explode('_', $request->payment_plan);
        $plan = $explodedPlan[0];
        $amount = $explodedPlan[1];
        $businessId = $explodedPlan[2];

        $recurring = true;
        $cart = $this->getCheckoutData($recurring, $plan, $amount, $businessId);
        
        try {
            $response = $this->provider->setExpressCheckout($cart, $recurring);
            return redirect($response['paypal_link']);
        } catch (\Exception $e) {
            $invoice = $this->createInvoice($cart, 'Invalid');
            Session::flash('error', 'Error processing PayPal payment for Order '.$invoice->id.'!');

        }                
    }

    public function success(Request $request)
    {
        $recurring = true;
        $token = $request->get('token');
        $PayerID = $request->get('PayerID');
        $plan = $request->get('plan');
        $amount = $request->get('amount');
        $businessId = $request->get('business_id');
        $business = BusinessListing::find($businessId);

        $cart = $this->getCheckoutData($recurring, $plan, $amount, $businessId);
        // Verify Express Checkout Token
        $response = $this->provider->getExpressCheckoutDetails($token);

        if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            if ($recurring === true) {

                switch($plan){
                case 'Annually' :     
                $response = $this->provider->createYearlySubscription($response['TOKEN'], $amount, $cart['subscription_desc']);
                $month = 12;
                break;
                case 'Semi-Annually' :
                $response = $this->provider->createSemiAnuallySubscription($response['TOKEN'], $amount, $cart['subscription_desc']);
                $month = 6;
                break;
                case 'Quarterly' :
                $response = $this->provider->createQuarterlySubscription($response['TOKEN'], $amount, $cart['subscription_desc']);
                $month = 3;
                break;                
                case 'Monthly' :
                $response = $this->provider->createMonthlySubscription($response['TOKEN'], $amount, $cart['subscription_desc']);
                $month = 1;
                break;
                } 
                if (!empty($response['PROFILESTATUS']) && in_array($response['PROFILESTATUS'], ['ActiveProfile', 'PendingProfile'])) {
                    $status = 'Processed';
                } else {
                    $status = 'Invalid';
                }
            } else {
                // Perform transaction on PayPal
                $payment_status = $this->provider->doExpressCheckoutPayment($cart, $token, $PayerID);
                $status = $payment_status['PAYMENTINFO_0_PAYMENTSTATUS'];
            }
           
            //Creating Invoice
            $invoice = $this->createInvoice($cart, $status, $month);
            if ($invoice->paid) {
                //Chaning Business To Premium Business
                $business->premium_status = true;
                $business->save();
                Session::flash('success', 'Order '.$invoice->id.' has been paid successfully!');
            } else {
                //Chaning Business To Non-Premium Business
                $business->premium_status = false;
                $business->save();
                Session::flash('error', 'Error processing PayPal payment for Order '.$invoice->id.'!');
            }
            
            return redirect()->route('owner.payment_information');
        }
    }

    public function failed()
    {
       Session::flash('error', 'Error processing PayPal payment. Please try again after some time'); 
       return redirect()->route('owner.payment_information');
    }


    /**
     * Parse PayPal IPN.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function notify(Request $request)
    {
        if (!($this->provider instanceof ExpressCheckout)) {
            $this->provider = new ExpressCheckout();
        }
        $request->merge(['cmd' => '_notify-validate']);
        $post = $request->all();
        $response = (string) $this->provider->verifyIPN($post);
        $logFile = 'ipn_log_'.Carbon::now()->format('Ymd_His').'.txt';
        Storage::disk('local')->put($logFile, $response);
    }    



    /**
     * Set cart data for processing payment on PayPal.
     *
     * @param bool $recurring
     *
     * @return array
     */
    protected function getCheckoutData($recurring, $plan, $amount, $businessId)
    {
    	$data = [];
        $order_id = Invoice::all()->count() + 1;
        if ($recurring === true) {
            $data['items'] = [
                [
                    'name'  => $plan.' Subscription '.config('paypal.invoice_prefix').' #'.$order_id,
                    'price' => $amount,
                    'qty'   => 1,
                    'business_id' => $businessId,
                    'membership' => $plan,
                ],
            ];
        $data['return_url'] = url('/owner/paypal/ec-checkout-success?mode=recurring&plan='.$plan.'&amount='.$amount.'&business_id='.$businessId.'');
        $data['subscription_desc'] = $plan.' Subscription '.config('paypal.invoice_prefix').' #'.$order_id;
        }
        $data['invoice_id'] = config('paypal.invoice_prefix').'_'.$order_id;
        $data['invoice_description'] = "Order #$order_id Invoice";
        $data['cancel_url'] = url('/');
        $total = $amount;
        $data['total'] = $total;
        return $data;
    }    


    protected function createInvoice($cart, $status, $month)
    {
        $request = [];

        $business_id = $cart['items'][0]['business_id'];
        if (strcasecmp($status, 'Completed') || strcasecmp($status, 'Processed')) {
            $request['paid']  = true;
        } else {
            $request['paid']  = false;
        }

        $request['title'] = $cart['invoice_description'];
        $request['business_id'] = $business_id;
        $request['price'] = $cart['total'];
        $request['membership']  = $cart['items'][0]['membership'];
        $request['membership_plan']  = $month;
        $invoice = Invoice::updateOrCreate(['business_id' => $business_id], $request);   
        
        return $invoice;
    }    
}
