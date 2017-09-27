<div class="gdlr-content">

	<!-- Above Sidebar Section-->

	<!-- Sidebar With Content Section-->
	<div class="with-sidebar-wrapper">
		<?php if(!empty($result)) { ?>
		<section id="content-section-4">
			<div class="gdlr-parallax-wrapper gdlr-background-image gdlr-show-all gdlr-skin-dark-skin" id="gdlr-parallax-wrapper-1" data-bgspeed="0.2" style="background-image: url('<?=PATH_URL?>media/<?=$result[0]?$result[0]->images:""?>'); padding-top: 110px; padding-bottom: 85px; ">
				<div class="container">
					<div class="gdlr-title-item">
						<div class="gdlr-item-title-wrapper gdlr-item pos-left ">
							<div class="gdlr-item-title-head" style="text-align:center;">
								<h3 class="gdlr-item-title gdlr-skin-title gdlr-skin-border" style="font-weight:700;text-align:center;"><?=$result[0]?stripslashes($result[0]->name):""?></h3>
								<h5 style="margin-top:15px;"><?=$result[0]?stripslashes($result[0]->content):""?></h5>
								<div class="clear"></div>
							</div>
						</div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<div class="clear"></div>
		</section>
		<?php } ?>

		<section id="content-section-1" style="margin-top:70px;">
			<div class="container">
				<div class="gdlr-full-size-wrapper gdlr-show-all" style="padding-bottom: 0px;  background-color: #ffffff; ">
					<div class="gdlr-master-slider-item gdlr-slider-item gdlr-item" style="margin-bottom: 0px;">
						<!-- MasterSlider -->
						<div id="P_MS568a7f1682c11" class="master-slider-parent ms-parent-id-2">
							<?php $img = $this->model->getListContent('images', array('article_id' => $result[1]?$result[1]->id:0))?>
							<!-- MasterSlider Main -->
							<div id="MS568a7f1682c11" class="master-slider ms-skin-default">
								<div class="ms-slide" data-delay="7" data-fill-mode="fill">
									<img src="<?=PATH_URL?>asset/frontend/wp-content/plugins/masterslider/public/assets/css/blank.gif" alt="" title="" data-src="<?=PATH_URL?>media/<?=$result[1]?$result[1]->images:""?>" />
								</div>
								<?php if(!empty($img)) { foreach($img as $key=>$val) { ?>
								<div class="ms-slide" data-delay="7" data-fill-mode="fill">
									<img src="<?=PATH_URL?>asset/frontend/wp-content/plugins/masterslider/public/assets/css/blank.gif" alt="" title="" data-src="<?=PATH_URL?>media/<?=$val->images?>" />
								</div>
								<?php } } ?>


							</div>
							<!-- END MasterSlider Main -->


						</div>
						<!-- END MasterSlider -->

						<script>
							(function ($) {
								"use strict";

								$(function () {
									var masterslider_2c11 = new MasterSlider();

									// slider controls
									masterslider_2c11.control('arrows', {
										autohide: true,
										overVideo: true
									});
									masterslider_2c11.control('bullets', {
										autohide: true,
										overVideo: true,
										dir: 'h',
										align: 'bottom',
										space: 6,
										margin: 15
									});
									// slider setup
									masterslider_2c11.setup("MS568a7f1682c11", {
										width: 1140,
										height: 570,
										minHeight: 0,
										space: 0,
										start: 1,
										grabCursor: false,
										swipe: true,
										mouse: false,
										keyboard: false,
										//layout: "fullwidth",
										wheel: false,
										autoplay: true,
										instantStartLayers: false,
										loop: true,
										shuffle: false,
										preload: 0,
										heightLimit: true,
										autoHeight: false,
										smoothHeight: true,
										endPause: false,
										overPause: true,
										fillMode: "fill",
										centerControls: true,
										startOnAppear: false,
										layersMode: "center",
										autofillTarget: "",
										hideLayers: false,
										fullscreenMargin: 0,
										speed: 20,
										dir: "h",
										parallaxMode: 'swipe',
										view: "fade"
									});



									$("head").append("<link rel='stylesheet' id='ms-fonts'  href='//fonts.googleapis.com/css?family=Open+Sans:800,300,regular' type='text/css' media='all' />");

									window.masterslider_instances = window.masterslider_instances || [];
									window.masterslider_instances.push(masterslider_2c11);
								});

							})(jQuery);
						</script>

					</div>
					<div class="clear"></div>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
				<style>
					.msp-cn-2-2 {
						color: #fff;
					}
					
					.msp-cn-2-3 {
						text-align: left;
					}
					
					body .ms-skin-default .ms-nav-prev {
						background: url(<?=PATH_URL?>asset/frontend/images/icon-left.png);
						width: 69px;
						height: 69px;
						margin-top: -34.5px;
					}
					
					body .ms-skin-default .ms-nav-next {
						background: url(<?=PATH_URL?>asset/frontend/images/icon-right.png);
						width: 69px;
						height: 69px;
						margin-top: -34.5px;
					}
					
					body .ms-skin-default .ms-bullet {
						border-color: #fff;
						border-width: 1px;
						width: 10px;
						height: 10px;
					}
					
					body .ms-skin-default .ms-bullet.ms-bullet-selected,
					body .ms-skin-default .ms-bullet:hover {
						background: #c8061c;
						border-color: #c8061c;
					}
				</style>
			</div>

		</section>

		<section id="section-2">
			<div class="container">
				<div class="twelve columns">
					<div class="wrap-content">
						<?php $name_team = $result[1]?stripslashes($result[1]->name):""; ?>
						<h3><?=str_replace("-","<br><span>",$name_team)?></span></h3>
						<?=$result[1]?stripslashes($result[1]->content):""?>
					</div>
				</div>
			</div>
			<style>
				#section-2 {}
				
				#section-2 .wrap-content {
					max-width: 680px;
					border-top: 8px solid #c8061c;
					margin-top: 25px;
					padding-top: 20px;
					padding-bottom: 40px;
				}
				
				#section-2 h3 {
					font-size: 48px;
				}
				
				#section-2 h3 > span {
					font-weight: 700;
				}
				
				#section-2 p {
					text-align: justify;
					color: #292929;
				}
				
				@media (min-width:768px) {
					#section-2 .wrap-content {
						padding-left: 20px;
					}
				}
			</style>
		</section>



	</div>

	<!-- Below Sidebar Section-->


</div>