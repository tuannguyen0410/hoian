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
<link href="<?=PATH_URL?>asset/global/plugins/uniform/css/uniform.default.min.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" type="text/css" href="<?=PATH_URL?>asset/global/plugins/jquery-tags-input/jquery.tagsinput.css"/>
<link href="<?=PATH_URL?>asset/global/plugins/fileinput/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />
<link href="<?=PATH_URL?>asset/global/plugins/cropper/css/picedit.min.css" media="all" rel="stylesheet" type="text/css" />
<link href="<?=PATH_URL?>asset/global/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" media="all" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?=PATH_URL?>asset/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="<?=PATH_URL?>asset/global/plugins/datatables/css/jquery.dataTables.min.css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<link rel="stylesheet" type="text/css" href="<?=PATH_URL?>asset/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="<?=PATH_URL?>asset/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>
<!-- BEGIN PAGE STYLES -->
<link href="<?=PATH_URL?>asset/admincp/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="<?=PATH_URL?>asset/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?=PATH_URL?>asset/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?=PATH_URL?>asset/admincp/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link href="<?=PATH_URL?>asset/admincp/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css" id="style_color"/>

<script src="<?=PATH_URL?>asset/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?=PATH_URL?>asset/admincp/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?=PATH_URL?>asset/admincp/js/jquery.validate.min.js"></script>
<script src="<?=PATH_URL?>asset/global/plugins/cropper/js/picedit.min.js"></script>
<script type="text/javascript" src="<?=PATH_URL?>asset/global/plugins/datatables/jquery.dataTables.min.js"></script>
</head>
<body class="page-header-fixed page-quick-sidebar-over-content ">
<!-- BEGIN HEADER -->
<?=$header//$this->load->view('BACKEND/header')?>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	<?=$left//$this->load->view("BACKEND/left")?>
	<!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<?=$content//$this->load->view('BACKEND/'.$content)?>
		</div>
	</div>
	<!-- END CONTENT -->
</div>

<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
	<div class="page-footer-inner">
		2015 &copy; All Rights Reserved
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDB2kTPKuK696iHSLDKEx6zIGCK5Q6ev1E&sensor=false"></script>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places&sensor=false"></script>
<script type="text/javascript">
  var geocoder = new google.maps.Geocoder();

  function geocodePosition(pos) {
	 geocoder.geocode({
		 latLng: pos
	 }, function(responses) {
		 if (responses && responses.length > 0) {
			 updateMarkerAddress(responses[0].formatted_address);
		 } else {
			 updateMarkerAddress('Cannot determine address at this location.');
		 }
	 });
 }

 function updateMarkerStatus(str) {
	 document.getElementById('markerStatus').innerHTML = str;
 }

	function updateMarkerPosition(latLng) {
	 document.getElementById('txtLatitude').value = latLng.lat();
	 document.getElementById('txtLongitude').value = latLng.lng();
	}

	function updateMarkerAddress(str) {
	 document.getElementById('address').innerHTML = str;
	}
	function updateAddress(str) {
		document.getElementById("txtAddress").value = str;
	}

// add custom maker

var iconBase = '<?=PATH_URL?>img/';
var infowindow =  new google.maps.InfoWindow({
    content: ''
  });
//end add custom maker
function bindInfoWindow(marker, map, infowindow, html) {
    google.maps.event.addListener(marker, 'click', function() {
        infowindow.setContent(html);
        infowindow.open(map, marker);
    });
}
 function initialize() {
	 var latLng = new google.maps.LatLng(<?=$this->model->getContent('setting', null, "latitude")->latitude?>,<?=$this->model->getContent('setting', null, "longitude")->longitude?>);//10.771328, 106.698661);
	 var map = new google.maps.Map(document.getElementById('mapCanvas'), {
		 zoom: 15,
		 center: latLng,
		 mapTypeId: google.maps.MapTypeId.ROADMAP
	 });
	 var input = document.getElementById('txtAddress');
	 var autocomplete = new google.maps.places.Autocomplete(input);

	 autocomplete.bindTo('bounds', map);

	 var marker = new google.maps.Marker({
		 position: latLng,
		 title: 'Drag this to change location',
		 icon: iconBase + 'maker.png',
		 shadow: {
			  url: iconBase + 'maker-shadow.png',
			  anchor: new google.maps.Point(0, 48)
			},
		 map: map,
		 draggable: true
	 });

	 // Update current position info.
	 updateMarkerPosition(latLng);
	 geocodePosition(latLng);

	 // Add dragging event listeners.
	 google.maps.event.addListener(marker, 'dragstart', function() {
		 updateMarkerAddress('Dragging...');
	 });

	 google.maps.event.addListener(marker, 'drag', function() {
		 updateMarkerStatus('Dragging...');
		 updateMarkerPosition(marker.getPosition());
	 });

	 google.maps.event.addListener(marker, 'dragend', function() {
		 updateMarkerStatus('Drag ended');
		 geocodePosition(marker.getPosition());
		 updateAddress(responses[0].formatted_address);
	 });


	 //autocomplex
	 google.maps.event.addListener(autocomplete, 'place_changed', function() {
	//infowindow.close();
	marker.setVisible(false);
	input.className = 'form-control';
	$('.pac-container').attr('z-index',1010);
	var place = autocomplete.getPlace();
	if (!place.geometry) {
	// Inform the user that the place was not found and return.
	input.className = 'notfound';
	return;
	}
	else
	{
		latLng = place.geometry.location;
		map.setCenter(latLng);
		marker.setPosition(latLng);
		marker.setVisible(true);
		updateMarkerPosition(latLng);
	 	geocodePosition(latLng);
	}
	});
	}
 // Onload handler to fire off the app.
 google.maps.event.addDomListener(window, 'load', initialize);
</script>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?=PATH_URL?>asset/global/plugins/respond.min.js"></script>
<script src="<?=PATH_URL?>asset/global/plugins/excanvas.min.js"></script>
<![endif]-->
<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?=PATH_URL?>asset/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?=PATH_URL?>asset/global/plugins/jquery-tags-input/jquery.tagsinput.min.js" type="text/javascript"></script>
<script src="<?=PATH_URL?>asset/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?=PATH_URL?>asset/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?=PATH_URL?>asset/global/plugins/fileinput/js/fileinput.js" type="text/javascript"></script>
<script src="<?=PATH_URL?>asset/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<script type="text/javascript" src="<?=PATH_URL?>asset/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?=PATH_URL?>asset/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script type="text/javascript" src="<?=PATH_URL?>asset/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?=PATH_URL?>asset/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?=PATH_URL?>asset/admincp/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?=PATH_URL?>asset/admincp/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="<?=PATH_URL?>asset/admincp/pages/scripts/index.js" type="text/javascript"></script>
<script src="<?=PATH_URL?>asset/admincp/pages/scripts/tasks.js" type="text/javascript"></script>
<script src="<?=PATH_URL?>asset/admincp/pages/scripts/components-form-tools.js"></script>
<script src="<?=PATH_URL?>asset/admincp/pages/scripts/form-samples.js"></script>
<script src="<?=PATH_URL?>asset/admincp/pages/scripts/components-pickers.js"></script>
<script src="<?=PATH_URL?>asset/admincp/pages/scripts/table-managed.js"></script>
<script>
	$(function(){
		var imgContent = $("#imgContent img").attr("src");
		$('#images').fileinput({
			showCaption: false,
			showUpload: false,
			showRemove: false,
			defaultPreviewContent: [
				'<img src="'+imgContent+'" class="file-preview-image" style="height: auto; width: 100%;">'
			]
		});
		$("#gallery").fileinput({
			uploadUrl: '#',
			allowedFileExtensions : ['jpg', 'png','gif'],
			showUpload: false,
        });
		$('.color-demo2').colorpicker();
	})
	$('#thebox').picEdit({
		maxWidth: 500,
		formSubmitted: function(res){location.href= res.response;}
	});
</script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {
	Metronic.init(); // init metronic core componets
	Layout.init(); // init layout
	QuickSidebar.init(); // init quick sidebar
	Index.init();
	Index.initDashboardDaterange();
	Tasks.initDashboardWidget();
	FormSamples.init();
	ComponentsFormTools.init();
	ComponentsPickers.init();
    TableManaged.init();
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
