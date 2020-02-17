
<ul class="nav nav-list">
	<li class="active" >
		<a href="" action="/controllers/Dashboard.php?dashboard">
			<i class="menu-icon fa fa-tachometer"></i>
			<span class="menu-text"> Dashboard </span>
		</a>

		<b class="arrow"></b>
	</li>


	<li class="">
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-users"></i>
			<span class="menu-text"> Students </span>

			<b class="arrow fa fa-angle-down"></b>
		</a>
		<b class="arrow"></b>

		<ul class="submenu">
			
			<!-- '/controllers/User.php?editUser='.$value['USER_ID'] -->
			<li class="">
				<a href="" action="/controllers/Student.php?studentTable">
					<i class="menu-icon fa fa-caret-right"></i>
					Student Information
				</a>

				<b class="arrow"></b>
			</li>

			<li class="">
				<a href="" action="/controllers/Academic.php?academicTable">
					<i class="menu-icon fa fa-caret-right"></i>
					Academic Information
				</a>

				<b class="arrow"></b>
			</li>

			<li class="">
				<a href="" action="/controllers/Result.php?resultTable">
					<i class="menu-icon fa fa-caret-right"></i>
					Results
				</a>

				<b class="arrow"></b>
			</li>
		</ul>
	</li>

	<li class="">
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-cogs"></i>
			<span class="menu-text"> Setup </span>
			<b class="arrow fa fa-angle-down"></b>
		</a>
		<b class="arrow"></b>

		<ul class="submenu">
			<li class="">
				<a href="" action="/controllers/Reference.php?referenceTable">
					<i class="menu-icon fa fa-caret-right"></i>
					References
				</a>

				<b class="arrow"></b>
			</li>

			<li class="">
				<a href="" action="/controllers/Role.php?roleTable">
					<i class="menu-icon fa fa-caret-right"></i>
					Role 
				</a>

				<b class="arrow"></b>
			</li>

			<li class="">
				<a href="" action="/controllers/Group.php?groupTable">
					<i class="menu-icon fa fa-caret-right"></i>
					Group 
				</a>

				<b class="arrow"></b>
			</li>

			<li class="">
				<a href="" action="/controllers/User.php?userTable">
					<i class="menu-icon fa fa-caret-right"></i>
					User 
				</a>

				<b class="arrow"></b>
			</li>
			<li class="">
				<a href="" action="/controllers/Duration.php?durationTable">
					<i class="menu-icon fa fa-caret-right"></i>
					Duration 
				</a>

				<b class="arrow"></b>
			</li>
		</ul>
	</li>

	
	<li class="">
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-user"></i>
			<span class="menu-text"> Employee </span>
			<b class="arrow fa fa-angle-down"></b>
		</a>

		<b class="arrow"></b>

		<ul class="submenu">
			
			<li class="">
				<a href="" action="/controllers/Employee.php?employeeTable">
					<i class="menu-icon fa fa-caret-right"></i>
					Employee Information
				</a>

				<b class="arrow"></b>
			</li>

			<li class="">
				<a href="" action="/controllers/Salary.php?salaryTable">
					<i class="menu-icon fa fa-caret-right"></i>
					Salary
				</a>

				<b class="arrow"></b>
			</li>
			
		</ul>
	</li>

	<li class="">
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon glyphicon glyphicon-usd"></i>
			<span class="menu-text"> Accounts </span>
			<b class="arrow fa fa-angle-down"></b>
		</a>

		<b class="arrow"></b>

		<ul class="submenu">
			<li class="">
				<a href="" action="/controllers/Donor.php?donorTable">
					<i class="menu-icon fa fa-caret-right"></i>
					Donor
				</a>

				<b class="arrow"></b>
			</li>

			<li class="">
				<a href="" action="/controllers/Balance.php?balanceTable">
					<i class="menu-icon fa fa-caret-right"></i>
					Balance
				</a>

				<b class="arrow"></b>
			</li>

			<li class="">
				<a href="" action="/controllers/Allowance.php?selectGroup">
					<i class="menu-icon fa fa-caret-right"></i>
					Allowance Distribution
				</a>

				<b class="arrow"></b>
			</li>

			<li class="">
				<a href="" action="/controllers/SpecialCase.php?allSpecialCase">
					<i class="menu-icon fa fa-caret-right"></i>
					Special Case
				</a>

				<b class="arrow"></b>
			</li>
			
		</ul>
	</li>

	<li class="">
		<a href="#" class="dropdown-toggle">
			<i class="menu-icon fa fa-bar-chart-o"></i>
			<span class="menu-text"> Reports </span>
			<b class="arrow fa fa-angle-down"></b>
		</a>

		<b class="arrow"></b>

		<ul class="submenu">
			
			<li class="">
				<a href="" action="/controllers/Report.php?searchAllowanceReport">
					<i class="menu-icon fa fa-caret-right"></i>
					Allowance Report
				</a>

				<b class="arrow"></b>
			</li>

			<!-- <li class="">
				<a href="" action="/controllers/Report.php?allBalanceReport">
					<i class="menu-icon fa fa-caret-right"></i>
					Balance Report
				</a>

				<b class="arrow"></b>
			</li> -->

			<li class="">
				<a href="" action="/controllers/Report.php?searchSalaryReport">
					<i class="menu-icon fa fa-caret-right"></i>
					Salary Report
				</a>

				<b class="arrow"></b>
			</li>
			
		</ul>
	</li>
</ul><!-- /.nav-list -->

<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
	<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
</div>




