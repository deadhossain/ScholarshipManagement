<?php 
    if (isset($editUser)) {
        $actionUrl = "../controllers/User.php?editUser=".$editUser['USER_ID'];
    }
    else
    {
        $actionUrl = "../controllers/User.php?addUser";
    }
    
?>
<div class="row">
    <form id="modalForm" data-toggle="validator" class="modalFormSubmit" method="post" action="<?php echo $actionUrl ?>">
        <meta name="csrf-token" content="{{ csrf_token() }}"  />
        <div class="form-group col-sm-12 ">
            <label class="control-label no-padding-right"> User Name </label>
            <input type="text" name="USERNAME" id="USERNAME" placeholder="Username" value="<?php if(isset($editUser)) echo $editUser['USERNAME']?>" class="form-control" required>
        </div>

        <div class="form-group col-sm-12">
            <label class="control-label no-padding-right"> Password </label>
            <input type="password" name="PASSWORD" id="PASSWORD" placeholder="Password" value="<?php if(isset($editUser)) echo $editUser['PASSWORD']?>" class="form-control" required>
        </div>

        <div class="form-group col-sm-12">
            <label class="control-label no-padding-right"> Role </label>
            <select class="chosen-select form-control" data-placeholder="Choose a Role" name="ROLE_ID" id="role" required>
                <option value=""></option>
                <?php foreach ($allRole as $role ) { ?>
                    <option value="<?php echo $role['ROLE_ID'] ?>" <?php if(isset($editUser) && $editUser['ROLE_ID']==$role['ROLE_ID']) { echo "selected";} ?> > 
                        <?php echo $role['ROLENAME']; ?>        
                    </option>
                <?php } ?>
            </select>
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
        /*var url = '../controllers/Role.php';
        var role = "role";
        $.ajax({
            type: 'GET',
            url: url,
            data: { role : role},
            dataType:'json',
            success:function(data) {
                $('#role').empty();
                $.each(data, function (i) {
                    $('#role').append($('<option>', { 
                        value: data[i].ROLE_ID,
                        text : data[i].ROLENAME 
                    }));
                });
                $('#role').trigger('chosen:updated');
            }
        })
        return false;*/
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