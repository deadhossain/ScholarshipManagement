<?php 
    if (isset($editAcademic)) {
        $actionUrl = "../controllers/Academic.php?editAcademic=".$editAcademic['ACADEMIC_ID'];
    }
    else
    {
        $actionUrl = "../controllers/Academic.php?addAcademic";
    }
    
?>
<div class="row">
    <form id="modalForm" data-toggle="validator" class="modalFormSubmit" method="post" action="<?php echo $actionUrl ?>">
        <meta name="csrf-token" content="{{ csrf_token() }}"  />

        <div class="form-group col-sm-12">
            <label class="control-label no-padding-right"> Student Name </label>
            <select class="chosen-select form-control" data-placeholder="Choose a student" name="STUDENT_ID" id="STUDENT_ID" required>
                <option value=""></option>
                <?php foreach ($allStudent as $student ) { ?>
                    <option value="<?php echo $student['STUDENT_ID'] ?>" <?php if(isset($editAcademic) && $editAcademic['STUDENT_ID']==$student['STUDENT_ID']) { echo "selected";} ?> > 
                        <?php echo $student['STNAME']; ?>        
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group col-sm-12 ">
            <label class="control-label no-padding-right"> Institute Name </label>
            <input type="text" name="INSTITUTENAME" id="INSTITUTENAME" placeholder="Write Institute Name" value="<?php if(isset($editAcademic)) echo $editAcademic['INSTITUTENAME']?>" class="form-control" required>
        </div>

        <div class="form-group col-sm-12">
            <label class="control-label no-padding-right"> Class </label>
            <select class="chosen-select form-control" data-placeholder="Choose a class" name="DURATION_ID" id="DURATION_ID" required>
                <option value=""></option>
                <?php foreach ($allDuration as $duration ) { ?>
                    <option value="<?php echo $duration['DURATION_ID'] ?>" <?php if(isset($editAcademic) && $editAcademic['DURATION_ID']==$duration['DURATION_ID']) { echo "selected";} ?> > 
                        <?php echo $duration['CLASSNAME']; ?>        
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group col-sm-6">
            <label class="control-label no-padding-right"> Start Date </label>
            <div class="input-group">
                <input class="date-picker form-control" name="START_DT" id="START_DT" value="<?php if(isset($editAcademic)) echo $editAcademic['START_DT']?>" type="text" >
                <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                </span>
            </div>
        </div>

        <div class="form-group col-sm-6">
            <label class="control-label no-padding-right"> End Date </label>
            <div class="input-group">
                <input class="date-picker form-control" name="END_DT" id="END_DT" value="<?php if(isset($editAcademic)) echo $editAcademic['END_DT']?>" type="text" >
                <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                </span>
            </div>
        </div>

        <div class="form-group col-sm-12">
            <input type="submit" name="userFormSubmit" value="submit" class="btn btn-success pull-right modalSubmit"> 
        </div>
    </form>
</div>

<script>

    $(document).ready(function (e) { 
        $('.chosen-select').chosen(); 
        $('.date-picker').datepicker({
            autoclose: true,
            todayHighlight: true
        });
        $('#START_DT').datepicker("setDate", new Date());
    });

    $('#modalForm').on('change','#DURATION_ID',function (e) {
        var url = '../controllers/Duration.php';
        var id = $(this).val();
        var startDate = $('#START_DT').val();

        var dt = new Date($('#START_DT').val());
        
        
        $.ajax({
            type: 'GET',
            url: url,
            data: { getDuration : id},
            dataType:'json',
            success:function(data) {
                var years = parseInt(data[0].DURATION, 10);
                dt.setFullYear((dt.getFullYear() + years));
                var dd = dt.getDate();
                var mm = dt.getMonth()+1;
                var y = dt.getFullYear();

                var someFormattedDate = mm + '/'+ dd + '/'+ y;

                $('#END_DT').val(someFormattedDate);
            }
        })
    });


    /*$(document).ready(function(){
        $(document).on('submit','.modalSubmit',function (e) {
            
            var myForm = document.getElementById('modalForm');
            var formData = new FormData(myForm);
            var url = $('#modalForm').attr('action');
            $.ajax({
                method : "POST",
                url: url,
                data : formData,
                dataType: 'JSON',
                success: function (argument) {
                    $('#modalForm').hide();
                }
            });
            e.preventDefault();
            

        })
    })*/

    $(document).ready(function(){
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