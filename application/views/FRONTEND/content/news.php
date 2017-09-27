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
<div class="faq-page blog-page">
    <div class="container">
        <h1>Newest blog</h1>
        <img src="<?=PATH_URL?>asset/frontend/images/line.png" class="line-right">
        
        <div class="text-center btn-category-wrap">  
            <a href="<?=PATH_URL.$newsall->links?>"><div class="btn-category <?=(!isset($cate))? 'active':'';?>">All blogs</div></a>
            <?php if(!empty($category)){ foreach($category as $key=>$val) {
                if($home_lang != ''){
                    $links = str_replace('en/','en/c/', $val->links);
                }else{
                    $links = 'c/'.$val->links;
                }
                if($val->name != ''){
            ?>    
            <a href="<?=PATH_URL.$links;?>"><div class="btn-category <?=(isset($cate) && $cate->id == $val->id)?'active':'';?>"><?=stripslashes($val->name)?></div></a>
            <?php }}} ?> 
        </div>
        <div class="row">
            <div class="col-lg-9 col-md-8 col-sm-7 col-xs-12">
			<?php if(!empty($news)){ foreach($news as $key=>$val){;?>
                <article class="article">
                    <a href="<?=PATH_URL.'blogs/'.$val->links?>"><img src="<?=PATH_URL.'media/'.$val->images?>" alt="" class="image"></a>
                    <h2><a href="<?=PATH_URL.'blogs/'.$val->links?>"><?php echo $val->name;?></a></h2>
                    <div class="info"><i class="fa fa-calendar"></i> <?php echo date('M d, Y', $val->updated);?></div>
                    <p><?=stripslashes($val->shortcontent)?></p>
                    <div class="text-right"><a href="<?=PATH_URL.'blogs/'.$val->links?>" class="link">CONTINUE READING <img src="<?=PATH_URL?>asset/frontend/images/icon-arrow-right.png" alt=""></a></div>
                </article>
            <?php }} ?>  
            <div class="breadcrums">
                <ul class="breadcrums">
                    <?php echo $pages;?>
                </ul>
            </div>

  
            </div>
            
            <div class="col-lg-3 col-md-4 col-sm-5 col-xs-12">
                <div class="post-block" id="feature-post">
                    <h2>Featured Posts</h2>
                    <img src="<?=PATH_URL?>asset/frontend/images/line.png" class="line-right">
					<?php if(!empty($featuredleft)){ foreach($featuredleft as $key=>$val){;?>
                    <div class="media">
                        <div class="media-left">
                            <a href="<?=PATH_URL.'blogs/'.$val->links?>">
                                <img class="media-object" src="<?=PATH_URL.'media/'.$val->images?>" alt="...">
                            </a>
                        </div>
                        <div class="media-body">
                            <a href="<?=PATH_URL.'blogs/'.$val->links?>"><h4 class="media-heading"><?php echo $val->name;?></h4></a>
                            <p><i class="fa fa-calendar"></i>&nbsp; <?php echo date('M d, Y', $val->updated);?></p>
                        </div>
                    </div>
                    <?php }} ?>
                    
                </div>
                <div class="post-block" id="popular-post">
                    <h2>popular Posts</h2>
                    <img src="<?=PATH_URL?>asset/frontend/images/line.png" class="line-right">
					<?php if(!empty($newsleft)){ foreach($newsleft as $key=>$val){;?>
                    <div class="media">
                        <div class="media-left">
                            <a href="<?=PATH_URL.'blogs/'.$val->links?>">
                                <img class="media-object" src="<?=PATH_URL.'media/'.$val->images?>" alt="...">
                            </a>
                        </div>
                        <div class="media-body">
                            <a href="<?=PATH_URL.'blogs/'.$val->links?>"><h4 class="media-heading"><?php echo $val->name;?></h4></a>
                            <p><i class="fa fa-calendar"></i>&nbsp; <?php echo date('M d, Y', $val->updated);?></p>
                        </div>
                    </div>
                    <?php }} ?>
                </div>
                
            </div>
        </div>
    </div>
</div>
