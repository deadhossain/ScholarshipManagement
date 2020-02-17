<?php
    require '../controllers/Authentication.php';
    $auth = new Authentication();
    if(isset($_GET['logout'])) {
    	$logout = $auth->logOut();
    } 
?>
<div class="navbar-container ace-save-state" id="navbar-container">
	<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
	  <span class="sr-only">Toggle sidebar</span>
	  <span class="icon-bar"></span>
	  <span class="icon-bar"></span>
	  <span class="icon-bar"></span>
	</button>

	<div class="navbar-header text-center">
	  <a action="/dashboard/dashboard.php" class="navbar-brand">
		<small>
			<i class="fa fa-praying-hands"></i>
			Tareq Mohammed Haider Trust
		</small>
	  </a>
	</div>
	
	<div class="navbar-buttons navbar-header pull-right" role="navigation">
		<ul class="nav ace-nav">
			<li class="light-blue dropdown-modal">
				<a data-toggle="dropdown" href="#" class="dropdown-toggle">
					<!-- <img class="nav-user-photo" src="assets/images/avatars/user.jpg" alt="Jason's Photo" /> -->
					<span class="user-info">
						<small>Welcome,</small>
						<?php echo $_SESSION['UserName'] ?>
					</span>

					<i class="ace-icon fa fa-caret-down"></i>
				</a>

				<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
					<li>
						<a href="?logout" name="logout">
							<i class="ace-icon fa fa-power-off"></i>
							Logout
						</a>
					</li>
				</ul>
			</li>
		</ul>
	</div>
</div><!-- /.navbar-container -->
