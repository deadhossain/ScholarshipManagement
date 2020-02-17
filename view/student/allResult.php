<div class="row">
	<?php include '../view/layout/header.php';?>
</div>

<div class="tableData">
	<table id="dynamic-table" class="table table-striped table-bordered table-hover dynamic-table" data-source="../controllers/Result.php?allResult">
		<thead>
			<tr>
				<th> SL </th>
				<th> Date </th>
				<th> Student Name </th>
				<th> Class </th>
				<th> Result Type </th>
				<th> Scale </th>
				<th> GPA </th>
				<th> Percentage(%) </th>
				<th> Action </th>
			</tr>
		</thead>
		<tbody>
			
		</tbody>
	</table>	
</div>


<script src="../assets/js/globalJquery.js"></script>