<div class="page-sidebar-wrapper">
	<div class="page-sidebar navbar-collapse collapse">
		<ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
			<li class="sidebar-toggler-wrapper">
				<div class="sidebar-toggler">
				</div>
			</li>
			<?php $user_groups = $this->model->getContent('user', array('username' => $this->session->userdata('user_admin')), "groups");?>
			
			<li class="sidebar-search-wrapper">
				<form class="sidebar-search " action="extra_search.html" method="POST">
					<a href="javascript:;" class="remove">
					<i class="icon-close"></i>
					</a>
					<!--<div class="input-group">
						<input type="text" class="form-control" placeholder="Search...">
						<span class="input-group-btn">
						<a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
						</span>
					</div>-->
				</form>
			</li>
			<?php if(!empty($user_groups)) { ?>
			<li class="start <?php if(!empty($active) && $active == "dashboard") echo "active"; ?>">
				<a href="<?=PATH_URL?>acp"> <i class="icon-home"></i>
					<span class="title"><?=@_dashboard?></span>
					<?php if(!empty($active) && $active == "dashboard") { ?>
					<span class="selected"></span>
					<?php } ?>
				</a>
			</li>
			<?php if($user_groups->groups == "editor" || $user_groups->groups == "managers" || $user_groups->groups == "administrators") { ?>
			<li class="heading">
				<h3 class="uppercase"><?=@_article?></h3>
			</li>
			<li class="<?php if(!empty($active) && $active == "article") echo "active"; ?>">
				<a href="<?=PATH_URL?>acp/article">
					<i class="icon-speech"></i> <span class="title"><?=@_all_article?></span>
					<?php if(!empty($active) && $active == "article") { ?>
					<span class="selected"></span>
					<?php } ?>
				</a>
			</li>
			<li class="<?php if(!empty($active) && $active == "article_categories") echo "active"; ?>">
				<a href="<?=PATH_URL?>acp/article/categories">
					<i class="icon-link"></i> <span class="title"><?=@_category?></span>
					<?php if(!empty($active) && $active == "article_categories") { ?>
					<span class="selected"></span>
					<?php } ?>
				</a>
			</li>
            
            
			<li class="heading">
				<h3 class="uppercase">Tours</h3>
			</li>
			<li class="<?php if(!empty($active) && $active == "tour" && (strlen(strstr($slug, 'book')) == 0)) echo "active"; ?>">
				<a href="<?=PATH_URL?>acp/tour">
					<i class="icon-flag"></i> <span class="title">All Tour</span>
					<?php if(!empty($active) && $active == "tour") { ?>
					<span class="selected"></span>
					<?php } ?>
				</a>
			</li>
			<li class="<?php if(!empty($active) && $active == "tour_categories") echo "active"; ?>">
				<a href="<?=PATH_URL?>acp/tour/categories">
					<i class="icon-link"></i> <span class="title"><?=@_category?></span>
					<?php if(!empty($active) && $active == "tour_categories") { ?>
					<span class="selected"></span>
					<?php } ?>
				</a>
			</li>
			<li class="<?php if(!empty($active) && $active == "tour" && (strlen(strstr($slug, 'book')) > 0)) echo "active"; ?>">
				<a href="<?=PATH_URL?>acp/tour/book">
					<i class="icon-flag"></i> <span class="title">Booking</span> 
					<?php if(!empty($active) && $active == "tour") { ?>  
					<span class="selected"></span>
					<?php } ?>
				</a>
			</li>
			<?php } ?>
			<?php if($user_groups->groups == "managers" || $user_groups->groups == "administrators") { ?>
			<li class="heading">
				<h3 class="uppercase">Banner</h3>
			</li>
			<li class="<?php if(!empty($active) && $active == "banner") echo "active"; ?>">
				<a href="<?=PATH_URL?>acp/banner">
					<i class="icon-flag"></i> <span class="title">All Banner</span>
					<?php if(!empty($active) && $active == "banner") { ?>
					<span class="selected"></span>
					<?php } ?>
				</a>
			</li>
                <!--<li class="<?php if(!empty($active) && $active == "banner_categories") echo "active"; ?>">
                    <a href="<?=PATH_URL?>acp/banner/categories">
                        <i class="icon-link"></i> <span class="title"><?=@_category?></span>
                        <?php if(!empty($active) && $active == "banner_categories") { ?>
                        <span class="selected"></span>
                        <?php } ?>
                    </a>
                </li>-->

			<li class="heading">
				<h3 class="uppercase"><?=@_pages?></h3>
			</li>
			<!--<li class="<?php if(!empty($active) && $active == "menu") echo "active"; ?>">
				<a href="<?=PATH_URL?>acp/menu">
					<i class="fa fa-bars"></i> <span class="title">Menu</span>
					<?php if(!empty($active) && $active == "menu") { ?>
					<span class="selected"></span>
					<?php } ?>
				</a>
			</li>-->
			<li class="<?php if(!empty($active) && $active == "contact") echo "active"; ?>">
				<a href="<?=PATH_URL?>acp/contact">
					<i class="icon-envelope-open"></i> <span class="title"><?=@_contact?></span>
					<?php if(!empty($active) && $active == "contact") { ?>
						<span class="selected"></span>
					<?php } ?>
				</a>
			</li>
			
			<!-- ONLINE BOOKING -->
			<!--<li class="<?php if(!empty($active) && $active == "booking") echo "active"; ?>">
				<a href="<?=PATH_URL?>acp/booking">
					<i class="fa fa-bookmark"></i> <span class="title"><?=@_booking?></span>
					<?php if(!empty($active) && $active == "booking") { ?>
						<span class="selected"></span>
					<?php } ?>
				</a>
			</li>-->
			<!--<li class="<?php if(!empty($active) && $active == "faqs") echo "active"; ?>">
				<a href="<?=PATH_URL?>acp/faqs">
					<i class="icon-question"></i> <span class="title"><?=@_faqs?></span>
					<?php if(!empty($active) && $active == "faqs") { ?>
					<span class="selected"></span>
					<?php } ?>
				</a>
			</li>
			<li class="<?php if(!empty($active) && $active == "feedback") echo "active"; ?>">
				<a href="<?=PATH_URL?>acp/feedback">
					<i class="icon-bubble"></i> <span class="title"><?=@_feedback?></span>
					<?php if(!empty($active) && $active == "feedback") { ?>
					<span class="selected"></span>
					<?php } ?>
				</a>
			</li>-->
			<!--<li class="<?php if(!empty($active) && $active == "comments") echo "active"; ?>">
				<a href="<?=PATH_URL?>acp/comments">
					<i class="icon-bubble"></i> <span class="title"><?=@_comments?></span>
					<?php if(!empty($active) && $active == "comments") { ?>
					<span class="selected"></span>
					<?php } ?>
				</a>
			</li>
			<li class="<?php if(!empty($active) && $active == "newsletter") echo "active"; ?>">
				<a href="<?=PATH_URL?>acp/newsletter">
					<i class="icon-envelope-letter"></i> <span class="title"><?=@_newsletter?></span>
					<?php if(!empty($active) && $active == "newsletter") { ?>
					<span class="selected"></span>
					<?php } ?>
				</a>
			</li>-->
			<?php } }?>
			<?php if($user_groups->groups == "administrators") { ?>
			<li class="heading">
				<h3 class="uppercase"><?=@_setting?></h3>
			</li>
			<!--<li class="<?php if(!empty($active) && $active == "users") echo "active"; ?>">
				<a href="<?=PATH_URL?>acp/users">
					<i class="icon-users"></i><span class="title"><?=@_user?></span>
					<?php if(!empty($active) && $active == "users") { ?>
					<span class="selected"></span>
					<?php } ?>
				</a>
			</li>-->
			<li class="<?php if(!empty($active) && $active == "setting") echo "active"; ?>">
				<a href="<?=PATH_URL?>acp/setting">
					<i class="icon-settings"></i> <span class="title"><?=@_general?></span>
					<?php if(!empty($active) && $active == "setting") { ?>
					<span class="selected"></span>
					<?php } ?>
				</a>
			</li>
			<li class="<?php if(!empty($active) && $active == "translate") echo "active"; ?>">
				<a href="<?=PATH_URL?>acp/translate">
					<i class="fa fa-globe"></i> <span class="title"><?=@_translate?></span>
					<?php if(!empty($active) && $active == "translate") { ?>
					<span class="selected"></span>
					<?php } ?>
				</a>
			</li>
			<?php } ?>
		</ul>
	</div>
</div>
