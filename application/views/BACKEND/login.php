<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>ADMINISTRATOR</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="<?=PATH_URL?>asset/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?=PATH_URL?>asset/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<?=PATH_URL?>asset/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="<?=PATH_URL?>asset/global/plugins/jquery-tags-input/jquery.tagsinput.css"/>
<link href="<?=PATH_URL?>asset/global/plugins/uniform/css/uniform.default.min.css" rel="stylesheet" type="text/css"/>
<!-- BEGIN PAGE STYLES -->
<link href="<?=PATH_URL?>asset/admincp/pages/css/login.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="<?=PATH_URL?>asset/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?=PATH_URL?>asset/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?=PATH_URL?>asset/admincp/layout/css/layout.css" rel="stylesheet" type="text/css"/>

<script src="<?=PATH_URL?>asset/global/plugins/jquery.min.js" type="text/javascript"></script>

<link rel="stylesheet" href="<?=PATH_URL?>asset/wow/animate.css">
<script src="<?=PATH_URL?>asset/wow/wow.js"></script>
  <!--[if IE 7]>
  <link rel="stylesheet" href="./assets/css/font-awesome-ie7.min.css" />
  <![endif]-->
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGIN -->
<div class="content wow slideInDown" data-wow-duration="300">
	<!-- BEGIN LOGIN FORM -->
	<form class="login-form" action="<?=PATH_URL?>acp/login.html" method="post">
		<h3 class="form-title">Sign In</h3>
		<?php if($this->session->flashdata('error_login') == 1) { ?>
			<div class="alert alert-danger">
				<button class="close" data-close="alert"></button>
				<span>Invalid username or password, please try again</span>
			</div>
		<?php } ?>
		<div class="alert alert-danger display-hide">
			<button class="close" data-close="alert"></button>
			<span>
			Enter any username and password. </span>
		</div>
		<!--<div class="form-group">
			<select class="pull-right form-control input-medium" name="lange">
				<option value="en">Select Language</option>
				<option value="en">English</option>
				<option value="vi">Vietname</option>
			</select>
			<div class="clearfix"></div>
		</div>-->
		
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Username</label>
			<div class="input-icon">
				<i class="fa fa-user" style="margin-top: 14px;"></i>
				<input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username"/>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<div class="input-icon">
				<i class="fa fa-lock" style="margin-top: 14px;"></i>
				<input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"/>
			</div>
		</div>
		<div class="form-actions">
			<button type="submit" class="btn btn-success uppercase  pull-right" name="login">Login</button>
			<label class="rememberme check">
			<input type="checkbox" name="remember" value="1"/>Remember </label>
			<div class="clearfix"></div>
		</div>
		<!--<div class="login-options">
			<h4>Or login with</h4>
			<ul class="social-icons">
				<li>
					<a class="social-icon-color facebook" data-original-title="facebook" href="javascript:;"></a>
				</li>
				<li>
					<a class="social-icon-color twitter" data-original-title="Twitter" href="javascript:;"></a>
				</li>
				<li>
					<a class="social-icon-color googleplus" data-original-title="Goole Plus" href="javascript:;"></a>
				</li>
				<li>
					<a class="social-icon-color linkedin" data-original-title="Linkedin" href="javascript:;"></a>
				</li>
			</ul>
		</div>-->
		<div class="create-account">
			<p>
				<a href="javascript:;" class="uppercase">ADMINISTRATOR</a>
			</p>
		</div>
	</form>
	<!-- END LOGIN FORM -->
</div>
<div class="copyright">
		© BCA. Admin Dashboard.
</div>
<!-- END LOGIN -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?=PATH_URL?>asset/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="<?=PATH_URL?>asset/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?=PATH_URL?>asset/global/plugins/jquery-tags-input/jquery.tagsinput.min.js" type="text/javascript"></script>
<script src="<?=PATH_URL?>asset/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?=PATH_URL?>asset/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?=PATH_URL?>asset/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="<?=PATH_URL?>asset/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?=PATH_URL?>asset/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?=PATH_URL?>asset/admincp/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?=PATH_URL?>asset/admincp/layout/scripts/demo.js" type="text/javascript"></script>
<script src="<?=PATH_URL?>asset/admincp/pages/scripts/login.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {     
Metronic.init(); // init metronic core components
Layout.init(); // init current layout
Login.init();
Demo.init();
});
wow = new WOW(
  {
	animateClass: 'animated'
  }
);
wow.init();
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>