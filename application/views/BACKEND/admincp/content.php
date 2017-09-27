<!-- BEGIN PAGE HEADER-->
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?=PATH_URL?>acp"><?=@_home?></a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#"><?=@_dashboard?></a>
					</li>
				</ul>
			</div>
			<h3 class="page-title"> <?=@_dashboard?> <small>reports & statistics</small> </h3>
			<!-- END PAGE HEADER-->
			<!-- BEGIN DASHBOARD STATS -->
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="dashboard-stat blue-madison">
						<div class="visual">
							<i class="fa fa-comments"></i>
						</div>
						<div class="details">
							<div class="number"> <?=$this->db->get_where('article', array('type' => 'article'))->num_rows()?></div>
							<div class="desc"> <?=@_article?></div>
						</div>
						<a class="more" href="<?=PATH_URL?>acp/article">View more <i class="m-icon-swapright m-icon-white"></i></a>
					</div>
				</div>
				<!--<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat red-intense">
						<div class="visual">
							<i class="fa fa-bar-chart-o"></i>
						</div>
						<div class="details">
							<div class="number"> <?=$this->db->get_where('newsletter')->num_rows()?></div>
							<div class="desc"> <?=@_newsletter?> </div>
						</div>
						<a class="more" href="<?=PATH_URL?>acp/newsletter"> View more <i class="m-icon-swapright m-icon-white"></i> </a>
					</div>
				</div>-->
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="dashboard-stat green-haze">
						<div class="visual">
							<i class="fa fa-shopping-cart"></i>
						</div>
						<div class="details">
							<div class="number"> <?=$this->db->get_where('contact')->num_rows()?> </div>
							<div class="desc"> <?=@_contact?> </div>
						</div>
						<a class="more" href="<?=PATH_URL?>acp/contact"> View more <i class="m-icon-swapright m-icon-white"></i> </a>
					</div>
				</div>
				<!--<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="dashboard-stat purple-plum">
						<div class="visual">
							<i class="fa fa-globe"></i>
						</div>
						<div class="details">
							<div class="number"> <?=$this->db->get_where('faqs', array('type' => 'feedback'))->num_rows()?> </div>
							<div class="desc"> <?=@_feedback?> </div>
						</div>
						<a class="more" href="<?=PATH_URL?>acp/feedback"> View more <i class="m-icon-swapright m-icon-white"></i> </a>
					</div>
				</div>-->
			</div>
			<!-- END DASHBOARD STATS -->
			<div class="clearfix"></div>
			<div class="row">
				<div class="col-md-6 col-sm-6">
					<div class="portlet light ">
						<div class="portlet-title">
							<div class="caption">
								<i class="icon-share font-blue-steel hide"></i>
								<span class="caption-subject font-blue-steel bold uppercase"><?=@_article?></span>
							</div>

						</div>
						<div class="portlet-body">
							<div class="scroller" style="height: 300px;" data-always-visible="1" data-rail-visible="0">
								<ul class="feeds">
									<?php $article = $this->model->getListContent('article', array('type' => 'article'), 'updated desc', 20, 0, "name, updated")?>
									<?php if(!empty($article)) { ?>
										<?php foreach($article as $items=>$item) { ?>
											<li>
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="label label-sm label-info">
																<i class="fa fa-check"></i>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																<?=$item->name?>
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														<?=date('d/m/Y', $item->updated)?>
													</div>
												</div>
											</li>
										<?php } ?>
									<?php } ?>
								</ul>
							</div>
							<div class="scroller-footer">
								<div class="btn-arrow-link pull-right">
									<a href="javascript:;">See All Records</a>
									<i class="icon-arrow-right"></i>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-sm-6">
					<!-- BEGIN PORTLET-->
					<div class="portlet light">
						<div class="portlet-title tabbable-line">
							<div class="caption">
								<i class="icon-globe font-green-sharp"></i>
								<span class="caption-subject font-green-sharp bold uppercase"><?=@_contact?></span>
							</div>
						</div>
						<div class="portlet-body">
							<div class="scroller" style="height: 339px;" data-always-visible="1" data-rail-visible="0">
								<ul class="feeds">
									<?php $contact = $this->model->getListContent('contact', null, 'created desc', 20, 0, "name, created,id")?>
									<?php if(!empty($contact)) { ?>
										<?php foreach ($contact as $items => $item) { $arrayName = array('success', 'danger', 'info', 'warning', 'default'); $class = array_rand($arrayName,1)?>
											<li>
												<div class="col1">
													<div class="cont">
														<div class="cont-col1">
															<div class="label label-sm label-<?=$class?>">
																<i class="fa fa-bullhorn"></i>
															</div>
														</div>
														<div class="cont-col2">
															<div class="desc">
																<a href='<?=PATH_URL?>acp/contact/edit/<?=$item->id?>'><?=$item->name?></a>
															</div>
														</div>
													</div>
												</div>
												<div class="col2">
													<div class="date">
														<?=date('d/m/Y', $item->created)?>
													</div>
												</div>
											</li>
										<?php } ?>
									<?php } ?>
								</ul>
							</div>
						</div>
					</div>
					<!-- END PORTLET-->
				</div>
			</div>
