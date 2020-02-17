<?php 
    require_once '../controllers/Student.php'; 
    require_once '../controllers/Balance.php'; 
    require_once '../controllers/Allowance.php'; 
    require_once '../controllers/Salary.php'; 
    require_once '../controllers/Reference.php'; 
    $bal = new Balance();
    $allw = new Allowance();
    $sal = new Salary();
    $ref = new Reference();
    $limitReference = $ref->checkLimitReference();
    $noLimitReference = $ref->checkNoLimitReference();
    $remainingBalance = $bal->checkTotalBalance();
    $totalSal = $sal->checkTotalSalary();
    $totalAllowance = $allw->checkTotalAllowance();
    $totalBalance = $bal->checkTotalBalance();
    $totalCost = $totalAllowance[0]['TOTAL_ALLOWANCE'] + $totalSal[0]['TOTAL_SALARY'];
    $remainingBalance = $totalBalance[0]['TOTAL_BALANCE'] - $totalCost;

    $st = new Student();
    $activeStudent = $st->checkTotalActiveStudent();
    $onHoldStudent = $st->checkTotalOnHoldStudent();
    $waitingStudent = $st->checkWaitingStudent();
    $comStudent = $st->checkCompletedStudent();
?>
<div class="row">
	<div class="page-header">
		<h1>
			Dashboard
			<small>
				<i class="ace-icon fa fa-angle-double-right"></i>
				overview &amp; stats
			</small>
		</h1>
	</div>
    <div class="col-md-4">
        <div class="panel panel-success">
            <div class="green" style="text-align: center;">
                <h4> <b> Student Informtaion </b></h4>
            </div>
            <div class="panel-heading">
                
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-graduation-cap fa-5x" style="font-size: 6em;"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"> <b> Active : </b><?php echo $activeStudent[0]['COUNT_STUDENT']; ?></div>
                        <div class="huge"><b> On Hold : </b><?php echo $onHoldStudent[0]['COUNT_STUDENT']; ?></div>
                        <div class="huge"><b> Waiting : </b><?php echo $waitingStudent[0]['COUNT_STUDENT']; ?></div>
                        <div class="huge"><b> Completed : </b><?php echo $comStudent[0]['COUNT_STUDENT']; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-info">
            <div class="blue" style="text-align: center;">
                <h4> <b> Accounts Summary </b></h4>
            </div>
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-dollar fa-5x" style="font-size: 6em;"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"> <b> Total Donation : </b><?php echo $totalBalance[0]['TOTAL_BALANCE']; ?></div>
                        

                        <div class="huge"><b> Total Cost : </b><?php echo $totalCost; ?></div>
                        

                        <div class="huge"><b> Remaining Balance :  </b><?php echo $remainingBalance; ?></div>
                        
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <div class="col-md-4">
        
        <div class="panel panel-danger">
            <div style="text-align: center;color: #8a6d3b;">
                <h4> <b> Reference Summary </b></h4>
            </div>
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user fa-5x" style="font-size: 6em;"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"> <b> Has Limit : </b><?php echo $limitReference[0]['COUNT_REF']; ?></div>
                        

                        <div class="huge"><b> No Limit : </b><?php echo $noLimitReference[0]['COUNT_REF']; ?></div>
                        

                        <div class="huge"><b> Total :  </b><?php echo $limitReference[0]['COUNT_REF'] + $noLimitReference[0]['COUNT_REF']; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    /*$(document).ready(function(argument) {
        $.ajax({
            type: 'GET',
            url: url,
            data: { getTotalBalance : id},
            dataType:'json',
            success:function(data) {

                var years = parseInt(data[0].DURATION, 10);
                dt.setFullYear((dt.getFullYear() + years));
                var dd = dt.getDate();
                var mm = dt.getMonth()+1;
                var y = dt.getFullYear();

                var someFormattedDate = mm + '/'+ dd + '/'+ y;

                $('#AMOUNT').val(data[0].SALARY);
            }
        })
    })*/
</script>