<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Google-->
    <script src="https://apis.google.com/js/api:client.js"></script>
    <link rel="icon" type="image/png" href="<?=PATH_URL?>asset/frontend/images/favicon.png">

    <title><?=$title?$title:""?></title>
    <meta name="description" content="<?=$description?$description:""?>" />
    <meta name="keywords" content="<?=$keywords?$keywords:""?>" />
    <meta itemprop="image" content="<?=$meta_image?$meta_image:""?>" />
    <meta name="google-site-verification" content="S3_KdKcB__RIpjmbNg3qJ1Slezv0Ivzx1bgoEZ82AG4" />
    <meta property="og:image" content="<?=$meta_image?$meta_image:""?>" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="<?=$title?$title:""?>" />
    <meta property="og:description"   content="<?=$description?$description:""?>" />
    <?php  
    $protocol = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
    $base_url = $protocol . "://" . $_SERVER['HTTP_HOST'];
    $complete_url =   $base_url . $_SERVER["REQUEST_URI"];
    ?>
    <!-- Bootstrap -->
    <link href="<?=PATH_URL?>asset/frontend/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=PATH_URL?>asset/frontend/css/animate.css" rel="stylesheet">
    <link rel="canonical" href="<?=$complete_url; ?>" />
    <!--Fonts-->
    <link rel="stylesheet" href="<?=PATH_URL?>asset/frontend/fonts/fonts.css" type="text/css" charset="utf-8">
    <link href='https://fonts.googleapis.com/css?family=Raleway:300,500,600,700,400,800' rel='stylesheet'
    type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300italic,600' rel='stylesheet'
    type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    
    <!-- flex slider -->
    <link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.5.0/flexslider.min.css' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?=PATH_URL?>asset/frontend/js/magnific-popup-master/magnific-popup.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

    <link href="<?=PATH_URL?>asset/frontend/css/style.css" rel="stylesheet">
    <link href="<?=PATH_URL?>asset/frontend/css/ori_style.css" rel="stylesheet">
    <link href="<?=PATH_URL?>asset/frontend/css/owl.carousel.css" rel="stylesheet">


    <link href="<?=PATH_URL?>asset/frontend/css/ourtour.css" rel="stylesheet">
    <link href="<?=PATH_URL?>asset/frontend/css/slider.css" rel="stylesheet">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

    <script type="text/javascript" src="https://code.jquery.com/jquery-2.2.3.min.js"></script>
    <!--     <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script> -->
</head>
<style type="text/css">
    .fontdt{display: none;}

</style>
<body class="has-pop-top">
    <?php
    $banner_all = $this->model->getListContent('article', "FIND_IN_SET(category_id, 11) > 0 AND status = 1 AND type = 'banner'",'order_by asc', 1, null, "name$home_lang as name, content$home_lang as content, links$home_lang as links, images");
    ?>
    <?php if(!empty($banner_all)){ foreach($banner_all as $key=>$val) { ?>    
    <div class="pop-top hidden-xs ori-banner-all-top">
        <div class="container">
            <div class="content">

                <form action="http://saigonadventure.com/home/add_tour" method="post" enctype="multipart/form-data">
                    <?=stripslashes($val->name)?>
                    <input type="hidden" name="id" value="67">              
                    <button class="grey-btn" onclick="location.href='<?=PATH_URL?>booking'">book now</button>       
                </form>
                
            </div>
            <div class="close"><img src="<?=PATH_URL?>asset/frontend/images/croix.png"></div>
        </div>
        
        
    </div>
    <style>
        .ori-banner-all-top h1{
         display:none;	
     }
 </style>
 <?php }} ?>
 <div class="advisor-pop hidden-xs">
    <div style="position:relative">
        <div class="close2"><i class="fa fa-times" aria-hidden="true"></i></div>




        <div id="TA_selfserveprop737" class="TA_selfserveprop">
            <ul id="wU0Jjpcaw" class="TA_links 7pymzYVP">
                <li id="u804EofTdzsv" class="54UGxsxHCI">
                    <a target="_blank" href="https://www.tripadvisor.com/"><img src="https://www.tripadvisor.com/img/cdsi/img2/branding/150_logo-11900-2.png" alt="TripAdvisor"/></a>
                </li>
            </ul>
        </div>
        <script src="https://www.jscache.com/wejs?wtype=selfserveprop&amp;uniq=737&amp;locationId=8599407&amp;lang=en_US&amp;rating=true&amp;nreviews=0&amp;writereviewlink=true&amp;popIdx=true&amp;iswide=false&amp;border=true&amp;display_version=2"></script>


    </div>
</div>
<div class="advisor-open hidden-xs">
    <img src="<?=PATH_URL?>asset/frontend/images/advisor-open.png">
</div>

<?=$header?>


<main id="mtatuong" >

    <?=$content?>


</main>


<?=$footer?>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?=PATH_URL?>asset/frontend/js/bootstrap.min.js"></script>
<!--count down-->
<script src="<?=PATH_URL?>asset/frontend/js/jquery.countdown.min.js"></script>
<!--linkedIn-->

<!--js cookie script-->
<script src="<?=PATH_URL?>asset/frontend/js/js.cookie.js"></script>
<!--Form validator-->
<script src="<?=PATH_URL?>asset/frontend/js/jquery.validate.js"></script>
<!--Twitter typeahead for autocomplete-->
<script src="<?=PATH_URL?>asset/frontend/js/typeahead.bundle.min.js"></script>
<script src="<?=PATH_URL?>asset/frontend/js/bloodhound.js"></script>
<!--Flexslider-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.5.0/jquery.flexslider.min.js"></script>
<script src="<?=PATH_URL?>asset/frontend/js/owl.carousel.min.js"></script>
<!--Data for Twitter typeahead -->
<script src="<?=PATH_URL?>asset/frontend/js/cities.js"></script>
<script src="<?=PATH_URL?>asset/frontend/js/industries.js"></script>
<!--main script-->
<script src="<?=PATH_URL?>asset/frontend/js/jquery.nice-select.min.js"></script>
<script src="<?=PATH_URL?>asset/frontend/js/magnific-popup-master/jquery.magnific-popup.min.js"></script>

<script src="<?=PATH_URL?>asset/frontend/js/main.js"></script>
<script src="<?=PATH_URL?>asset/frontend/js/silder.js"></script>
<script src="<?=PATH_URL?>asset/frontend/js/script.js"></script>
<script type="text/javascript">
    $( window ).load(function() {
        var popup_status = $('#popup_status').val();
        if(popup_status == 1){
            $('button.btn-popup').click();
            $('.advisor-pop').css('right','0px');
            $('.advisor-open').css('right','-50px');
        }else{
            $('.advisor-pop').css('right','-340px');
            $('.advisor-open').css('right','0px');
        }
    });
</script>
<script>
    $('.owl-carousel').owlCarousel({

        navText: ["<img src='<?=PATH_URL?>asset/frontend/images/back.png'>", "<img src='<?=PATH_URL?>asset/frontend/images/next.png'>"],
        loop: false,
        margin: 10,
        nav: true,
        autoplay: false,
        autoplayHoverPause: true,
        responsive: {
            0: { 
                items: 1
            }
            ,
            600: {
                items: 2
            },
            1000: {
                items: 3
            },
            1400: {
                items: 3
            }

        }
    });
</script>
<script>
    $( document ).ready(function() { 

        var menu_id = <?=$menu_id;?>;
        $('header ul li').each(function(index, element) {
            if($(element).data('id') == menu_id) {
               $(element).addClass('active');  
           }
       });

        $("#ori_scroll_menu").click(function(e) {
          if(menu_id != 6){

          }else{
           e.preventDefault();
           $('html, body').animate({
            scrollTop: $("#ori_scroll_ourtour").offset().top
        }, 1000);
       }
   });
    });
</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-89470294-1', 'auto');
  ga('send', 'pageview');

</script>
<script>

    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-103153930-1', 'auto');
    ga('send', 'pageview');

</script>
</body>
</html>



