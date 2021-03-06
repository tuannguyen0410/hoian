<h3 class="page-title"><?=@_newsletter?> <small><?=@_all?> <?=@_newsletter?></small></h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="<?=PATH_URL?>acp"><?=@_home?></a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#"><?=@_newsletter?></a>
		</li>
	</ul>
</div>
<div class="panel-body">
	<form name="frmList" id="frm_content" method="post" action="<?=PATH_URL?>acp/newsletter/del" class="form-horizontal" enctype="multipart/form-data">
		<?php if($this->session->flashdata('success') == 1) echo '<p style="text-align: center; color: red;">Success !!!</p>'?>
		<table class="table table-striped table-bordered table-hover" id="sample_1">
			<thead class="flip-content">
				<tr>
					<th>#</th>
					<th style="min-width: 250px;"><?=@_full_name?></th>
					<th><?=@_email?></th>
					<th><?=@_created?></th>
					<th><?=@_content?></th>
					<th align="center"><?=@_action?></th>
					<th class="table-checkbox" align="center">
                        <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"/>
                    </th>
				</tr>
			</thead>
			<tbody>
				<?php if(!empty($result)) { ?>
					<?php $i = 0; foreach($result as $items=>$item) { $i++;?>
						<tr>
							<td><?=$i?></td>
							<td><?=$item->name?></td>
							<td><?=$item->email?></td>
							<td><?=date('d/m/Y', $item->created)?></td>
							<td><?=$item->content?></td>
							<td align="center">
								<a href="<?=PATH_URL?>acp/newsletter/del/<?=$item->id?>" class="tooltips red btn btn-xs btn_delete_single" data-container="body" data-placement="top" data-original-title="<?=@_delete?>"><i class="fa fa-trash-o"></i> <?=@_delete?> </a>
							</td>
							<td align="center"><input type="checkbox" class="checkboxes" name="id[]" value="<?=$item->id?>"/></td>
						</tr>
					<?php } ?>
				<?php } ?>
			</tbody>
		</table>
		<div>
			<div class="pull-left" style="margin: 5px 0;">
				<label><?=@_with_selected?>: </label>
				<button type="submit" name="delButton" onclick="return confirm('Are you sure delete?')" class="btn btn-sm red btn_delete_multi"><i class="fa fa-trash-o"></i> <?=@_delete?></button>
				<button type="submit" name="exportXls" class="btn btn-sm green btn_delete_multi"><i class="fa fa-download"></i> <?=@_export_xls?></button>
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
		$.post('<?=PATH_URL?>acp/newsletter/updateStatus',{id:id,type:type}, function(data){if(data == 1) location.reload();})
	}
</script>
