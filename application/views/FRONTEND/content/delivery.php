<?php
// print_r($result); exit();
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
    
     
    <section class="home-news page-news page-contact  page-factories page-retail">
		<div class="container">
        	<div class="row title">
                <div class="col-lg-12 col-md-12">
                    <h1><?=@_he_thong_phan_phoi;?></h1>
                    <hr class="title-hr" />
                </div>
			</div>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div id="mapFull" style="width: 100%; height: 450px;"></div>
                    <?php
					//var_dump($location); exit();
					$loca = '';
					$i = 0;
					foreach($location as $loc){
						$i++;
						$loca .= "['', ".$loc->title." , '".$i."'],";
					}
					?>
                    <script type="text/javascript">
                    var locations = [
                      <?=$loca;?>
                    ];
                    var map = new google.maps.Map(document.getElementById('mapFull'), {
                      zoom: 5,
                      scrollwheel: false,
                      center: new google.maps.LatLng(16.2084125,107.5531999),
                      mapTypeId: google.maps.MapTypeId.ROADMAP,

                    });
                    var infowindow = new google.maps.InfoWindow();
                    var marker, i;
                    for (i = 0; i < locations.length; i++) {  
                      marker = new google.maps.Marker({
                        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                        map: map,
						label: locations[i][3], 
                      });
                      google.maps.event.addListener(marker, 'click', (function(marker, i) {
                        return function() {
                          infowindow.setContent(locations[i][0]);
                          infowindow.open(map, marker);
                        }
                      })(marker, i));
                    }
                    </script>
                </div>
            </div>
            <div id="retail" class="row" style="text-align:center;">
            	<h3><?=@_cac_doi_tac_phan_phoi;?></h3>
                <div class="col-lg-12 col-md-12" style="margin: 15px 0px 40px;">
					<?php if(!empty($partners)){ foreach($partners as $key=>$val) { ?>    
                            <a target="_blank" href="<?=$val->links?>"><img height="65" style="margin: 5px 20px;" src="<?=PATH_URL.'media/'.$val->images?>"></a>
                    <?php }} ?>
                </div>
            </div>
            <div class="row">
            <?php foreach($category as $cate){ ?>
			<?php $data = $this->model->getListContent('article', "FIND_IN_SET(category_id, '".$cate->id."') > 0", 'order_by asc',  null, null, "name$home_lang as name, id"); ?>
                <div class="col-lg-4 col-md-4">
                    <select onchange="if (this.value) window.location.href=this.value" class="form-control js-basic-select2">
                      <option selected="selected" disabled="disabled"><?=stripslashes($cate->name)?></option>
                      <?php foreach($data as $val){ ?>
                      <option value="?id=<?=stripslashes($val->id)?>#retail"><?=stripslashes($val->name)?></option>
                      <?php } ?>
                    </select>
 				</div>
            <?php } ?>
            </div>
            <div class="row">
                <div class="col-lg-7 col-md-7">
				<div style="height: 524px;overflow: hidden;position: relative;">
                <?php if(!empty($result)){ $ii = 0; foreach($result as $key=>$val){ $ii++; ?>
				<?php $img = $this->model->getListContent('images', "FIND_IN_SET(article_id, '".$val->id."') > 0", null, null, "images"); ?> 
					<div style="height:524px" role="tabpanel" class="tab-pane fade <?=($ii==1)?'in active':'';?> content" id="ori-tab-<?=$key;?>">
						<ul id="bxslider-<?=$key;?>" class="bxslider">
							<li>
								<div id="googleMap<?=$key;?>" style="width:100%; height:404px;"></div>
							</li>
							<?php if($val->links != ''){ ?>
							<li><iframe src="<?=$val->links;?>" width="653" height="404" style="height:404px;" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></li>
                            <?php } ?>
                            <?php foreach($img as $ig){ ?>
                                <li><img style="object-fit: cover; width: 100%; height:404px;" src="<?=PATH_URL.'media/'.$ig->images?>" /></li>
							<?php } ?>
						</ul>
						<div id="bx-pager-<?=$key;?>" class="bx-pager">
							<img class="left" src="<?=PATH_URL?>asset/frontend/images/left2.png" />
							<div>
								<a data-slide-index="0" href=""><img src="<?=PATH_URL?>asset/frontend/images/maps.jpg" /></a>
								<?php if($val->links != ''){ ?>
								<a data-slide-index="1" href=""><img style="opacity: 0.7;" src="<?=PATH_URL?>asset/frontend/images/video.jpg" /></a>
                                <?php $i=1; }else{ $i= 0; } ?>
								<?php  foreach($img as $ig){ $i++;?>
									<a data-slide-index="<?=$i;?>" href=""><img src="<?=PATH_URL.'media/'.$ig->images?>" /></a>
								<?php } ?>
							</div>
							<img class="right"  src="<?=PATH_URL?>asset/frontend/images/right2.png" />
						</div>
                        <style>
						.active#ori-tab-<?=$key;?>{
							top: -<?=($ii-1);?>00%;
						}
						</style>
					</div>
                <?php }} ?>    
				</div>	
				</div>
				<div class="col-lg-5 col-md-5">
					<div class="content">
						<!--<img class="up" src="<?=PATH_URL?>asset/frontend/images/up2.png" />-->
						<ul class="nav nav-tabs" role="tablist">
						<?php if(!empty($result)){ $i = 0; foreach($result as $key=>$val){ $i++; ?>
							<li role="presentation" <?=($i==1)?'class="active"':'';?>>
								<a href="#ori-tab-<?=$key;?>" role="tab" aria-controls="ori-tab-<?=$key;?>" data-toggle="tab">
									<div class="info">
										<h3><?=stripslashes($val->name)?></h3>
                                        <span><?=stripslashes($val->content);?></span>
										<span class="first"><b><i class="fa fa-map-marker"></i> <?=@_address;?>:</b> <?=stripslashes($val->shortcontent);?></span>
										<span class="last"><b><i class="fa fa-mobile"></i> <?=@_phone;?>:</b> <?=stripslashes($val->description);?></span>
									</div>
								</a>
							</li>
								<script>
$( document ).ready(function() { 
								var myCenter<?=$key;?>=new google.maps.LatLng(<?=$val->title;?>);
								function initialize(){
								var mapProp = {
									  center:myCenter<?=$key;?>,
									  zoom:15,
									  scrollwheel: false,
									  mapTypeId:google.maps.MapTypeId.ROADMAP
									  };
									var map=new google.maps.Map(document.getElementById("googleMap<?=$key;?>"),mapProp);
									var marker=new google.maps.Marker({
										position:myCenter<?=$key;?>,
									});
									marker.setMap(map);
								}
								google.maps.event.addDomListener(window, 'load', initialize);

                                $('#bxslider-<?=$key;?>').bxSlider({
                                     video: true,
                                     pagerCustom: '#bx-pager-<?=$key;?>',
                                     controls: false,
                                });
                                $('#bx-pager-<?=$key;?> .left').click(function(){
                                    $('#bx-pager-<?=$key;?>>div').scrollLeft($('#bx-pager-1>div').scrollLeft()-50);
                                }); 	
                                $('#bx-pager-<?=$key;?> .right').click(function(){
                                     $('#bx-pager-<?=$key;?>>div').scrollLeft($('#bx-pager-<?=$key;?>>div').scrollLeft()+50);;
                                });
								
});
                            </script>	
						<?php }} ?>    
						</ul>
						<!--<img class="down" src="<?=PATH_URL?>asset/frontend/images/down2.png" />-->
					</div>
				</div>
            </div>
		</div>
	</section>

<script>
	$('.up').click(function(){
		$('ul.nav.nav-tabs').scrollTop($('ul.nav.nav-tabs').scrollTop()-50);
	}); 	
	$('.down').click(function(){
		 $('ul.nav.nav-tabs').scrollTop($('ul.nav.nav-tabs').scrollTop()+50);;
	});

</script>
<style>

.page-retail ul.nav-tabs li a:hover, .page-retail ul.nav-tabs li.active a:hover, .page-retail ul.nav-tabs li.active a{
    border-bottom: 0px solid #000;
    border-top: 0px solid #000;	
}
.page-retail ul.nav-tabs li{
	margin-top: -30px;
}
.page-retail ul.nav-tabs{
	max-height:none;
}
</style>