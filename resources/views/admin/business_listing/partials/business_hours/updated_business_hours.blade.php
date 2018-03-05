             <form role="form" action="{{ route('admin.update_business_hours',['slug' => $businessListing->slug]) }}" enctype="multipart/form-data" method="POST">
              {{ csrf_field() }}
                <div class="box-body">

                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-3 col-xs-3 test-sam">
                          <div class="day">Sun</div>
                          <input type="checkbox" data-toggle="toggle" name="sunday_status" class="business_checkbox" @if($businessHours->sun_status == true) checked @endif>
                          <input type="hidden" value="{{ ($businessHours->sun_status == true) ? 1 : 0}}" name="sun_status" class="hidden">
                        </div>

                        <div class="col-sm-9 col-xs-9 text-right @if($businessHours->sun_status == false) hide @endif">
                          <div class="hours"><label class="switch_margin"></label>
                            
                            <ul class="open-down">
                              <div class="input-group bootstrap-timepicker timepicker">
                               <input type="text" class="form-control input-small timepicker1" name="sun_open" value="{{ $businessHours->sun_open }}">
                               <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                              </div>  
                              To
                              <div class="input-group bootstrap-timepicker timepicker">
                               <input type="text" class="form-control input-small timepicker1" name="sun_close" value="{{ $businessHours->sun_close }}">
                               <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                              </div>  
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-3 col-xs-3 test-sam">
                          <div class="day">Mon</div>
                            <input type="checkbox" data-toggle="toggle" name="monday_status" class="business_checkbox" value="0" @if($businessHours->mon_status == true) checked @endif>
                            <input type="hidden" value="{{ ($businessHours->mon_status == true) ? 1 : 0}}" name="mon_status" class="hidden">
                        </div>

                        <div class="col-sm-9 col-xs-9 text-right @if($businessHours->mon_status == false) hide @endif">
                          <div class="hours"><label class="switch_margin"></label>
                           
                            <ul class="open-down">
                              <div class="input-group bootstrap-timepicker timepicker">
                               <input type="text" class="form-control input-small timepicker1" name="mon_open" value="{{ $businessHours->mon_open }}">
                               <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                              </div>                          
                              To
                              <div class="input-group bootstrap-timepicker timepicker">
                               <input type="text" class="form-control input-small timepicker1" name="mon_close" value="{{ $businessHours->mon_close }}">
                               <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                              </div> 
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>                        

                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-3 col-xs-3 test-sam">
                          <div class="day">Tue</div>
                            <input type="checkbox" data-toggle="toggle" name="tuesday_status" class="business_checkbox" value="0" @if($businessHours->tue_status == true) checked @endif>
                            <input type="hidden" value="{{ ($businessHours->tue_status == true) ? 1 : 0}}" name="tue_status" class="hidden">                     
                        </div>

                        <div class="col-sm-9 col-xs-9 text-right @if($businessHours->tue_status == false) hide @endif">
                          <div class="hours"><label class="switch_margin"></label>
                           
                            <ul class="open-down">
                              <div class="input-group bootstrap-timepicker timepicker">
                               <input type="text" class="form-control input-small timepicker1" name="tue_open" value="{{ $businessHours->tue_open }}">
                               <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                              </div>  
                              To
                              <div class="input-group bootstrap-timepicker timepicker">
                               <input type="text" class="form-control input-small timepicker1" name="tue_close" value="{{ $businessHours->tue_close }}">
                               <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                              </div>  
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>                        

                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-3 col-xs-3 test-sam">
                          <div class="day">Wed</div>
                            <input type="checkbox" data-toggle="toggle" name="wednesday_status" class="business_checkbox" value="0" @if($businessHours->wed_status == true) checked @endif>
                            <input type="hidden" value="{{ ($businessHours->wed_status == true) ? 1 : 0}}" name="wed_status" class="hidden">                                         
                        </div>

                        <div class="col-sm-9 col-xs-9 text-right @if($businessHours->wed_status == false) hide @endif">
                          <div class="hours"><label class="switch_margin"></label>
                            
                            <ul class="open-down">
                              <div class="input-group bootstrap-timepicker timepicker">
                               <input type="text" class="form-control input-small timepicker1" name="wed_open" value="{{ $businessHours->wed_open }}">
                               <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                              </div>  
                               To
                              <div class="input-group bootstrap-timepicker timepicker">
                               <input type="text" class="form-control input-small timepicker1" name="wed_close" value="{{ $businessHours->wed_close }}">
                               <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                              </div>  
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>                        

                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-3 col-xs-3 test-sam">
                          <div class="day">Thur</div>
                            <input type="checkbox" data-toggle="toggle" name="thursday_status" class="business_checkbox" value="0" @if($businessHours->thur_status == true) checked @endif>
                            <input type="hidden" value="{{ ($businessHours->thur_status == true) ? 1 : 0}}" name="thur_status" class="hidden">                                          
                        </div>

                        <div class="col-sm-9 col-xs-9 text-right @if($businessHours->thur_status == false) hide @endif">
                          <div class="hours"><label class="switch_margin"></label>
                            
                            <ul class="open-down">
                              <div class="input-group bootstrap-timepicker timepicker">
                               <input type="text" class="form-control input-small timepicker1" name="thur_open" value="{{ $businessHours->thur_open }}">
                               <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                              </div>  
                              To
                              <div class="input-group bootstrap-timepicker timepicker">
                               <input type="text" class="form-control input-small timepicker1" name="thur_open" value="{{ $businessHours->thur_close }}">
                               <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                              </div>  
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>                        

                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-3 col-xs-3 test-sam">
                          <div class="day">Fri</div>
                            <input type="checkbox" data-toggle="toggle" name="friday_status" class="business_checkbox" value="0" @if($businessHours->fri_status == true) checked @endif>
                            <input type="hidden" value="{{ ($businessHours->fri_status == true) ? 1 : 0}}" name="fri_status" class="hidden">                                         
                        </div>

                        <div class="col-sm-9 col-xs-9 text-right @if($businessHours->fri_status == false) hide @endif">
                          <div class="hours"><label class="switch_margin"></label>
                            
                            <ul class="open-down">
                              <div class="input-group bootstrap-timepicker timepicker">
                               <input type="text" class="form-control input-small timepicker1" name="fri_open" value="{{ $businessHours->fri_open }}">
                               <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                              </div>  
                              To
                              <div class="input-group bootstrap-timepicker timepicker">
                               <input type="text" class="form-control input-small timepicker1" name="fri_close" value="{{ $businessHours->fri_close }}">
                               <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                              </div>  
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>                        

                    <div class="form-group">
                      <div class="row">
                        <div class="col-sm-3 col-xs-3 test-sam">
                          <div class="day">Sat</div>
                            <input type="checkbox" data-toggle="toggle" name="saturday_status" class="business_checkbox" value="0" @if($businessHours->sat_status == true) checked @endif>
                            <input type="hidden" value="{{ ($businessHours->sat_status == true) ? 1 : 0}}" name="sat_status" class="hidden">                                          
                        </div>

                        <div class="col-sm-9 col-xs-9 text-right @if($businessHours->sat_status == false) hide @endif">
                          <div class="hours"><label class="switch_margin"></label>
                            
                            <ul class="open-down">
                              <div class="input-group bootstrap-timepicker timepicker">
                               <input type="text" class="form-control input-small timepicker1" name="sat_open" value="{{ $businessHours->sat_open }}">
                               <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                              </div>  
                              To
                              <div class="input-group bootstrap-timepicker timepicker">
                               <input type="text" class="form-control input-small timepicker1" name="sat_close" value="{{ $businessHours->sat_close }}">
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