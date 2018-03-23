         <!-- form start -->
         <form role="form" action="{{ route('admin.update_business_payment',['slug' => $businessListing->slug]) }}" enctype="multipart/form-data" method="POST">
          {{ csrf_field() }}
         
         <input type="hidden" name="user_id" value="{{ $businessListing->user_id }}">
   
        <div class="creditCardForm">
          <div class="payment">
            <div class="form-group owner">
              <label for="credit_card_owner_name">Customer Name</label>
              <input type="text" class="form-control" name="credit_card_owner_name" id="owner" value="@if(@sizeof($businessPaymentInfo->credit_card_owner_name)) {{ $businessPaymentInfo->credit_card_owner_name }} @endif">
            </div>

            <div class="form-group CVV">
              <label for="cvv">CVV</label>
              <input type="password" class="form-control" id="cvv" name="cvv" value="@if(@sizeof($businessPaymentInfo->cvv)) {{ $businessPaymentInfo->cvv }} @endif">
            </div>

            <div class="form-group" id="card-number-field">
              <label for="credit_card_number">Card Number</label>
              <input type="text" class="form-control" id="cardNumber" name="credit_card_number" value="@if(@sizeof($businessPaymentInfo->credit_card_number)) {{ $businessPaymentInfo->credit_card_number }} @endif">
            </div>

            <div class="form-group" id="expiration-date">
                <label>Expiration Date</label>
                <select name="credit_exp_month">
                    <option value="">Month</option>
                    <option value="01" @if(@sizeof($businessPaymentInfo) && $businessPaymentInfo->credit_exp_month == "01")selected="selected"@endif>January</option>
                    <option value="02" @if(@sizeof($businessPaymentInfo) && $businessPaymentInfo->credit_exp_month == "02")selected="selected"@endif>February </option>
                    <option value="03" @if(@sizeof($businessPaymentInfo) && $businessPaymentInfo->credit_exp_month == "03")selected="selected"@endif>March</option>
                    <option value="04" @if(@sizeof($businessPaymentInfo) && $businessPaymentInfo->credit_exp_month == "04")selected="selected"@endif>April</option>
                    <option value="05" @if(@sizeof($businessPaymentInfo) && $businessPaymentInfo->credit_exp_month == "05")selected="selected"@endif>May</option>
                    <option value="06" @if(@sizeof($businessPaymentInfo) && $businessPaymentInfo->credit_exp_month == "06")selected="selected"@endif>June</option>
                    <option value="07" @if(@sizeof($businessPaymentInfo) && $businessPaymentInfo->credit_exp_month == "07")selected="selected"@endif>July</option>
                    <option value="08" @if(@sizeof($businessPaymentInfo) && $businessPaymentInfo->credit_exp_month == "08")selected="selected"@endif>August</option>
                    <option value="09" @if(@sizeof($businessPaymentInfo) && $businessPaymentInfo->credit_exp_month == "09")selected="selected"@endif>September</option>
                    <option value="10" @if(@sizeof($businessPaymentInfo) && $businessPaymentInfo->credit_exp_month == "10")selected="selected"@endif>October</option>
                    <option value="11" @if(@sizeof($businessPaymentInfo) && $businessPaymentInfo->credit_exp_month == "11")selected="selected"@endif>November</option>
                    <option value="12" @if(@sizeof($businessPaymentInfo) && $businessPaymentInfo->credit_exp_month == "12")selected="selected"@endif>December</option>
                </select>
                <select name="credit_exp_year">
                    <option value="">Year</option>
                    <option value="18" @if(@sizeof($businessPaymentInfo) && $businessPaymentInfo->credit_exp_year == "18")selected="selected"@endif> 2018</option>
                    <option value="19" @if(@sizeof($businessPaymentInfo) && $businessPaymentInfo->credit_exp_year == "19")selected="selected"@endif> 2019</option>
                    <option value="20" @if(@sizeof($businessPaymentInfo) && $businessPaymentInfo->credit_exp_year == "20")selected="selected"@endif> 2020</option>
                    <option value="21" @if(@sizeof($businessPaymentInfo) && $businessPaymentInfo->credit_exp_year == "21")selected="selected"@endif> 2021</option>
                    <option value="22" @if(@sizeof($businessPaymentInfo) && $businessPaymentInfo->credit_exp_year == "22")selected="selected"@endif> 2022</option>
                    <option value="23" @if(@sizeof($businessPaymentInfo) && $businessPaymentInfo->credit_exp_year == "23")selected="selected"@endif> 2023</option>
                    <option value="24" @if(@sizeof($businessPaymentInfo) && $businessPaymentInfo->credit_exp_year == "24")selected="selected"@endif> 2024</option>
                    <option value="25" @if(@sizeof($businessPaymentInfo) && $businessPaymentInfo->credit_exp_year == "25")selected="selected"@endif> 2025</option>
                </select>
            </div>

              <div class="form-group" id="credit_cards">
                <img src="{{URL::asset('img/credit-card/visa.jpg')}}" id="visa">
                <img src="{{URL::asset('img/credit-card/mastercard.jpg')}}" id="mastercard">
                <img src="{{URL::asset('img/credit-card/amex.jpg')}}" id="amex">
              </div>
            </div>



            <div class="box-footer">
             <button type="submit" class="btn btn-primary">Submit</button>
           </div>
        </div>   
         </form>