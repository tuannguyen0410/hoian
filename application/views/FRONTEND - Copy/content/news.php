<?php 
//print_r($this->session->userdata('link_mutilang')); exit();
?>
    <!-- Slide -->
    <section class="slide-top">
		<?php if(!empty($banner)){ foreach($banner as $key=>$val) { ?>    
                <img src="<?=PATH_URL.'media/'.$val->images?>">
		<?php break; }} ?>
    </section>
    <!-- End Slide -->
    
    <section class="home-news page-news">
		<div class="container">
        	<div class="row title">
                <div class="col-lg-12 col-md-12">
                    <h1><?= (!isset($_GET['s']))? @_tin_tuc_noi_bat:@_tim_kiem.': '.$_GET['s'];?></h1>
                    <hr class="title-hr" />
                </div>
			</div>
            <div class="row">
            	<div class="col-lg-9 col-md-9 content">
                	<ul class="category">
                        <li <?=(!isset($cate))? 'class="active"':'';?>><a href="<?=PATH_URL.$newsall->links?>"><?=@_tat_ca?></a></li>
						<?php if(!empty($category)){ foreach($category as $key=>$val) {
							if($home_lang != ''){
								$links = str_replace('en/','en/c/', $val->links);
							}else{
								$links = 'c/'.$val->links;
							}
							if($val->name != ''){
						?>    
                        <li <?=(isset($cate) && $cate->id == $val->id)?'class="active"':'';?>><a href="<?=PATH_URL.$links;?>"><?=stripslashes($val->name)?></a></li>
                        <?php }}} ?> 
                    </ul>
                    <div class="row">
					<?php if(!empty($news)){ foreach($news as $key=>$val){;?>
                    <?php $cate_name = $this->model->getContent('category', array('id' => $val->category_id), "name$home_lang as name"); ?>
                        <div class="list">
                            <a class="imgview" href="<?=PATH_URL.$val->links?>">
                                <div class="image" style="background-image:url('<?=PATH_URL.'media/'.$val->images?>');">
                                    <img src="<?=PATH_URL?>asset/frontend/images/bpnews.png" style="width:100%"/>
                                    <div class="img-overlay"></div>
                                </div>
                            </a>
                            <div class="meta">
                                <div>
                                    <h3><a href="<?=PATH_URL.$val->links?>"><?=stripslashes($val->name)?></a></h3>
                                    <h5><?php echo $cate_name->name;?></h5>
                                    <p><?=stripslashes($val->shortcontent)?></p>
                                    <a href="<?=PATH_URL.$val->links?>" class="viewmore"><?=@_xem_them?></a>
                                </div>
                            </div>
                        </div>
					<?php }} ?>
                    </div>
                	<div class="breadcrums">
                        <ul class="breadcrums">
							<?php echo $pages;?>
                        </ul>
                    </div>

                </div>
                <div class="col-lg-3 col-md-3 sidebar">
                	<div class="list-news">
                		<h3><?=@_tin_trong_thang;?></h3>
						<?php if(!empty($newsleft)){ foreach($newsleft as $key=>$val){;?>
                        <div class="list">
                            <div class="thumb" style="background-image:url('<?=PATH_URL.'media/'.$val->images?>');">
                                <img src="<?=PATH_URL?>asset/frontend/images/btnews.png" style="width:100%"/>
                            </div>
                            <div class="descrip">
                            	<p><?php echo $val->name;?></p>
                                <a href="<?=PATH_URL.$val->links?>"><?=@_xem_them?> <i class="fa fa-chevron-circle-right"></i></a>
                            </div>
                        </div>
                        <hr />
						<?php }} ?>
                    </div>
                </div>
            </div>
		</div>
	</section> 
	
