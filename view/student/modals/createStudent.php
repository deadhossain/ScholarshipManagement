<?php 
    if (isset($editStudent)) {
        $actionUrl = "../controllers/Student.php?editStudent=".$editStudent['STUDENT_ID'];
    }
    else
    {
        $actionUrl = "../controllers/Student.php?addStudent";
    }
    
?>
<style>
    .form-group{
        margin-bottom: 8px !important;
    }
    .label-info{ margin-bottom: 15px !important; }
    h4{
    margin-bottom: 1px solid #000000 !important;
    margin-left: 5px !important;
  }
</style>
<div class="row">
    <form id="modalForm" data-toggle="validator" class="modalFormSubmit" method="post" action="<?php echo $actionUrl ?>" style="margin-left: 15px">
        <meta name="csrf-token" content="{{ csrf_token() }}"  />
        <div class="col-md-12" style="margin-top: 10px;">
            <div class="col-md-6">

                <div class="control-group">
                    <span class="label label-info" style="width: 100%"><h4>Student Information</h4></span>
                </div>

                <div class="col-md-6">
                
                    <div class="form-group">
                        <label class="control-label  no-padding-right"> Student Name </label>
                        <input type="text" name="STNAME" id="STNAME" value="<?php if(isset($editStudent)) echo $editStudent['STNAME']?>" placeholder="Enter your name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label class="control-label no-padding-right"> Card </label>
                        <input type="text" name="CARDNO" id="NAME" value="<?php if(isset($editStudent)) echo $editStudent['CARDNO']?>" placeholder="Enter card number" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label class="control-label no-padding-right"> Phone </label>
                        <input type="number" name="PHONE" id="PHONE" value="<?php if(isset($editStudent)) echo $editStudent['PHONE']?>" placeholder=" Enter phone number" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label class="control-label no-padding-right"> Email </label>
                        <input type="text" name="EMAIL" id="EMAIL" value="<?php if(isset($editStudent)) echo $editStudent['EMAIL']?>" placeholder="Enter email address" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label class="control-label no-padding-right"> National ID </label>
                        <input type="text" name="NATIONALID" id="NATIONALID" value="<?php if(isset($editStudent)) echo $editStudent['NATIONALID']?>" placeholder="Enter national id" class="form-control" required>
                    </div>

                    

                    
                </div>



                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label no-padding-right"> Allowance </label>
                        <input type="text" name="ALLOWANCE" id="ALLOWANCE" value="<?php if(isset($editStudent)) echo $editStudent['ALLOWANCE']?>" placeholder="Enter allowance amount" class="form-control" required>
                    </div>
                    <!-- <div class="form-group">
                        <label class="control-label no-padding-right"> Start Date </label>
                        <div class="input-group">
                            <input class="date-picker form-control" name="STARTDT" id="STARTDT" value="<?php if(isset($editStudent)) echo $editStudent['STARTDT']?>" type="text" data-date-format="dd-mm-yyyy">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar bigger-110"></i>
                            </span>
                        </div>
                    </div> -->

                    <div class="form-group">
                        <label class="control-label no-padding-right"> GENDER </label>
                        <select class="chosen-select form-control" name="GENDER" id="GENDER" data-placeholder="Select Gender" required>
                            <option value=""></option>
                            <?php foreach ($allGender as $gender ) { ?>
                                <option value="<?php echo $gender['CLU_ID'] ?>" <?php if(isset($editStudent) && $editStudent['GENDER']==$gender['CLU_ID']) { echo "selected";} ?> > 
                                    <?php echo $gender['CLUNAME']; ?>        
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="control-label no-padding-right"> Reference </label>
                        <select class="chosen-select form-control" data-placeholder="Choose a reference" name="REF_ID" id="REF_ID" required>
                            <option value=""></option>
                            <?php foreach ($allReference as $ref ) { ?>
                                <option value="<?php echo $ref['REF_ID'] ?>" <?php if(isset($editStudent) && $editStudent['REF_ID']==$ref['REF_ID']) { echo "selected";} ?> > 
                                    <?php echo $ref['NAME']; ?>        
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="control-label no-padding-right"> Group </label>
                        <select class="chosen-select form-control" data-placeholder="Choose a group" name="GROUP_ID" id="GROUP_ID" required>
                            <option value=""></option>
                            <?php foreach ($allGroup as $group ) { ?>
                                <option value="<?php echo $group['GROUP_ID'] ?>" <?php if(isset($editStudent) && $editStudent['GROUP_ID']==$group['GROUP_ID']) { echo "selected";} ?> > 
                                    <?php echo $group['NAME']; ?>        
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="control-label no-padding-right"> Status </label>
                        <select class="chosen-select form-control" name="STATUS" id="STATUS" data-placeholder="Select Status" required>
                            <option value=""> </option>
                            <?php foreach ($allStatus as $status ) { ?>
                                <option value="<?php echo $status['CLU_ID'] ?>" <?php if(isset($editStudent) && $editStudent['STATUS']==$status['CLU_ID']) { echo "selected";} ?> > 
                                    <?php echo $status['CLUNAME']; ?>        
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            

            <div class="col-md-3">

                <div class="control-group">
                    <span class="label label-info" style="width: 100%"><h4>Guardian Information</h4></span>
                </div>
                <input type="hidden" name="GUARDIAN_ID" value="<?php if(isset($editStudent)) echo $editStudent['GUARDIAN_ID']?>">
                <div class="form-group">
                    <label class="control-label no-padding-right"> Guardian Name </label>
                    <input type="text" name="GNAME" id="GNAME" value="<?php if(isset($editStudent)) echo $editStudent['GNAME']?>" placeholder="Enter your name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="control-label no-padding-right"> Relation </label>
                    <input type="text" name="GRELATION" id="GRELATION" value="<?php if(isset($editStudent)) echo $editStudent['GRELATION']?>" placeholder="Enter your relation" class="form-control" required>
                </div>

                <!-- <div class="form-group">
                    <label class="control-label no-padding-right"> GENDER </label>
                    <select class="chosen-select form-control" name="GGENDER" id="GGENDER" data-placeholder="Select Gender" required>
                        <option value=""> </option>
                        <option value="Male"> Male </option>
                        <option value="Female"> Female </option>
                    </select>
                </div> -->

                <div class="form-group">
                    <label class="control-label no-padding-right"> Phone </label>
                    <input type="number" name="GPHONE" id="GPHONE" value="<?php if(isset($editStudent)) echo $editStudent['GPHONE']?>" placeholder=" Enter phone number" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="control-label no-padding-right"> Email </label>
                    <input type="text" name="GEMAIL" id="GEMAIL" value="<?php if(isset($editStudent)) echo $editStudent['GEMAIL']?>" placeholder="Enter email address" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="control-label no-padding-right"> National ID </label>
                    <input type="text" name="GNATIONALID" id="GNATIONALID" value="<?php if(isset($editStudent)) echo $editStudent['GEMAIL']?>" placeholder="Enter national id" class="form-control" required>
                </div>
            </div>
<!-- 
            <div class="col-md-3">
                <div class="form-group col-md-12">
                    <label class="control-label no-padding-right"> Student Image </label>
                    <span class="profile-picture ">
                        <img id="IMAGE" class="img-responsive" style="margin: auto;" alt="Reference photo" src="../assets/images/avatars/profile-pic.jpg" />
                        <input type="file" class="form-control" placeholder="Browse">
                    </span>    
                </div>
            </div> -->

            <div class="col-md-3">
                <div class="form-group col-md-12">
                    <label class="control-label no-padding-right"> Image </label>
                    <span class="profile-picture ">
                        <?php 
                            if(isset($editStudent) && $editStudent['IMAGE']!==null)  {
                                $src = "../assets/images/student/".$editStudent['IMAGE'];
                            } 
                            else
                            {
                                $src = "../assets/images/student/default.jpg";
                            }
                        ?>
                        <img id="IMAGEVIEW" class="img-responsive" style="margin: auto;" alt="Reference photo" src="<?php echo $src ?>" />
                        <input type="file" id="IMAGE" name="IMAGE" class="form-control" placeholder="Browse">
                    </span>    
                </div>
            </div>  
        </div>

        <div class="col-md-12" style="margin-top: 15px;">
            <div class="control-group">
                <span class="label label-info" style="width: 100%"><h4>Student Address</h4></span>
            </div>
            <div class="col-md-6">
                <h4 style="border-bottom: 2px solid #eee"><i class="ace-icon fa fa-envelope" style="padding-right: 5px"></i> Present Address </h4>
                <div class="form-group col-md-6">
                    <label class="control-label no-padding-right"> DIVISION </label>
                    <select class="form-control chosen-select" name="PRSNTDIV_ID" id="PRSNTDIV_ID" data-placeholder="Select Division" required>
                        <option value=""> </option>
                        <?php foreach ($allDivision as $division ) { ?>
                            <option value="<?php echo $division['ID'] ?>" <?php if(isset($editStudent) && $editStudent['PRSNTDIV_ID']==$division['ID']) { echo "selected";} ?> > 
                                <?php echo $division['NAME']; ?>        
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label class="control-label no-padding-right"> DISTRICT </label>
                    <select class="form-control chosen-select" name="PRSNTDIS_ID" id="PRSNTDIS_ID" data-placeholder="Select District" required>
                        <option value=""> </option>
                        <?php foreach ($allDistrict as $district ) { ?>
                            <option value="<?php echo $district['ID'] ?>" <?php if(isset($editStudent) && $editStudent['PRSNTDIS_ID']==$district['ID']) { echo "selected";} ?> > 
                                <?php echo $district['NAME']; ?>        
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group col-md-12">
                    <label> Full Address</label>
                    <textarea class="col-sm-12 form-control" name="PRSNTADDR" value="" id="PRSNTADDR" placeholder="Enter full address"><?php if(isset($editStudent)) echo $editStudent['PRSNTADDR']?></textarea>    
                </div>
            </div>

            <div class="col-md-6">
                <h4 style="border-bottom: 2px solid #eee"><i class="ace-icon fa fa-home" style="padding-right: 5px"></i> Permanent Address </h4>
                <div class="form-group col-md-6">
                    <label class="control-label no-padding-right"> DIVISION </label>
                    <select class="form-control chosen-select" name="PRMNTDIV_ID" id="PRMNTDIV_ID" data-placeholder="Select Division" required>
                        <option value=""> </option>
                        <?php foreach ($allDivision as $division ) { ?>
                            <option value="<?php echo $division['ID'] ?>" <?php if(isset($editStudent) && $editStudent['PRMNTDIV_ID']==$division['ID']) { echo "selected";} ?> > 
                                <?php echo $division['NAME']; ?>        
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label class="control-label no-padding-right"> DISTRICT </label>
                    <select class="form-control chosen-select" name="PRMNTDIS_ID" id="PRMNTDIS_ID" data-placeholder="Select District" required>
                        <option value=""> </option>
                        <?php foreach ($allDistrict as $district ) { ?>
                            <option value="<?php echo $district['ID'] ?>" <?php if(isset($editStudent) && $editStudent['PRMNTDIS_ID']==$district['ID']) { echo "selected";} ?> > 
                                <?php echo $district['NAME']; ?>        
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group col-md-12">
                    <label> Full Address</label>
                    <textarea class="col-sm-12 form-control" name="PRMNTADDR" value="" id="PRMNTADDR" placeholder="Enter full address"> <?php if(isset($editStudent)) echo $editStudent['PRMNTADDR']?> </textarea>    
                </div>
            </div>
            
        </div>
                   
        
        <div class="form-group col-sm-12">
            <input type="submit" name="userFormSubmit" value="submit" class="btn btn-success pull-right modalSubmit"> 
        </div>
    </form>
</div>

<script>
    // Bring all role from role table and put it in select
    $(document).ready(function (e) { 
        $('.chosen-select').chosen(); 
        
        $('.date-picker').datepicker({
            autoclose: true,
            todayHighlight: true
        }).datepicker("setDate", new Date());
    });

    $('#modalForm').on('change','#PRSNTDIV_ID',function (e) {
        var url = '../controllers/Area.php';
        var division = $(this).val();
        $.ajax({
            type: 'GET',
            url: url,
            data: { division : division},
            dataType:'json',
            success:function(data) {
                $('#PRSNTDIS_ID').empty();
                $('#PRSNTDIS_ID').append($('<option>', { 
                    value: "",
                    text : "" 
                }));
                $.each(data, function (i) {
                    $('#PRSNTDIS_ID').append($('<option>', { 
                        value: data[i].id,
                        text : data[i].name 
                    }));
                });
                $('#PRSNTDIS_ID').trigger('chosen:updated');
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

    $('#modalForm').on('change','#PRMNTDIV_ID',function (e) {
        var url = '../controllers/Area.php';
        var division = $(this).val();
        $.ajax({
            type: 'GET',
            url: url,
            data: { division : division},
            dataType:'json',
            success:function(data) {
                $('#PRMNTDIS_ID').empty();
                $('#PRMNTDIS_ID').append($('<option>', { 
                    value: "",
                    text : "" 
                }));
                $.each(data, function (i) {
                    $('#PRMNTDIS_ID').append($('<option>', { 
                        value: data[i].id,
                        text : data[i].name 
                    }));
                });
                $('#PRMNTDIS_ID').trigger('chosen:updated');
            }
        })
    })

    $('#LIMIT_FLAG').on('click',function(e) {
        if($(this).prop('checked'))
        {
           $("#LIMIT").prop('disabled', true);
        }
        else
        {
           $("#LIMIT").prop('disabled', false);
        }
    })

    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#IMAGE').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

      $("input#profile_pic").change(function(){
        readURL(this);
      });

    $(document).ready(function(){
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