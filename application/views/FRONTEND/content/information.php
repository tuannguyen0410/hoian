<?php
// var_dump($info);
?>
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
                                    <input type="text" class="txtinput" name="firstname" value="<?=$info['firstname'];?>">
                                    <p class="notice"></p>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 lastname">
                                    <label class="lbl-title">Last Name<span>*</span></label>
                                    <input type="text" class="txtinput" name="lastname" value="<?=$info['lastname'];?>">
                                    <p class="notice"></p>
                                </div>
                              <!--   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 gender">
                                    <label class="lbl-title">Gender</label>
                                    <select name="gender" id="">
                                        <option value="Male">MALE</option>
                                        <option <?=($info['gender'] == 'Female')? 'selected="selected"':'';?>  value="Female">FEMALE</option>
                                    </select>
                                    <p class="notice"></p>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 nationality">
                                    <label class="lbl-title">Nationality<span>*</span></label>
                                    <input type="text" class="txtinput" name="nationality" value="<?=$info['nationality'];?>">
                                    <p class="notice"></p>
                                </div> -->
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 email">
                                    <label class="lbl-title">Email Address<span>*</span></label>
                                    <input type="text" class="txtinput" name="email" value="<?=$info['email'];?>">
                                    <p class="notice"></p>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 reemail">
                                    <label class="lbl-title">Re-enter your email address<span>*</span></label>
                                    <input type="text" class="txtinput" name="reemail" value="<?=$info['reemail'];?>">
                                    <p class="notice"></p>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 phone">
                                    <label class="lbl-title">Whatsaap/viber number<span>*</span></label>
                                    <input type="text" class="txtinput" name="phone" value="<?=$info['phone'];?>">
                                    <p class="notice"></p>
                                </div>
                               <!--  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 address">
                                    <label class="lbl-title">Address<span>*</span></label>
                                    <input type="text" class="txtinput" name="address" value="<?=$info['address'];?>">
                                    <p class="notice"></p>
                                </div> -->
                            </div>
                            <br>
                            <h2 class="sub-line-text">Hotel information</h2>
                            <img src="<?=PATH_URL?>asset/frontend/images/line.png" class="line-right sub-line">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 hname">
                                    <label class="lbl-title">Hotel Name<span>*</span></label>
                                    <input type="text" class="txtinput" name="hname" value="<?=$info['hname'];?>">
                                    <p class="notice"></p>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 hroom">
                                    <label class="lbl-title">Room number<span>*</span></label>
                                    <input type="text" class="txtinput" name="hroom" value="<?=$info['hroom'];?>">
                                    <p class="notice"></p>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 haddress">
                                    <label class="lbl-title">Hotel Address<span>*</span></label>
                                    <input type="text" class="txtinput" name="haddress" value="<?=$info['haddress'];?>">
                                    <p class="notice"></p>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 hnote">
                                    <label class="lbl-title">Notes</label>
                                    <input type="text" class="txtinput" name="hnote" value="<?=$info['hnote'];?>">
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
		// Firstname không rỗng
		if($('input[name="firstname"]').val() == ''){
			$('input[name="firstname"]').parent('div.firstname').find('p.notice').html('Firstname can\'t null');
			check = 1;
		}
		// Lastname không rỗng
		if($('input[name="lastname"]').val() == ''){
			$('input[name="lastname"]').parent('div.lastname').find('p.notice').html('Lastname can\'t null');
			check = 1;
		}
		// Nationality không rỗng
		if($('input[name="nationality"]').val() == ''){
			$('input[name="nationality"]').parent('div.nationality').find('p.notice').html('Nationality can\'t null');
			check = 1;
		}
		// Email không rỗng
		if($('input[name="email"]').val() == ''){
			$('input[name="email"]').parent('div.email').find('p.notice').html('Email can\'t null');
			check = 1;
		}
		// Re-mail phải giống email
		if($('input[name="reemail"]').val() == '' || $('input[name="reemail"]').val() != $('input[name="email"]').val()){
			$('input[name="reemail"]').parent('div.reemail').find('p.notice').html('Re-email must be the same as email');
			check = 1;
		}
		// Phone không rỗng
		if($('input[name="phone"]').val() == ''){
			$('input[name="phone"]').parent('div.phone').find('p.notice').html('Phone can\'t null');
			check = 1;
		}
		// Address không rỗng
		if($('input[name="address"]').val() == ''){
			$('input[name="address"]').parent('div.address').find('p.notice').html('Address can\'t null');
			check = 1;
		}
		// Hotel name không rỗng
		if($('input[name="hname"]').val() == ''){
			$('input[name="hname"]').parent('div.hname').find('p.notice').html('Hotel name can\'t null');
			check = 1;
		}
		// Room number không rỗng
		if($('input[name="hroom"]').val() == ''){
			$('input[name="hroom"]').parent('div.hroom').find('p.notice').html('Room number can\'t null');
			check = 1;
		}
		// Hotel Address không rỗng
		if($('input[name="haddress"]').val() == ''){
			$('input[name="haddress"]').parent('div.haddress').find('p.notice').html('Hotel Address can\'t null');
			check = 1;
		}

		if(check == 0){
			$('form#ori-booking').submit();			
		}
	});

});
</script>