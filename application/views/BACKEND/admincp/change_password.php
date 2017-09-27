<style>
	.tabbable-custom > .tab-content {
		min-height: 250px;
	}
</style>
<h3 class="page-title">
	<?=@_user?> <small><?=@_reset_password?></small>
</h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="<?=PATH_URL?>acp">Home</a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#"><?=@_reset_password?></a>
		</li>
	</ul>
</div>
<div class="panel-body">
	<form id="frm_submit" method="post" action="<?=PATH_URL?>acp/reset-password/save" class="form-horizontal" enctype="multipart/form-data">
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
							<div class="form-body">
								<div class="form-group">
									<label class="col-md-3 control-label"><?=@_old_password?></label>
									<div class="col-md-6">
										<input type="password" class="form-control" id="old_password" onchange="checkPassword(this.value)" name="old_password" placeholder="<?=@_old_password?>">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label"><?=@_password?></label>
									<div class="col-md-6">
										<div class="input-icon">
										    <i class="fa fa-lock fa-fw"></i>
											<input type="password" class="form-control" required minlength="6" id="new_password" name="new_password" placeholder="<?=@_password?>">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label"><?=@_confirm_password?></label>
									<div class="col-md-6">
										<div class="input-icon">
											<i class="fa fa-lock fa-fw"></i>
											<input type="password" class="form-control" id="re_new_password" name="re_new_password" placeholder="<?=@_confirm_password?>">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label"><?=@_email?></label>
									<div class="col-md-6">
										<input type="text" class="form-control" id="txtEmail" name="txtEmail" value="<?php if(!empty($result)) echo $result->email?>" placeholder="E-mail">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button id="btn_submit" type="submit" class="btn btn-success"><i class="fa fa-save"></i> <?=@_save?></button>
						<button type="button" onclick="return location.href='<?=PATH_URL?>acp'" class="btn btn-info"><i class="fa fa-ban"></i> <?=@_cancel?></button>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<script>
	function checkPassword(val){
		$.post('<?=PATH_URL?>acp/checkPassword',{password:val},function(data){if(data == 0){alert("Password not true!"); $("#old_password").val(''); $("#old_password").focus();}})
	}
	$(function(){
		$("#btn_submit").bind('click',function(){
			$("#frm_submit").validate({
				rules: {
					old_password: {
						required: true,
						minlength: 6
					},
					new_password: {
						required: true,
						minlength: 6,
						maxlength: 32
					},
					re_new_password: {
						required: true,
						equalTo: "#new_password"
					},
					txtEmail: {
						required: true,
						email: true
					}
				}
				/* messages: {
					old_password: {
						required: "Please enter oll password",
						minlength: "Min length 6 charaters"
					},
					new_password: {
						required: "Vui lòng nhập password mới ",
						minlength: " Nhập ít nhất phải là 6 ký tự "
						
					},
					re_new_password: {
						required: " Bạn phải nhập re-password mới ",
						minlength: " Nhập ít nhất là 6 ký tự ",
						equalTo: " password và re-password không giống nhau "
					},
					txtEmail: "Vui lòng nhập địa chỉ email "
				} */
			});
        
		})
	})
</script>