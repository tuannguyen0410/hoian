<div class="gdlr-content">
	
	<div class="with-sidebar-wrapper">
		<?php if(!empty($result)) { ?>
		<section id="content-section-4">
			<div class="gdlr-parallax-wrapper gdlr-background-image gdlr-show-all gdlr-skin-dark-skin" id="gdlr-parallax-wrapper-1" data-bgspeed="0.2" style="background-image: url('<?=PATH_URL?>media/<?=$result[0]?$result[0]->images:""?>'); padding-top: 110px; padding-bottom: 85px; ">
				<div class="container">
					<div class="gdlr-title-item">
						<div class="gdlr-item-title-wrapper gdlr-item pos-left ">
							<div class="gdlr-item-title-head" style="text-align:center;">
								<h3 class="gdlr-item-title gdlr-skin-title gdlr-skin-border" style="font-weight:700;text-align:center;"><?=$result[0]?stripslashes($result[0]->name):""?></h3>
								
								<div class="clear"></div>
							</div>
						</div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<div class="clear"></div>
		</section>
		<?php for($i = 1; $i < count($result); $i++) { ?>
			<section id="section-1" class="huvi-article <?php if($i%2 == 0) echo "bg-trang"; else echo "bg-xam"?>">
				<div class="container">
					<div class="six columns <?php if($i%2 == 0) echo "right"?>">
						<div class="gdlr-item">
							<img src="<?=PATH_URL.'media/'.$result[$i]->images?>" alt="<?=stripslashes($result[$i]->name)?>">
						</div>

					</div>
					<div class="six columns">
						<div class="gdlr-item">
							<div class="wrap-content">
								<h4 class="article-title"><?=stripslashes($result[$i]->name)?></h4>
								<?=stripslashes($result[$i]->content)?>
								
							</div>
						</div>
					</div>
					<div class="clear"></div>
				</div>

			</section>
		<?php } ?>
		<?php } ?>
		<style>
			.huvi-article {
				padding-bottom: 30px;
			}
			
			.huvi-article h4.article-title {
				font-size: 24px;
				color: #d4051d;
				font-weight: 700;
			}
			
			.huvi-article img {
				margin: 70px 0px 10px;
			}
			
			.huvi-article .wrap-content {
				padding: 60px 0px 0px 0px;
			}
			
			.huvi-article.bg-trang {
				background: #fff;
			}
			
			.huvi-article.bg-xam {
				background: #f2f2f2;
			}
			
			.huvi-article .right {
				float: right;
			}
			
			@media (max-width:767px) {
				.huvi-article .wrap-content {
					padding-top: 0px;
				}
			}
		</style>


	</div>

	<!-- Below Sidebar Section-->


</div>