    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-lg btn-popup" data-toggle="modal" data-target="#myModal"></button>
    <input id="popup_status" type="hidden" value="0">
    <?php //if($popup_status == 1){ 
        ?>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none !important;">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <a href="<?php  echo $popup->links; ?>">
                <img class="img-responsive" src="<?=PATH_URL.'media/'.$popup->images?>">
            </a>
          </div>
        </div>
      </div>
    </div>
    <?php //}
     ?>
    <style type="text/css">
        button.btn-popup{
            display: none !important;
        }
        #myModal{
            z-index: 99999;
        }
        .modal-content{
            border: 1px solid #589442;
            border-radius: 0px;
        }
        .modal-body{
            padding: 15px;
        }
        .modal-body img{
            object-fit: fill;
        }
        .modal-body .btn-close{
            height: 20px;
            float: right;
            margin-top: -21px;
            margin-right: -20px;
            background: none;
            border: none;
            font-size: 25px;
        }
        @media (max-width: 480px){
            #myModal{
                margin-top: 50px;
            }
        }
    </style>

    <?php if(!empty($banner)){ foreach($banner as $key=>$val) { ?>
		<?php if($key == 0){ ?>
        <section class="banner" style="background-image:url(<?=PATH_URL.'media/'.$val->images?>); margin-top: -1px;">
            <div class="container">
                <h2><?=stripslashes($val->name)?></h2>
                <h2><strong><?=stripslashes($val->links)?></strong></h2>
                <h2><img class="line-center" src="<?=PATH_URL?>asset/frontend/images/line.png">
                </h2>
            </div>
        </section>
        <?php } ?>
		<?php if($key == 1){ ?>
        <section id="whyus" class="whyus">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12">
                        <h2><?=stripslashes($val->name)?></h2>
                        <img src="<?=PATH_URL?>asset/frontend/images/line.png" class="line-right">
                        <h1><?=stripslashes($val->links)?></h1>
                        <div><?=stripslashes($val->content)?></div>
                    </div>
                    <div class="col-lg-7 col-md-6 col-sm-12 col-xs-12">
                        <img src="<?=PATH_URL.'media/'.$val->images?>">
    
                    </div>
                </div>
            </div>
        </section>
        <?php } ?>
		<?php if($key == 2){ ?>
        <img class="moto" src="<?=PATH_URL.'media/'.$val->images?>">
		<?php } ?>
	<?php }} ?>
    <button id="ori_scroll_ourtour" style="position: relative; top: -620px;"></button>
    <div id="" class="background-global">
        <img class="bg" src="<?=PATH_URL?>asset/frontend/images/bg.png">

        <section id="tour" class="tour">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 ">
					<?php if(!empty($banner)){ foreach($banner as $key=>$val) { ?>    
						<?php if($key == 2){ ?>
                            <h1><?=stripslashes($val->name)?></h1>
                            <img src="<?=PATH_URL?>asset/frontend/images/line.png" class="line-right">
                            <div class="resume"><?=stripslashes($val->content)?></div>
                        <?php } ?>
					<?php }} ?>
                    </div>
                    <style type="text/css">
                        .ori-filer-btn>div{
                            padding-top: 215px !important;
                        }
                        .ori-filer-btn h3{
                            position: absolute;
                            top: 130px;
                            font-weight: bold;
                        }
                        #ori_scroll_ourtour{
                            top: -500px !important;
                        }
                    </style>
                    <div class="col-md-6 ori-filer-btn col-md-offset-1">
    
                        <div>
                            <h3>PICK UP BY</h3>
                            <br /> 
							<?php if(!empty($category)){ foreach($category as $key => $val){ ?>
                            <button class="center-block white-btn ori_button ori_button_<?=$val->id;?>" onclick="ori_filter(<?=$val->id;?>);" style="<?=$key==0?'margin-left:0px;':''?>"><?=$val->name;?></button>
                            <?php }} ?>
                        </div>
						<script>
                            function ori_filter(id){
                                $('.ori_button').removeClass('active');
                                $('.ori_button_' + id).addClass('active');
                                $('.owl-carousel .item').parent('.owl-item').fadeOut(); 
                                $('.owl-carousel .ori_cat_' + id).parent('.owl-item').fadeIn();
                                $('.owl-carousel .owl-stage').css('transform', 'translate3d(0px, 0px, 0px)');
                            }
                        </script>
                        <style>
                            .ori-filer-btn h3{
								padding-top: 50px;
								color: #fff;
								text-align: right;
								font-family: "proxima_nova_rgregular";
							}
                            .ori-filer-btn>div{
								text-align: right;
								padding-top: 20px;
							}
                            .ori-filer-btn .ori_button{
                                background:none;	
								display: inline-block;
								margin-left: 15px;
							}
                            .ori-filer-btn .ori_button.active, .ori-filer-btn .ori_button.hover{
                                background:#61a78b; 
                                color:#fff;
                            }
							.owl-carousel .ori-images{
								position:relative;	
							}
							.owl-carousel .ori-images .ori_price{
							    position: absolute;
								background: #313638;
								font-size: 24px;
								padding: 5px 30px;
								left: 0;
								top: 0;
								color:#fff; 
								font-family: "sfu_futurabold";
							}
							.owl-carousel .ori-images .ori_cat{
							    position: absolute;
								bottom: 5px;
								left: 30px;
							}
							.owl-carousel .ori-images .ori_cat img{
								margin-right:15px;
							}
                            @media (max-width:767px) {
                                .ori-filer-btn h3 {
                                    padding-top:30px !important;
                                    color: #000;
                                }
                                #ori_scroll_ourtour {
                                    top: -200px !important;
                                }
                            }
                            @media (min-width: 768px) and (max-width: 991px) {
                                .ori-filer-btn h3 {
                                    padding-top:80px !important;
                                    color: #000;
                                }
                                
                            }
                        </style>
                    </div>
                </div>
            </div> 
            <?php // var_dump($tour); ?>
            <div class="container">
                <div style="margin-left:-10px;margin-right:-10px; margin-top: 30px;">
                    <div class="owl-carousel">
                        <?php if(!empty($tour)){ foreach($tour as $key=>$val){ ?>
                        <?php $cates = explode(',', $val->category_id);?>
                        <div class="item <?php foreach($cates as $cat){ echo 'ori_cat_'.$cat.' '; }?>">
                            <div class="box-margin">
                                <div class="box-tour">
                                    <div class="ori-images" style="background-image:url(<?=PATH_URL.'media/'.$val->images?>); background-size:cover;"> 
                                        <a href="<?=PATH_URL.$val->links?>">
                                            <img src="<?=PATH_URL?>asset/frontend/images/img-ourtour-water.png">
                                        </a>
                                        <div class="ori_price">
                                        <?php 
						if($val->title=="0"){echo " PRIVATE";}else
									{
										
											echo "$".$val->title;}
									
								?>  
                                     </div>
                                        <div class="ori_cat">
                                            <?php foreach($cates as $cat){ ?>
                                                <?php $cate_img = $this->model->getContent('category', array('id' => $cat), "images"); ?>                                
                                                    <img src="<?=PATH_URL.'media/'.$cate_img->images;?>" style="width:37px" />
                                            <?php } ?>
                                        </div> 
                                    </div>
                                    <article>
                                        <h3><?=$val->name;?></h3>
                                        <p class="comment">Departures <?=$val->keywords;?></p>
                                        <p><?=$val->description;?></p>
                                        <div class="row">
                                            <form action="<?=PATH_URL?>home/add_tour" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="id" value="<?=$val->id;?>" />
                                                <button type="submit" class="center-block gold-btn">book now</button>
                                                <button type="button" class="center-block white-btn" onclick="location.href='<?=PATH_URL.$val->links?>'">view more</button>
                                            </form>
                                        </div>
                                    </article>  
                                </div>
                            </div>
                        </div>
                        <?php }} ?>
                    </div>
                </div>
            </div>
            <div class="container">

            </div>
        </section>

        <style type="text/css">
            .photo-gallery-list .title{
                min-height: 52px;
            }
        </style>
        <section id="video" class="video">
            <div class="container">
                <h1>newest video</h1>
                <img src="<?=PATH_URL?>asset/frontend/images/line.png" class="line-right">
            </div>
            <div class="photo-gallery-list">
            <div class="row">
			<?php if(!empty($newest_video)){ foreach($newest_video as $key=>$val) { ?>    
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="title">
                        <h3><?= stripslashes($val->name) ?></h3>
                    </div> 
                    <div class="photo-item">
                        <div class="img-wrap">
                            <img src="<?=PATH_URL?>asset/frontend/images/img-photo-water.jpg" alt="" class="img-water">
                            <img src="<?=PATH_URL.'media/'.$val->images?>" alt="" class="img">
                        </div>
                        <div class="hover"></div>
                        <div class="content"><h2><?=stripslashes($val->name)?></h2></div>
                        <div class="icon-video"></div>
                        <a href="<?=stripslashes($val->links)?>" class="view video-popup"></a>
                    </div>
                </div>
			<?php }} ?> 
            </div>
        </div>
        </section>
        
        
    </div>
    <section id="blog" class="blog">
        <div class="container">
            <h1>newest blog</h1>
            <img src="<?=PATH_URL?>asset/frontend/images/line.png" class="line-right">
        </div>
		<?php if(!empty($news)){ $i=0; foreach($news as $key=>$val){ $i++;?>
		<?php $cate_name = $this->model->getContent('category', array('id' => $val->category_id), "name$home_lang as name"); ?>
			<?php if($i==2){ ?>
            <div class="row">
                <div class=" col-sm-12 col-md-5  vcenter hidden-sm hidden-xs left">
                    <div class="resume">
                    <h3><?=stripslashes($val->name)?></h3>
                    <p class="comment">Category: <?php echo $cate_name->name; ?></p>
                    <p><?=stripslashes($val->shortcontent)?></p>
                    <div class="row">
                        <div class="">
                            <button class="gold-btn" onclick="location.href='<?=PATH_URL.'blogs/'.$val->links?>'">view more</button>
                        </div>
                    </div>
                </div>
                </div><!--
                --><div class="col-md-7 col-md-push-0 vcenter col-sm-12 ">
                    <img src="<?=PATH_URL.'media/'.$val->images?>">
                </div>
                <div class=" col-sm-12   visible-xs visible-sm  resume">
                    <h3><?=stripslashes($val->name)?></h3>
                    <p class="comment">Category: <?php echo $cate_name->name; ?></p>
                    <p><?=stripslashes($val->shortcontent)?></p>
                    <div class="row">
                        <div class="">
                            <button class="gold-btn" onclick="location.href='<?=PATH_URL.'blogs/'.$val->links?>'">view more</button>
                        </div>
                    </div>
                </div>
            </div>
			<?php }else{ ?>
            <div class="row">
                <div class="col-md-7 col-sm-12 vcenter">
                    <img src="<?=PATH_URL.'media/'.$val->images?>">
                </div><!--
                --><div class=" col-md-5 col-sm-12 vcenter ">
                <div class="resume">
                    <h3><?=stripslashes($val->name)?></h3>
                    <p class="comment">Category: <?php echo $cate_name->name; ?></p>
                    <p><?=stripslashes($val->shortcontent)?></p>
                    <div class="row">
                        <div class="">
                            <button class="gold-btn" onclick="location.href='<?=PATH_URL.'blogs/'.$val->links?>'">view more</button>
                        </div>
                    </div>
                </div>
                </div>
            </div>
			<?php } ?>
        <?php }} ?>
    </section>
    <section id="gallery" class="gallery">
        <div class="container">
            <h1>travel gallery</h1>
            <img src="<?=PATH_URL?>asset/frontend/images/line.png" class="line-right">
            <div class="row">
				<?php if(!empty($travel_gallery)){$i = 0; foreach($travel_gallery as $key=>$val) { ?>    
                <?php $img = $this->model->getListContent('images', "FIND_IN_SET(article_id, '".$val->id."') > 0", null, null, "images"); ?>
                <?php if(!empty($img)){ foreach($img as $ig){ ?>
                <?php $i++;?>
                <?php if($i==1 || $i==2 || $i==3 || $i==5){$aaa = '4';}
						elseif($i==4){$aaa = '8';}
						elseif($i==6){$aaa = '5';}
						else{$aaa = '7';}
				?>
                <div class="col-sm-<?=$aaa;?>">
                    <h3><?php echo $val->name; ?></h3>
                    <img style="height:320px; object-fit:cover;" src="<?=PATH_URL.'media/'.$ig->images?>">
                </div>
				<?php if($i ==7){ break;}?>
                <?php }}}} ?>
            </div>
            <div class="text-center">
                <button class="gold-btn" onclick="location.href='<?=PATH_URL;?>gallery'">view more</button>
            </div>
        </div>
    </section>
	
    <section id="review" class="rew">
        <div class="container">
            <h1>tripadvisor reviews</h1>
            <img src="<?=PATH_URL?>asset/frontend/images/line.png" class="line-right">
            <div class="flexslider">
                <ul class="slides">
				<?php if(!empty($reviews)){ foreach($reviews as $key=>$val) { ?>    
                    <li>
                        <div class="">
                            <h3 class="text-center"><?=stripslashes($val->name)?></h3>
                            <div class="info text-center"><?=stripslashes($val->links)?></div>
                            <div><?=stripslashes($val->content)?></div>
                        </div>
                    </li>
				<?php }} ?>
                </ul>
            </div>
        </div>
    </section>


<script type="text/javascript">
    // $( window ).load(function() {
    //     var popup_status = $('#popup_status').val();
    //     if(popup_status == 1){
    //         $('button.btn-popup').click();
    //         $('.advisor-pop').css('right','0px');
    //         $('.advisor-open').css('right','-50px');
    //     }else{
    //         $('.advisor-pop').css('right','-340px');
    //         $('.advisor-open').css('right','0px');
    //     }
    // });
    $(document).ready(function() {
       $('main').removeAttr('id');
        });

</script>
<script type="text/javascript">
    
</script>