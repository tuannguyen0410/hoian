
    <div class="booking-page">
        <div class="container">
            <h1>BOOK NOW</h1>
            <img src="<?=PATH_URL?>asset/frontend/images/line.png" class="line-right">
            <ul class="list-dot">
                <li><p>For all bookings, please fill in your details into our form and we will confirm your booking via email within 24 hours. <br>(If you don't hear from us, please you check your spam or junk mail folder or call <strong>+84 977123244</strong> (Mr. Trung)</p></li>
                <li><p>If you'd like to ask a question , click on the "contact" menu and send us a message.</p></li>
                <li><p>For good arrangement, we suggest you book tour ONE day ahead</p></li>
                <li><p>Please call directly hot line <strong>+84 977123244</strong> to make sure your booking will be confirmed.</p></li>
            </ul>
			<form id="ori-booking" action="" method="post" enctype="multipart/form-data">
            <div class="panel-group booking-list" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne" aria-expanded="false" style="pointer-events: none;" aria-controls="collapseOne">
                                    <i class="icon-book"></i>Book the tour
                                </a>
                              </h4>
                    </div>
                    
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingTwo">
                        <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo" style="pointer-events: none;" aria-expanded="false" aria-controls="collapseTwo">
                                    <i class="icon-hotelinfo"></i>hotel & Basic Information
                                </a>
                              </h4>
                    </div>
                   
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingThree">
                        <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion3" href="#collapseThree" style="pointer-events: none;" aria-expanded="true" aria-controls="collapseThree">
                                    <i class="icon-payment"></i>Payment method
                                </a>
                              </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingThree">
                        <div class="panel-body">
                            <div class="ourtour-form">
                                <label class="checkbox"><input checked="checked" value="1" type="radio" name="payment"><i class="icon"></i> I will pay in cash on the day of the tour</label>
                                <div><span class="text-weaccept">WE ACCEPT</span><img src="<?=PATH_URL?>asset/frontend/images/img-payment.png" alt=""></div>
                                <!-- <label class="checkbox"><input type="radio" value="2" name="payment"><i class="icon"></i> I want to pay in full now</label>
                                <div><span class="text-weaccept">WE ACCEPT</span><img src="<?=PATH_URL?>asset/frontend/images/img-payment.png" alt=""></div> -->
                                
                                <span class="text-totalprice">Total Price:</span>
                                <div class="select-totalprice">
                                    <label class="checkbox first"><input type="radio" value="1" checked="checked" name="currency"><i class="icon"></i> <span class="total-price">$<?=number_format($price);?> <?php if($discount > $price){ ?>(<del>$<?=number_format($discount);?></del>)<?php } ?></span></label> 
                                    <label class="checkbox"><input type="radio" value="2" name="currency"><i class="icon"></i> <span class="total-price"><?=number_format(($price)*($setting->usd_to_vnd));?>VND <?php if($discount > $price){ ?>(<del><?=number_format(($discount)*($setting->usd_to_vnd));?>VND</del>)<?php } ?></span></label>
                                </div>
                            </div>
                            <br>
                            <div>
                                <a href="<?=PATH_URL?>information" class="gold-btn">Back</a>
                                <button type="submit" class="gold-btn">Book Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>

        </div>
    </div>
