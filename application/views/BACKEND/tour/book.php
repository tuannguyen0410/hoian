<h3 class="page-title">Booking <small><?=@_all?> Book</small></h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="<?=PATH_URL?>acp"><?=@_home?></a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li>
			<a href="#">Booking</a>
		</li>
	</ul>
</div>
<div class="panel-body">
	
	<form name="frmList" id="frm_content" method="post" action="<?=PATH_URL?>acp/tour/del" class="form-horizontal" enctype="multipart/form-data">
		<table class="table table-striped table-bordered table-hover" id="sample_1">
			<thead class="flip-content">
				<tr>
                	<th>#</th>
					<th>Book by</th>
					<th>Price</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Tour Name</th>
					<th>Date</th>
					<th>Status</th>
					<th><?=@_action?></th>
				</tr>
			</thead>
			<tbody>
				<?php if(!empty($result)) { ?>
 					<?php $i = 0; foreach($result as $items=>$item) { $i++;
					?>
						<tr>
							<td><?=stripslashes($item->id)?></td>
							<td><?=stripslashes($item->firstname)?> <?=stripslashes($item->lastname)?></td>
							<td style="text-align:right;"><?=($item->currency == 1)? '$'.number_format($item->price):number_format($item->price).'VND';?></td>
							<td><?=stripslashes($item->email)?></td>
							<td><?=stripslashes($item->phone)?></td>
							<td><?=stripslashes($item->name)?></td>
							<td><?=stripslashes($item->date)?></td>
                            <td><?=$status[stripslashes($item->status)]?></td>
							<td>
								<a href="<?=PATH_URL?>acp/tour/book_view/<?=$item->id?>" class="tooltips yellow btn btn-xs " data-container="body" data-placement="top" data-original-title="View"><i class="fa fa-eye" aria-hidden="true"></i>  View </a>
								<!--<a onclick="return confirm('Are you sure?')" href="<?=PATH_URL?>acp/tour/book_del/<?=$item->id?>" class="tooltips red btn btn-xs btn_delete_single" data-container="body" data-placement="top" data-original-title="<?=@_delete?>"><i class="fa fa-trash-o"></i> <?=@_delete?> </a>-->
							</td>
						</tr>
					<?php } ?>
				<?php } ?>
			</tbody>
		</table>
				<div>
			<div class="pull-left" style="margin: 5px 0;">
				<label><?=@_with_selected?>: </label>
	<!-- 			<button type="submit" name="delButton" onclick="return confirm('Are you sure delete?')" class="btn btn-sm red btn_delete_multi"><i class="fa fa-trash-o"></i> <?=@_delete?></button> -->
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
                "orderable": false
            }, {
                "orderable": false
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
            },{
                "orderable": false
            } ],
            bStateSave: false,
            lengthMenu: [[10, 20, 50,-1],[10, 20, 50,"All"]],
            pageLength: 10
        });
    })
</script>
