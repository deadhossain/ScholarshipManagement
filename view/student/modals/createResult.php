<?php 
    if (isset($editResult)) {
        $actionUrl = "../controllers/Result.php?editResult=".$editResult['RESULT_ID'];
    }
    else
    {
        $actionUrl = "../controllers/Result.php?addResult";
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
                    <option value="<?php echo $student['STUDENT_ID'] ?>" <?php if(isset($editResult) && $editResult['STUDENT_ID']==$student['STUDENT_ID']) { echo "selected";} ?> > 
                        <?php echo $student['STNAME']; ?>        
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group col-sm-12">
            <label class="control-label no-padding-right"> Class </label>
            <select class="chosen-select form-control" data-placeholder="Choose a class" name="DURATION_ID" id="DURATION_ID" required>
                <option value=""></option>
                <?php foreach ($allDuration as $duration ) { ?>
                    <option value="<?php echo $duration['DURATION_ID'] ?>" <?php if(isset($editResult) && $editResult['DURATION_ID']==$duration['DURATION_ID']) { echo "selected";} ?> > 
                        <?php echo $duration['CLASSNAME']; ?>        
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group col-sm-6">
            <label class="control-label no-padding-right"> Exam Type </label>
            <input type="text" name="EXAMTYPE" id="EXAMTYPE" value="<?php if(isset($editResult)) echo $editResult['EXAMTYPE']?>" placeholder=" Enter exam type" class="form-control" required>
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
            <label class="control-label no-padding-right"> Scale </label>
            <input min="0" step="0.01" type="number" name="SCALE" id="SCALE" value="<?php if(isset($editResult)) echo $editResult['SCALE']?>" placeholder=" Enter total scale" class="form-control" required>
        </div>

        <div class="form-group col-sm-6">
            <label class="control-label no-padding-right"> GPA </label>
            <input min="0" step="0.01" type="number" name="GPA" id="GPA" value="<?php if(isset($editResult)) echo $editResult['GPA']?>" placeholder=" Enter gpa" class="form-control" required>
        </div>

        

        <div class="form-group col-sm-12">
            <label class="control-label no-padding-right"> Mark Sheet </label>
            <input type="file" name="MARKSHEET" id="id-input-file-2" />    
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
        $('#DATE').datepicker("setDate", new Date());

        $('#SCALE').on('keyup',function(e) {
            $('#GPA').attr('max',$(this).val());
        })

        $('#id-input-file-2').ace_file_input({
            no_file:'No File ...',
            btn_choose:'Choose',
            btn_change:'Change',
            droppable:false,
            onchange:null,
            thumbnail:false //| true | large
            //whitelist:'gif|png|jpg|jpeg'
            //blacklist:'exe|php'
            //onchange:''
            //
        });
    });

    /*$(document).ready(function(){
        $('.modalFormSubmit').submit(function (e) {          
            var myForm = document.getElementById('modalForm');
            var formData = new FormData(this);
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            formData.append('_token', CSRF_TOKEN);
            var file = $("input['MARKSHEET']").val();
            alert(file);
            formData.append('_token', CSRF_TOKEN);
            if(file!='')
            {
              formData.append('MARKSHEET',file);
            }
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
                }
            })
        });
    });*/

    $(document).ready(function(){
        $('.modalFormSubmit').submit(function (e) {  

            var myForm = document.getElementById('modalForm');
            var formData = new FormData(this);
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var file = $("#MARKSHEET").val();
            
            formData.append('_token', CSRF_TOKEN);
            if(file!='')
            {
              formData.append('MARKSHEET',file);
            }
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