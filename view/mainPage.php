<?php 
session_start();
if(empty($_SESSION))
{
    require_once '../controllers/Authentication.php';
    $msg = Authentication::logOut();
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Scholarship Management</title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="../assets/css/main.css" />
		<!-- <link rel="stylesheet" href="../assets/css/bootstrapl.min.css" /> -->
		<link rel="stylesheet" href="../assets/font-awesome/4.5.0/css/font-awesome.min.css" />

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="../assets/css/jquery-ui.custom.min.css">
		<link rel="stylesheet" href="../assets/css/chosen.min.css">
		<link rel="stylesheet" href="../assets/css/bootstrap-datepicker3.min.css">
        <link rel="stylesheet" href="../assets/css/bootstrap-timepicker.min.css">
        <link rel="stylesheet" href="../assets/css/daterangepicker.min.css">
        <link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css">
        <link rel="stylesheet" href="../assets/css/bootstrap-colorpicker.min.css">

		<!-- text fonts -->
		<link rel="stylesheet" href="../assets/css/fonts.googleapis.com.css" />
		


		<!-- <link rel="stylesheet" href="../assets/css/dataTables.bootstrap.min.css" /> -->



		<!-- ace styles -->
		<link rel="stylesheet" href="../assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="../assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="../assets/css/ace-rtl.min.css" />


		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->


		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="../assets/js/jquery-2.1.4.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="../assets/js/bootstrap.min.js"></script>
		
		
		<!-- page specific plugin scripts -->
		<script src="../assets/js/chosen.jquery.min.js"></script>
		<script src="../assets/js/jquery.dataTables.min.js"></script>
		<script src="../assets/js/jquery.dataTables.bootstrap.min.js"></script>
		<script src="../assets/js/dataTables.buttons.min.js"></script>
		<script src="../assets/js/buttons.flash.min.js"></script>
		<script src="../assets/js/buttons.html5.min.js"></script>
		<script src="../assets/js/buttons.print.min.js"></script>
		<script src="../assets/js/buttons.colVis.min.js"></script>
		<script src="../assets/js/dataTables.select.min.js"></script>
		<script src="../assets/js/moment.min.js"></script>
		<script src="../assets/js/bootstrap-datepicker.min.js"></script>
		<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

		<!-- <script src="../assets/js/bootstrap-timepicker.min.js"></script>
		
		<script src="../assets/js/daterangepicker.min.js"></script>
		<script src="../assets/js/bootstrap-datetimepicker.min.js"></script> -->



		<!-- ace scripts -->
		<script src="../assets/js/ace-elements.min.js"></script>
		<script src="../assets/js/ace.min.js"></script>
		<!-- <script src="../assets/js/globalJquery.js"></script> -->
		

		<!-- inline scripts related to this page -->

		
	</head>

	<body class="no-skin">
		<div id="navbar" class="navbar navbar-default ace-save-state">
			<?php include 'layout/topBar.php'; ?> 
		</div>

		<div class="main-container ace-save-state" id="main-container">
			

			<div id="sidebar" class="sidebar responsive ace-save-state">
				<?php include 'layout/sideBar.php'; ?>
			</div>

			<div class="main-content">
				<div class="main-content-inner">
					
					<div class="page-content">
						<div class="row successMsg" style="display:none">
				          <div class="col-md-12">
				            <div class="alert alert-success alert-bordered " >
				              <button type="button" class="close" data-dismiss="alert"><span class="crossBtn">×</span><span class="sr-only">Close</span></button>
				              <span class="text-semibold">Well done!</span> <span class="alertMsg"></span>
				            </div>
				          </div>
				        </div>

						<div class="row">
							
							<div class="col-xs-12" id="dynamicContent">
								<?php include 'dashboard/dashboard.php';?>
								
							</div><!-- /.col -->
							
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<div class="footer">
				<?php include 'layout/footer.php';?>
			</div>

		</div><!-- /.main-container -->

		<!-- ace settings handler -->
		<!-- <script src="../assets/js/ace-extra.min.js"></script> -->

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->

		    <!--Modal Start-->
	  <div class="modal fade" id="showDetaildModal" data-backdrop="static">
	    <div id="modalSize" class="modal-dialog">
	      <div class="modal-content">
	        <div class="modal-header bg-primary">
	          <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
	          <h3 class="modal-title" id="showDetaildModalTile"></h3>
	        </div>
	        <div class="modal-body" id="showDetaildModalBody"></div>
	      </div>
	    </div>
	  </div>
	  <!--Modal End-->
		
		
	</body>
</html>

<script>
	var staticPage = '/ScholarshipManagement';
	$(document).ready(function(){
	    $('.chosen-select').chosen(); 
	    $('#sidebar a').click(function(e){
	     	e.preventDefault();
	     	
	     	var content = $(this).attr('action');
	     	if(content!=undefined)
	     	{
	     		$("#dynamicContent").load(staticPage+content);
	     	}

	        var headerModal = $(this).attr('modal');
	        var modalSize = $(this).attr('modalSize');
	     	var pageHeader = $(this).attr('pageHeader');

	        
	     	if(headerModal!=undefined)
	     	{
	            $("div.modal-dialog").removeClass('modal-sm');
	            $("div.modal-dialog").removeClass('modal-md');
	            $("div.modal-dialog").removeClass('modal-lg');
	            $("div.modal-dialog").removeClass('modal-bg');
	     		$(".modalLink").show();
	            $(".modalLink").attr("modalUrl",headerModal);
	            $(".modalLink").attr("data-modal-size",modalSize);
	     		$(".pageHeader").text(pageHeader);
	     	}
	     	else
	     	{
	     		// $(".modalLink").hide();
	     	}
	    });

	    $('.submenu li').click(function(){
	    	$('li').removeClass('active');
	    	$(this).addClass('active');
	    	$(this).parents('li').addClass('active');
	    });
	});

	$(document).ready(function(){
	   $(document).on("click", ".modalLink", function (e) {
		    var modal_size = $(this).attr('data-modal-size');
		    if($(this).attr('modalUrl')=="")
	        {
	            return;
	        }
	            
		    var url = staticPage + $(this).attr('modalUrl');
		    $("div.modal-dialog").removeClass('modal-md');
            $("div.modal-dialog").removeClass('modal-lg');
            $("div.modal-dialog").removeClass('modal-bg');
		    if ( modal_size!=='' && typeof modal_size !== typeof undefined && modal_size !== false ) {
		      $("#modalSize").addClass(modal_size);
		    }
		    else{
		      $("#modalSize").addClass('modal-lg');
		    }
		    $("#modalSize").addClass(modal_size);
		    /*$("#showDetaildModal").modal('show');*/
		    var title = $(this).attr('title');
		    $("#showDetaildModalTile").text(title);
		    var data_title = $(this).attr('data-original-title');
		    $("#showDetaildModalTile").text(data_title);

		    $("#showDetaildModalBody").load(url);
		    $("#showDetaildModal").modal('show');

		});
	});

	$(document).ready(function() {
    var url = $('.dynamic-table').attr('data-source');

    // $('.dynamic-table tbody').html(data);
    $('.dynamic-table')
	    .DataTable({
	        
	                    // bAutoWidth: false,
	                    // "aoColumns": [
	                    //   { "bSortable": false },
	                    //   null, null,null, null, null,
	                    //   { "bSortable": false }
	                    // ],
	                    // "aaSorting": [],
	                    
	                    
	                    // "bProcessing": true,
	                    // "bServerSide": true,
	                    // "sAjaxSource": url  

	                    "ajax":{"url":url} 
	                    // ajax: {
	                    //     url: url,
	                    //     dataSrc: ''
	                    // }
	                    // columns: [ ... ]
	            
	                    //,
	                    //"sScrollY": "200px",
	                    //"bPaginate": false,
	            
	                    //"sScrollX": "100%",
	                    //"sScrollXInner": "120%",
	                    //"bScrollCollapse": true,
	                    //Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
	                    //you may want to wrap the table inside a "div.dataTables_borderWrap" element
	            
	                    //"iDisplayLength": 50
	            
	            
	                    // select: {
	                    //     style: 'multi'
	                    // }
	                
	    });
	    // body...
	});

	$(document).on("click", ".confirm", function (e) {
	  var r = confirm("Are You Sure To Perform This Action ?");
	  if (r == true) {
	    event.preventDefault();
	      var url = staticPage + $(this).attr('action');
	      $.ajax({
	        url: url,
	        datatype: 'json',
	        success: function (data) {
	        	var json = JSON.parse(data);
                var title=json["TITLE"];
                var type=json["TYPE"];
	            $("span.alertMsg").html('<a href="#" class="alert-link">'+title+'</a> has been '+type+' successfully.');
	            $("div.successMsg").fadeIn().delay(1500).fadeOut('slow');
	            $('.dynamic-table').DataTable().ajax.reload();
	        }
	      });
	  } else {
	    return false;
	  }

	});

</script>


