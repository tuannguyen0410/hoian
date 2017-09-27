
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
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo" style="pointer-events: none;" aria-expanded="true" aria-controls="collapseTwo">
                                    <i class="icon-hotelinfo"></i>hotel & Basic Information
                                </a>
                              </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingTwo">
                        <div class="panel-body">
                            <h2 class="sub-line-text">Basic information</h2>
                            <img src="<?=PATH_URL?>asset/frontend/images/line.png" class="line-right sub-line">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 firstname">
                                    <label class="lbl-title">First Name<span>*</span></label>
                                    <input type="text" class="txtinput" name="firstname">
                                    <p class="notice"></p>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 lastname">
                                    <label class="lbl-title">Last Name<span>*</span></label>
                                    <input type="text" class="txtinput" name="lastname">
                                    <p class="notice"></p>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 gender">
                                    <label class="lbl-title">Gender</label>
                                    <select name="gender" id="">
                                        <option value="Male">MALE</option>
                                        <option value="Female">FEMALE</option>
                                    </select>
                                    <p class="notice"></p>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 nationality">
                                    <label class="lbl-title">Nationality<span>*</span></label>
                                    <input type="text" class="txtinput" name="nationality">
                                    <p class="notice"></p>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 email">
                                    <label class="lbl-title">Email Address<span>*</span></label>
                                    <input type="text" class="txtinput" name="email">
                                    <p class="notice"></p>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 reemail">
                                    <label class="lbl-title">Re-enter your email address<span>*</span></label>
                                    <input type="text" class="txtinput" name="reemail">
                                    <p class="notice"></p>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 phone">
                                    <label class="lbl-title">Phone number<span>*</span></label>
                                    <input type="text" class="txtinput" name="phone">
                                    <p class="notice"></p>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 address">
                                    <label class="lbl-title">Address<span>*</span></label>
                                    <input type="text" class="txtinput" name="address">
                                    <p class="notice"></p>
                                </div>
                            </div>
                            <br>
                            <h2 class="sub-line-text">Hotel information</h2>
                            <img src="<?=PATH_URL?>asset/frontend/images/line.png" class="line-right sub-line">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 hname">
                                    <label class="lbl-title">Hotel Name<span>*</span></label>
                                    <input type="text" class="txtinput" name="hname">
                                    <p class="notice"></p>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 hroom">
                                    <label class="lbl-title">Room number<span>*</span></label>
                                    <input type="text" class="txtinput" name="hroom">
                                    <p class="notice"></p>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 haddress">
                                    <label class="lbl-title">Hotel Address<span>*</span></label>
                                    <input type="text" class="txtinput" name="haddress">
                                    <p class="notice"></p>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 hnote">
                                    <label class="lbl-title">Notes</label>
                                    <input type="text" class="txtinput" name="hnote">
                                    <p class="notice"></p>
                                </div>
                            </div><br>
                            <div>
                                <a href="<?=PATH_URL?>booking" class="gold-btn">Back</a>
                                <a href="javascript:;" class="gold-btn" id="ori_step_2">Continue</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="headingThree">
                        <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion3" href="#collapseThree" style="pointer-events: none;" aria-expanded="false" aria-controls="collapseThree">
                                    <i class="icon-payment"></i>Payment method
                                </a>
                              </h4>
                    </div>
                </div>
            </div>
            </form>

        </div>
    </div>
<script>
$(document).ready(function() {

	// ori_step_2
	$('#ori_step_2').on('click',function(){
		$('p.notice').html('');
		var check = 0;
		// Date không rỗng
		if($('input[name="date_' + $(this).data("id") + '"]').val() == ''){
			$('input[name="date_' + $(this).data("id") + '"]').parent('div.date').find('p.notice').html('Tour date can\'t null');
			check = 1;
		}

		console.log(check);
		if(check == 0){
			$('form#ori-booking').submit();			
		}
	});

});
</script>