<h3 class="page-title"><?=@_category?> <small><?=@_all?> <?=@_category?></small></h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="<?=PATH_URL?>acp"><?=@_home?></a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#"><?=@_category?></a>
		</li>
	</ul>
</div>
<div class="panel-body">
	<form method="post" class="form-inline" style="margin-bottom: 20px;">
	    <div class="form-group">
            <select class="form-control input-large" name="category">
				<option value="">&rarr; <?=@_category?> &larr;</option>
				<?php if(!empty($category)) { ?>
					<?php foreach($category as $items=>$item) { ?>
						<option value="<?=$item->id?>"><?=$item->name?></option>
					<?php } ?>
				<?php } ?>
			</select>
        </div>
        <div class="form-group">
            <button type="button" onclick="return location.href='<?=PATH_URL?>acp/support/categories/filter/'+$('select').val()" id="btn_search" class="btn btn-info"><i class="icon-search"></i> <?=@_filter?></button>
        </div>
        <div class="form-group navbar-right" style="margin-right: 0;">
			<button id="btn_submit" type="button" class="btn btn-success" onclick="return location.href='<?=PATH_URL?>acp/support/categories/add'"><i class="icon-plus"></i> <?=@_add_new?></button>
		</div>
	</form>
	<form name="frmList" id="frm_content" method="post" action="<?=PATH_URL?>acp/support/categories/del" class="form-horizontal" enctype="multipart/form-data">
		<?php if($this->session->flashdata('success') == 1) echo '<p style="text-align: center; color: red;">Success !!!</p>'?>
		<table class="table table-striped table-bordered table-hover" id="sample_1">
			<thead class="flip-content">
				<tr>
					<th style="min-width: 250px;"><?=@_name?></th>
					<th><i class="fa fa-check"></i></th>
					<th><?=@_order_by?></th>
					<th style="min-width: 70px;"><?=@_action?></th>
					<th class="table-checkbox">
                        <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"/>
                    </th>
				</tr>
			</thead>
			<tbody>
				<?php 
					if(!empty($result)) { 
						foreach($result as $items=>$item) {
							$child = $this->model->getListContent('category', array('parent_id' => $item->id, 'type' => 'support'), 'order_by asc', null, null, "name, images, id, status, order_by");
				?>
					<tr>
						<td style="color: red;"><?=stripslashes($item->name)?></td>
						<td align="center"><?php if($item->status == 1) { ?><i style="cursor: pointer; color: green;" onclick="updateStatus('<?=$item->id?>','status')" class="fa fa-check"></i><?php } else { ?><i style="cursor: pointer; color: red;" onclick="updateStatus('<?=$item->id?>','status')" class="fa fa-ban"></i><?php } ?></td>
						<td><input type="text" autocomplete="off" name="order_by" id="order_by_<?=$item->id?>" class="form-control input-xsmall" value="<?=$item->order_by?>" onkeyup="changeOrderBy(<?=$item->id?>,this.value)" ></td>
						<td>
							<a href="<?=PATH_URL?>acp/support/categories/edit/<?=$item->id?>" class="tooltips yellow btn btn-xs " data-container="body" data-placement="top" data-original-title="<?=@_edit?>"><i class="fa fa-pencil"></i>  <?=@_edit?> </a>
							<a onclick="return confirm('Are you sure?')" href="<?=PATH_URL?>acp/support/categories/del/<?=$item->id?>" class="tooltips red btn btn-xs btn_delete_single" data-container="body" data-placement="top" data-original-title="<?=@_delete?>"><i class="fa fa-trash-o"></i> <?=@_delete?> </a>
						</td>
						<td align="center"><input type="checkbox"class="checkboxes" name="id[]" value="<?=$item->id?>"></td>
					</tr>
					<?php
						if(!empty($child)) {
							foreach($child as $items1=>$item1) {
					?>
						<tr>
							<td style="color: green;padding-left: 30px;"><i class="fa fa-chevron-right"></i> <?=stripslashes($item1->name)?></td>
							<td align="center"><?php if($item->status == 1) { ?><i style="cursor: pointer; color: green;" onclick="updateStatus('<?=$item1->id?>','status')" class="fa fa-check"></i><?php } else { ?><i style="cursor: pointer; color: red;" onclick="updateStatus('<?=$item1->id?>','status')" class="fa fa-ban"></i><?php } ?></td>
							<td><input type="text" autocomplete="off" name="order_by" id="order_by_<?=$item1->id?>" class="form-control input-xsmall" value="<?=$item1->order_by?>" onkeyup="changeOrderBy(<?=$item1->id?>,this.value)" ></td>
							<td>
								<a href="<?=PATH_URL?>acp/support/categories/edit/<?=$item1->id?>" class="tooltips yellow btn btn-xs " data-container="body" data-placement="top" data-original-title="<?=@_edit?>"><i class="fa fa-pencil"></i>  <?=@_edit?> </a>
								<a onclick="return confirm('Are you sure?')" href="<?=PATH_URL?>acp/support/categories/del/<?=$item1->id?>" class="tooltips red btn btn-xs btn_delete_single" data-container="body" data-placement="top" data-original-title="<?=@_delete?>"><i class="fa fa-trash-o"></i> <?=@_delete?> </a>
							</td>
							<td align="center"><input type="checkbox"class="checkboxes" name="id[]" value="<?=$item1->id?>"></td>
						</tr>
					<?php } } ?>
				<?php } } ?>
			</tbody>
		</table>
		<div>
			<div class="pull-left" style="margin: 5px 0;">
				<label><?=@_with_selected?>: </label>
				<button type="submit" name="orderButton" class="btn btn-sm blue"><?=@_re_order?></button>
				<button type="submit" name="hideButton" class="btn btn-sm yellow"><i class="fa fa-ban"></i> <?=@_deactive?></button>
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
		$.post('<?=PATH_URL?>acp/support/categories/updateStatus',{id:id,type:type}, function(data){if(data == 1) location.reload();})
	}
	function changeOrderBy(id,val){
		$.post('<?=PATH_URL?>acp/support/categories/changeOrderBy',{id:id, order_by:val},function(data){$("#order_by_"+id).val(data)})
	}
</script>
