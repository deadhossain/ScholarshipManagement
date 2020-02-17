<div class="row">
	<?php include '../view/layout/header.php';?>
</div>

<div class="tableData">
	<table id="dynamic-table" class="table table-striped table-bordered table-hover dynamic-table" data-source="../controllers/Donor.php?allDonor">
		<thead>
			<tr>
				<th> SL </th>
				<th> Name </th>
				<th> Phone </th>
				<th> Email </th>
				<th> Action </th>
			</tr>
		</thead>
		<tbody>
			
		</tbody>
	</table>	
</div>


<script src="../assets/js/globalJquery.js"></script>