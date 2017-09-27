

<header id="mtsa">
    <div class="col-md-6 col-sm-12 supp1">
                    Hotline : <a href="tel:<?=$setting?stripslashes($setting->phone):""?>"> <?=$setting?stripslashes($setting->phone):""?></a>
                </div>
    <div id="top" class="container">
        <div class="row">
            <div class="col-md-3 col-sm-4 col-xs-6 logo">



                <a href="<?=PATH_URL.str_replace("_","",$home_lang)?>"><img class="center-block" src="<?=PATH_URL.'media/'.$setting->images?>"></a>
            </div>
            <div class="col-md-7 col-sm-5 hidden-xs">
                <div class="col-md-6 col-sm-12 supp">
                    Hotline : <a href="tel:<?=$setting?stripslashes($setting->phone):""?>"> <?=$setting?stripslashes($setting->phone):""?></a><br>
                    <a href="http://hoianadventure.com/">OUR HOI AN TOUR</a>
                </div>
                <div class="col-md-6 col-sm-12 social">
                    <p>like us on: </p>
                    <a href="<?=$setting?$setting->facebook_url:""?>"> <img src="<?=PATH_URL?>asset/frontend/images/fb.png"></a>
                    <a href="<?=$setting?$setting->twitter_plus:""?>"> <img src="<?=PATH_URL?>asset/frontend/images/twitter.png"></a>
                    <a href="<?=$setting?$setting->youtube_url:""?>"> <img src="<?=PATH_URL?>asset/frontend/images/yt.png"></a>
                    <a href="https://www.tripadvisor.com/Attraction_Review-g293925-d8599407-Reviews-Saigon_Adventure-Ho_Chi_Minh_City.html"><img src="<?=PATH_URL?>asset/frontend/images/tripadvisor.png"></a>
                </div>
            </div>
            <div class="col-md-2 col-sm-3 butt hidden-xs">
                <form action="http://saigonadventure.com/home/add_tour" method="post" enctype="multipart/form-data">
          
             <input type="hidden" name="id" value="67">              
               <button class="center-block gold-btn" onclick="location.href='<?=PATH_URL?>booking'">book now</button>
                    
            </form>
            </div>
        </div>
    </div>
    <nav>
        <ul class="center-block hidden-xs">
			<?php if(!empty($menu)) { ?>
                <?=$this->model->getMenuTop('category', array('parent_id' => 0, 'status' => 1, 'type' => 'menu'),$home_lang, "name$home_lang as name, id, links$home_lang as links, category_id")?>
            <?php } ?>
        </ul>
    </nav>
    <nav class=" visible-xs ">

        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>


        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
				<?php if(!empty($menu)) { ?>
                    <?=$this->model->getMenuTop('category', array('parent_id' => 0, 'status' => 1, 'type' => 'menu'),$home_lang, "name$home_lang as name, id, links$home_lang as links, category_id")?>
                <?php } ?>
    
                <li class="social">
                    <a href="<?=$setting?$setting->facebook_url:""?>"> <img src="<?=PATH_URL?>asset/frontend/images/fb.png"></a>
                    <a href="<?=$setting?$setting->twitter_plus:""?>"> <img src="<?=PATH_URL?>asset/frontend/images/twitter.png"></a>
                    <a href="<?=$setting?$setting->youtube_url:""?>"> <img src="<?=PATH_URL?>asset/frontend/images/yt.png"></a>
                    <a href="https://www.tripadvisor.com/Attraction_Review-g293925-d8599407-Reviews-Saigon_Adventure-Ho_Chi_Minh_City.html"><img src="<?=PATH_URL?>asset/frontend/images/tripadvisor.png"></a>
                </li>
            </ul>

        </div><!-- /.navbar-collapse -->
    </nav>
    
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-89007732-2', 'auto');
  ga('send', 'pageview');

</script>
</header>
<script type="text/javascript">
    $('.navbar-nav>li>a').on('click', function() {
        $('.navbar-toggle').click();
    });
</script>

