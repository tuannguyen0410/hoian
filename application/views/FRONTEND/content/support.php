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
        <h1>Promotion</h1>
        <img src="<?=PATH_URL?>asset/frontend/images/line.png" class="line-right">
        
        <div class="text-center btn-category-wrap">  

           <div class="row">
                <div class="col-md-12" style="text-align: left;">
            <?php if(!empty($result)){ foreach($result as $key=>$val) { ?>    
                <div class="media">
                   
                    <div class="media-body"><?=stripslashes($val->content)?></div>
                </div>
            <?php }} ?>
            </div>
            
        </div>
