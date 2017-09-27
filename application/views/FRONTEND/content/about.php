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
    <?php if(!empty($banner)){ foreach($banner as $key=>$val) { ?>
    <section class="banner-about section-banner" style="background-image: url(<?=PATH_URL.'media/'.$val->images?>);    margin: -1px 0 0 0;">
        <div class="container">
            <h2><?=stripslashes($val->name)?></h2>
            <h2><strong><?=stripslashes($val->links)?></strong></h2>
            <h2><img class="line-center" src="<?=PATH_URL?>asset/frontend/images/line.png">
            </h2>
            <div class="text-center"><?=stripslashes($val->content)?></div>
        </div>
    </section>
    <?php }} ?>
    <div id="aboutus" class="section-aboutus">
        <div class="container">
            <h1>FOUNDER</h1>
            <img src="<?=PATH_URL?>asset/frontend/images/line.png" class="line-right">
            <?php if(!empty($founder)){ foreach($founder as $key=>$val) { ?>
                <?php if($key==0){ ?>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-5">
                        <div class="image">
                            <img src="<?=PATH_URL.'media/'.$val->images?>" alt="" class="image">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-7 ourhistory-text">
                        <h2><i class="<?=stripslashes($val->links)?>"></i> <?=stripslashes($val->name)?></h2>
                        <div><?=stripslashes($val->content)?></div>
                    </div>
                </div>
                <?php } ?>
                <?php if($key==1){ ?>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-5 standard-text">
                        <h2><i class="<?=stripslashes($val->links)?>"></i> <?=stripslashes($val->name)?></h2>
                        <div><?=stripslashes($val->content)?></div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-7">
                        <img src="<?=PATH_URL.'media/'.$val->images?>" alt="">
                    </div>
                </div>
                <?php } ?>
            <?php }} ?>
        </div>
    </div>
    <?php if(!empty($featured)){ foreach($featured as $key=>$val) { ?>
        <?php if($key==0){ ?>
        <div id="officestaff" class="section-officestaff" style="background-image:url(<?=PATH_URL.'media/'.$val->images?>);">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                        <h1><?=stripslashes($val->name)?></h1>
                        <img src="<?=PATH_URL?>asset/frontend/images/line.png" class="line-right">
                        <div><?=stripslashes($val->content)?></div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    <?php }} ?>
    <div id="about-avatar-1" class="about-avatar-wrap showall-about-avatar">
        <div class="container">
            <div class="row">
                <?php if(!empty($team1)){ foreach($team1 as $key=>$val) { ?>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="max-height: 290px;">
                    <div class="about-block-1 text-center large" <?=($key>5)? ' style="display:none;"':'';?>>
                        <img src="<?=PATH_URL.'media/'.$val->images?>" alt="">
                        <h2><?=stripslashes($val->name)?></h2>
                        <h3><?=stripslashes($val->links)?></h3>
                    </div>
                </div>
                <?php }} ?>
                <div class="clearfix"></div>
                <div class="text-center">
                    <a href="javascript:;" class="link-viewall gold-btn">View all</a>   
                </div>
            </div>
        </div>
    </div>
    <?php if(!empty($featured)){ foreach($featured as $key=>$val) { ?>
        <?php if($key==1){ ?>
        <div id="tourguide" class="section-officestaff" style="background-image:url(<?=PATH_URL.'media/'.$val->images?>);">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" >
                        <h1><?=stripslashes($val->name)?></h1>
                        <img src="<?=PATH_URL?>asset/frontend/images/line.png" class="line-right">
                        <div><?=stripslashes($val->content)?></div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    <?php }} ?>
    <div id="about-avatar-2" class="about-avatar-wrap showall-about-avatar">
        <div class="container">
            <div class="row about-block-1-list">
                <?php if(!empty($team2)){ foreach($team2 as $key=>$val) { ?>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" style="max-height: 290px;">
                    <div class="about-block-1 text-center large" <?=($key>5)? ' style="display:none;"':'';?>>
                        <img src="<?=PATH_URL.'media/'.$val->images?>" alt="">
                        <h2><?=stripslashes($val->name)?></h2>
                        <h3><?=stripslashes($val->links)?></h3>
                    </div>
                </div>
                <?php }} ?>
                <div class="clearfix"></div>
                <div class="text-center">
                    <a href="javascript:;" class="link-viewall gold-btn">View all</a>   
                </div>
            </div>
        </div>
    </div>
    <div id="ourvehicle" class="section-ourvehicle">
        <div class="container">
            <h1>Our Vehicle</h1>
            <img src="<?=PATH_URL?>asset/frontend/images/line.png" class="line-right">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                    <img src="<?=PATH_URL?>asset/frontend/images/img-ourvehicle.png" alt="" class="image">
                </div>
                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <?php if(!empty($vehicle)){ foreach($vehicle as $key=>$val) { ?>
                    <h2><i class="<?=stripslashes($val->links)?>"></i> <?=stripslashes($val->name)?></h2>
                    <div><?=stripslashes($val->content)?></div>
                    <br>
                    <?php }} ?>
                </div>
            </div>
        </div>
    </div>
    