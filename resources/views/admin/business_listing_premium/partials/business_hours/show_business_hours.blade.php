  <div class="box-header hours-1">
    <h3>Hours</h3>
  </div>    

<form role="form" action="{{ route('admin.update_business_hours',['slug' => $businessListing->slug]) }}" enctype="multipart/form-data" method="POST">
              {{ csrf_field() }}
                <div class="box-body">

                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-3 col-xs-12 test-sam">
                          <div class="day">Sun</div>
                          <input type="checkbox" data-toggle="toggle" name="sunday_status" class="business_checkbox">
                          <input type="hidden" value="0" name="sun_status" class="hidden">
                        </div>

                        <div class="col-sm-9 col-xs-12 text-right hide">
                          <div class="hours"><label class="switch_margin"></label>
                            
                            <ul class="open-down">
                              <div class="input-group bootstrap-timepicker timepicker">
                               <input type="text" class="form-control input-small timepicker1" name="sun_open">
                               <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                              </div>  
                              To
                              <div class="input-group bootstrap-timepicker timepicker">
                               <input type="text" class="form-control input-small timepicker1" name="sun_close">
                               <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                              </div>  
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-3 col-xs-12 test-sam">
                          <div class="day">Mon</div>
                            <input type="checkbox" data-toggle="toggle" name="monday_status" class="business_checkbox" value="0">
                            <input type="hidden" value="0" name="mon_status" class="hidden">
                        </div>

                        <div class="col-sm-9 col-xs-12 text-right hide">
                          <div class="hours"><label class="switch_margin"></label>
                           
                            <ul class="open-down">
                              <div class="input-group bootstrap-timepicker timepicker">
                               <input type="text" class="form-control input-small timepicker1" name="mon_open">
                               <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                              </div>                          
                              To
                              <div class="input-group bootstrap-timepicker timepicker">
                               <input type="text" class="form-control input-small timepicker1" name="mon_close">
                               <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                              </div> 
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>                        

                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-3 col-xs-12 test-sam">
                          <div class="day">Tue</div>
                            <input type="checkbox" data-toggle="toggle" name="tuesday_status" class="business_checkbox" value="0">
                            <input type="hidden" value="0" name="tue_status" class="hidden">                     
                        </div>

                        <div class="col-sm-9 col-xs-12 text-right hide">
                          <div class="hours"><label class="switch_margin"></label>
                           
                            <ul class="open-down">
                              <div class="input-group bootstrap-timepicker timepicker">
                               <input type="text" class="form-control input-small timepicker1" name="tue_open">
                               <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                              </div>  
                              To
                              <div class="input-group bootstrap-timepicker timepicker">
                               <input type="text" class="form-control input-small timepicker1" name="tue_close">
                               <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                              </div>  
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>                        

                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-3 col-xs-12 test-sam">
                          <div class="day">Wed</div>
                            <input type="checkbox" data-toggle="toggle" name="wednesday_status" class="business_checkbox" value="0">
                            <input type="hidden" value="0" name="wed_status" class="hidden">                                         
                        </div>

                        <div class="col-sm-9 col-xs-12 text-right hide">
                          <div class="hours"><label class="switch_margin"></label>
                            
                            <ul class="open-down">
                              <div class="input-group bootstrap-timepicker timepicker">
                               <input type="text" class="form-control input-small timepicker1" name="wed_open">
                               <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                              </div>  
                               To
                              <div class="input-group bootstrap-timepicker timepicker">
                               <input type="text" class="form-control input-small timepicker1" name="wed_close">
                               <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                              </div>  
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>                        

                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-3 col-xs-12 test-sam">
                          <div class="day">Thur</div>
                            <input type="checkbox" data-toggle="toggle" name="thursday_status" class="business_checkbox" value="0">
                            <input type="hidden" value="0" name="thur_status" class="hidden">                                          
                        </div>

                        <div class="col-sm-9 col-xs-12 text-right hide">
                          <div class="hours"><label class="switch_margin"></label>
                            
                            <ul class="open-down">
                              <div class="input-group bootstrap-timepicker timepicker">
                               <input type="text" class="form-control input-small timepicker1" name="thur_open">
                               <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                              </div>  
                              To
                              <div class="input-group bootstrap-timepicker timepicker">
                               <input type="text" class="form-control input-small timepicker1" name="thur_close">
                               <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                              </div>  
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>                        

                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-3 col-xs-12 test-sam">
                          <div class="day">Fri</div>
                            <input type="checkbox" data-toggle="toggle" name="friday_status" class="business_checkbox" value="0">
                            <input type="hidden" value="0" name="fri_status" class="hidden">                                         
                        </div>

                        <div class="col-sm-9 col-xs-12 text-right hide">
                          <div class="hours"><label class="switch_margin"></label>
                            
                            <ul class="open-down">
                              <div class="input-group bootstrap-timepicker timepicker">
                               <input type="text" class="form-control input-small timepicker1" name="fri_open">
                               <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                              </div>  
                              To
                              <div class="input-group bootstrap-timepicker timepicker">
                               <input type="text" class="form-control input-small timepicker1" name="fri_close">
                               <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                              </div>  
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>                        

                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-3 col-xs-12 test-sam">
                          <div class="day">Sat</div>
                            <input type="checkbox" data-toggle="toggle" name="saturday_status" class="business_checkbox" value="0">
                            <input type="hidden" value="0" name="sat_status" class="hidden">                                          
                        </div>

                        <div class="col-sm-9 col-xs-12 text-right hide">
                          <div class="hours"><label class="switch_margin"></label>
                            
                            <ul class="open-down">
                              <div class="input-group bootstrap-timepicker timepicker">
                               <input type="text" class="form-control input-small timepicker1" name="sat_open">
                               <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                              </div>  
                              To
                              <div class="input-group bootstrap-timepicker timepicker">
                               <input type="text" class="form-control input-small timepicker1" name="sat_close">
                               <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                              </div>  
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>                                     

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                   <button type="submit" class="btn btn-primary">Update</button>
                   <a href="{{ route('admin.business_listing') }}" class="btn btn-warning">Go Back</a>
                </div>

</form>                