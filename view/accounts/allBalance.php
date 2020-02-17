<div class="row">
	<?php include '../view/layout/header.php';?>
</div>

<div class="tableData">
	<table id="dynamic-table" class="table table-striped table-bordered table-hover dynamic-table" data-source="../controllers/Balance.php?allBalance">
		<thead>
			<tr>
				<th> SL </th>
				<th> Date </th>
				<th> Donor Name </th>
				<th> Payment Type </th>
				<th> Amount </th>
				<th> Action </th>
			</tr>
		</thead>
		<tbody>
			
		</tbody>
	</table>	
</div>


<script src="../assets/js/globalJquery.js"></script>