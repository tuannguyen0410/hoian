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
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript" src="../saigon/asset/frontend/js/jquery.shorten.js"></script>
    <script language="javascript">
      $(document).ready(function() {
        $(".text-description").shorten();
        $('.show-all').hide();

      });
    </script>


    <?php if(!empty($banner)){ foreach($banner as $key=>$val) { ?>
    <?php if($key == 0){ ?>

    <?php } ?>
    <?php if($key == 1){ ?>

    <?php } ?>
    <?php if($key == 2){ ?>
    <img class="moto1" src="<?=PATH_URL.'media/'.$val->images?>">
    <?php } ?>
    <?php }} ?>
    <button id="ori_scroll_ourtour" style="position: relative; top: -620px;"></button>
    <div id="" class="background-global" style="height: 100%">
      <img class="bg" src="<?=PATH_URL?>asset/frontend/images/bg.png" style="height: 100%">

      <section id="tour" class="tour">
        <div class="container">
          <div class="row">
            <div class="col-md-5 ">
              <?php if(!empty($banner)){ foreach($banner as $key=>$val) { ?>    
              <?php if($key == 2){ ?>
              <h1><?=stripslashes($val->name)?></h1>
              <img src="<?=PATH_URL?>asset/frontend/images/line.png" class="line-right">
              <div class="resume"><?=stripslashes($val->content)?></div>
              <?php } ?>
              <?php }} ?>
            </div>
            <style type="text/css">
              img.moto1 {
                z-index: -1;
                position: relative;
                top: -1px;
                height: 550px;
                width: 100vw;
                object-fit: cover;
              }
              .ori-filer-btn>div{
                padding-top: 215px !important;
              }
              .ori-filer-btn h3{
                position: absolute;
                top: 130px;
                font-weight: bold;
              }
              #ori_scroll_ourtour{
                top: -500px !important;

              }
              a.morelink {
                text-decoration:none;
                outline: none;
              }
              .morecontent span {
                display: none;

              </style>
              <div class="col-md-6 ori-filer-btn col-md-offset-1">

                <div>
                  <h3>PICK UP BY</h3>

                  <button class="center-block white-btn ori_button ori_button all" onclick="ori_filter1('all');" style="'margin-left:0px;':''?>;margin-right: 16px;">All</button>
                  <?php if(!empty($category)){ foreach($category as $key => $val){ ?>
                  <button class="center-block white-btn ori_button ori_button_<?=$val->id;?> btn_cat" onclick="ori_filter(<?=$val->id;?>);" style="<?=$key==0?'margin-left:0px;':''?>"><?=$val->name;?></button>

                  <?php }} ?>

                </div>
                <script>
                  function ori_filter1(id){
               // $('.owl-carousel1').fadeIn();
               $('.show-all').fadeOut();
               $('.all').addClass('active');
               $('.btn_cat').removeClass('active');
             }
           </script>
           <script>
            function ori_filter(id){
             // $('.owl-carousel1').fadeOut();
             $('.show-all').fadeIn();

             $('.ori_button').removeClass('active');

             $('.ori_button_' + id).addClass('active');

             $('.owl-carousel .item').parent('.owl-item').fadeOut(); 
             $('.owl-carousel .ori_cat_' + id).parent('.owl-item').fadeIn();
             $('.owl-carousel .owl-stage').css('transform', 'translate3d(0px, 0px, 0px)');

           }
         </script>
         <style>
          .ori-filer-btn h3{
            padding-top: 50px;
            color: #fff;
            text-align: right;
            font-family: "proxima_nova_rgregular";
          }
          .ori-filer-btn>div{
            text-align: right;
            padding-top: 20px;
          }
          .ori-filer-btn .ori_button{
            background:none;    
            display: inline-block;
            margin-left: 15px;
            margin-top: 15px;
          }
          .ori-filer-btn .ori_button.active, .ori-filer-btn .ori_button.hover{
            background:#61a78b; 
            color:#fff;
          }
          .owl-carousel .ori-images{
            position:relative;  
          }
          .owl-carousel .ori-images .ori_price{
            position: absolute;
            background: #313638;
            font-size: 24px;
            padding: 5px 30px;
            left: 0;
            top: 0;
            color:#fff; 
            font-family: "sfu_futurabold";
          }
          .owl-carousel .ori-images .ori_cat{
            position: absolute;
            bottom: 5px;
            left: 30px;
          }
          .owl-carousel .ori-images .ori_cat img{
            margin-right:15px;
          }
          @media (max-width:767px) {
            .ori-filer-btn h3 {
              padding-top:30px !important;
              color: #000;
            }
            #ori_scroll_ourtour {
              top: -200px !important;
            }
          }
          @media (min-width: 768px) and (max-width: 991px) {
            .ori-filer-btn h3 {
              padding-top:80px !important;
              color: #000;
            }

          }
          .text-description{min-height: 120px;}
          .title{min-height: 52px;}

        </style>
      </div>
    </div>
  </div> 

  <!-- <div class="container">
    <div class="container">

      <div class="row" style="color: #000;">


        <div class="owl-carousel1" style=" margin-top: 100px; margin-bottom: 20px;">
          <?php if(!empty($article)){ foreach($article as $key=>$val){ ?>
          <?php $cates = explode(',', $val->category_id);?>
          <div class="col-md-4" style="margin-top: 20px; margin-bottom: 20px;display: inline-block; ">
            <div class="owl-item" >

              <div class="box-margin">
                <div class="box-tour">
                  <div class="ori-images1" style="background-image:url(<?=PATH_URL.'media/'.$val->images?>); background-size:cover;"> 
                    <a href="<?=PATH_URL.$val->links?>">
                      <img src="<?=PATH_URL?>asset/frontend/images/img-ourtour-water.png">
                    </a>
                    <div class="ori_price1"><?php 
                      if($val->title=="0"){echo " PRIVATE";}else
                      {

                        echo "$".$val->title;}

                        ?>  </div>

                        <div class="ori_cat1">
                          <?php foreach($cates as $cat){ ?>
                          <?php $cate_img = $this->model->getContent('category', array('id' => $cat), "images"); 
                          $cate_name = $this->model->getContent('category', array('id' => $cat), "name");?>      

                          <img src="<?=PATH_URL.'media/'.$cate_img->images;?>" style="width:37px" />
                          <?php } ?>
                        </div> 
                      </div>
                      <article style="min-height: 480px;">
                        <h3><?=$val->name;?></h3>
                        <p class="comment" style="color: #333;">Departures <?=$val->keywords;?></p>

                        <p class="text-description"><?=$val->description;?></p>
                        <div class="row">
                          <form action="<?=PATH_URL?>home/add_tour" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?=$val->id;?>" />
                            <button type="submit" class="center-block gold-btn">book now</button>
                            <button type="button" class="center-block white-btn" onclick="location.href='<?=PATH_URL.$val->links?>'">view more</button>
                          </form>
                        </div>
                      </article>  

                    </div>
                  </div>
                </div>
              </div>
              <?php }} ?>

            </div>
          </div>
        </div>
        <div class="show-all" style="margin-left:-10px;margin-right:-10px;margin-top: 120px; ">
          <div class="owl-carousel">
            <?php if(!empty($article)){ foreach($article as $key=>$val){ ?>
            <?php $cates = explode(',', $val->category_id);?>
            <div class="item <?php foreach($cates as $cat){ echo 'ori_cat_'.$cat.' '; }?>">
              <div class="box-margin">
                <div class="box-tour">
                  <div class="ori-images" style="background-image:url(<?=PATH_URL.'media/'.$val->images?>); background-size:cover;"> 
                    <a href="<?=PATH_URL.$val->links?>">
                      <img src="<?=PATH_URL?>asset/frontend/images/img-ourtour-water.png">
                    </a>
                    <div class="ori_price"><?php 
                      if($val->title=="0"){echo " PRIVATE";}else
                      {

                        echo "$".$val->title;}

                        ?>  </div>
                        <div class="ori_cat">
                          <?php foreach($cates as $cat){ ?>
                          <?php $cate_img = $this->model->getContent('category', array('id' => $cat), "images"); ?>                                
                          <img src="<?=PATH_URL.'media/'.$cate_img->images;?>" style="width:37px" />
                          <?php } ?>
                        </div> 
                      </div>
                      <article>
                       <div class="title"> <h3><?=$val->name;?></h3></div>
                       <p class="comment">Departures <?=$val->keywords;?></p>
                       <p class="text-description"><?=$val->description;?></p>
                       <div class="row">
                        <form action="<?=PATH_URL?>home/add_tour" method="post" enctype="multipart/form-data">
                          <input type="hidden" name="id" value="<?=$val->id;?>" />
                          <button type="submit" class="center-block gold-btn">book now</button>
                          <button type="button" class="center-block white-btn" onclick="location.href='<?=PATH_URL.$val->links?>'">view more</button>
                        </form>
                      </div>
                    </article>  
                  </div>
                </div>
              </div>
              <?php }} ?>
            </div>
          </div>
        </div> -->
        <div style="margin-top: 100px;"></div>
        <div class="box-tour">
          <div class="tour-banner">
            <img src="https://localhost/saigon/media/screen-shot-2017-09-22-at-9-81.png">
            <div class="banner-title">
              <h1>The Real Vietnam</h1>
              <h2 class="line3"></h2>
              <p class="banner-des">
                See Hoi An as the locals do with our Rural Village Experience. Relax as we bring you through breathtaking countryside and waterways while stopping to see families &amp; their crafts.See Hoi An as the locals do with our Rural Village Experience. Relax as we bring you through breathtaking countryside and waterways while stopping to see families &amp; their crafts.See Hoi An as the locals do with our Rural Village Experience. Relax as we bring you through breathtaking countryside and waterways while stopping to see families &amp; their crafts.

              </p>
            </div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <h3 class="content-title">Rural Villages Experience – Hoi An, Central Vietnam</h3>
            </div>
            <div class="col-md-6">
              <div class="content-tour">
               <span class="content-time">Tour Runs Daily 1:30pm – 5:00pm</span>

               <p class="content-text">Rural Villages Experience – Hoi an: Experience local life in the slow lane.

                Setting off from Café Zoom in Hoi An, we head out west along the banks of the Thu Bon River, first stopping at a bustling local fish market before heading into the rice paddy rich countryside and local villages, stopping to meet a local family producing local rice crackers. Crossing a bridge over the Thu Bon River takes us through more quiet villages and then into beautiful farmlands, where we take a break for a local speciality dish while surrounded by seasonal vegetables in the picturesque fields of corn, eggplants, sweet potatoes, cucumbers, and herbs (location is seasonal).

                As the sun starts to go down, we set off through the rice paddies, passing duck farms, visit a local mat weaving family and then ride along by the prawn farms and over the river to visit a charming family home where they produce the local & potent favourite brew – rice wine. It’s then a short ride over the Cam Kim Bridge into Hoi An as the sun begins to set on this beautiful heritage town.


                Highlights – local fish market, zooming through the countryside, rice cracker family, local food on tour, mat weaving family, home rice wine distillery.</p>
              </div>
            </div>

            <div class="col-md-6">
             <p class="content-text"> Rural Villages Experience – Hoi an: Experience local life in the slow lane.

              Setting off from Café Zoom in Hoi An, we head out west along the banks of the Thu Bon River, first stopping at a bustling local fish market before heading into the rice paddy rich countryside and local villages, stopping to meet a local family producing local rice crackers. Crossing a bridge over the Thu Bon River takes us through more quiet villages and then into beautiful farmlands, where we take a break for a local speciality dish while surrounded by seasonal vegetables in the picturesque fields of corn, eggplants, sweet potatoes, cucumbers, and herbs (location is seasonal).

              As the sun starts to go down, we set off through the rice paddies, passing duck farms, visit a local mat weaving family and then ride along by the prawn farms and over the river to visit a charming family home where they produce the local & potent favourite brew – rice wine. It’s then a short ride over the Cam Kim Bridge into Hoi An as the sun begins to set on this beautiful heritage town.


              Highlights – local fish market, zooming through the countryside, rice cracker family, local food on tour, mat weaving family, home rice wine distillery.
            </p>
          </div>

          

        </div>
      </div>



      
    </section>

    <section id="review" class="rew" style="margin-top: 100px;">
      <div class="container">
        <h1>tripadvisor reviews</h1>
        <img src="<?=PATH_URL?>asset/frontend/images/line.png" class="line-right">
        <div class="flexslider">
          <ul class="slides">
            <?php if(!empty($reviews)){ foreach($reviews as $key=>$val) { ?>    
            <li>
              <div class="">
                <h3 class="text-center"><?=stripslashes($val->name)?></h3>
                <div class="info text-center"><?=stripslashes($val->links)?></div>
                <div><?=stripslashes($val->content)?></div>
              </div>
            </li>
            <?php }} ?>
          </ul>
        </div>
      </div>
    </section>

    <style>
      .ori-filer-btn h3{
        padding-top: 50px;
        color: #fff;
        text-align: right;
        font-family: "proxima_nova_rgregular";
      }
      .ori-filer-btn>div{
        text-align: right;
        padding-top: 20px;
      }
      .ori-filer-btn .ori_button{
        background:none;    
        display: inline-block;
        margin-left: 15px;
      }
      .ori-filer-btn .ori_button.active, .ori-filer-btn .ori_button.hover{
        background:#61a78b; 
        color:#fff;
      }
      .owl-carousel1 .ori-images1{
        position:relative;  
      }
      .owl-carousel1 .ori-images1 .ori_price1{
        position: absolute;
        background: #313638;
        font-size: 24px;
        padding: 5px 30px;
        left: 0;
        top: 0;
        color:#fff; 
        font-family: "sfu_futurabold";
      }
      .owl-carousel1 .ori-images1 .ori_cat1{
        position: absolute;
        bottom: 5px;
        left: 30px;
      }
      .owl-carousel1 .ori-images1 .ori_cat1 img{
        margin-right:15px;
      }
      @media (max-width:767px) {
        .ori-filer-btn h3 {
          padding-top:30px !important;
          color: #000;
        }
        #ori_scroll_ourtour {
          top: -200px !important;
        }
      }
      @media (min-width: 768px) and (max-width: 991px) {
        .ori-filer-btn h3 {
          padding-top:50px !important;
          color: #000;
        }

      }


    </style>
  </div>
