<?php 
    if (isset($editSalary)) {
        $actionUrl = "../controllers/Allowance.php?editAllowance=".$editSalary['SAL_ID'];
    }
    else
    {
        $actionUrl = "../controllers/Allowance.php?specialCase";
    }
    
?>
<div class="row">
    <?php include '../view/layout/header.php';?>
</div>

<div class="row">
    <form id="modalForm" data-toggle="validator" class="modalFormSubmit" method="post" action="<?php echo $actionUrl ?>">
        <meta name="csrf-token" content="{{ csrf_token() }}"  />


        <div class="form-group col-sm-12">
            <label class="control-label no-padding-right"> Student Name </label>
            <select class="chosen-select form-control" data-placeholder="Choose Student" name="STUDENT_ID" id="STUDENT_ID" required>
                <option value=""></option>
                <?php foreach ($allStudent as $student ) { ?>
                    <option value="<?php echo $student['STUDENT_ID'] ?>"> 
                        <?php echo $student['STNAME']; ?>        
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group col-sm-12">
            <label class="control-label no-padding-right"> Status </label>
            <select class="chosen-select form-control" data-placeholder="Choose STATUS" name="STATUS" id="STATUS" required>
                <option value=""></option>
                <?php foreach ($allPaymentStatus as $status ) { ?>
                    <option value="<?php echo $status['CLU_ID'] ?>"> 
                        <?php echo $status['CLUNAME']; ?>        
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group col-sm-12">
            <label> Reason </label>
            <textarea class="col-sm-12 form-control" name="REMARKS" value="" id="REMARKS" placeholder="Enter Reamarks"><?php if(isset($editReference)) echo $editReference['Reason']?></textarea>    
        </div>
       

        <div class="form-group col-sm-12">
            <input type="submit" name="userFormSubmit" value="submit" class="btn btn-success pull-right modalSubmit"> 
        </div>
    </form>
</div>

<div class="groupWiseStudent">
    
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


</script>