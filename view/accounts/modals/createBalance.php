<?php 
    if (isset($editBalance)) {
        $actionUrl = "../controllers/Balance.php?editBalance=".$editBalance['BALANCE_ID'];
    }
    else
    {
        $actionUrl = "../controllers/Balance.php?addBalance";
    }
    
?>
<div class="row">
    <form id="modalForm" data-toggle="validator" class="modalFormSubmit" method="post" action="<?php echo $actionUrl ?>">
        <meta name="csrf-token" content="{{ csrf_token() }}"  />


        <div class="form-group col-sm-6">
            <label class="control-label no-padding-right"> Donor Name </label>
            <select class="chosen-select form-control" data-placeholder="Choose Donor" name="DONOR_ID" id="DONOR_ID" required>
                <option value=""></option>
                <?php foreach ($allDonor as $donor ) { ?>
                    <option value="<?php echo $donor['DONOR_ID'] ?>" <?php if(isset($editBalance) && $editBalance['DONOR_ID']==$donor['DONOR_ID']) { echo "selected";} ?> > 
                        <?php echo $donor['NAME']; ?>        
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group col-sm-6">
            <label class="control-label no-padding-right"> Date </label>
            <div class="input-group">
                <input class="date-picker form-control" name="DATE" id="DATE" value="<?php if(isset($editResult)) echo $editResult['DATE']?>" type="text" >
                <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                </span>
            </div>
        </div>

        <div class="form-group col-sm-6">
            <label class="control-label no-padding-right"> Payment Type </label>
            <select class="chosen-select form-control" data-placeholder="Choose payment type" name="PAYMENTTYPE" id="role" required>
                <option value=""></option>
                <?php foreach ($allPaymentType as $paymentType ) { ?>
                    <option value="<?php echo $paymentType['CLU_ID'] ?>" <?php if(isset($editBalance) && $editBalance['PAYMENTTYPE']==$paymentType['CLU_ID']) { echo "selected";} ?> > 
                        <?php echo $paymentType['CLUNAME']; ?>        
                    </option>
                <?php } ?>
            </select>
        </div>
        
        

        <div class="form-group col-sm-6 ">
            <label class="control-label no-padding-right"> Amount </label>
            <input type="text" name="AMOUNT" id="AMOUNT" placeholder="Enter donation amount" value="<?php if(isset($editBalance)) echo $editBalance['AMOUNT']?>" class="form-control" required>
        </div>

        

        <div class="form-group col-sm-12">
            <input type="submit" name="balanceFormSubmit" value="submit" class="btn btn-success pull-right modalSubmit"> 
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
</script>