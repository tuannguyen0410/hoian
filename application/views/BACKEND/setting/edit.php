<style>
	.tabbable-custom > .tab-content {
		min-height: 250px;
	}
</style>
<h3 class="page-title">
	<?=@_setting?> <small><?=@_create_edit?> <?=@_setting?></small>
</h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="<?=PATH_URL?>acp"><?=@_home?></a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="<?=PATH_URL?>acp/products"><?=@_setting?></a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="javascript:;"><?=$this->uri->segment(3)?></a>
		</li>
	</ul>
</div>
<div class="panel-body">
	<form id="frm_submit" method="post" action="<?=PATH_URL?>acp/setting/save" class="form-horizontal" enctype="multipart/form-data">
		<input type="hidden" name="id" id="id" value="<?php if(!empty($result)) echo $result->id?>">
		<div class="row">
			<div class="col-md-9 col-sm-9">
				<div class="tabbable-custom ">
					<ul class="nav nav-tabs ">
						<li>
							<a href="#tab_1_1" data-toggle="tab"><?=@_general?></a>
						</li>
						<li>
							<a href="#tab_1_2" data-toggle="tab"><?=@_contact?></a>
						</li>
						<li class="active">
							<a href="#tab_1_4" data-toggle="tab"><?=@_location?></a>
						</li>
						<li>
							<a href="#tab_1_3" data-toggle="tab">S.E.O</a>
						</li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane" id="tab_1_1">
							<div class="form-group">
								<label class="col-sm-3 control-label"><?=@_website_title?></label>
								<div class="col-sm-9">
									<input type="text" class="form-control input-large"  autocomplete="off" id="website_title" name="website_title" value="<?php if(!empty($result)) echo $result->website_title;?>" placeholder="<?=@_website_title?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label"><?=@_price_plus?></label>
								<div class="col-sm-9">
									<input type="text" class="form-control input-large"  autocomplete="off" id="price_plus" name="price_plus" value="<?php if(!empty($result)) echo $result->price_plus;?>" placeholder="<?=@_price_plus?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label"><?=@_usd_to_vnd?></label>
								<div class="col-sm-9">
									<input type="text" class="form-control input-large"  autocomplete="off" id="usd_to_vnd" name="usd_to_vnd" value="<?php if(!empty($result)) echo $result->usd_to_vnd;?>" placeholder="<?=@_usd_to_vnd?>">
								</div>
							</div>
							<!--<div class="form-group">
								<label class="col-sm-3 control-label"><?=@_language_admin?></label>
								<div class="col-sm-9">
									<select name="language_admin" class="form-control input-large">
										<option value="en" <?php if(!empty($result)){ if($result->language_admin == 'en') echo "selected";}?>>English</option>
										<option value="" <?php if(!empty($result)){ if($result->language_admin == '') echo "selected";}?>>Vietnam</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label"><?=@_language_site?></label>
								<div class="col-sm-9">
									<select name="language_site" class="form-control input-large">
										<option value="_en" <?php if(!empty($result)){ if($result->language_site == '_en') echo "selected";}?>>English</option>
										<option value="" <?php if(!empty($result)){ if($result->language_site == '') echo "selected";}?>>Vietnam</option>
									</select>
								</div>
							</div>-->
							<!--<div class="form-group">
								<label class="col-sm-3 control-label"><?=@_facebook_id?></label>
								<div class="col-sm-9">
									<input type="text" class="form-control input-large"  autocomplete="off" id="facebook_id" name="facebook_id" value="<?php if(!empty($result)) echo $result->facebook_id;?>" placeholder="<?=@_facebook_id?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label"><?=@_facebook_secret?></label>
								<div class="col-sm-9">
									<input type="text" class="form-control input-large"  autocomplete="off" id="facebook_secret" name="facebook_secret" value="<?php if(!empty($result)) echo $result->facebook_secret;?>" placeholder="<?=@_facebook_secret?>">
								</div>
							</div>-->
							
						</div>
						<div class="tab-pane" id="tab_1_2">
							<div class="form-group">
								<label class="col-sm-3 control-label"><?=@_owner_company?></label>
								<div class="col-sm-9">
									<input type="text" class="form-control input-large"  autocomplete="off" id="owner_company" name="owner_company" value="<?php if(!empty($result)) echo $result->owner_company;?>" placeholder="<?=@_owner_company?>">
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-3 control-label"><?=@_phone?> 1</label>
								<div class="col-sm-9">
									<input type="text" class="form-control input-large"  autocomplete="off" id="phone" name="phone" value="<?php if(!empty($result)) echo $result->phone;?>" placeholder="<?=@_phone?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label"><?=@_phone?> 2</label>
								<div class="col-sm-9">
									<input type="text" class="form-control input-large"  autocomplete="off" name="owner_address" value="<?php if(!empty($result)) echo $result->owner_address;?>" placeholder="<?=@_phone?>">
								</div>
							</div>							
                            <div class="form-group">
								<label class="col-sm-3 control-label"><?=@_fax?></label>
								<div class="col-sm-9">
									<input type="text" class="form-control input-large"  autocomplete="off" id="fax" name="fax" value="<?php if(!empty($result)) echo $result->fax;?>" placeholder="<?=@_fax?>">
								</div>
							</div> 
							<div class="form-group">
								<label class="col-sm-3 control-label"><?=@_email?></label>
								<div class="col-sm-9">
									<input type="text" class="form-control input-large"  autocomplete="off" id="email" name="email" value="<?php if(!empty($result)) echo $result->email;?>" placeholder="<?=@_email?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label"><?=@_yahoo_support?></label>
								<div class="col-sm-9">
									<input type="text" class="form-control input-large"  autocomplete="off" id="yahoo_support" name="yahoo_support" value="<?php if(!empty($result)) echo $result->yahoo_support;?>" placeholder="<?=@_yahoo_support?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label"><?=@_skype_support?></label>
								<div class="col-sm-9">
									<input type="text" class="form-control input-large"  autocomplete="off" id="skype_support" name="skype_support" value="<?php if(!empty($result)) echo $result->skype_support;?>" placeholder="<?=@_skype_support?>">
								</div>
							</div>
						</div>
						<div class="tab-pane active" id="tab_1_4">
							<div class="form-group">
								<label class="col-sm-2 control-label"><b><?=@_address?>:</b></label>
								<div class="col-sm-10">
									<input name="address" placeholder="14 Ham Nghi st. Ben Nghe Ward, 1 District" id="txtAddress" class="form-control" maxlength="255" type="text" value="<?php if(!empty($result)) echo $result->address;?>"/>
								</div>
							</div>
							<div class="row">
                <div class="col-md-4">
                	<div id="infoPanel" class="col-md-12">
                    <div class="form-group">
                      <label class=""><b>Maker status:</b></label>
                      <div id="markerStatus"><i>Click and drag the Maker.</i></div>
                    </div>
                		<div class="form-group">
                			<label class=""><b>Closest matching address:</b></label>
                			<div id="address"></div>
                		</div>
               			<div class="form-group">
                			<label class="control-label"><b>Latitude:</b></label>
                			<input name="latitude" id="txtLatitude" class="form-control" maxlength="100" type="text" value="<?php if(!empty($result)) echo $result->latitude?>"/>
                        </div>
                        <div class="form-group">
                			<label class="control-label"><b>Longitude:</b></label>
                			<input name="longitude" id="txtLongitude" class="form-control" maxlength="100" type="text" value="<?php if(!empty($result)) echo $result->longitude?>"/>
                		</div>
                	</div>
                </div><!--end col-md-4 -->
                <div class="col-md-8">
                    <style type="text/css">
                     #mapCanvas {
                         height: 500px;
                         width:500px;
                     }
                    </style>
                    <div id="mapCanvas" class="col-md-12" style="margin-left:0px;"></div>
                </div><!-- end col-md-8 -->
              </div>
						</div>
						<div class="tab-pane" id="tab_1_5">
							<div class="form-group">
								<label class="col-sm-3 control-label"><?=@_product_per_page?></label>
								<div class="col-sm-9">
									<input type="text" class="form-control input-large"  autocomplete="off" id="product_per_page" name="product_per_page" value="<?php if(!empty($result)) echo $result->product_per_page;?>" placeholder="<?=@_product_per_page?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label"><?=@_article_per_page?></label>
								<div class="col-sm-9">
									<input type="text" class="form-control input-large"  autocomplete="off" id="article_per_page" name="article_per_page" value="<?php if(!empty($result)) echo $result->article_per_page;?>" placeholder="<?=@_article_per_page?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label"><?=@_row_per_page?></label>
								<div class="col-sm-9">
									<input type="text" class="form-control input-large"  autocomplete="off" id="row_per_page" name="row_per_page" value="<?php if(!empty($result)) echo $result->row_per_page;?>" placeholder="<?=@_row_per_page?>">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label"><?=@_comment_per_page?></label>
								<div class="col-sm-9">
									<input type="text" class="form-control input-large"  autocomplete="off" id="comment_per_page" name="comment_per_page" value="<?php if(!empty($result)) echo $result->comment_per_page;?>" placeholder="<?=@_comment_per_page?>">
								</div>
							</div>
						</div>
						<div class="tab-pane" id="tab_1_3">
							<div class="form-group">
								<label class="col-sm-3 control-label">Meta Title</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" autocomplete="off" id="title" name="title"  value="<?php if(!empty($result)) echo $result->title?>" placeholder="Title">
								</div>
							</div>
							<div class="form-group">
								<label for="description" class="col-sm-3 control-label">Meta Description</label>
								<div class="col-sm-9">
									<textarea class="form-control" rows="7" id="description" name="description"><?php if(!empty($result)) echo $result->description?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label for="keywords" class="col-sm-3 control-label">Meta Keywords</label>
								<div class="col-sm-9">
									<textarea class="form-control" rows="7" id="keywords" name="keywords"><?php if(!empty($result)) echo $result->keywords?></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Google Analytic ID</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" autocomplete="off" id="google_analytic_id" name="google_analytic_id"  value="<?php if(!empty($result)) echo $result->google_analytic_id?>" placeholder="Google Analytic ID">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Facebook Url</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" autocomplete="off" id="facebook_url" name="facebook_url"  value="<?php if(!empty($result)) echo $result->facebook_url?>" placeholder="Facebook Url">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Google Plus</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" autocomplete="off" id="google_plus" name="google_plus"  value="<?php if(!empty($result)) echo $result->google_plus?>" placeholder="Google Plus">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Twitter Plus</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" autocomplete="off" id="twitter_plus" name="twitter_plus"  value="<?php if(!empty($result)) echo $result->twitter_plus?>" placeholder="Twitter Plus">
								</div>
							</div>
                            <div class="form-group">
								<label class="col-sm-3 control-label">Youtube Url</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" autocomplete="off" id="youtube_url" name="youtube_url"  value="<?php if(!empty($result)) echo $result->youtube_url?>" placeholder="Youtube Url">
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-9">
						<button id="btn_submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> <?=@_save?></button>
						<button type="button" onclick="return history.back()" class="btn btn-info"><i class="fa fa-ban"></i> <?=@_cancel?></button>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-3">
			    <div class="portlet box green">
					<div class="portlet-title">
						<div class="caption">
							Logo
						</div>
						<div class="tools">
							<a href="javascript:;" class="collapse"></a>
						</div>
					</div>
					<div class="portlet-body" style="position: relative;">
						<div id="imgContent" style="display: none;">
							<?php if(!empty($result)) { ?>
								<?php if($result->images != '') { ?>
									<img src="<?=PATH_URL?>media/<?=$result->images?>" style="width: 100%;">
								<?php } else { ?>
									<img src="<?=PATH_URL?>media/no_images.gif" style="width: 100%;">
								<?php } ?>
							<?php } else { ?>
								<img src="<?=PATH_URL?>media/no_images.gif" style="width: 100%;">
							<?php } ?>
						</div>
						<input id="images" name="images" type="file" class="file-loading">
						<?php if(!empty($result)) if($result->images != '') { ?>
							<button class="btn btn-danger btn-destroy" type="button" onclick="deleteImageContent(<?=$result->id?>)" style="position: absolute; top: 10px; right: 10px;"><i class="glyphicon glyphicon-trash"></i></button>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<style>
	.tab-content>.active {
		display: block !important;
	}
</style>
<script>
	$(window).load(function(){
		setTimeout(function(){
				$("#tab_1_4").css({"display":"none","width":"auto","height":"auto"});
		},2000);
	})
	$(function(){
		$("#images").bind('change',function(){
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
		})
	})
	function deleteImageContent(id) {
		$.post("<?=PATH_URL?>acp/setting/deleteImageContent",{id:id},function(data){$("#imgContent").html(data); location.reload();});
	}
</script>
