<?php 
    if (isset($editEmployee)) {
        $actionUrl = "../controllers/Employee.php?editEmployee=".$editEmployee['EMPLOYEE_ID'];
    }
    else
    {
        $actionUrl = "../controllers/Employee.php?addEmployee";
    }  
?>
<div class="row">
    <form id="modalForm" data-toggle="validator" class="modalFormSubmit" method="post" action="<?php echo $actionUrl ?>">
        <meta name="csrf-token" content="{{ csrf_token() }}"  />
        <div class="col-md-8">

            <div class="form-group col-md-6 ">
                <label class="control-label no-padding-right"> Name </label>
                <input type="text" name="NAME" id="NAME" placeholder="Enter your name" value="<?php if(isset($editEmployee)) echo $editEmployee['NAME']?>" class="form-control" required>
            </div>

            <div class="form-group col-md-6">
                <label class="control-label no-padding-right"> Hire Date </label>
                <div class="input-group">
                    <input class="date-picker form-control" name="HIRE_DT" id="HIRE_DT" value="<?php if(isset($editEmployee)) echo date('d/m/Y', strtotime($editEmployee['HIRE_DT']))?>" type="text" >
                    <span class="input-group-addon">
                        <i class="fa fa-calendar bigger-110"></i>
                    </span>
                </div>
            </div>
            
            <div class="form-group col-md-6">
                <label class="control-label no-padding-right"> Phone </label>
                <input type="number" name="PHONE" id="PHONE" placeholder=" Enter phone number" value="<?php if(isset($editEmployee)) echo $editEmployee['PHONE']?>" class="form-control" required>
            </div>

            <div class="form-group col-md-6">
                <label class="control-label no-padding-right"> Email </label>
                <input type="text" name="EMAIL" id="EMAIL" placeholder="Enter email address" value="<?php if(isset($editEmployee)) echo $editEmployee['EMAIL']?>" class="form-control" required>
            </div>

            

            <div class="form-group col-md-6">
                <label class="control-label no-padding-right"> DIVISION </label>
                <select class="form-control chosen-select" name="DIVISION_ID" id="DIVISION_ID" data-placeholder="Select Division" required>
                    <option value=""> </option>
                    <?php foreach ($allDivision as $division ) { ?>
                        <option value="<?php echo $division['ID'] ?>" <?php if(isset($editEmployee) && $editEmployee['DIVISION_ID']==$division['ID']) { echo "selected";} ?> > 
                            <?php echo $division['NAME']; ?>        
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group col-md-6">
                <label class="control-label no-padding-right"> DISTRICT </label>
                <select class="form-control chosen-select" name="DISTRICT_ID" id="DISTRICT_ID" data-placeholder="Select District" required>
                    <option value=""> </option>
                    <?php foreach ($allDistrict as $district ) { ?>
                        <option value="<?php echo $district['ID'] ?>" <?php if(isset($editEmployee) && $editEmployee['DISTRICT_ID']==$district['ID']) { echo "selected";} ?> > 
                            <?php echo $district['NAME']; ?>        
                        </option>
                    <?php } ?>
                </select>
            </div>   

            <div class="form-group col-md-6">
                <label class="control-label no-padding-right"> Salary </label>
                <input type="number" name="SALARY" step="0.01" id="SALARY" placeholder=" Enter salary" value="<?php if(isset($editEmployee)) echo $editEmployee['SALARY']?>" class="form-control" required>
            </div>

            <div class="form-group col-md-6">
                <label class="control-label no-padding-right"> Status </label>
                <select class="form-control chosen-select" name="STATUS" id="STATUS" data-placeholder="Select Status" required>
                    <option value=""> </option>
                    <?php foreach ($allStatus as $status ) { ?>
                        <option value="<?php echo $status['CLU_ID'] ?>" <?php if(isset($editEmployee) && $editEmployee['STATUS']==$status['CLU_ID']) { echo "selected";} ?> > 
                            <?php echo $status['CLUNAME']; ?>        
                        </option>
                    <?php } ?>
                </select>
            </div>         
          
        </div>
        
        <div class="col-md-4">
            <div class="form-group col-md-12">
                <label class="control-label no-padding-right"> Image </label>
                <span class="profile-picture ">
                    <?php 
                        if(isset($editEmployee) && $editEmployee['IMAGE']!==null)  {
                            $src = "../assets/images/employee/".$editEmployee['IMAGE'];
                        } 
                        else
                        {
                            $src = "../assets/images/employee/default.jpg";
                        }
                    ?>
                    <img id="IMAGEVIEW" class="img-responsive" style="margin: auto;" alt="Employee photo" src="<?php echo $src ?>" />
                    <input type="file" id="IMAGE" name="IMAGE" class="form-control" placeholder="Browse">
                </span>    
            </div>
        </div>
    	
        <div class="col-md-12">
            

            <div class="form-group col-sm-12">
                <label> Full Address</label>
                <textarea class="col-sm-12 form-control" name="ADDRESS" value="" id="ADDRESS" placeholder="Enter full address"> <?php if(isset($editEmployee)) echo $editEmployee['ADDRESS']?></textarea>    
            </div>
        </div>
              
        
        <div class="form-group col-sm-12">
            <input type="submit" name="userFormSubmit" value="submit" class="btn btn-success pull-right modalSubmit"> 
        </div>
    </form>
</div>

<script>
    $('#modalForm').on('change','#DIVISION_ID',function (e) {
        var url = '../controllers/Area.php';
        var division = $(this).val();
        $.ajax({
            type: 'GET',
            url: url,
            data: { division : division},
            dataType:'json',
            success:function(data) {
                $('#DISTRICT_ID').empty();
                $('#DISTRICT_ID').append($('<option>', { 
                    value: "",
                    text : "" 
                }));
                $.each(data, function (i) {
                    $('#DISTRICT_ID').append($('<option>', { 
                        value: data[i].id,
                        text : data[i].name 
                    }));
                });
                $('#DISTRICT_ID').trigger('chosen:updated');
            }
        })
    });

    
    function isImage(file){
       return (file['type'].split('/')[0]==='image');//returns true or false
    }


    function imagePreview(input) {
        if (input.files && input.files[0] && isImage(input.files[0])) 
        {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#IMAGEVIEW').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
            return true;
        }
        else
        {
            alert("Invalid File. Please only select image");
            return false;
        }
    }

    $("#IMAGE").change(function(){
        if(!imagePreview(this))
        {
            $('#IMAGE').replaceWith($('#IMAGE').val('').clone(true));
            $('#IMAGEVIEW').attr('src', '../assets/images/avatars/profile-pic.jpg');
        }
    });

    $(document).ready(function(){
        $('.chosen-select').chosen(); 
        $('.date-picker').datepicker({
            autoclose: true,
            todayHighlight: true
        });

        if ($('#HIRE_DT').val()=="" || $('#HIRE_DT').val()==undefined) 
        {
            $('#HIRE_DT').datepicker("setDate", new Date());
        }
        
        $('.modalFormSubmit').submit(function (e) {          
            var myForm = document.getElementById('modalForm');
            var formData = new FormData(this);
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            var img = $("#IMAGE").val();
            formData.append('_token', CSRF_TOKEN);
            if(img!='')
            {
              formData.append('IMAGE',img);
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