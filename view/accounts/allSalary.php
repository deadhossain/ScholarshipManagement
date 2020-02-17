<div class="row">
	<?php include '../view/layout/header.php';?>
</div>

<div class="tableData">
	<table id="dynamic-table" class="table table-striped table-bordered table-hover dynamic-table" data-source="../controllers/Salary.php?allSalary" style="width: 100%">
		<thead>
			<tr>
				<th> SL </th>
				<th> Date </th>
				<th> Employee Name </th>
				<th> Amount </th>
				<th> Payment Status </th>
				<th> Action </th>
			</tr>
		</thead>
		<tbody>
			
		</tbody>
	</table>	
</div>

<script src="../assets/js/globalJquery.js"></script>