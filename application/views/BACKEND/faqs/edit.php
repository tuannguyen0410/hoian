<style>
	.tabbable-custom > .tab-content {
		min-height: 250px;
	}
</style>
<h3 class="page-title">
	<?=@_faqs?> <small><?=@_create_edit?> <?=@_faqs?></small>
</h3>
<?php if($this->uri->segment(3) == 'edit') { ?>
    <div class="form-group">
        <button id="btn_submit" type="button" class="btn btn-success" onclick="return location.href='<?=PATH_URL?>acp/faqs/add'"><?=@_add_new?> <i class="fa fa-plus"></i></button>
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
			<a href="<?=PATH_URL?>acp/faqs"><?=@_faqs?></a>
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
	<form id="frm_submit" method="post" action="<?=PATH_URL?>acp/faqs/save" class="form-horizontal" enctype="multipart/form-data">
		<input type="hidden" name="id" id="id" value="<?php if(!empty($result)) echo $result->id?>">
		<div class="row">
			<div class="col-md-9 col-sm-9">
				<div class="tabbable-custom ">
					<ul class="nav nav-tabs ">
						<li class="active">
							<a href="#tab_1_1" data-toggle="tab"><?=@_content_vi?></a>
						</li>
						<li>
							<a href="#tab_1_2" data-toggle="tab"><?=@_content_en?></a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tab_1_1">
							<div class="form-group">
								<label class="col-sm-2 control-label"><?=@_name?></label>
								<div class="col-sm-10">
									<input type="text" class="form-control" required autocomplete="off" id="txtName" name="txtName" value="<?php if(!empty($result)) echo stripslashes($result->name);?>" placeholder="<?=@_name?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?=@_content?></label>
								<div class="col-sm-10">
									<textarea class="form-control" rows="7" id="content" name="content"> <?php if(!empty($result)) echo stripslashes($result->content)?></textarea>
									<script>
										CKEDITOR.replace( 'content',
											{
												filebrowserBrowseUrl : '<?=PATH_URL?>asset/admincp/ckeditor/ckfinder/ckfinder.html',
												filebrowserImageBrowseUrl : '<?=PATH_URL?>asset/admincp/ckeditor/ckfinder/ckfinder.html?type=Images',
												filebrowserFlashBrowseUrl : '<?=PATH_URL?>asset/admincp/ckeditor/ckfinder/ckfinder.html?type=Flash',
												filebrowserUploadUrl : '<?=PATH_URL?>asset/admincp/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
												filebrowserImageUploadUrl : '<?=PATH_URL?>asset/admincp/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
												filebrowserFlashUploadUrl : '<?=PATH_URL?>asset/admincp/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
												filebrowserWindowWidth : '500',
												filebrowserWindowHeight : '500'
											});
									</script>
								</div>
							</div>
							<div class="form-group">
								<label for="order_by" class="col-sm-2 control-label"><?=@_order_by?></label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="order_by" name="order_by" value="<?php if(!empty($result)) echo $result->order_by?>" placeholder="<?=@_order_by?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?=@_status?></label>
								<div class="col-sm-10">
									<div class="checkbox-inline">
										<label>
											<input type="checkbox" name="status" <?php if(!empty($result)) {if($result->status == 1) echo "checked";} else echo "checked";?>> <?=@_active?>
										</label>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="tab_1_2">
							<div class="form-group">
								<label class="col-sm-2 control-label"><?=@_name?></label>
								<div class="col-sm-10">
									<input type="text" class="form-control" required autocomplete="off" id="txtName_en" name="txtName_en" value="<?php if(!empty($result)) echo stripslashes($result->name_en);?>" placeholder="<?=@_name?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?=@_content?></label>
								<div class="col-sm-10">
									<textarea class="form-control" rows="7" id="content_en" name="content_en"> <?php if(!empty($result)) echo stripslashes($result->content_en)?></textarea>
									<script>
										CKEDITOR.replace( 'content_en',
											{
												filebrowserBrowseUrl : '<?=PATH_URL?>asset/admincp/ckeditor/ckfinder/ckfinder.html',
												filebrowserImageBrowseUrl : '<?=PATH_URL?>asset/admincp/ckeditor/ckfinder/ckfinder.html?type=Images',
												filebrowserFlashBrowseUrl : '<?=PATH_URL?>asset/admincp/ckeditor/ckfinder/ckfinder.html?type=Flash',
												filebrowserUploadUrl : '<?=PATH_URL?>asset/admincp/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
												filebrowserImageUploadUrl : '<?=PATH_URL?>asset/admincp/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
												filebrowserFlashUploadUrl : '<?=PATH_URL?>asset/admincp/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
												filebrowserWindowWidth : '500',
												filebrowserWindowHeight : '500'
											});
									</script>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button id="btn_submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> <?=@_save?></button>
						<button type="button" onclick="return location.href='<?=PATH_URL?>acp/faqs'" class="btn btn-info"><i class="fa fa-ban"></i> <?=@_cancel?></button>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-3">

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
		});
		$("#thebox").bind('change',function(){
			var name = this.files[0].name;
			var ext = name.split(".");
            var type = ['image/jpeg','image/gif','image/png']
			ext = ext[ext.length-1];
            if($.inArray(this.files[0].type,type) < 0) {
                this.value = "";
                alert("Please choose your photo.");
                return false;
            }
			if(ext.toLowerCase() != "png" && ext.toLowerCase() != "gif" && ext.toLowerCase() != "jpg" && ext.toLowerCase() != "jpeg") {
				this.value = "";
				alert("Your format is not supported.");
                return false;
			}
            var filder = new FileReader();
            filder.onload = function(e) {
                $("#imgContent img").attr('src',e.target.result)
            }
            filder.readAsDataURL(this.files[0]);
		})
	})
</script>
