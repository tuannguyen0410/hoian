<style>	.tabbable-custom > .tab-content {		min-height: 250px;	}</style><h3 class="page-title">	<?=@_contact?> <small><?=@_create_edit?> <?=@_contact?></small></h3><div class="page-bar">	<ul class="page-breadcrumb">		<li>			<i class="fa fa-home"></i>			<a href="<?=PATH_URL?>acp"><?=@_home?></a>			<i class="fa fa-angle-right"></i>		</li>		<li>			<a href="<?=PATH_URL?>acp/article"><?=@_contact?></a>			<i class="fa fa-angle-right"></i>		</li>		<li>			<a href="javascript:;"><?=$this->uri->segment(3)?></a>		</li>	</ul></div><div class="portlet-body form">	<!-- BEGIN FORM-->	<form class="form-horizontal" method="post" role="form" action="<?=PATH_URL?>acp/contact/save">		<input type="hidden" name="id" value="<?php if(!empty($result)) echo $result->id?>">		<div class="form-body">			<h3 class="form-section"><?=@_customer_info?></h3>			<div class="form-group">				<label class="control-label col-md-3"><?=@_full_name?></label>				<div class="col-md-9">					<p class="form-control-static">						<b><?php if(!empty($result)) echo $result->name;?></b>					</p>				</div>			</div>			<div class="form-group">				<label class="control-label col-md-3"><?=@_email?></label>				<div class="col-md-9">					<p class="form-control-static">						<b><?php if(!empty($result)) echo $result->email;?></b>					</p>				</div>			</div>			<div class="form-group">				<label class="control-label col-md-3"><?=@_content?></label>				<div class="col-md-9">					<p class="form-control-static">						<b><?php if(!empty($result)) echo $result->content;?></b>					</p>				</div>			</div>			<div class="form-group">				<label class="control-label col-md-3"><?=@_created?></label>				<div class="col-md-9">					<p class="form-control-static">						<b><?php if(!empty($result)) echo date("d/m/Y H:i:s", $result->created);?></b>					</p>				</div>			</div>			<div class="form-group">				<label class="control-label col-md-3"><?=@_status?></label>				<div class="col-md-9">					<p class="form-control-static">						<input type="checkbox" name="status" checked="checked"/> <?=@_active?>					</p>				</div>			</div>		</div>		<div class="form-actions">			<div class="row">				<div class="col-md-6">					<div class="row">						<div class="col-md-offset-3 col-md-9">							<button type="submit" class="btn green"><i class="fa fa-pencil"></i> <?=@_edit?></button>						</div>					</div>				</div>				<div class="col-md-6">				</div>			</div>		</div>	</form>	<!-- END FORM--></div>