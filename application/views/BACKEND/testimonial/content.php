<h3 class="page-title"><?=@_testimonials?> <small><?=@_all?> <?=@_testimonials?></small></h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="<?=PATH_URL?>acp"><?=@_home?></a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#"><?=@_testimonials?></a>
		</li>
	</ul>
</div>
<div class="panel-body">
	<form method="post" class="form-inline" style="margin-bottom: 20px;">
	    <div class="form-group">
            <select class="form-control input-large" name="category">
                <option value="0">&rarr; <?=@_category?> &larr;</option>
                <?php if(!empty($category)) { ?>
                    <?php foreach($category as $items=>$item) { ?>
                        <option value="<?=$item->id?>">&rarr; <?=stripslashes($item->name)?></option>
                        <?php $child_category = $this->model->getListContent('category', "FIND_IN_SET(".$item->id.",category_id)>0 AND type='testimonial'", "order_by asc", null,null, "name, id")?>
                        <?php if(!empty($child_category)) { foreach ($child_category as $items1 => $item1) {
                            echo "<option value='".$item1->id."'>&rarr;&rarr; ".stripslashes($item1->name)."</option>";
                        }}?>
                    <?php } ?>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <button type="button" onclick="return location.href='<?=PATH_URL?>acp/testimonial/filter/'+$('select').val()" id="btn_search" class="btn btn-info"><i class="icon-search"></i> <?=@_filter?></button>
        </div>
        <div class="form-group navbar-right" style="margin-right: 0;">
			<button id="btn_submit" type="button" class="btn btn-success" onclick="return location.href='<?=PATH_URL?>acp/testimonial/add'"><i class="icon-plus"></i> <?=@_add_new?></button>
		</div>
	</form>
	<form name="frmList" id="frm_content" method="post" action="<?=PATH_URL?>acp/testimonial/del" class="form-horizontal" enctype="multipart/form-data">
		<table class="table table-striped table-bordered table-hover" id="sample_1">
			<thead class="flip-content">
				<tr>
					<th><?=@_image?></th>
					<th style="min-width: 250px;"><?=@_name?></th>
					<th><?=@_category?></th>
					<th style="min-width: 70px;">
						<i class="fa fa-check"></i>
						<i class="fa fa-home"></i>
					</th>
					<th><?=@_order_by?></th>
					<th style="min-width: 150px;"><?=@_action?></th>
					<th class="table-checkbox">
                        <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"/>
                    </th>
				</tr>
			</thead>
			<tbody>
				<?php if(!empty($result)) { ?>
					<?php $i = 0; foreach($result as $items=>$item) { $i++; $category_name = $this->model->getContent('category', "id IN ($item->category_id)","name");?>
						<tr>
							<td><a href="<?=PATH_URL?>acp/testimonial/edit/<?=$item->id?>"><img src="<?=PATH_URL?>media/<?php if($item->images <> null) echo $item->images; else echo "no_images.gif";?>" class="img-thumbnail" style="max-width: 100px;"></a></td>
							<td><?=stripslashes($item->name)?></td>
							<td><?=stripslashes($category_name->name)?></td>
							<td align="center">
								<?php if($item->status == 1) { ?><i style="cursor: pointer; color: green;" onclick="updateStatus('<?=$item->id?>','status')" class="fa fa-check"></i><?php } else { ?><i style="cursor: pointer; color: red;" onclick="updateStatus('<?=$item->id?>','status')" class="fa fa-ban"></i><?php } ?>
								<?php if($item->homepage == 1) { ?><i style="cursor: pointer; color: green;" onclick="updateStatus('<?=$item->id?>','homepage')" class="fa fa-home"></i><?php } else { ?><i style="cursor: pointer; color: gray;" onclick="updateStatus('<?=$item->id?>','homepage')" class="fa fa-home"></i><?php } ?>
							</td>
							<td><input type="text" autocomplete="off" name="order_by" id="order_by_<?=$item->id?>" class="form-control input-xsmall" value="<?=$item->order_by?>" onkeyup="changeOrderBy(<?=$item->id?>,this.value)" ></td>
							<td>
								<a href="<?=PATH_URL?>acp/testimonial/edit/<?=$item->id?>" class="tooltips yellow btn btn-xs " data-container="body" data-placement="top" data-original-title="<?=@_edit?>"><i class="fa fa-pencil"></i>  <?=@_edit?> </a>
								<a onclick="return confirm('Are you sure?')" href="<?=PATH_URL?>acp/testimonial/del/<?=$item->id?>" class="tooltips red btn btn-xs btn_delete_single" data-container="body" data-placement="top" data-original-title="<?=@_delete?>"><i class="fa fa-trash-o"></i> <?=@_delete?> </a>
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
				<button type="submit" name="orderButton" class="btn btn-sm blue"><?=@_re_order?></button>
				<button type="submit" name="hideButton" class="btn btn-sm yellow"><i class="fa fa-ban"></i> <?=@_deactive?></button>
				<button type="submit" name="delButton" onclick="return confirm('Are you sure delete?')" class="btn btn-sm red btn_delete_multi"><i class="fa fa-trash-o"></i> <?=@_delete?></button>
			</div>
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
            "order": [[ 2, "desc" ]],
            columns: [ {
                "orderable": false
            }, {
                "orderable": true
            }, {
                "orderable": true
            }, {
                "orderable": false
            },{
                "orderable": false
            },{
                "orderable": false
            },{
                "orderable": false
            } ],
            bStateSave: false,
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
		$.post('<?=PATH_URL?>acp/testimonial/updateStatus',{id:id,type:type}, function(data){if(data == 1) location.reload();})
	}
	function changeOrderBy(id,val){
		$.post('<?=PATH_URL?>acp/testimonial/changeOrderBy',{id:id, order_by:val},function(data){$("#order_by_"+id).val(data)})
	}
</script>
