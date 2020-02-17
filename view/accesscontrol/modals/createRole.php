<?php 
    if (isset($editRole)) {
        $actionUrl = "../controllers/Role.php?editRole=".$editRole['ROLE_ID'];
    }
    else
    {
        $actionUrl = "../controllers/Role.php?addRole";
    }
    
?>
<div class="row">
    <form id="modalForm" data-toggle="validator" class="modalFormSubmit" method="post" action="<?php echo $actionUrl ?>">
        <meta name="csrf-token" content="{{ csrf_token() }}"  />
    	<div class="form-group col-sm-12 ">
            <label class="control-label no-padding-right"> Role Name </label>
            <input type="text" name="ROLENAME" id="ROLENAME" placeholder="Class Name" class="form-control" value="<?php if(isset($editRole)) echo $editRole['ROLENAME']?>" required>
        </div>

        <div class="form-group col-sm-12">
            <label class="control-label no-padding-right"> Description </label>
            <textarea class="col-sm-12 form-control" name="DESCRIPTION" value="" id="DESCRIPTION" placeholder="write role description"><?php if(isset($editRole)) echo $editRole['DESCRIPTION']?></textarea>
        </div>

        <div class="form-group col-sm-12">
            <input type="submit" name="userFormSubmit" value="submit" class="btn btn-success pull-right modalSubmit"> 
        </div>
    </form>
</div>

<script>
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