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
    <div class="faq-page">
        <div class="container">
            <h1>FAQs</h1>
            <img src="<?=PATH_URL?>asset/frontend/images/line.png" class="line-right">

            <div class="panel-group faq-list" id="accordion" role="tablist" aria-multiselectable="true">
			<?php if(!empty($result)){ foreach($result as $key=>$val) { ?>    
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="heading-<?=$key;?>">
                        <h4 class="panel-title">
                            <a class="<?=($key == 0)? '':'collapsed';?>" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-<?=$key;?>" aria-expanded="false" aria-controls="collapse-<?=$key;?>">
                                <i class="icon-faq"></i><?=stripslashes($val->name)?>
                            </a>
                        </h4>
                    </div>
                    <div id="collapse-<?=$key;?>" class="panel-collapse collapse <?=($key == 0)? 'in':'';?>" role="tabpanel" aria-labelledby="heading-2">
                        <div class="panel-body"><?=stripslashes($val->content)?></div>
                    </div>
                </div>
			<?php }} ?> 
            </div>

        </div>
    </div>
    