<div class="row">
	<?php include '../view/layout/header.php';?>
</div>

<div class="tableData">
	<table id="dynamic-table" class="table table-striped table-bordered table-hover dynamic-table" data-source="../controllers/Employee.php?allEmployee" style="width: 100%">
		<thead>
			<tr>
				<th> SL </th>
				<th> Name </th>
				<th> Hire Date </th>
				<th> Phone </th>
				<th> Email </th>
				<th> Salary </th>
				<th> Action </th>
			</tr>
		</thead>
		<tbody>
			
		</tbody>
	</table>	
</div>


<script src="../assets/js/globalJquery.js"></script>