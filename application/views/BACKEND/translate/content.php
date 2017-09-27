<h3 class="page-title"><?=@_translate?> <small><?=@_all?> <?=@_translate?></small></h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="<?=PATH_URL?>acp"><?=@_home?></a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#"><?=@_translate?></a>
		</li>
	</ul>
</div>
<div class="panel-body">
	<div class="form-group">
        <button id="btn_submit" type="button" class="btn btn-success" onclick="return location.href='<?=PATH_URL?>acp/translate/add'"><?=@_add_new?> <i class="fa fa-plus"></i></button>
    </div>
	<form name="frmList" id="frm_content" method="post" action="<?=PATH_URL?>acp/translate/del" class="form-horizontal" enctype="multipart/form-data">
		<?php if($this->session->flashdata('success') == 1) echo '<p style="text-align: center; color: red;">Success !!!</p>'?>
		<table class="table table-striped table-bordered table-hover" id="sample_1">
			<thead class="flip-content">
				<tr>
					<th style="min-width: 150px;"><?=@_content_slug?></th>
					<th style="min-width: 250px;"><?=@_content_vi?></th>
					<th style="min-width: 250px;"><?=@_content_en?></th>
					<th class="table-checkbox">
                        <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"/>
                    </th>
				</tr>
			</thead>
			<tbody>
				<?php if(!empty($result)) { ?>
					<?php $i = 0; foreach($result as $items=>$item) { ?>
					<tr>
						<td><?=stripslashes($item->value)?></td>
						<td><input onkeyup="changeValue(this.value,'name',<?=$item->id?>)" type="text" value="<?=stripslashes($item->name)?>" class="form-control" placeholder=".col-md-2"></td>
						<td><input onkeyup="changeValue(this.value,'name_en',<?=$item->id?>)" type="text" value="<?=stripslashes($item->name_en)?>" class="form-control" placeholder=".col-md-2"></td>
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
			</div>
			<div class="clearfix"></div>
		</div>
	</form>
</div>
<script>
    $(document).ready(function(){
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
            bStateSave: false,
            lengthMenu: [[50, 100, 200,-1],[50, 100, 200,"All"]],
            pageLength: 50
        });
    })
	function deleteAll() {
		var r = confirm('Are you sure !!!');
		if(r == true) {
			$("#frm_content").submit();
		}
	}
    function changeValue(val,name,id) {
        $.post('<?=PATH_URL?>acp/translate/changeValue',{id:id, val:val,name:name})
    }
</script>
