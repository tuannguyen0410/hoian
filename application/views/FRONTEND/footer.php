    
<footer>
    <div class="top-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-7 col-xs-12 ">
                    <h5><?=$setting?stripslashes($setting->owner_company):""?></h5>

                    <p><strong>Email:</strong> <?=$setting?stripslashes($setting->email):""?></p>

                    <p><strong>Phone:</strong> <?=$setting?stripslashes($setting->phone):""?></p>

                    <p><strong>Hotline:</strong> <?=$setting?stripslashes($setting->owner_address):""?></p>

                    <p><strong>Address:</strong> <?=$setting?stripslashes($setting->address):""?></p>
                </div>
                <div class="col-md-3 col-md-push-1 col-sm-5 col-sm-push-0 col-sm-push-0 col-xs-12">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <h5>SITE MAP </h5>
                        </div>
                        <ul style="columns: 2;-webkit-columns: 2;-moz-columns: 2; margin-left: 0;padding-left: 15px;">
                            <?php if(!empty($menu)) { ?>
                            <?=$this->model->getMenuTop('category', array('parent_id' => 0, /*'status' => 1,*/ 'type' => 'menu'),$home_lang, "name$home_lang as name, id, links$home_lang as links, category_id")?>
                            <?php } ?>
                            <li><a href="<?=PATH_URL?>booking">Book now</a></li>
                            <li><a href="<?=PATH_URL?>rss">RSS</a></li>
                        </ul>
                    </div>
                </div>
                <div class="facebook-box col-md-3 col-md-push-2 col-sm-push-3 col-sm-6 col-xs-10 col-xs-push-1">
                	<div class="fb-page" data-href="<?=$setting?$setting->facebook_url:""?>" data-small-header="false" data-width="500" data-adapt-container-width="true" data-show-posts="false" data-hide-cover="false" data-show-facepile="true"></div>      
                </div>
            </div>
            <div class="scroll-top pull-right">
                <img src="<?=PATH_URL?>asset/frontend/images/go-top.png">
            </div>
        </div>
    </div>
    
    

    <div class="bottom-footer">
        <div class="container">
         <div class="row">
            <div class="col-md-5 center-block col-sm-6 col-lg-4 col-xs-12">
                <p>Copyright © 2016 - All rights reserved by saigonadventure.com.</p></div>
                <div class="col-md-5 center-block col-sm-6 col-lg-4 col-xs-12">
                    <p> Powered by <?=$setting?stripslashes($setting->owner_company):""?></p></div>
                </div>
            </div>

        </div>


    </footer>

<!--Start of Tawk.to Script-->
 <script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/59b9f5054854b82732fefe9b/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->


   <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.7";
      fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>
 <!--     <style>
        #cfacebook{position:fixed;bottom:0px;right: 40px;z-index:999999999999999;width:250px;height:auto;box-shadow:6px 6px 6px 10px rgba(0,0,0,0.2);border-top-left-radius:5px;border-top-right-radius:5px;overflow:hidden;}#cfacebook .fchat{float:left;width:100%;height:270px;overflow:hidden;display:none;background-color:#fff;}#cfacebook .fchat .fb-page{margin-top:-130px;float:left;}#cfacebook a.chat_fb{float:left;padding:0 25px;width:250px;color:#fff;text-decoration:none;height:40px;line-height:40px;text-shadow:0 1px 0 rgba(0,0,0,0.1);background-image:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAAqCAMAAABFoMFOAAAAWlBMV…8/UxBxQDQuFwlpqgBZBq6+P+unVY1GnDgwqbD2zGz5e1lBdwvGGPE6OgAAAABJRU5ErkJggg==);background-repeat:repeat-x;background-size:auto;background-position:0 0;background-color:#3a5795;border:0;border-bottom:1px solid #133783;z-index:9999999;margin-right:12px;font-size:18px;}#cfacebook a.chat_fb:hover{color:#61a78b;text-decoration:none;}
        @media (max-width: 320px)
        {
          #cfacebook{right: 55px;}
      }
  </style>
  <script>
    jQuery(document).ready(function () {
      jQuery(".chat_fb").click(function() {
        jQuery('.fchat').toggle('slow');
    });
  });
</script>
<div id="cfacebook">
    <a href="javascript:;" class="chat_fb" onclick="return:false;"><i class="fa fa-facebook-square"></i>Chat With Us</a>
    <div class="fchat">
      <div class="fb-page" data-tabs="messages" data-href="https://www.facebook.com/123cheers/?fref=ts" data-width="250" data-height="400" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="false"></div>
  </div>
</div> -->