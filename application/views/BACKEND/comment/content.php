<h3 class="page-title"><?=@_comments?> <small><?=@_all?> <?=@_comments?></small></h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="<?=PATH_URL?>acp"><?=@_home?></a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#"><?=@_comments?></a>
		</li>
	</ul>
</div>
<div class="panel-body">
	<div class="form-group">
        <button id="btn_submit" type="button" class="btn btn-success" onclick="return location.href='<?=PATH_URL?>acp/comments/add'"><?=@_add_new?> <i class="fa fa-plus"></i></button>
    </div>
	<form name="frmList" id="frm_content" method="post" action="<?=PATH_URL?>acp/comments/del" class="form-horizontal" enctype="multipart/form-data">
		<?php if($this->session->flashdata('success') == 1) echo '<p style="text-align: center; color: red;">Success !!!</p>'?>
		<table class="table table-striped table-bordered table-hover" id="sample_1">
			<thead class="flip-content">
				<tr>
					<th class="table-checkbox">
                        <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"/>
                    </th>
					<th><?=@_name?></th>
					<th style="max-width: 350px;"><?=@_content?></th>
					<th align="center">
						<i class="fa fa-check"></i>
					</th>
					<th><?=@_article?></th>
					<th style="min-width: 100px;"><?=@_action?></th>
				</tr>
			</thead>
			<tbody>
				<?php if(!empty($result)) { ?>
					<?php foreach($result as $items=>$item) { $article = $this->model->getContent('article', array('id' => $item->article_id), "name, links")?>
						<tr>
							<td align="center"><input type="checkbox" class="checkboxes" name="id[]" value="<?=$item->id?>"/></td>
							<td><?=stripslashes($item->name)?><br><a href="mailto:<?=$item->email?>"><?=$item->email?></a></td>
							<td><?=@_submited_on?> <a target="_blank" href="<?=PATH_URL.$article->links?>/#comments-<?=$item->id?>"><?=date("d M Y", $item->created).' at '.date("H:i a", $item->created)?></a> <br><?=stripslashes(CutText($item->content,250))?></td>
							<td align="center">
								<?php if($item->status == 1) { ?><i style="cursor: pointer; color: green;" onclick="updateStatus('<?=$item->id?>','status')" class="fa fa-check"></i><?php } else { ?><i style="cursor: pointer; color: red;" onclick="updateStatus('<?=$item->id?>','status')" class="fa fa-ban"></i><?php } ?>
							</td>
							<td><a target="_blank" href="<?=PATH_URL.$article->links?>/#comment-<?=$item->id?>"><?=$article?$article->name:""?></a></td>
							<td align="center">
								<a href="<?=PATH_URL?>acp/comments/edit/<?=$item->id?>" class="tooltips green btn btn-xs btn_delete_single" data-container="body" data-placement="top" data-original-title="<?=@_edit?>"><i class="fa fa-edit-o"></i> <?=@_edit?> </a>
								<a href="<?=PATH_URL?>acp/comments/del/<?=$item->id?>" class="tooltips red btn btn-xs btn_delete_single" data-container="body" data-placement="top" data-original-title="<?=@_delete?>"><i class="fa fa-trash-o"></i> <?=@_delete?> </a>
							</td>
						</tr>
					<?php } ?>
				<?php } ?>
			</tbody>
		</table>
		<div>
			<div class="pull-left" style="margin: 5px 0;">
				<label><?=@_with_selected?> </label>
				<button type="submit" name="hideButton" class="btn btn-sm green btn_delete_multi"><i class="fa fa-ban"></i> <?=@_deactive?></button>
				<button type="submit" name="delButton" onclick="return confirm('Are you sure delete?')" class="btn btn-sm red btn_delete_multi"><i class="fa fa-trash-o"></i> <?=@_delete?></button>
			</div>
			<div class="pull-right"><?php if(!empty($pageindex)) echo $pageindex;?></div>
			<div class="clearfix"></div>
		</div>
	</form>
</div>
<script>
    $(function(){
        $("#sample_1").DataTable({
            language: {
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                },
                "emptyTable": "No data available in table",
                "info": "Showing _START_ to _END_ of _TOTAL_ records",
                "infoEmpty": "No entries found",
                "infoFiltered": "(filtered1 from _MAX_ total records)",
                "lengthMenu": "Show _MENU_ records",
                "search": "Keywords:",
                "zeroRecords": "No matching records found"
            },
            "ordering": false,
            bStateSave: true,
            lengthMenu: [[10, 20, 50,-1],[10, 20, 50,"All"]],
            pageLength: 10
        });
    })
	function deleteAll() {
		var r = confirm('Are you sure !!!');
		if(r == true) {
			$("#frm_content").submit();
		}
	}
	function updateStatus(id,type) {
		$.post('<?=PATH_URL?>acp/comments/updateStatus',{id:id,type:type}, function(data){if(data == 1) location.reload();})
	}
</script>
