<style>
	.tabbable-custom > .tab-content {
		min-height: 250px;
	}
</style>
<h3 class="page-title">
	<?=@_testimonials?> <small><?=@_create_edit?> <?=@_testimonials?></small>
</h3>
<?php if($this->uri->segment(3) == 'edit') { ?>
    <div class="form-group">
        <button id="btn_submit" type="button" class="btn btn-success" onclick="return location.href='<?=PATH_URL?>acp/testimonial/add'"><?=@_add_new?> <i class="fa fa-plus"></i></button>
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
			<a href="<?=PATH_URL?>acp/testimonial"><?=@_testimonials?></a>
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
	<form id="frm_submit" method="post" action="<?=PATH_URL?>acp/testimonial/save" class="form-horizontal" enctype="multipart/form-data">
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
						<li>
							<a href="#tab_1_4" data-toggle="tab"><?=@_featured_images?></a>
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
								<label class="col-sm-2 control-label"><?=@_workplace?></label>
								<div class="col-sm-10">
									<input class="form-control" id="shortcontent" name="shortcontent" value="<?php if(!empty($result)) echo stripslashes($result->shortcontent)?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?=@_content?></label>
								<div class="col-sm-10">
									<textarea rows="5" class="form-control" id="content" name="content"><?php if(!empty($result)) echo stripslashes($result->content)?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?=@_status?></label>
								<div class="col-sm-10">
									<div class="checkbox-inline">
										<label>
											<input type="checkbox" name="status" <?php if(!empty($result)) if($result->status == 1) echo "checked";?> checked> <?=@_active?>
										</label>
									</div>
									<div class="checkbox-inline">
										<label>
											<input type="checkbox" name="homepage" <?php if(!empty($result)) if($result->homepage == 1) echo "checked";?>> <?=@_home?>
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
								<label class="col-sm-2 control-label"><?=@_workplace?></label>
								<div class="col-sm-10">
									<input class="form-control" id="shortcontent_en" name="shortcontent_en" value="<?php if(!empty($result)) echo stripslashes($result->shortcontent_en)?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label"><?=@_content?></label>
								<div class="col-sm-10">
									<textarea class="form-control" rows="5" id="content_en" name="content_en" ><?php if(!empty($result)) echo stripslashes($result->content_en)?></textarea>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="tab_1_4">
							<input type="file" name="images" id="thebox">
							<!-- END CROPPER -->
						</div>
						<div class="tab-pane" id="tab_1_3">
							<?php if(!empty($images)) { ?>
								<div id="images_content">
									<?php foreach($images as $items=>$item) { ?>
										<div class="file-preview-frame">
											<img src="<?=PATH_URL?>media/<?=$item->images?>" class="file-preview-image" title="<?=stripslashes($result->name)?>" alt="<?=stripslashes($result->name)?>" style="width:auto;height:110px;">
											<div class="file-thumbnail-footer">
												<div class="file-footer-caption" title="<?=stripslashes($result->name)?>"><?=stripslashes($result->name)?></div>
												<div class="file-actions">
													<button type="button" class="kv-file-remove btn btn-xs btn-default" title="Remove file" onclick="delGalleryImage(<?=$item->id?>)"><i class="glyphicon glyphicon-trash text-danger"></i></button>
												</div>
												<div class="clearfix"></div>
											</div>
										</div>
									<?php } ?>
								<div class="clearfix"></div>
								</div>
							<?php } ?>
							<div><input id="gallery" type="file" multiple name="gallery[]" data-overwrite-initial="false" data-min-file-count="3"></div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button id="btn_submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> <?=@_save?></button>
						<button type="button" onclick="return location.href='<?=PATH_URL?>acp/testimonial'" class="btn btn-info"><i class="fa fa-ban"></i> <?=@_cancel?></button>
					</div>
				</div>
			</div>
			
			<div class="col-md-3 col-sm-3">
				<?php if(!empty($category)) { ?>
				<div class="portlet box green">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-gift"></i><?=@_category?>
						</div>
						<div class="tools">
							<a href="javascript:;" class="collapse"></a>
						</div>
					</div>
					<div class="portlet-body">
						<div class="scroller" style="height:250px" data-always-visible="1" data-rail-visible="1" data-rail-color="blue" data-handle-color="green">
							<ul class="list-unstyled">
								<?php if(!empty($result)) $result_id = $result->id; else $result_id = 0; foreach($category as $items=>$item) { ?>
									<li>
										<label><input type="checkbox" name="category[]" value="<?=$item->id?>" <?php if(!empty($result)) { if(in_array($item->id, explode(',',$result->category_id))) echo "checked";}?>><?=stripslashes($item->name)?></label>
										<?php $child_category = $this->model->getListContent('category', "FIND_IN_SET(".$item->id.",category_id)>0 AND type='testimonial' AND id <> $result_id AND parent_id = 0",'order_by asc', null, null, "name, id");?>
										<?php if(!empty($child_category)) { ?>
											<ul class="list-unstyled">
												<?php foreach ($child_category as $items1 => $item1) { ?>
													<li>
														<label><input type="radio" name="parent_id" value="<?=$item1->id?>" <?php if(!empty($result)) { if(in_array($item1->id, explode(',',$result->parent_id))) echo "checked";}?>><?=stripslashes($item1->name)?></label>
														<?php $child1 = $this->model->getListContent('category', array('parent_id' => $item1->id, 'type' => 'testimonial', 'id <> ' => $result_id),'order_by asc', null, null, "name, id");?>
														<?php if(!empty($child1)) { ?>
															<ul class="list-unstyled">
																<?php foreach ($child1 as $items2 => $item2) { ?>
																	<li>
																		<label><input type="radio" name="parent_id" value="<?=$item2->id?>" <?php if(!empty($result)) { if(in_array($item2->id, explode(',',$result->parent_id))) echo "checked";}?>><?=stripslashes($item2->name)?></label>
																	</li>
																<?php }?>
															</ul>
														<?php } ?>
													</li>
												<?php }?>
											</ul>
										<?php } ?>
									</li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
				<?php } ?>
				<div class="portlet box green">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-gift"></i><?=@_featured_images?>
						</div>
						<div class="tools">
							<a href="javascript:;" class="collapse"></a>
						</div>
					</div>
					<div class="portlet-body" style="position: relative;">
						<div id="imgContent">
							<?php if(!empty($result->images)) { ?>
								<img src="<?=PATH_URL?>media/<?=$result->images?>" class="file-preview-image" style="max-width: 100%;">
							<?php } else { ?>
								<img src="<?=PATH_URL?>media/no_images.gif" class="file-preview-image" style="max-width: 100%;">
							<?php } ?>
						</div>
						<?php if(!empty($result)) if($result->images != '') { ?>
							<button class="btn btn-danger btn-destroy" type="button" onclick="deleteImageContent(<?=$result->id?>)" style="position: absolute; top: 10px; right: 10px;"><i class="glyphicon glyphicon-trash"></i></button>
						<?php } ?>
					</div>
				</div>
			</div>
			
		</div>
	</form>
</div>
<script>
    id = $("#id").val();
    if(id == '')
        id = <?=$this->model->maxId('article')?>;
    path = "<?=PATH_URL.'acp/testimonial/edit/'?>";
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
	$('#thebox').picEdit({
		maxWidth: 500,
		redirectUrl: path+id
	});
	function delGalleryImage(id) {
		$.post("<?=PATH_URL?>acp/testimonial/delGalleryImage",{id:id},function(data){$("#images_content").html(data)})
	}
	function deleteImageContent(id) {
		$.post("<?=PATH_URL?>acp/testimonial/deleteImageContent",{id:id},function(data){$("#imgContent").html(data); location.reload();});
	}
	function addLinksNews(name){
        checkLinks(name)
		$("#title").val(name);
		$("#description").val(name);
		$("#keywords").val(name);
    }
    function checkLinks(name){
        var links = cleanUnicode(name);
        $.post("<?=PATH_URL?>acp/testimonial/checkLinks",{links:links,id:$("#id").val()},function(data){var json = JSON.parse(data); $("#links").val(json.links)});
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
		str= str.replace(/!|@|\$|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\'| |\"|\&|\#|\[|\]|\;|\||\{|\}|\~|\“|\”|\™|\–|\-/g,"-");
		str= str.replace(/^\-+|\-+$/g,"");
		str= str.replace(/\\/g,"");
		str= str.replace(/-+-/g,"-");
		return str;
	}
</script>
