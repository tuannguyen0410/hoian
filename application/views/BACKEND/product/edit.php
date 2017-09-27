<style>	.tabbable-custom > .tab-content {		min-height: 250px;	}</style><h3 class="page-title">	<?=@_product?> <small><?=@_create_edit?> <?=@_product?></small></h3><div class="page-bar">	<ul class="page-breadcrumb">		<li>			<i class="fa fa-home"></i>			<a href="<?=PATH_URL?>acp"><?=@_home?></a>			<i class="fa fa-angle-right"></i>		</li>		<li>			<a href="<?=PATH_URL?>acp/products"><?=@_product?></a>			<i class="fa fa-angle-right"></i>		</li>		<li>			<a href="javascript:;"><?=$this->uri->segment(3)?></a>		</li>	</ul></div><div class="panel-body">	<form id="frm_submit" method="post" action="<?=PATH_URL?>acp/products/save" class="form-horizontal" enctype="multipart/form-data">		<input type="hidden" name="id" id="id" value="<?php if(!empty($result)) echo $result->id?>">		<div class="row">			<div class="col-md-9 col-sm-9">				<div class="tabbable-custom ">					<ul class="nav nav-tabs ">						<li class="active">							<a href="#tab_1_1" data-toggle="tab"><?=@_general?></a>						</li>						<li>							<a href="#tab_1_2" data-toggle="tab"><?=@_image?></a>						</li>						<li>							<a href="#tab_1_4" data-toggle="tab"><?=@_attributes?></a>						</li>						<li>							<a href="#tab_1_5" data-toggle="tab">Video</a>						</li>						<li>							<a href="#tab_1_6" data-toggle="tab"><?=@_content?></a>						</li>						<li>							<a href="#tab_1_3" data-toggle="tab">S.E.O</a>						</li>					</ul>					<div class="tab-content">						<div class="tab-pane active" id="tab_1_1">							<div class="form-group">								<label class="col-sm-2 control-label"><?=@_name?></label>								<div class="col-sm-10">									<input type="text" class="form-control" required autocomplete="off" id="txtName" onkeyup="addLinksNews(this.value)" name="txtName" value="<?php if(!empty($result)) echo $result->name;?>" placeholder="<?=@_name?>">								</div>							</div>							<div class="form-group">								<label class="col-sm-2 control-label"><?=@_category?></label>								<div class="col-sm-10">									<select class="form-control input-large" required name="category" onchange="getFeature(this.value,<?php if(!empty($result)) echo $result->id; else echo 0?>)">										<option value="">&rarr; <?=@_category?> &larr;</option>										<?php if(!empty($category)) { ?>											<?php foreach($category as $items=>$item) { ?>												<?php if(!empty($result)) { ?>													<?php if($result->category_id == $item->id) { ?>														<option value="<?=$item->id?>" selected><?=$item->name?></option>													<?php } else { ?>														<option value="<?=$item->id?>"><?=$item->name?></option>													<?php } ?>												<?php } else { ?>													<option value="<?=$item->id?>"><?=$item->name?></option>												<?php } ?>											<?php } ?>										<?php } ?>									</select>								</div>							</div>							<div class="form-group">								<label for="order_by" class="col-sm-2 control-label"><?=@_order_by?></label>								<div class="col-sm-5">									<input type="text" class="form-control" id="order_by" name="order_by" value="<?php if(!empty($result)) echo $result->order_by?>" placeholder="<?=@_order_by?>">								</div>							</div>							<div class="form-group">								<label class="col-sm-2 control-label"><?=@_slug?></label>								<div class="col-sm-10">									<input type="text" class="form-control" onchange="checkLinks(this.value,'')" id="links" readonly name="links" value="<?php if(!empty($result)) echo $result->links;?>" placeholder="<?=@_slug?>">								</div>							</div>							<div class="form-group">								<label class="col-sm-2 control-label"><?=@_product_code?></label>								<div class="col-sm-10">									<input type="text" class="form-control" id="code" name="code" value="<?php if(!empty($products)) echo $products->code;?>" placeholder="<?=@_product_code?>">								</div>							</div>							<div class="form-group">								<label class="col-sm-2 control-label"><?=@_price?></label>								<div class="col-sm-10">									<input type="text" class="form-control" id="price" name="price" value="<?php if(!empty($products)) echo number_format($products->price,0,'.',',');?>" placeholder="<?=@_price?>">								</div>							</div>							<div class="form-group">								<label class="col-sm-2 control-label"><?=@_sale_price?></label>								<div class="col-sm-10">									<input type="text" class="form-control" id="sale_price" name="sale_price" value="<?php if(!empty($products)) echo number_format($products->sale_price,0,'.',',');?>" placeholder="<?=@_sale_price?>">								</div>							</div>							<div class="form-group">								<label class="col-sm-2 control-label"><?=@_promotion?></label>								<div class="col-sm-10">									<textarea class="form-control" rows="7" id="promotion" name="promotion"> <?php if(!empty($products)) echo $products->promotion?></textarea>									<script>										CKEDITOR.replace( 'promotion',											{												// Define the toolbar groups as it is a more accessible solution.												toolbarGroups: [													{"name":"basicstyles","groups":["basicstyles"]},													{"name":"links","groups":["links"]},													{"name":"paragraph","groups":["list","blocks"]},													{"name":"document","groups":["mode"]},													{"name":"insert","groups":["insert"]},													{"name":"styles","groups":["styles"]},													{"name":"colors","groups":["colors"]}												],												// Remove the redundant buttons from toolbar groups defined above.												removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar',												filebrowserBrowseUrl : '<?=PATH_URL?>asset/admincp/ckeditor/ckfinder/ckfinder.html',												filebrowserImageBrowseUrl : '<?=PATH_URL?>asset/admincp/ckeditor/ckfinder/ckfinder.html?type=Images',												filebrowserFlashBrowseUrl : '<?=PATH_URL?>asset/admincp/ckeditor/ckfinder/ckfinder.html?type=Flash',												filebrowserUploadUrl : '<?=PATH_URL?>asset/admincp/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',												filebrowserImageUploadUrl : '<?=PATH_URL?>asset/admincp/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',												filebrowserFlashUploadUrl : '<?=PATH_URL?>asset/admincp/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',												filebrowserWindowWidth : '500',												filebrowserWindowHeight : '500'											});									</script>								</div>							</div>							<div class="form-group">								<label class="col-sm-2 control-label"><?=@_status?></label>								<div class="col-sm-10">									<div class="checkbox-inline">										<label>											<input type="checkbox" name="status" <?php if(!empty($result)) if($result->status == 1) echo "checked";?> checked> <?=@_active?>										</label>									</div>									<div class="checkbox-inline">										<label>											<input type="checkbox" name="featured" <?php if(!empty($result)) if($result->featured == 1) echo "checked";?>> <?=@_featured?>										</label>									</div>									<div class="checkbox-inline">										<label>											<input type="checkbox" name="homepage" <?php if(!empty($result)) if($result->homepage == 1) echo "checked";?>> <?=@_home?>										</label>									</div>								</div>							</div>						</div>						<div class="tab-pane" id="tab_1_2">							<?php if(!empty($images)) { ?>								<div id="images_content">									<?php foreach($images as $items=>$item) { ?>										<div class="file-preview-frame">											<img src="<?=PATH_URL?>img_data/<?=$item->images?>" class="file-preview-image" title="<?=$result->name?>" alt="<?=$result->name?>" style="width:auto;height:110px;">											<div class="file-thumbnail-footer">												<div class="file-footer-caption" title="<?=$result->name?>"><?=$result->name?></div>												<div class="file-actions">													<button type="button" class="kv-file-remove btn btn-xs btn-default" title="Remove file" onclick="Delete(<?=$item->id?>)"><i class="glyphicon glyphicon-trash text-danger"></i></button>												</div>												<div class="clearfix"></div>											</div>										</div>									<?php } ?>								<div class="clearfix"></div>								</div>							<?php } ?>							<div><input id="gallery" type="file" multiple name="gallery[]" data-overwrite-initial="false" data-min-file-count="3"></div>						</div>						<div class="tab-pane" id="tab_1_4">							<div id="attributes">								<?php if(!empty($brand)) { ?>									<div class="form-group">										<label class="col-sm-2 control-label"><?=@_brands?></label>										<div class="col-sm-10">											<select class="form-control input-large" required name="brand_id">												<?php if(!empty($brand)) { ?>													<?php foreach($brand as $items=>$item) { ?>														<?php if(!empty($products)) { ?>															<?php if($products->brand_id == $item->id) { ?>																<option value="<?=$item->id?>" selected><?=$item->name?></option>															<?php } else { ?>																<option value="<?=$item->id?>"><?=$item->name?></option>															<?php } ?>														<?php } else { ?>															<option value="<?=$item->id?>"><?=$item->name?></option>														<?php } ?>													<?php } ?>												<?php } ?>											</select>										</div>									</div>								<?php } ?>								<?php if(!empty($operating)) { ?>									<div class="form-group">										<label class="col-sm-2 control-label"><?=@_operating?></label>										<div class="col-sm-10">											<select class="form-control input-large" required name="operating_id">												<?php if(!empty($operating)) { ?>													<?php foreach($operating as $items=>$item) { ?>														<?php if(!empty($products)) { ?>															<?php if($products->operating_id == $item->id) { ?>																<option value="<?=$item->id?>" selected><?=$item->name?></option>															<?php } else { ?>																<option value="<?=$item->id?>"><?=$item->name?></option>															<?php } ?>														<?php } else { ?>															<option value="<?=$item->id?>"><?=$item->name?></option>														<?php } ?>													<?php } ?>												<?php } ?>											</select>										</div>									</div>								<?php } ?>								<?php if(!empty($color)) { ?>									<div class="form-group">										<label class="col-sm-2 control-label"><?=@_color?></label>										<div class="col-sm-10">											<?php foreach($color as $items=>$item) { ?>												<div class="checker checker_custom">													<span <?php $color_id = explode(",",$products->color_id); if(!empty($color_id)) foreach($color_id as $col_id) { if($col_id == $item->id) echo "class='checked'";}?>>														<input type='checkbox' value="<?=$item->id?>" <?php $color_id = explode(",",$products->color_id); if(!empty($color_id)) foreach($color_id as $col_id) { if($col_id == $item->id) echo "checked";}?> class='checkbox-input-class' name='color_id[]' style='background-color: <?=$item->value?>'>													</span>												</div>											<?php } ?>										</div>									</div>								<?php } ?>								<?php if(!empty($features)) { ?>									<div class="form-group">										<label class="col-sm-2 control-label"><?=@_features?></label>										<div class="col-sm-10">											<?php foreach($features as $items=>$item) { ?>												<label class='checkbox-inline' style="width: 30%; margin-right: 0;"><input type='checkbox' value="<?=$item->id?>" name='feature_id[]' <?php $feature_id = explode(",",$products->feature_id); if(!empty($feature_id)){ foreach($feature_id as $feature) { if($feature == $item->id) echo "checked='checked'";}}?>> <?=$item->name?></label>											<?php } ?>										</div>									</div>								<?php } ?>								<?php if(!empty($digital)) { ?>									<div class="form-group">										<label class="col-sm-2 control-label"><?=@_digital?></label>										<div class="col-sm-10">											<?php foreach($digital as $items=>$item) { ?>												<h5 style="font-weight: bold;"><?=$item->name?></h5>												<hr>												<?php $digital_content = $this->model->getListContent('digital_content', array('digital_id' => $item->id, 'products_id' => $result->id), "id asc", null, null, "id,value,properties")?>												<?php if(!empty($digital_content)) { ?>												<div id="digital_content_<?=$item->id?>">													<?php foreach($digital_content as $items1 => $item1) { ?>														<div class='form-group' style='position: relative;'>															<button type='button' onclick='deleteDigital(<?=$item1->id?>,"digital_content_<?=$item->id?>")' class='btn btn-default' style='position: absolute; left: -65px; z-index: 3; top: 2px; padding: 5px 10px; background: none; border-color: #eee; box-shadow: none;'><?=@_delete?></button>															<div class='col-md-6 col-sm-6' style='padding-right: 20px;'>																<input type='text' class='form-control' id='properties_<?=$item1->id?>' onchange='updateDigital(<?=$item1->id?>,"properties",this.value)' value='<?=$item1->properties?>' placeholder='Name'>															</div>															<div class='col-md-6 col-sm-6' style='padding-right: 20px;'>																<input type='text' class='form-control' id='value_<?=$item1->id?>' onchange='updateDigital(<?=$item1->id?>,value,this.value)' value='<?=$item1->value?>' placeholder='value'>															</div>														</div>													<?php } ?>												</div>												<?php } ?>												<div id='digital_<?=$item->id?>'>													<div class='form-group'>														<div class='col-md-6 col-sm-6' style='padding-right: 20px;'>															<input type='text' class='form-control' name='properties_<?=$item->id?>[]' placeholder='Name'>														</div>														<div class='col-md-6 col-sm-6' style='padding-right: 20px;'>															<input type='text' class='form-control' name='value_<?=$item->id?>[]' placeholder='Value'>														</div>													</div>												</div>												<div id='addDigital_<?=$item->id?>'></div>												<p class='text-right'><button type='button' class='btn btn-default' onclick='addDigital(<?=$item->id?>)'>Add Field</button></p>											<?php } ?>										</div>									</div>								<?php } ?>								<?php if(empty($result)) { ?>									<div class="note note-danger">										<p>											NOTE: Could not complete request. Please choose product categories.										</p>									</div>								<?php } ?>							</div>						</div>						<div class="tab-pane" id="tab_1_5">							<div class="form-group">								<label class="col-sm-2 control-label">Video</label>								<div class="col-sm-10">									<textarea class="form-control" rows="7" id="shortcontent" name="shortcontent"> <?php if(!empty($result)) echo $result->shortcontent?></textarea>									<script>										CKEDITOR.replace( 'shortcontent',											{												toolbarGroups: [													{"name":"basicstyles","groups":["basicstyles"]},													{"name":"links","groups":["links"]},													{"name":"paragraph","groups":["list","blocks"]},													{"name":"document","groups":["mode"]},													{"name":"insert","groups":["insert"]},													{"name":"styles","groups":["styles"]},													{"name":"colors","groups":["colors"]}												],												// Remove the redundant buttons from toolbar groups defined above.												removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar',												filebrowserBrowseUrl : '<?=PATH_URL?>asset/admincp/ckeditor/ckfinder/ckfinder.html',												filebrowserImageBrowseUrl : '<?=PATH_URL?>asset/admincp/ckeditor/ckfinder/ckfinder.html?type=Images',												filebrowserFlashBrowseUrl : '<?=PATH_URL?>asset/admincp/ckeditor/ckfinder/ckfinder.html?type=Flash',												filebrowserUploadUrl : '<?=PATH_URL?>asset/admincp/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',												filebrowserImageUploadUrl : '<?=PATH_URL?>asset/admincp/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',												filebrowserFlashUploadUrl : '<?=PATH_URL?>asset/admincp/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',												filebrowserWindowWidth : '500',												filebrowserWindowHeight : '500'											});									</script>								</div>							</div>						</div>						<div class="tab-pane" id="tab_1_6">							<div class="form-group">								<label class="col-sm-2 control-label"><?=@_content?></label>								<div class="col-sm-10">									<textarea class="form-control" rows="7" id="content" name="content"> <?php if(!empty($result)) echo $result->content?></textarea>									<script>										CKEDITOR.replace( 'content',											{												toolbarGroups: [													{"name":"basicstyles","groups":["basicstyles"]},													{"name":"links","groups":["links"]},													{"name":"paragraph","groups":["list","blocks"]},													{"name":"document","groups":["mode"]},													{"name":"insert","groups":["insert"]},													{"name":"styles","groups":["styles"]},													{"name":"colors","groups":["colors"]}												],												// Remove the redundant buttons from toolbar groups defined above.												removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar',												filebrowserBrowseUrl : '<?=PATH_URL?>asset/admincp/ckeditor/ckfinder/ckfinder.html',												filebrowserImageBrowseUrl : '<?=PATH_URL?>asset/admincp/ckeditor/ckfinder/ckfinder.html?type=Images',												filebrowserFlashBrowseUrl : '<?=PATH_URL?>asset/admincp/ckeditor/ckfinder/ckfinder.html?type=Flash',												filebrowserUploadUrl : '<?=PATH_URL?>asset/admincp/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',												filebrowserImageUploadUrl : '<?=PATH_URL?>asset/admincp/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',												filebrowserFlashUploadUrl : '<?=PATH_URL?>asset/admincp/ckeditor/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',												filebrowserWindowWidth : '500',												filebrowserWindowHeight : '500'											});									</script>								</div>							</div>						</div>						<div class="tab-pane" id="tab_1_3">							<div class="form-group">								<label class="col-sm-2 control-label">Meta Title</label>								<div class="col-sm-10">									<input type="text" class="form-control" autocomplete="off" id="title" name="title"  value="<?php if(!empty($result)) echo $result->title?>" placeholder="Title">								</div>							</div>							<div class="form-group">								<label for="description" class="col-sm-2 control-label">Meta Description</label>								<div class="col-sm-10">									<textarea class="form-control" rows="7" id="description" name="description"><?php if(!empty($result)) echo $result->description?></textarea>								</div>							</div>							<div class="form-group">								<label for="keywords" class="col-sm-2 control-label">Meta Keywords</label>								<div class="col-sm-10">									<textarea class="form-control" rows="7" id="keywords" name="keywords"> <?php if(!empty($result)) echo $result->keywords?></textarea>								</div>							</div>						</div>					</div>				</div>				<div class="form-group">					<div class="col-sm-offset-2 col-sm-10">						<button id="btn_submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> <?=@_save?></button>						<button type="button" onclick="return history.back()" class="btn btn-info"><i class="fa fa-ban"></i> <?=@_cancel?></button>					</div>				</div>			</div>			<div class="col-md-3 col-sm-3">				<div id="imgContent" style="display: none;">					<?php if(!empty($result)) { ?>						<?php if($result->images != '') { ?>							<img src="<?=PATH_URL?>img_data/<?=$result->images?>" class="file-preview-image" style="max-width: 100%;">						<?php } else { ?>							<img src="<?=PATH_URL?>img_data/no_images.gif" class="file-preview-image" style="max-width: 100%;">						<?php } ?>					<?php } else { ?>						<img src="<?=PATH_URL?>img_data/no_images.gif" class="file-preview-image" style="max-width: 100%;">					<?php } ?>				</div>				<input id="images" name="images" type="file" class="file-loading">				<?php if(!empty($result)) if($result->images != '') { ?>					<button class="btn btn-danger btn-destroy" type="button" onclick="deleteImageContent(<?=$result->id?>)" style="position: absolute; top: 0; right: 16px;"><i class="glyphicon glyphicon-trash"></i></button>				<?php } ?>			</div>		</div>	</form></div><script>	$(function(){		$("#btn_submit").bind('click',function(){			$("#frm_submit").validate({				rules: {					txtName: {						required: true					},					category: {						required: true					}				}			});		});		$("#images").bind('change',function(){			var name = this.files[0].name;			var ext = name.split(".");			ext = ext[ext.length-1];			if(ext.toLowerCase() != "png" && ext.toLowerCase() != "gif" && ext.toLowerCase() != "jpg" && ext.toLowerCase() != "jpge") {				this.value = "";				alert("Please choose file");			}		})	})	function addDigital(id) {		$("#addDigital_"+id).append($("#digital_"+id).html());	}	function updateDigital(id,field,val) {		$.post('<?=PATH_URL?>acp/products/updateDigital',{id:id,field:field,val:val},function(data){$("#"+field+"_"+id).val(val)})	}	function deleteDigital(id,field) {		$.post('<?=PATH_URL?>acp/products/deleteDigital',{id:id},function(data){$("#"+field).html(data)})	}	function deleteImageContent(id) {		$.post("<?=PATH_URL?>acp/products/deleteImageContent",{id:id},function(data){$("#imgContent").html(data); location.reload();});	}	function Delete(id) {		$.post("<?=PATH_URL?>acp/products/deleteImage",{id:id},function(data){$("#images_content").html(data)})	}	function addLinksNews(name){        checkLinks(name)		$("#title").val(name);		$("#description").val(name);		$("#keywords").val(name);    }    function checkLinks(name){        var links = cleanUnicode(name);        $.post("<?=PATH_URL?>acp/products/checkLinks",{links:links,id:$("#id").val()},function(data){var json = JSON.parse(data); $("#links").val(json.links)});    }	function getFeature(id,result_id) {		$.post("<?=PATH_URL?>acp/products/getFeature",{id:id,result_id:result_id},function(data){$("#attributes").html(data)});	}	function cleanUnicode(str){		str= str.toLowerCase();		str= str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a");		str= str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e");		str= str.replace(/ì|í|ị|ỉ|ĩ/g,"i");		str= str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o");		str= str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");		str= str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y");		str= str.replace(/đ/g,"d");		str= str.replace(/!|@|\$|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\'| |\"|\&|\#|\[|\]|\;|\||\{|\}|\~|\“|\”|\–|\-/g,"-");		str= str.replace(/^\-+|\-+$/g,"");		str= str.replace(/\\/g,"");		str= str.replace(/-+-/g,"-");		return str;	}</script>