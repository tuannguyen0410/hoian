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
    <div class="faq-page blog-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="sharethis-block">Share this story: &nbsp; 
						<?php
                        $link =  "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                        $escaped_link = htmlspecialchars($link, ENT_QUOTES, 'UTF-8');
                        ?>
                        <a onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no, menubar=no, scrollbars=yes,resizable=yes,width=600,height=400'); return false;" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $escaped_link; ?>"><img src="<?=PATH_URL?>asset/frontend/images/icon-fb.png" alt=""></a> &nbsp; 
                        <a onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no, menubar=no, scrollbars=yes,resizable=yes,width=600,height=400'); return false;" href="https://twitter.com/home?status=<?php echo $escaped_link; ?>"><img src="<?=PATH_URL?>asset/frontend/images/icon-tw.png" alt=""></a>
                    </div>
                </div>
            </div>
            
            <article class="article">
				<?php $cate_name = $this->model->getContent('category', array('id' => $result->category_id), "name$home_lang as name"); ?>
                <h2><a href="blog-detail.html"><?=stripslashes($result->name)?></a></h2>
                <div class="info"><i class="fa fa-user"></i> Category: <?php echo $cate_name->name; ?> &nbsp;&nbsp;|&nbsp;&nbsp; <i class="fa fa-calendar"></i> <?=date('M d, Y', $result->updated)?></div>
                <p><?=stripslashes($result->shortcontent)?><br><br></p>
                <img src="<?=PATH_URL.'media/'.$result->images?>" alt="" width="100%"><br><br><br>
                <div class=""><?=stripslashes($result->content)?></div>
            </article>

            <div class="post-block" id="feature-post">
                <h2>Featured Posts</h2>
                <img src="<?=PATH_URL?>asset/frontend/images/line.png" class="line-right">
                <div class="feature-post-slider-wrap">
                    <div class="owl-carousel feature-post-slider">
					<?php if(!empty($other)){ foreach($other as $key=>$val) { ?>
					<?php $cat_name = $this->model->getContent('category', array('id' => $val->category_id), "name$home_lang as name"); ?>
                        <div class="item">
                            <div class="post-block-item">
                                <div class="img-wrap">
                                    <img src="<?=PATH_URL?>asset/frontend/images/img-blog-thumb-large-water.jpg" alt="" class="img-water">
                                    <img src="<?=PATH_URL.'media/'.$val->images?>" alt="..." class="img">    
                                </div>
                                <a href="<?=PATH_URL.'blogs/'.$val->links?>"><h4 class="media-heading"><?=$val->name?></h4></a>
                                <div><i class="fa fa-user"></i> <?php echo $cat_name->name; ?> &nbsp;&nbsp;|&nbsp;&nbsp; <i class="fa fa-calendar"></i> <?=date('M d, Y', $val->updated)?></div>
                                <p><?=$val->shortcontent?></p>
                            </div>
                        </div>
                    <?php }} ?>    
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    