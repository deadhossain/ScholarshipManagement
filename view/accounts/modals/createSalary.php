<?php 
    if (isset($editSalary)) {
        $actionUrl = "../controllers/Salary.php?editSalary=".$editSalary['SAL_ID'];
    }
    else
    {
        $actionUrl = "../controllers/Salary.php?addSalary";
    }
    
?>
<div class="row">
    <form id="modalForm" data-toggle="validator" class="modalFormSubmit" method="post" action="<?php echo $actionUrl ?>">
        <meta name="csrf-token" content="{{ csrf_token() }}"  />


        <div class="form-group col-sm-6">
            <label class="control-label no-padding-right"> Employee Name </label>
            <select class="chosen-select form-control" data-placeholder="Choose Employee" name="EMPLOYEE_ID" id="EMPLOYEE_ID" required>
                <option value=""></option>
                <?php foreach ($allEmployee as $employee ) { ?>
                    <option value="<?php echo $employee['EMPLOYEE_ID'] ?>" <?php if(isset($editSalary) && $editSalary['EMPLOYEE_ID']==$employee['EMPLOYEE_ID']) { echo "selected";} ?> > 
                        <?php echo $employee['NAME']; ?>        
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group col-sm-6">
            <label class="control-label no-padding-right"> Date </label>
            <div class="input-group">
                <input class="date-picker form-control" name="DATE" id="DATE" value="<?php if(isset($editResult)) echo $editResult['DATE']?>" type="text" autocomplete="off">
                <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                </span>
            </div>
        </div>

        <div class="form-group col-sm-4">
            <label class="control-label no-padding-right"> Payment Status </label>
            <select class="chosen-select form-control" data-placeholder="Choose payment status" name="PAYMENTSTATUS" id="role" required>
                <?php foreach ($allPaymentStatus as $paymentStatus ) { ?>
                    <option value="<?php echo $paymentStatus['CLU_ID'] ?>" <?php if(isset($editSalary) && $editSalary['PAYMENTSTATUS']==$paymentStatus['CLU_ID']) { echo "selected";} ?> > 
                        <?php echo $paymentStatus['CLUNAME']; ?>        
                    </option>
                <?php } ?>
            </select>
        </div>
        
        <div class="form-group col-sm-4 ">
            <label class="control-label no-padding-right"> Amount </label>
            <input type="text" name="AMOUNT" id="AMOUNT" placeholder="Enter salary amount" value="<?php if(isset($editSalary)) echo $editSalary['AMOUNT']?>" class="form-control" required>
        </div>

        <div class="form-group col-sm-4 ">
            <label class="control-label no-padding-right"> Bonus </label>
            <input type="text" name="BONUS" id="BONUS" placeholder="Enter bonus amount" value="<?php if(isset($editSalary)) echo $editSalary['BONUS']?>" class="form-control">
        </div>

        <div class="form-group col-sm-12">
            <label> Remarks </label>
            <textarea class="col-sm-12 form-control" name="REMARKS" value="" id="REMARKS" placeholder="Enter REMARKS"><?php if(isset($editSalary)) echo $editSalary['REMARKS']?></textarea>    
        </div>

        

        <div class="form-group col-sm-12">
            <input type="submit" name="salaryFormSubmit" value="submit" class="btn btn-success pull-right modalSubmit"> 
        </div>
    </form>
</div>

<script>
    $(document).ready(function(){
        $('.chosen-select').chosen(); 
        $('.date-picker').datepicker({
            autoclose: true,
            todayHighlight: true
        });
        $('#DATE').datepicker("setDate", new Date());
        $('.modalFormSubmit').submit(function (e) {          
            var myForm = document.getElementById('modalForm');
            var formData = new FormData(this);
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            formData.append('_token', CSRF_TOKEN);
            var url = $(this).attr('action');
            e.preventDefault();
                        
            $.ajax({
                method : "POST",
                url: url,
                data : formData,
                cache:false,
                contentType: false,
                processData: false,
                datatype: 'json',
                success: function (data) {
                    var json = JSON.parse(data);
                    var title=json["TITLE"];
                    var type=json["TYPE"];
                    $('.modal').modal('hide');
                    $("span.alertMsg").html('<a href="#" class="alert-link">'+title+'</a> has been '+type+' successfully.');
                    $("div.successMsg").fadeIn().delay(1500).fadeOut('slow');
                    $('.dynamic-table').DataTable().ajax.reload();
                }
            })
        });
    });

    $('#modalForm').on('change','#EMPLOYEE_ID',function (e) {
        var url = '../controllers/Employee.php';
        var id = $(this).val();
                
        
        $.ajax({
            type: 'GET',
            url: url,
            data: { getEmployeeSalary : id},
            dataType:'json',
            success:function(data) {

                /*var years = parseInt(data[0].DURATION, 10);
                dt.setFullYear((dt.getFullYear() + years));
                var dd = dt.getDate();
                var mm = dt.getMonth()+1;
                var y = dt.getFullYear();

                var someFormattedDate = mm + '/'+ dd + '/'+ y;*/

                $('#AMOUNT').val(data[0].SALARY);
            }
        })
    });
</script>