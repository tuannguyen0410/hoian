<style>
	.tabbable-custom > .tab-content {
		min-height: 250px;
	}
</style>
<h3 class="page-title">
	<?=@_translate?> <small><?=@_create_edit?> <?=@_translate?></small>
</h3>
<?php if($this->uri->segment(3) == 'edit') { ?>
    <div class="form-group">
        <button id="btn_submit" type="button" class="btn btn-success" onclick="return location.href='<?=PATH_URL?>acp/translate/add'"><i class="icon-plus"></i> <?=@_add_new?></button>
</div>
<?php } ?>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="<?=PATH_URL?>acp"><?=@_home?></a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?=PATH_URL?>acp/translate"><?=@_translate?></a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="javascript:;"><?=$this->uri->segment(3)?></a>
		</li>
	</ul>
</div>
<?php if($this->session->flashdata('success') == 1) { ?>
<div class="Metronic-alerts alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><i class="fa-lg fa fa-success"></i>Your infomation has been update.</div>
<?php } ?>
<div class="panel-body">
	<form id="frm_submit" method="post" action="<?=PATH_URL?>acp/translate/save" class="form-horizontal" enctype="multipart/form-data">
		<input type="hidden" name="id" id="id" value="<?php if(!empty($result)) echo $result->id?>">
		<div class="row">
			<div class="col-md-9 col-sm-9">
				<div class="tabbable-custom ">
					<ul class="nav nav-tabs ">
						<li class="active">
							<a href="#tab_1_1" data-toggle="tab"><?=@_general?></a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tab_1_1">
							<div class="form-group">
								<label class="col-sm-3 control-label"><?=@_content_vi?></label>
								<div class="col-sm-9">
									<input type="text" class="form-control" autocomplete="off" id="txtName" name="txtName" value="<?php if(!empty($result)) echo stripslashes($result->name);?>" placeholder="<?=@_name?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label"><?=@_content_en?></label>
								<div class="col-sm-9">
									<input type="text" class="form-control" autocomplete="off" id="txtName_en" name="txtName_en" value="<?php if(!empty($result)) echo stripslashes($result->name_en);?>" placeholder="<?=@_name?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label"><?=@_slug?></label>
								<div class="col-sm-9">
									<input type="text" class="form-control" autocomplete="off" id="value" name="value" value="<?php if(!empty($result)) echo stripslashes($result->value);?>" placeholder="<?=@_slug?>">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button id="btn_submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> <?=@_save?></button>
						<button type="button" onclick="return location.href='<?=PATH_URL?>acp/translate'" class="btn btn-info"><i class="fa fa-ban"></i> <?=@_cancel?></button>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<script>
	$(function(){
		$("#btn_submit").bind('click',function(){
			$("#frm_submit").validate({
				rules: {
					txtName: {
						required: true
					}
				}
			});
		})
		$("#images").bind('change',function(){
			var name = this.files[0].name;
			var ext = name.split(".");
			ext = ext[ext.length-1];
			if(ext.toLowerCase() != "png" && ext.toLowerCase() != "gif" && ext.toLowerCase() != "jpg" && ext.toLowerCase() != "jpge") {
				this.value = "";
				alert("Please choose file");
			}
		})
	})
	function deleteImageContent(id) {
		$.post("<?=PATH_URL?>acp/article/categories/deleteImageContent",{id:id},function(data){$("#imgContent").html(data); location.reload();});
	}
	function addLinksNews(name){
		$("#title").val(name);
		$("#description").val(name);
		$("#keywords").val(name);
    }
    function checkLinks(name){
        var links = cleanUnicode(name);
        $.post("<?=PATH_URL?>acp/article/categories/checkLinks",{links:links,id:$("#id").val()},function(data){var json = JSON.parse(data); $("#links").val(json.links); $("#order_by").val(json.order_by)});
    }
	function cleanUnicode(str){
		str= str.toLowerCase();
		str= str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a");
		str= str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e");
		str= str.replace(/ì|í|ị|ỉ|ĩ/g,"i");
		str= str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o");
		str= str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");
		str= str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y");
		str= str.replace(/đ/g,"d");
		str= str.replace(/!|@|\$|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\'| |\"|\&|\#|\[|\]|\;|\||\{|\}|\~|\“|\”|\–|\-/g,"-");
		str= str.replace(/^\-+|\-+$/g,"");
		str= str.replace(/\\/g,"");
		str= str.replace(/-+-/g,"-");
		return str;
	}
</script>
