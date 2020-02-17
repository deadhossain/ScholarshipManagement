<?php 
    if (isset($editSalary)) {
        $actionUrl = "../controllers/Allowance.php?editAllowance=".$editSalary['SAL_ID'];
    }
    else
    {
        $actionUrl = "../controllers/Allowance.php?allowanceTable";
    }
    
?>
<div class="row">
    <form id="modalForm" data-toggle="validator" class="modalFormSubmit" method="post" action="<?php echo $actionUrl ?>">
        <meta name="csrf-token" content="{{ csrf_token() }}"  />


        <div class="form-group col-sm-3">
            <label class="control-label no-padding-right"> Group </label>
            <select class="chosen-select form-control" data-placeholder="Choose Group" name="GROUP_ID" id="GROUP_ID" required>
                <option value=""></option>
                <?php foreach ($allGroup as $group ) { ?>
                    <option value="<?php echo $group['GROUP_ID'] ?>"> 
                        <?php echo $group['NAME']; ?>        
                    </option>
                <?php } ?>
            </select>
        </div>      

        <div class="form-group col-sm-1">
            <label class="col-sm-12"> Action </label>
            <button type="submit" name="salaryFormSubmit" value="search" class="btn btn-success modalSubmit"> 
                <i class="glyphicon glyphicon-search"></i>
            </button>            
        </div>
    </form>
</div>

<div class="groupWiseStudent">
    
</div>

<script>
    $(document).ready(function(){
        $('.chosen-select').chosen(); 
        
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
                    $('.groupWiseStudent').html(data);
                }
            })
        });
    });
</script>