 <style type="text/css" media="screen">
 	.rss a{margin-left:10px;color:#000;}
 	.rss a:hover{color:#61a78b;}
 </style>

 <div class="container rss">
 <h3>Blog</h3>
 	<?php foreach ($article as $key => $val) {

 		?>
 		<p><i class="fa fa-rss" aria-hidden="true"></i><a  href="<?=PATH_URL.'rss/'.$val->id?>" ><?=$val->name ?></a></p>
 		<?php } ?>
 		<h3>Tour</h3>
 		<?php foreach ($tour as $key => $val) {
 			?>
 			<p><i class="fa fa-rss" aria-hidden="true"></i><a href="<?=PATH_URL.'rss/'.$val->id?>" ><?=$val->name ?></a></p>
 			<?php } ?>
 	<!-- 		<h3>Page</h3>
 			<?php foreach ($page as $key => $val) {
 				?>
 				<p><i class="fa fa-rss" aria-hidden="true"></i><a href="<?=PATH_URL.'rss/'.$val->id?>" ><?=$val->name ?></a></p>
 				<?php } ?> -->
 			</div>