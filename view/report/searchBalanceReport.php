<?php 

    $actionUrl = "../controllers/Report.php?balanceReportTable";
    
?>
<div class="row">
    <form id="modalForm" data-toggle="validator" class="modalFormSubmit" method="post" action="<?php echo $actionUrl ?>">
        <meta name="csrf-token" content="{{ csrf_token() }}"  />

        <div class="form-group col-sm-3">
            <label class="control-label no-padding-right"> From Date </label>
            <div class="input-group">
                <input class="date-picker form-control" placeholder="From Date" name="FROM_DT" id="START_DT" type="text" autocomplete="off">
                <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                </span>
            </div>
        </div>

        <div class="form-group col-sm-3">
            <label class="control-label no-padding-right"> To Date </label>
            <div class="input-group">
                <input class="date-picker form-control" name="TO_DT" placeholder="To Date" id="END_DT" type="text" autocomplete="off">
                <span class="input-group-addon">
                    <i class="fa fa-calendar bigger-110"></i>
                </span>
            </div>
        </div> 

        <div class="form-group col-sm-2">
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
        /*// $.validator.setDefaults({ ignore: ":hidden:not(.chosen-select)" }) 
        $('.date-picker').datepicker({
            endDate: '+1d',
            autoclose: true,
            todayHighlight: true

        });

        $("#datepicker").datepicker( {
            format: "mm-yyyy",
            viewMode: "months", 
            minViewMode: "months"
        });

        $("#START_DT").datepicker({
            todayBtn:  1,
            autoclose: true,
        }).on('changeDate', function (selected) {
            var minDate = new Date(selected.date.valueOf());
            $('#END_DT').datepicker('setStartDate', minDate);
            $('#END_DT').attr('required', true);
        }).on('change', function (selected) {
            if ($(this).val().length === 0) {
                $('#END_DT').removeAttr('required');
            }
        });

        $("#END_DT").datepicker()
            .on('changeDate', function (selected) {
                var maxDate = new Date(selected.date.valueOf());
                $('#START_DT').datepicker('setEndDate', maxDate);
                $('#START_DT').attr('required', true);
            }).on('change', function (selected) {
                if ($(this).val().length === 0) {
                    $('#START_DT').removeAttr('required');
                }
            });*/

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