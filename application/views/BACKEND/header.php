<div class="page-header -i navbar navbar-fixed-top">
	<div class="page-header-inner">
		<div class="page-logo">
			<a href="<?=PATH_URL?>acp" style="color: #FFF; line-height: 46px; font-size: 18px;">ADMINISTRATOR</a>
		</div>
		<div class="top-menu">
			<ul class="nav navbar-nav pull-right">
				<li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
					<a href="<?=PATH_URL?>acp/comments" class="dropdown-toggle">
					<i class="icon-bell"></i>
					<span class="badge badge-default"><?=$this->db->get_where('comment', array('status' => 0))->num_rows()?></span>
					</a>
					<ul class="dropdown-menu"></ul>
				</li>
				<li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
					<a href="<?=PATH_URL?>" target="_blank" class="dropdown-toggle" style="padding-top: 14px; padding-bottom: 12px;">
						<i class="fa fa-home"></i>
						<span class="username username-hide-on-mobile text-capitalize" style="color: #c6cfda; padding-right: 15px; margin-top: -5px;">My Site</span>
					</a>
				</li>
				<li class="dropdown dropdown-user">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
						<span class="username username-hide-on-mobile text-capitalize"><?=$this->session->userdata('user_admin')?></span>
						<i class="fa fa-angle-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-menu-default">
						<li>
							<a href="<?=PATH_URL?>acp/contact"> <i class="icon-envelope-open"></i> My Inbox <span class="badge badge-danger"> <?=$this->db->get_where('contact', array('status' => 0))->num_rows()?> </span> </a>
						</li>
						<li class="divider"></li>
						<li>
							<a href="<?=PATH_URL?>acp/reset-password"><i class="icon-lock"></i> Reset Password</a>
						</li>
						<li>
							<a href="<?=PATH_URL?>acp/logout"><i class="icon-logout"></i> Log Out </a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</div>