<?php
//print_r($result);
?> 
<!-- Only factories -->
<script src="<?=PATH_URL?>asset/frontend/js/jquery_bxslider/plugins/jquery.fitvids.js"></script>
<script src="<?=PATH_URL?>asset/frontend/js/jquery_bxslider/jquery.bxslider.js"></script>
    <!-- Slide -->
    <section class="slide-top">
		<?php if(!empty($banner)){ foreach($banner as $key=>$val) { ?>    
                <img src="<?=PATH_URL.'media/'.$val->images?>">
		<?php break; }} ?>
    </section>
    <!-- End Slide -->
    
    <section class="home-news page-news page-contact page-factories">
		<div class="container">
        	<div class="row title">
                <div class="col-lg-12 col-md-12">
                    <h1><?=stripslashes($setting->name);?></h1>
                    <hr class="title-hr" />
                </div>
			</div>
			<?php if(!empty($result)){ foreach($result as $key=>$val) { ?>
            <?php $img = $this->model->getListContent('images', "FIND_IN_SET(article_id, '".$val->id."') > 0", null, null, "images"); ?>  
            <div class="row">
                <div class="col-lg-7 col-md-7">
					<div class="content">
						<ul id="bxslider-<?=$key;?>" class="bxslider">
                        	<?php if($val->links != ''){ ?>
							<li><iframe src="<?=$val->links;?>" width="653" height="404" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></li>
                            <?php } ?>
                            <?php foreach($img as $ig){ ?>
								<li><img style="object-fit: cover; width: 100%; height:404px;" src="<?=PATH_URL.'media/'.$ig->images?>" /></li>
							<?php } ?>
						</ul>
						<div id="bx-pager-<?=$key;?>" class="bx-pager">
							<img class="up" src="<?=PATH_URL?>asset/frontend/images/up.png" />
							<div>
								<?php if($val->links != ''){ ?>
								<a data-slide-index="0" href=""><img style="opacity: 0.7;" src="<?=PATH_URL?>asset/frontend/images/video.jpg" /></a>
                                <?php $i=0; }else{ $i= -1; } ?>
								<?php  foreach($img as $ig){ $i++;?>
									<a data-slide-index="<?=$i;?>" href=""><img src="<?=PATH_URL.'media/'.$ig->images?>" /></a>
								<?php } ?>
							</div>
							<img class="down" src="<?=PATH_URL?>asset/frontend/images/down.png" />
						</div>
					</div>
                    <script>
						$('#bxslider-<?=$key;?>').bxSlider({
							 video: true,
							 pagerCustom: '#bx-pager-<?=$key;?>',
							 controls: false,
						});
						$('#bx-pager-<?=$key;?> .up').click(function(){
							$('#bx-pager-<?=$key;?>>div').scrollTop($('#bx-pager-<?=$key;?>>div').scrollTop()-20);
						}); 	
						$('#bx-pager-<?=$key;?> .down').click(function(){
							 $('#bx-pager-<?=$key;?>>div').scrollTop($('#bx-pager-<?=$key;?>>div').scrollTop()+20);;
						});
					</script>
				</div>
				<div class="col-lg-5 col-md-5">
					<div class="content">
						<script>
                        var myCenter<?=$key;?>=new google.maps.LatLng(<?=$val->title;?>);
                        function initialize(){
                            var mapProp = {
                                center:myCenter<?=$key;?>,
                                zoom:15,
                                scrollwheel: false,
                                mapTypeId:google.maps.MapTypeId.ROADMAP
                            };
                            var map=new google.maps.Map(document.getElementById("googleMap<?=$key;?>"),mapProp);
                            var marker=new google.maps.Marker({ position:myCenter<?=$key;?> });
                            marker.setMap(map);
                        }
                        google.maps.event.addDomListener(window, 'load', initialize);
                        </script>
                        <div id="googleMap<?=$key;?>" style="width:100%; height:300px;"></div>	
                        <div class="info">
                            <span class="first"><b><i class="fa fa-map-marker"></i> <?=@_address;?>:</b> <?=stripslashes($val->shortcontent);?></span>
                            <span class="last"><b><i class="fa fa-mobile"></i> <?=@_phone;?>:</b> <?=stripslashes($val->description);?></span>
                        </div>							
					</div>
				</div>
            </div>
			<?php }} ?>
		</div>
	</section>

	