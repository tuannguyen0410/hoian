<style>
	.tabbable-custom > .tab-content {
		min-height: 250px;
	}
</style>
<h3 class="page-title">
	<?=@_category?> <small><?=@_create_edit?> <?=@_category?></small>
</h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="<?=PATH_URL?>acp"><?=@_home?></a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?=PATH_URL?>acp/categories"><?=@_category?></a>
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
	<form id="frm_submit" method="post" action="<?=PATH_URL?>acp/categories/save" class="form-horizontal" enctype="multipart/form-data">
		<input type="hidden" name="id" id="id" value="<?php if(!empty($result)) echo $result->id?>">
		<div class="row">
			<div class="col-md-9 col-sm-9">
				<div class="tabbable-custom ">
					<ul class="nav nav-tabs ">
						<li class="active">
							<a href="#tab_1_1" data-toggle="tab"><?=@_general?></a>
						</li>
						<li>
							<a href="#tab_1_3" data-toggle="tab">S.E.O</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tab_1_1">
							<div class="form-group">
								<label class="col-sm-2 control-label"><?=@_name?></label>
								<div class="col-sm-10">
									<input type="text" class="form-control" autocomplete="off" id="txtName" onkeyup="addLinksNews(this.value)" name="txtName" value="<?php if(!empty($result)) echo $result->name;?>" placeholder="<?=@_name?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?=@_parent?></label>
								<div class="col-sm-10">
									<select class="form-control input-large" name="category">
										<option value="">&rarr; <?=@_no_parent?> &larr;</option>
										<?php if(!empty($category)) { ?>
											<?php foreach($category as $items=>$item) { ?>
												<?php if(!empty($result)) { ?>
													<?php if($result->parent_id == $item->id) { ?>
														<option value="<?=$item->id?>" selected><?=$item->name?></option>
													<?php } else { ?>
														<option value="<?=$item->id?>"><?=$item->name?></option>
													<?php } ?>
												<?php } else { ?>
													<option value="<?=$item->id?>"><?=$item->name?></option>
												<?php } ?>
											<?php } ?>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="order_by" class="col-sm-2 control-label"><?=@_order_by?></label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="order_by" name="order_by" value="<?php if(!empty($result)) echo $result->order_by?>" placeholder="<?=@_order_by?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?=@_slug?></label>
								<div class="col-sm-10">
									<input type="text" class="form-control" onchange="checkLinks(this.value,'')" id="links" readonly name="links" value="<?php if(!empty($result)) echo $result->links;?>" placeholder="<?=@_slug?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?=@_status?></label>
								<div class="col-sm-10">
									<div class="checkbox-inline" style="padding-left: 0;">
										<label>
											<input type="checkbox" name="status" <?php if(!empty($result)) if($result->status == 1) echo "checked";?> checked> <?=@_active?>
										</label>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="tab_1_3">
							<div class="form-group">
								<label class="col-sm-2 control-label">Meta Title</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" autocomplete="off" id="title" name="title"  value="<?php if(!empty($result)) echo $result->title?>" placeholder="Title">
								</div>
							</div>
							<div class="form-group">
								<label for="description" class="col-sm-2 control-label">Meta Description</label>
								<div class="col-sm-10">
									<textarea class="form-control" rows="7" id="description" name="description"><?php if(!empty($result)) echo $result->description?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label for="keywords" class="col-sm-2 control-label">Meta Keywords</label>
								<div class="col-sm-10">
									<textarea class="form-control" rows="7" id="keywords" name="keywords"> <?php if(!empty($result)) echo $result->keywords?></textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button id="btn_submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> <?=@_save?></button>
						<button type="button" onclick="return history.back()" class="btn btn-info"><i class="fa fa-ban"></i> <?=@_cancel?></button>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-3">
				<div id="imgContent" style="display: none;">
					<?php if(!empty($result)) { ?>
						<?php if($result->images != '') { ?>
							<img src="<?=PATH_URL?>img_data/<?=$result->images?>" class="file-preview-image" style="max-width: 100%;">
						<?php } else { ?>
							<img src="<?=PATH_URL?>img_data/no_images.gif" class="file-preview-image" style="max-width: 100%;">
						<?php } ?>
					<?php } else { ?>
						<img src="<?=PATH_URL?>img_data/no_images.gif" class="file-preview-image" style="max-width: 100%;">
					<?php } ?>
				</div>
				<input id="images" name="images" type="file" class="file-loading">
				<?php if(!empty($result)) if($result->images != ''){ ?>
					<button class="btn btn-danger btn-destroy" type="button" onclick="deleteImageContent(<?=$result->id?>)" style="position: absolute; top: 0; right: 16px;"><i class="glyphicon glyphicon-trash"></i></button>
				<?php } ?>
				<p class="help-block"><span class="btn btn-danger">Note</span> please choose file image [.png, .jpg, .gif, .jpge]</p>
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
		$.post("<?=PATH_URL?>acp/categories/deleteImageContent",{id:id},function(data){$("#imgContent").html(data); location.reload();});
	}
	function addLinksNews(name){
        checkLinks(name)
		$("#title").val(name);
		$("#description").val(name);
		$("#keywords").val(name);
    }
    function checkLinks(name){
        var links = cleanUnicode(name);
        $.post("<?=PATH_URL?>acp/categories/checkLinks",{links:links,id:$("#id").val()},function(data){var json = JSON.parse(data); $("#links").val(json.links); $("#order_by").val(json.order_by)});
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