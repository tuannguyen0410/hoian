    <div class="container">
        <div class="row">
                <div class="breadcrumb-blk">
                    <ul>
                        <li><a href="<?=PATH_URL?>"><i class="fa fa-home"></i>Home</a></li>
                        <li ><a  href="<?=PATH_URL.$title->links?>"><?=$title->name; ?></a></li>
                    </ul>

                </div>
            </div>
        
    </div>
    <div class="faq-page gallery-page">

        
        
        <div class="container">
            <h1>VIDEO GALLERY</h1>
            <img src="<?=PATH_URL?>asset/frontend/images/line.png" class="line-right">
        </div>
        <div class="photo-gallery-list">
            <div class="row">
			<?php if(!empty($resultvideo)){ foreach($resultvideo as $key=>$val) { ?>    
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div style="min-height: 52px;"><h3 class="text-center" style="min-height: 78px;"><?= stripslashes($val->name) ?></h3></div>
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
                <div class="container">
            <h1>PHOTO GALLERY</h1>
            <img src="<?=PATH_URL?>asset/frontend/images/line.png" class="line-right">
        </div>
        <div class="photo-gallery-list photo-gallery">
            <div class="row">
			<?php if(!empty($result)){ foreach($result as $key=>$val) { ?>    
			<?php $img = $this->model->getListContent('images', "FIND_IN_SET(article_id, '".$val->id."') > 0", null, null, "images"); ?>
			<?php if(!empty($img)){ foreach($img as $ig){ ?>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div>
                        <h3 class="text-center" ><?= stripslashes($val->name) ?></h3>
                    </div>
                    <div class="photo-item">
                        <div class="img-wrap">
                            <img src="<?=PATH_URL?>asset/frontend/images/img-photo-water.jpg" alt="" class="img-water">
                            <img src="<?=PATH_URL.'media/'.$ig->images?>" alt="" class="img">
                        </div>
                        <div class="hover"></div>
                        <div class="content"><?=stripslashes($val->name)?></div>
                        <a href="<?=PATH_URL.'media/'.$ig->images?>" class="view" title="<?=stripslashes($val->name)?>"></a>
                    </div>
                </div>
			<?php }}}} ?> 
            </div>
        </div>
        <br><br>
    </div>

    