@extends('layouts.admin')

@section('content')

<aside class="right-side">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <h1>
         Dashboard
         <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Dashboard</li>
      </ol>
   </section>
   <!-- Main content -->
   <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
         <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
               <div class="inner">
                  <h3>
                     150
                  </h3>
                  <p>
                     New Orders
                  </p>
               </div>
               <div class="icon">
                  <i class="fa fa-briefcase"></i>
               </div>
               <a href="#" class="small-box-footer">
               More info <i class="fa fa-arrow-circle-right"></i>
               </a>
            </div>
         </div>
         <!-- ./col -->
         <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
               <div class="inner">
                  <h3>
                     53<sup style="font-size: 20px">%</sup>
                  </h3>
                  <p>
                     Bounce Rate
                  </p>
               </div>
               <div class="icon">
                  <i class="fa fa-signal"></i>
               </div>
               <a href="#" class="small-box-footer">
               More info <i class="fa fa-arrow-circle-right"></i>
               </a>
            </div>
         </div>
         <!-- ./col -->
         <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
               <div class="inner">
                  <h3>
                     44
                  </h3>
                  <p>
                     User Registrations
                  </p>
               </div>
               <div class="icon">
                  <i class="fa fa-user"></i>
               </div>
               <a href="#" class="small-box-footer">
               More info <i class="fa fa-arrow-circle-right"></i>
               </a>
            </div>
         </div>
         <!-- ./col -->
         <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
               <div class="inner">
                  <h3>
                     65
                  </h3>
                  <p>
                     Unique Visitors
                  </p>
               </div>
               <div class="icon">
                  <i class="fa fa-eye"></i>
               </div>
               <a href="#" class="small-box-footer">
               More info <i class="fa fa-arrow-circle-right"></i>
               </a>
            </div>
         </div>
         <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- top row -->
      <div class="row">
         <div class="col-xs-12 connectedSortable">
         </div>
         <!-- /.col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
         <!-- Left col -->
         <section class="col-lg-6 connectedSortable">
            <!-- Box (with bar chart) -->
            <div class="box box-danger" id="loading-example">
               <div class="box-header">
                  <!-- tools box -->
                  <div class="pull-right box-tools">
                     <button class="btn btn-danger btn-sm refresh-btn" data-toggle="tooltip" title="Reload"><i class="fa fa-refresh"></i></button>
                     <button class="btn btn-danger btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                     <button class="btn btn-danger btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                  </div>
                  <!-- /. tools -->
                  <i class="fa fa-cloud"></i>
                  <h3 class="box-title">Server Load</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body no-padding">
                  <div class="row">
                     <div class="col-sm-7">
                        <!-- bar chart -->
                        <div class="chart" id="bar-chart" style="height: 250px;"></div>
                     </div>
                     <div class="col-sm-5">
                        <div class="pad">
                           <!-- Progress bars -->
                           <div class="clearfix">
                              <span class="pull-left">Bandwidth</span>
                              <small class="pull-right">10/200 GB</small>
                           </div>
                           <div class="progress xs">
                              <div class="progress-bar progress-bar-green" style="width: 70%;"></div>
                           </div>
                           <div class="clearfix">
                              <span class="pull-left">Transfered</span>
                              <small class="pull-right">10 GB</small>
                           </div>
                           <div class="progress xs">
                              <div class="progress-bar progress-bar-red" style="width: 70%;"></div>
                           </div>
                           <div class="clearfix">
                              <span class="pull-left">Activity</span>
                              <small class="pull-right">73%</small>
                           </div>
                           <div class="progress xs">
                              <div class="progress-bar progress-bar-light-blue" style="width: 70%;"></div>
                           </div>
                           <div class="clearfix">
                              <span class="pull-left">FTP</span>
                              <small class="pull-right">30 GB</small>
                           </div>
                           <div class="progress xs">
                              <div class="progress-bar progress-bar-aqua" style="width: 70%;"></div>
                           </div>
                           <!-- Buttons -->
                           <p>
                              <button class="btn btn-default btn-sm"><i class="fa fa-cloud-download"></i> Generate PDF</button>
                           </p>
                        </div>
                        <!-- /.pad -->
                     </div>
                     <!-- /.col -->
                  </div>
                  <!-- /.row - inside box -->
               </div>
               <!-- /.box-body -->
            </div>
            <!-- /.box -->        
            <!-- Custom tabs (Charts with tabs)-->
            <div class="nav-tabs-custom">
               <!-- Tabs within a box -->
               <ul class="nav nav-tabs pull-right">
                  <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>
                  <li><a href="#sales-chart" data-toggle="tab">Donut</a></li>
                  <li class="pull-left header"><i class="fa fa-inbox"></i> Sales</li>
               </ul>
               <div class="tab-content no-padding">
                  <!-- Morris chart - Sales -->
                  <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
                  <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
               </div>
            </div>
            <!-- /.nav-tabs-custom -->

         </section>
         <!-- /.Left col -->
         <!-- right col (We are only adding the ID to make the widgets sortable)-->
         <section class="col-lg-6 connectedSortable">
            <!-- Map box -->
            <div class="box box-primary">
               <div class="box-header">
                  <!-- tools box -->
                  <div class="pull-right box-tools">                                        
                     <button class="btn btn-primary btn-sm daterange pull-right" data-toggle="tooltip" title="Date range"><i class="fa fa-calendar"></i></button>
                     <button class="btn btn-primary btn-sm pull-right" data-widget='collapse' data-toggle="tooltip" title="Collapse" style="margin-right: 5px;"><i class="fa fa-minus"></i></button>
                  </div>
                  <!-- /. tools -->
                  <i class="fa fa-map-marker"></i>
                  <h3 class="box-title">
                     Visitors
                  </h3>
               </div>
               <div class="box-body no-padding">
                  <div id="world-map" style="height: 300px;"></div>
                  <div class="table-responsive">
                     <!-- .table - Uses sparkline charts-->
                     <table class="table table-striped">
                        <tr>
                           <th>Country</th>
                           <th>Visitors</th>
                           <th>Online</th>
                           <th>Page Views</th>
                        </tr>
                        <tr>
                           <td><a href="#">USA</a></td>
                           <td>
                              <div id="sparkline-1"></div>
                           </td>
                           <td>209</td>
                           <td>239</td>
                        </tr>
                        <tr>
                           <td><a href="#">India</a></td>
                           <td>
                              <div id="sparkline-2"></div>
                           </td>
                           <td>131</td>
                           <td>958</td>
                        </tr>
                        <tr>
                           <td><a href="#">Britain</a></td>
                           <td>
                              <div id="sparkline-3"></div>
                           </td>
                           <td>19</td>
                           <td>417</td>
                        </tr>
                        <tr>
                           <td><a href="#">Brazil</a></td>
                           <td>
                              <div id="sparkline-4"></div>
                           </td>
                           <td>109</td>
                           <td>476</td>
                        </tr>
                        <tr>
                           <td><a href="#">China</a></td>
                           <td>
                              <div id="sparkline-5"></div>
                           </td>
                           <td>192</td>
                           <td>437</td>
                        </tr>
                        <tr>
                           <td><a href="#">Australia</a></td>
                           <td>
                              <div id="sparkline-6"></div>
                           </td>
                           <td>1709</td>
                           <td>947</td>
                        </tr>
                     </table>
                     <!-- /.table -->
                  </div>
               </div>
               <!-- /.box-body-->
               <div class="box-footer">
                  <button class="btn btn-info"><i class="fa fa-download"></i> Generate PDF</button>
                  <button class="btn btn-warning"><i class="fa fa-bug"></i> Report Bug</button>
               </div>
            </div>
            <!-- /.box -->

         </section>
         <!-- right col -->
      </div>
      <!-- /.row (main row) -->
   </section>
   <!-- /.content -->
</aside>
<!-- /.right-side -->

@endsection
