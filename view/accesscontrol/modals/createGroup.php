<?php 
    if (isset($editGroup)) {
        $actionUrl = "../controllers/Group.php?editGroup=".$editGroup['GROUP_ID'];
    }
    else
    {
        $actionUrl = "../controllers/Group.php?addGroup";
    }
    
?>
<div class="row">
    <form id="modalForm" data-toggle="validator" class="modalFormSubmit" method="post" action="<?php echo $actionUrl ?>">
        <meta name="csrf-token" content="{{ csrf_token() }}"  />
    	<div class="form-group col-sm-12 ">
            <label class="control-label no-padding-right"> Name </label>
            <input type="text" name="NAME" id="NAME" placeholder="Enter group name" class="form-control" value="<?php if(isset($editGroup)) echo $editGroup['NAME']?>" required>
        </div>

        <div class="form-group col-sm-12">
            <label class="control-label no-padding-right"> Week No </label>
            <input type="number" name="WEEKNO" id="WEEKNO" placeholder="Enter week number" class="form-control" value="<?php if(isset($editGroup)) echo $editGroup['WEEKNO']?>" required>
        </div>

        <div class="form-group col-sm-12">
            <label class="control-label no-padding-right"> Day Of Week </label>
            <select class="chosen-select form-control" data-placeholder="Choose a Day" name="DAYOFWEEK" id="DAYOFWEEK" required>
                <option value=""></option>
                <option value="Saturday"> Saturday </option>
                <option value="Sunday"> Sunday </option>
                <option value="Monday"> Monday </option>
                <option value="Tuesday"> Tuesday </option>
                <option value="Wednesday"> Wednesday </option>
                <option value="Thursday"> Thursday </option>
                <option value="Friday"> Friday </option>
            </select>
        </div>

        <div class="form-group col-sm-12">
            <input type="submit" name="userFormSubmit" value="submit" class="btn btn-success pull-right modalSubmit"> 
        </div>
    </form>
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