<style>
	.tabbable-custom > .tab-content {
		min-height: 250px;
	}
</style>
<h3 class="page-title">
	<?=@_pages?> <small><?=@_create_edit?> <?=@_pages?></small>
</h3>
<?php if($this->uri->segment(3) == 'edit') { ?>
    <div class="form-group">
        <button id="btn_submit" type="button" class="btn btn-success" onclick="return location.href='<?=PATH_URL?>acp/menu/add'"><i class="icon-plus"></i> <?=@_add_new?></button>
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
			<a href="<?=PATH_URL?>acp/menu">Menu</a>
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
	<form id="frm_submit" method="post" action="<?=PATH_URL?>acp/menu/save" class="form-horizontal" enctype="multipart/form-data">
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
							<a href="#tab_1_3" data-toggle="tab">S.E.O</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tab_1_1">
							<div class="form-group">
								<label class="col-sm-2 control-label"><?=@_name?></label>
								<div class="col-sm-10">
									<input type="text" class="form-control" autocomplete="off" onkeyup="addLinks(this.value,'')" id="txtName" name="txtName" value="<?php if(!empty($result)) echo stripslashes($result->name);?>" placeholder="<?=@_name?>">
								</div>
							</div>
							<div class="form-group">
								<label for="order_by" class="col-sm-2 control-label"><?=@_order_by?></label>
								<div class="col-sm-5">
									<input type="text" class="form-control" id="order_by" autocomplete="off" name="order_by" value="<?php if(!empty($result)) echo $result->order_by?>" placeholder="<?=@_order_by?>">
								</div>
							</div>
							<div class="form-group" style="display:none;">
								<label class="col-sm-2 control-label"><?=@_slug?></label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="links" value="<?php if(!empty($result)) echo $result->links;?>" placeholder="<?=@_slug?>">
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
								</div>
							</div>
						</div>
						<div class="tab-pane" id="tab_1_2">
							<div class="form-group">
								<label class="col-sm-2 control-label"><?=@_name?></label>
								<div class="col-sm-10">
									<input type="text" class="form-control" autocomplete="off" onkeyup="addLinks(this.value,'_en')" id="txtName_en" name="txtName_en" value="<?php if(!empty($result)) echo stripslashes($result->name_en);?>" placeholder="<?=@_name?>">
								</div>
							</div>
							<div class="form-group" style="display:none;">
								<label class="col-sm-2 control-label"><?=@_slug?></label>
								<div class="col-sm-10">
									<input type="text" class="form-control" name="links_en" value="<?php if(!empty($result)) echo str_replace('en/','',$result->links_en);?>" placeholder="<?=@_slug?>">
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
						<button type="button" onclick="return location.href='<?=PATH_URL?>acp/menu'" class="btn btn-info"><i class="fa fa-ban"></i> <?=@_cancel?></button>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-3" style="display:none;">
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
								<?php foreach($category as $items=>$item) { if(!empty($result)) $result_id = $result->id; else $result_id = 0;?>
									<li>
										<label><input type="radio" name="parent_id" value="<?=$item->id?>" <?php if(!empty($result)) { if(in_array($item->id, explode(',',$result->parent_id))) echo "checked";}?>><?=stripslashes($item->name)?></label>
										<?php $child_category = $this->model->getListContent('category', array('parent_id' => $item->id, 'type' => 'menu', 'id <> ' => $result_id),'order_by asc', null, null, "name, id");?>
										<?php if(!empty($child_category)) { ?>
											<ul class="list-unstyled">
												<?php foreach ($child_category as $items1 => $item1) { ?>
													<li>
														<label><input type="radio" name="parent_id" value="<?=$item1->id?>" <?php if(!empty($result)) { if(in_array($item1->id, explode(',',$result->parent_id))) echo "checked";}?>><?=stripslashes($item1->name)?></label>
														<?php $child1 = $this->model->getListContent('category', array('parent_id' => $item1->id, 'type' => 'banner', 'id <> ' => $result_id),'order_by asc', null, null, "name, id");?>
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
			    <?php if(!empty($page)) { ?>
				<div class="portlet box green">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-gift"></i><?=@_pages?>
						</div>
						<div class="tools">
							<a href="javascript:;" class="collapse"></a>
						</div>
					</div>
					<div class="portlet-body">
						<div class="scroller" style="height:250px" data-always-visible="1" data-rail-visible="1" data-rail-color="blue" data-handle-color="green">
							<ul class="list-unstyled">
								<?php foreach($page as $items=>$item) { if(!empty($result)) $result_id = $result->id; else $result_id = 0;?>
									<li>
										<label><input type="checkbox" name="category[]" value="<?=$item->id?>" <?php if(!empty($result)) { if(in_array($item->id, explode(',',$result->category_id))) echo "checked";}?>><?=stripslashes($item->name)?></label>
									</li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
				<?php } ?>
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
	function addLinks(name,lang){
        checkLinks(name,lang);
        if(lang == '') {
            $("#title").val(name);
            $("#description").val(name);
            $("#keywords").val(name);
        }
    }
    function checkLinks(name,lang){
      var links = cleanUnicode(name);
      $.post("<?=PATH_URL?>acp/article/categories/checkLinks",{links:links,lang:lang,id:$("#id").val()},function(data){var json = JSON.parse(data); $("#links"+lang).val(json.links)});
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
