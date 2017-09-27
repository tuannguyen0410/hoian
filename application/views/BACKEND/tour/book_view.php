<h3 class="page-title">Details <small>Tour details</small></h3>
<div class="page-bar">
	<ul class="page-breadcrumb">
		<li>
			<i class="fa fa-home"></i>
			<a href="<?=PATH_URL?>acp"><?=@_home?></a>
			<i class="fa fa-angle-right"></i>
		</li>
		<li> 
			<a href="#">Tour Details</a>
		</li>
	</ul>
</div> 
<div class="panel-body">
	<form method="post" class="form-inline" style="margin-bottom: 20px;">
        <div class="form-group">
        	STATUS
        </div>
        <?php if($result->status == 3){ ?>
	    <div class="form-group">
            <select class="form-control input-smail" name="status">
				<option value="3"><?=$status[3];?></option>
            </select>
        </div>
        <?php }else{ ?>
	    <div class="form-group">
            <select class="form-control input-smail" name="status">
                <?php if(!empty($status)) { ?>
                    <?php foreach($status as $items=>$item) { ?>
                        <option <?=($result->status == $items)? 'selected="selected"':'';?> value="<?=$items?>"><?=$item?></option>
                    <?php } ?>
                <?php } ?> 
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-info">Change</button>
        </div>
        <?php } ?>
        <div class="form-group navbar-right" style="margin-right: 0;">
		</div>
	</form>
    <div class="row">
    	<div class="col-md-6">
    	<h3>BASIC INFORMATION</h3>
        <div>
            <p>Fullname: <?=$result->firstname;?> <?=$result->lastname;?></p>
            <p>Gender: <?=$result->gender;?></p>
            <p>Email: <?=$result->email;?></p>
            <p>Phone number: <?=$result->phone;?></p>
            <p>Address: <?=$result->address;?></p>
        </div>
        </div>
    	<div class="col-md-6">
        <h3>HOTEL INFORMATION</h3>
        <div>
            <p>Hotel name: <?=$result->hname;?></p>
            <p>Room number: <?=$result->hroom;?></p>
            <p>Hotel address: <?=$result->haddress;?></p>
            <p>Notes: <?=$result->hnote;?></p>
        </div>
        </div>
    </div>
    <h3>TOUR DETAILS</h3> 
		<table class="table table-striped table-bordered table-hover" id="sample_1">
			<thead class="flip-content">
				<tr>
					<th>Tour #</th> 
					<th>Tour name</th>
					<th>Tour date</th>
					<th>Tour time</th>
					<th>Optional services</th>
                    <th>Transportation</th>
					<th>Guests</th>
				</tr>
			</thead>
			<tbody>
				<?php if(!empty($book)) { ?>
					<?php $i = 0; foreach($book as $items=>$item) { $i++;
					?>
						<tr>
							<td><?=$item->id;?></td>
							<td><?=$item->name;?></td>
							<td><?=$item->date;?></td>
							<td><?=$item->time;?></td>
							<td><?=($item->service == 1)? 'Private Tour':'None Service';?></td>
							<td>
                                <?php 
                                    echo $this->model->getContent('category', array('id' => $item->transportation), "name")->name;
                                ?>                     
                            </td>
                            <td><?=$item->guest;?></td>
						</tr>
					<?php } ?>
				<?php } ?>
			</tbody>
            <tfoot>
            	<tr>
                	<td colspan="7" style="text-align:right; font-size: 16px; text-transform: uppercase;"><b>Total Price: 
					<?=($result->currency == 1)? '$'.number_format($result->price):number_format($result->price).'VND';?></b></td>
                </tr>
            </tfoot>
		</table>
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
            } ],
            bStateSave: false,
            lengthMenu: [[10, 20, 50,-1],[10, 20, 50,"All"]],
            pageLength: 10
        });
    })
</script>
