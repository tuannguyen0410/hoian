    <div class="container">
        <div class="row">
                <div class="breadcrumb-blk">
                    <ul>
                        <li><a href="<?=PATH_URL?>"><i class="fa fa-home"></i>Home</a></li>
                        <li ><a  href="<?=PATH_URL.$title->links?>"><?=$title->name; ?></a></li>
                         <li ><a  href="<?=PATH_URL.$title->links.'/'.$result->links?>"><?=$result->name; ?></a></li>
                    </ul>

                </div>
            </div>
        
    </div>
    <section class="banner" style="background-image:url(<?=PATH_URL.'media/'.$result->images?>);">
        <div class="container">
            <h2>let your life be an </h2>
            <h2><strong>adventure</strong></h2>
            <h2><img class="line-center" src="<?=PATH_URL?>asset/frontend/images/line.png"></h2>
            <p class="text-center" style="font-size:18px;"><?=stripslashes($result->description)?></p>
        </div>
    </section>
    <section id="sgstreetfoodtour" class="sgstreetfoodtour">

        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12">
                    <h1><?=stripslashes($result->name)?></h1>
                    <img src="<?=PATH_URL?>asset/frontend/images/line.png" class="line-right">
                    <div class="ourtour-form">
                        <form action="<?=PATH_URL?>home/add_tour" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-9 col-md-8 col-sm-12 col-xs-12">
                                    <div class="time">TIME: <span>Departures <?=stripslashes($result->keywords)?></span></div>
									<?php $cates = explode(',', $result->category_id);?>

                                    <div class="car">TRANSPORTATION: <span>
										<?php foreach($cates as $cat){ ?>
                                        	<?php $cate_name = $this->model->getContent('category', array('id' => $cat), "name"); ?>
                                            <?=$cate_name->name;?>, 
                                        <?php } ?>

                                    </span></div>
                                    <div class="service">OPTIONAL SERVICES: <span>
                                    
                                    
                                    
                                        <?php if(number_format($result->title)==0)
                                       {
										  echo"PRIVATE";
										   }
										  else{
											  ?>
                                              
                                              Private Tour add $<?=$setting?stripslashes($setting->price_plus):""?> per person
                                              <?php 
											  
											  }
									   ?>
                                    
                                    </span></div>

<!--                                    <div class="row">
                                        <div class="col-lg-5 col-md-12 col-sm-12">
                                            <div class="car">TRANSPORTATION:</div>
                                        </div>
                                        <div class="col-lg-2 col-lg-push-0 col-md-3 col-md-push-1 col-sm-3 col-sm-push-1 col-xs-12 col-xs-push-1">
                                            <label class="checkbox"><input type="radio" name="transportation"><i class="icon"></i> Cyclo</label>
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12 col-xs-push-1">
                                            <label class="checkbox"><input type="radio" name="transportation"><i class="icon"></i> Motobike</label>
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-sm-2 col-xs-12 col-xs-push-1">
                                            <label class="checkbox"><input type="radio" name="transportation"><i class="icon"></i> Taxi</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-5 col-md-12 col-sm-12">
                                            <div class="service">OPTIONAL SERVICES:</div>
                                        </div>
                                        <div class="col-lg-6 col-lg-push-0 col-md-12 col-md-push-1 col-sm-6 col-sm-push-1 col-xs-12 col-xs-push-1">
                                            <label class="checkbox"><input type="radio" name="service"><i class="icon"></i> Private Tour add $30 per person</label>
                                            <label class="checkbox"><input type="radio" name="service"><i class="icon"></i> Video Tour add $35 per person</label>
                                        </div>
                                    </div>-->
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
                                    <div class="price-block">
                                     
                                        <?php if(number_format($result->title)==0)
                                       {

?>
                                         <div class="price"><span class="usd">
                                         PRIVATE
                                         </span>
                                         </div>

                                            <?php

                                        }

                                        
                                          else  

                                      {
                                            ?>


   <div class="price"><span class="usd">
                                        $<?php echo number_format($result->title);?></span><br>or <span><?php echo number_format(($result->title)*($setting->usd_to_vnd));?>VND</span></div>


                                         <?php   } ?>
                                        <input type="hidden" name="id" value="<?=$result->id;?>" />
                                        <button type="submit" class="center-block gold-btn">book now</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>  
                </div>
            </div>
        </div>


    </section>
    <div>
        <div class="container">
            <h1>ITINERARY</h1>
            <img src="<?=PATH_URL?>asset/frontend/images/line.png" class="line-right">
            <div class="row">
                <div class="col-lg-8 col-md-9">
                    <?php 
                        echo str_replace("\\", "", $result->shortcontent);
                    ?>
                </div>
            </div>
            
            <h1>INCLUDED</h1>
            <img src="<?=PATH_URL?>asset/frontend/images/line.png" class="line-right">
            <div class="row">
                <div class="col-lg-6 col-md-8">
                    <?php 
                        echo str_replace("\\", "", $result->content);                       
                    ?>
                </div>
            </div>

        </div>
    </div>
    <section id="gallery" class="gallery" style="background:#fff;">
        <div class="container">
            <h1>MEMORIES OF TOUR</h1>
            <img src="<?=PATH_URL?>asset/frontend/images/line.png" class="line-right">
            <div class="row">
                <?php $img = $this->model->getListContent('images', "FIND_IN_SET(article_id, '".$result->id."') > 0", null, null, "images"); ?>
                <?php $i=0; ?> 
                <?php if(!empty($img)){ foreach($img as $ig){ ?>
                <?php $i++;?>
                <?php if($i==1 || $i==2 || $i==3 || $i==5){$aaa = '4';}
						elseif($i==4){$aaa = '8';}
						elseif($i==6){$aaa = '5';}
						else{$aaa = '7';}
				?>
                <div class="col-sm-<?=$aaa;?>">
                    <img style="height:320px; object-fit:cover;" src="<?=PATH_URL.'media/'.$ig->images?>">
                </div>
				<?php if($i == 7){ $i=0;} ?>
                <?php }} ?>
            </div>
<!--            <div class="col-sm-2 col-sm-push-5">
                <button class="gold-btn">book now</button> 
            </div>
-->        </div>
    </section>
