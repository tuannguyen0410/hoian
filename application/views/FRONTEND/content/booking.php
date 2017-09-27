<style type="text/css">
    @media (min-width: 1200px){
        .booking-page .booking-col-1{
            width: 270px;
        }
        .booking-page .booking-col-3 {
            width: 150px;
        }
        .booking-page .booking-col-4 {
            width: 200px;
        }
        .booking-page .booking-col-6 {
            width: 150px;
        }
    }

</style>
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
                                <a role="button" data-toggle="collapse" data-parent="#accordion1" href="#collapseOne" aria-expanded="true" style="pointer-events: none;" aria-controls="collapseOne">
                                    <i class="icon-book"></i>Book the tour
                                </a>
                              </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body">
                        	<?php if(!empty($tour)){ ?>
                            	<?php $i = 0; ?>
                            	<?php foreach($tour as $key=>$val){
								//var_dump($val);
								$i++
								?>
                                <div id="ori_row_<?=$key;?>" data-id="<?=$key;?>" class="row booking-row">
                                <h2 class="sub-line-text"><a class="ori-delete-tour" href="<?=PATH_URL?>home/del_tour/<?=$key;?>"><i class="fa fa-times" aria-hidden="true"></i></a>Tour <?=$i;?></h2>
                                <img src="<?=PATH_URL?>asset/frontend/images/line.png" class="line-right sub-line">
                                    <div class="booking-col-1 col-xs-12 col-sm-6 name">
                                        <label class="lbl-title">Tour NAME</label><br>
                                        <select name="name_<?=$key;?>">
                                        <?php foreach($tour_name as $to_name){ ?>
                                            <option <?=($key == $to_name->id)? 'selected':'';?> value="<?=$to_name->id;?>"><?=$to_name->name;?></option>
                                        <?php } ?>
                                        </select>
                                        <p class="notice"></p>
                                    </div>
                                    <div class="booking-col-2 col-xs-12 col-sm-6 date">
                                        <label class="lbl-title">Tour date<span>*</span></label><br>
                                        <input readonly='true' type="text" id="tourdate-datepicker-<?=$key;?>" name="date_<?=$key;?>" class="datepicker ori-pick-<?=$key;?>" placeholder="DD/MM/YY" value="<?=$val['date'];?>">
                                        <script>
                                            $( ".ori-pick-<?=$key;?>" ).datepicker({
                                                minDate:new Date(),
												"dateFormat": "dd/mm/yy"
											});
										</script>

                                        <p class="notice"></p>
                                    </div>
                                    <div class="booking-col-3 col-xs-12 col-sm-6 time">
                                        <label class="lbl-title">Tour Time</label><br>
                                        <select name="time_<?=$key;?>" id="">
                                        	<?php
											$tmp_time = explode(',', ($this->model->getContent('article', array('id' => $key), "keywords")->keywords));
											if(!empty($tmp_time)){
												foreach($tmp_time as $tt){
													if($tt != ''){
														if($val['time'] == $tt){
															echo '<option selected="selected" value="'.$tt.'">'.$tt.'</option>';
														}else{
															echo '<option value="'.$tt.'">'.$tt.'</option>';
														}
													}
												}
											}
											?>
                                        </select>
                                        <p class="notice"></p>
                                    </div>
                                    <div class="booking-col-4 col-xs-12 col-sm-6 service">
                                        <label class="lbl-title">Optional Services</label><br>
                                        <select name="service_<?=$key;?>" id="service_<?=$key;?>">
                                            <option value="0">None Service</option>
                                            <option <?=($val['service'] == 1)? 'selected="selected"':'';?> value="1">Private Tour</option>
                                        </select>
                                        <p class="notice"></p>
                                    </div>
                                    <div class="booking-col-6 col-xs-12 col-sm-6 transportation">
                                        <label class="lbl-title">Transportation</label><br>
                                        <select name="transportation_<?=$key;?>" id="">
                                            <?php
                                            $category_id = explode(',', $this->model->getContent('article', array('id' => $key), "category_id")->category_id);
                                            if(!empty($category_id)){
                                                $category_name = array();
                                                foreach ($category_id as $item => $value) {
                                                    $category_name[] = $this->model->getContent('category', array('id' => $value), "name , id");
                                                }
                                            }
                                            if(!empty($category_name)){
                                                foreach($category_name as $tt){
                                                    if($tt != ''){
                                                        if($val['transportation'] == $tt){
                                                            echo '<option selected="selected" value="'.$tt->id.'">'.$tt->name.'</option>';
                                                        }else{
                                                            echo '<option value="'.$tt->id.'">'.$tt->name.'</option>';
                                                        }
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                        <p class="notice"></p>
                                    </div>
                                    <div class="booking-col-5 col-xs-12 col-sm-6 guest">
                                        <label class="lbl-title">Guests<span>*</span></label><br>
                                        <input type="number" class="txtinput" name="guest_<?=$key;?>" min="1" value="1" pattern="[0-9]*">
                                        <p class="notice"></p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <?php } ?>
                            <?php }else{ ?>
                                <div id="ori_row_38" data-id="38" class="row booking-row">
                                    <h2 class="sub-line-text"><a class="ori-delete-tour" href=""><i class="fa fa-times" aria-hidden="true"></i></a>Tour 1</h2>
                                    <img src="<?=PATH_URL?>asset/frontend/images/line.png" class="line-right sub-line">
                                    <div class="booking-col-1 col-xs-12 col-sm-6 name">
                                        <label class="lbl-title">Tour NAME</label><br>
                                        <select name="name_38">
                                        <?php foreach($tour_name as $to_name){ ?>
                                            <option value="<?=$to_name->id;?>"><?=$to_name->name;?></option>
                                        <?php } ?>
                                        </select>
                                        <p class="notice"></p>
                                    </div>
                                    <div class="booking-col-2 col-xs-12 col-sm-6 date">
                                        <label class="lbl-title">Tour date<span>*</span></label><br>
                                        <input type="text" id="tourdate-datepicker-0" class="datepicker ori-pick-0" placeholder="DD/MM/YY">
                                        <script>
                                            $( ".ori-pick-0" ).datepicker({
												"dateFormat": "dd/mm/yy"
											});
										</script>
                                        <p class="notice"></p>
                                    </div>
                                    <div class="booking-col-3 col-xs-12 col-sm-6 time">
                                        <label class="lbl-title">Tour Time</label><br>
                                        <select name="time_" id="">
                                            <?php
                                            $tmp_time = explode(',', ($this->model->getContent('article', array('id' => 38), "keywords")->keywords));
                                            if(!empty($tmp_time)){
                                                foreach($tmp_time as $tt){
                                                    if($tt != ''){
                                                        if($val['time'] == $tt){
                                                            echo '<option selected="selected" value="'.$tt.'">'.$tt.'</option>';
                                                        }else{
                                                            echo '<option value="'.$tt.'">'.$tt.'</option>';
                                                        }
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                        <p class="notice"></p>
                                    </div>
                                    <div class="booking-col-4 col-xs-12 col-sm-6 service">
                                        <label class="lbl-title">Optional Services</label><br>
                                        <select name="" id="service_<?=$key;?>">
                                            <option value="0">None Service</option>
                                            <option value="1">Private Tour</option>
                                        </select>
                                        <p class="notice"></p>
                                    </div>
                                    <div class="booking-col-5 col-xs-12 col-sm-6 guest">
                                        <label class="lbl-title">Guests<span>*</span></label><br>
                                        <input type="number" class="txtinput" name="guest" value="1"  min="1" pattern="[0-9]*">
                                        <p class="notice"></p>
                                    </div>
                                    <div class="booking-col-6 col-xs-12 col-sm-6 transportation">
                                        <label class="lbl-title">Transportation</label><br>
                                        <select name="transportation_" id="">
                                            <?php
                                            $category_id = explode(',', $this->model->getContent('article', array('id' => 38), "category_id")->category_id);
                                            if(!empty($category_id)){
                                                $category_name = array();
                                                foreach ($category_id as $item => $value) {
                                                    $category_name[] = $this->model->getContent('category', array('id' => $value), "name , id");
                                                }
                                            }
                                            if(!empty($category_name)){
                                                foreach($category_name as $tt){
                                                    if($tt != ''){
                                                        if($val['transportation'] == $tt){
                                                            echo '<option selected="selected" value="'.$tt->id.'">'.$tt->name.'</option>';
                                                        }else{
                                                            echo '<option value="'.$tt->id.'">'.$tt->name.'</option>';
                                                        }
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                        <p class="notice"></p>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            <?php } ?>
                            <br>
                            <p>If you book more than 1 tour with us, we give 5% discount on top of total price.</p>
                            <div>
                                <a href="<?=PATH_URL?>#ori_scroll_ourtour" id="ori_more_tour" class="gold-btn">Book more tour</a>
                                <a href="javascript:;" class="gold-btn" id="ori_step_1">Continue</a>
                            </div>
                        </div>
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
	// Change Tour name //
    $("#service_66").val("0").addClass('disabled');
    $("#service_54").val("0").addClass('disabled');
    $("#service_49").val("0").addClass('disabled');
    $("#service_92").val("0").addClass('disabled');
    $("#service_93").val("0").addClass('disabled');
    $("#service_69").val("0").addClass('disabled');
    $("#service_96").val("0").addClass('disabled');
    $("#service_157").val("0").addClass('disabled');
    $("#service_158").val("0").addClass('disabled');

	$('#collapseOne .name select').on('change',function(){
		var id = $(this).parent('div').parent('div').attr('data-id');
		var val = $(this).val();
		$.ajax({
			type: "POST",
			url: "<?=PATH_URL?>home/update_tour",
			data: { id: id, val: val},
			success: function(result){
				var data = JSON.parse(result);
				$('#ori_row_' + id + ' .name p').html('');
				//console.log(data['transportationopt']);
				if(data['type'] == 1){
					if($('#ori_row_' + id + ' .name select').val() != id){
						$('#ori_row_' + id + ' .name p').html('This tour selected');
					}
					$('#ori_row_' + id + ' .name select').val(id);
					$('#ori_row_' + id + ' .name div.nice-select>span').html($('#ori_row_' + id + ' .name select').find('option:selected').text());
				}else{
					$('#ori_row_' + id + ' .ori-delete-tour').attr('href', '<?=PATH_URL?>home/del_tour/' + val );
		 			$('#ori_row_' + id).attr('data-id', val);

					$('#ori_row_' + id + ' .name select').attr('name', 'name_' + val);
					$('#ori_row_' + id + ' .date input').attr('name', 'date_' + val);

					$('#ori_row_' + id + ' .time select').html(data['timeopt']);
					$('#ori_row_' + id + ' .time select').parent('div.time').find('.nice-select').html(data['timeopt2']);
					$('#ori_row_' + id + ' .time select').attr('name', 'time_' + val);
					$('#ori_row_' + id + ' .service select').attr('name', 'service_' + val);
					$('#ori_row_' + id + ' .guest select').attr('name', 'guest_' + val);

					$('#ori_row_' + id + ' .transportation select').html(data['transportationopt']);
                    $('#ori_row_' + id + ' .transportation select').parent('div.transportation').find('.nice-select').html(data['transportationopt2']);
                    $('#ori_row_' + id + ' .transportation select').attr('name', 'transportation_' + val);

					$('#ori_row_' + id).attr('id', 'ori_row_' + val);

				}
			}
		});
	});

	// ori_step_1
	$('#ori_step_1').on('click',function(){
		$('p.notice').html('');
		var check = 0;
		$(".booking-row").map(function(i) {
			// Date không rỗng
			if($('input[name="date_' + $(this).data("id") + '"]').val() == ''){
				$('input[name="date_' + $(this).data("id") + '"]').parent('div.date').find('p.notice').html('Tour date can\'t null');
				check = 1;
			}
			// Guests > 0
			if($('input[name="guest_' + $(this).data("id") + '"]').val() == '' || $('input[name="guest_' + $(this).data("id") + '"]').val() < 1){
				$('input[name="guest_' + $(this).data("id") + '"]').parent('div.guest').find('p.notice').html('Guests > 0');
				check = 1;
			}
		});
		console.log(check);
		if(check == 0){
			$('form#ori-booking').submit();
		}
	});

});
</script>
