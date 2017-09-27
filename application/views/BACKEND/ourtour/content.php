<h3 class="page-title"><?=@_contact?> <small><?=@_all?> <?=@_contact?></small></h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="<?=PATH_URL?>acp"><?=@_home?></a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#"><?=@_contact?></a>
		</li>
	</ul>
</div>
<div class="panel-body">
	<form name="frmList" id="frm_content" method="post" action="<?=PATH_URL?>acp/contact/del" class="form-horizontal" enctype="multipart/form-data">
		<table class="table table-striped table-bordered table-hover" id="sample_1">
			<thead class="flip-content">
				<tr>
					<th style="min-width: 250px;"><?=@_full_name?></th>
					<th><?=@_email?></th>
					<th><?=@_content?></th>
					<th><?=@_created?></th>
					<th><i class="fa fa-eye"></i></th>
					<th style="min-width: 150px;"><?=@_action?></th>
					<th class="table-checkbox">
                        <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"/>
                    </th>
				</tr>
			</thead>
			<tbody>
				<?php if(!empty($result)) { ?>
					<?php $i = 0; foreach($result as $items=>$item) { $i++;?>
						<tr>
							<td><?=$item->name?></td>
							<td><?=$item->email?></td>
							<td><?=CutText($item->content, 250)?></td>
							<td><?=date('d/m/Y H:i', $item->created)?></td>
							<td><a href="<?=PATH_URL?>acp/contact/edit/<?=$item->id?>" title="<?=@_edit?>"><i class="fa <?php if($item->status == 0) echo "fa-eye-slash"; else echo "fa-eye";?>"></i></a></td>
							<td>
								<a onclick="return confirm('Are you sure?')" href="<?=PATH_URL?>acp/contact/del/<?=$item->id?>" class="tooltips red btn btn-xs btn_delete_single" data-container="body" data-placement="top" data-original-title="<?=@_delete?>"><i class="fa fa-trash-o"></i> <?=@_delete?> </a>
							</td>
							<td align="center"><input type="checkbox" class="checkboxes" name="id[]" value="<?=$item->id?>"></td>
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
            "order": [[ 0, "desc" ]],
            columns: [ {
                "orderable": true
            }, {
                "orderable": false
            }, {
                "orderable": false
            },{
                "orderable": false
            },{
                "orderable": false
            },{
                "orderable": false
            },{
                "orderable": false
            } ],
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
</script>