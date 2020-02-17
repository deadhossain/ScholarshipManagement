<script src="../assets/js/wizard.min.js"></script>
        <div class="modal-content">
            <div id="modal-wizard-container">
                <div class="modal-header">
                    <ul class="steps">
                        <li data-step="1" class="active">
                            <span class="step">1</span>
                            <span class="title">Validation states</span>
                        </li>

                        <li data-step="2">
                            <span class="step">2</span>
                            <span class="title">Alerts</span>
                        </li>

                        <li data-step="3">
                            <span class="step">3</span>
                            <span class="title">Payment Info</span>
                        </li>

                        <li data-step="4">
                            <span class="step">4</span>
                            <span class="title">Other Info</span>
                        </li>
                    </ul>
                </div>

                <div class="modal-body step-content">
                    <div class="step-pane active" data-step="1">
                        <div class="center">
                            <h4 class="blue">Step 1</h4>
                        </div>
                    </div>

                    <div class="step-pane" data-step="2">
                        <div class="center">
                            <h4 class="blue">Step 2</h4>
                        </div>
                    </div>

                    <div class="step-pane" data-step="3">
                        <div class="center">
                            <h4 class="blue">Step 3</h4>
                        </div>
                    </div>

                    <div class="step-pane" data-step="4">
                        <div class="center">
                            <h4 class="blue">Step 4</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer wizard-actions">
                <button class="btn btn-sm btn-prev">
                    <i class="ace-icon fa fa-arrow-left"></i>
                    Prev
                </button>

                <button class="btn btn-success btn-sm btn-next" data-last="Finish">
                    Next
                    <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                </button>

                <button class="btn btn-danger btn-sm pull-left" data-dismiss="modal">
                    <i class="ace-icon fa fa-times"></i>
                    Cancel
                </button>
            </div>
        </div>


<!-- <?php 
    if (isset($editData)) {
            
    }
    
?>
<div class="row">
    <form id="modalForm" data-toggle="validator" class="modalFormSubmit" method="post" action="<?php echo "../controllers/Reference.php" ?>">
        <meta name="csrf-token" content="{{ csrf_token() }}"  />
        <div class="col-md-8">
            <div class="form-group col-md-12 ">
                <label class="control-label no-padding-right"> Name </label>
                <input type="text" name="NAME" id="NAME" placeholder="Enter your name" class="form-control" required>
            </div>
            
            

            <div class="form-group col-md-6">
                <label class="control-label no-padding-right"> Phone </label>
                <input type="number" name="PHONE" id="PHONE" placeholder=" Enter phone number" class="form-control" required>
            </div>

            <div class="form-group col-md-6">
                <label class="control-label" style="padding-right: 5px;"> Limit </label>
                <label>(
                    <input id="LIMIT_FLAG" value="N" name="LIMIT_FLAG" type="checkbox" class="ace">
                    <span class="lbl"> No Limit </span>)
                </label>
                <input type="number" name="LIMIT" id="LIMIT" placeholder="Enter limit" class="form-control" required>
            </div>

            <div class="form-group col-md-12">
                <label class="control-label no-padding-right"> Email </label>
                <input type="text" name="EMAIL" id="EMAIL" placeholder="Enter email address" class="form-control" required>
            </div>

            <div class="form-group col-sm-6">
                <label class="control-label no-padding-right"> DIVISION </label>
                <select class="form-control chosen-select" name="DIVISION_ID" id="DIVISION" data-placeholder="Select Division" required>
                    <option value=""> </option>
                </select>
            </div>

            <div class="form-group col-sm-6">
                <label class="control-label no-padding-right"> DISTRICT </label>
                <select class="form-control chosen-select" name="DISTRICT_ID" id="DISTRICT" data-placeholder="Select District" required>
                    <option value=""> </option>
                </select>
            </div>

            
          
        </div>
        <div class="col-md-4">
            <div class="form-group col-md-12">
                <label class="control-label no-padding-right"> Image </label>
                <span class="profile-picture ">
                    <img id="IMAGE" class="img-responsive" style="margin: auto;" alt="Reference photo" src="../assets/images/avatars/profile-pic.jpg" />
                    <input type="file" class="form-control" placeholder="Browse">
                </span>    
            </div>
        </div>
        
        <div class="col-md-12">
            

            <div class="form-group col-sm-12">
                <label> Full Address</label>
                <textarea class="col-sm-12 form-control" name="ADDRESS" id="ADDRESS" placeholder="Enter full address"></textarea>    
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
        var url = '../controllers/Area.php';
        $.ajax({
            type: 'GET',
            url: url,
            data: 'getDivisions',
            dataType:'json',
            success:function(data) {
                $.each(data, function (i) {
                    $('#DIVISION').append($('<option>', { 
                        value: data[i].id,
                        text : data[i].name 
                    }));
                });
                $('#DIVISION').trigger('chosen:updated');
            }
        })
        return false;
    });

    $('#modalForm').on('change','#DIVISION',function (e) {
        var url = '../controllers/Area.php';
        var division = $(this).val();
        $.ajax({
            type: 'GET',
            url: url,
            data: { division : division},
            dataType:'json',
            success:function(data) {
                $('#DISTRICT').empty();
                $('#DISTRICT').append($('<option>', { 
                    value: "",
                    text : "" 
                }));
                $.each(data, function (i) {
                    $('#DISTRICT').append($('<option>', { 
                        value: data[i].id,
                        text : data[i].name 
                    }));
                });
                $('#DISTRICT').trigger('chosen:updated');
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
            var img = $("input#IMAGE").val();
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
                    $("div.successMsg").fadeIn().delay(1500).fadeOut('slow');;
                }
            })
        });
    });
</script> -->

<script>
    // $('#modal-wizard-container').ace_wizard();
    var $validation = false;
    $('#modal-wizard-container')
    .ace_wizard({
        //step: 2 //optional argument. wizard will jump to step "2" at first
        //buttons: '.wizard-actions:eq(0)'
    })
    .on('actionclicked.fu.wizard' , function(e, info){
        if(info.step == 1 && $validation) {
            if(!$('#validation-form').valid()) e.preventDefault();
        }
    })
    // .on('changed.fu.wizard', function() {
    //     alert("changed");
    // })
    .on('finished.fu.wizard', function(e) {
        alert("finished");
    }).on('stepclick.fu.wizard', function(e){
        //e.preventDefault();//this will prevent clicking and selecting steps
    });
</script>