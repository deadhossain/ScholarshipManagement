<?php 
	$actionUrl = "../controllers/Report.php?".http_build_query($reportParameter);
?>
<style type="text/css">
	tfoot tr td{
		border-bottom: 1px solid red !important;
	}
</style>
<div class="col-md-12 tableTools-container pull-right"></div>

<div class="tableData">
	<table id="dynamic-table-report" class="table table-striped table-hover dynamic-table" data-source="<?php echo $actionUrl ?>">
		<thead>
			<tr>
				<th> SL </th>
				<th> Received Date </th>
				<th> Card No </th>
				<th> Student Name </th>
				<th> Status </th>
				<th> Amount </th>
			</tr>
		</thead>
		<tbody>
			
		</tbody>
		<tfoot>
            <tr>
              	<td></td>
              	<td></td>
                <td>  </td>
                <td></td>
                <td> <p class="pull-right"> Total Cost: </p></td>
                <td> </td>
                  
                  
              </tr>
          </tfoot>
	</table>	
</div>


<!-- <script src="../assets/js/globalJquery.js"></script> -->
<!-- <script src="//cdn.datatables.net/plug-ins/1.10.19/api/sum().js"></script> -->
<script type="text/javascript">
	var url = $('#dynamic-table-report').attr('data-source');
	var myTable = $('#dynamic-table-report').DataTable( {
	    
	    "ajax":{"url":url},
	    "footerCallback": function(display) {
            var api = this.api();

            api.column(5, { page: 'current' }).every(function () {
                var sum = api
                    .cells( null, this.index(), { page: 'current'} )
                    .render('display')
                    .reduce(function (a, b) {
                        var x = parseFloat(a) || 0;
                        var y = parseFloat(b) || 0;
                        return x + y;
                    }, 0);
                console.log(this.index() +' '+ sum); //alert(sum);
                $(this.footer()).html(sum);
            });
        }
	});

	$.fn.dataTable.Buttons.defaults.dom.container.className = 'pull-right dt-buttons btn-overlap btn-group btn-overlap';
                
    new $.fn.dataTable.Buttons( myTable, {
        buttons: [
          {
            "extend": "colvis",
            "text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
            "className": "btn btn-white btn-primary btn-bold",
            columns: ':not(:first):not(:last)'
          },
          
          {
            "extend": "csv",
            "text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
            "className": "btn btn-white btn-primary btn-bold",
          },
          
          {
            "extend": "print",
            "text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
            "className": "btn btn-white btn-primary btn-bold",
            footer: true,
            title: function(){
                return "Allowance Report"
            },
          }       
        ]
    } );
    myTable.buttons().container().appendTo( $('.tableTools-container') );
    var defaultColvisAction = myTable.button(0).action();
    myTable.button(0).action(function (e, dt, button, config) {
        
        defaultColvisAction(e, dt, button, config);
        
        
        if($('.dt-button-collection > .dropdown-menu').length == 0) {
            $('.dt-button-collection')
            .wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
            .find('a').attr('href', '#').wrap("<li />")
        }
        $('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
    });

	/*var table = $('#dynamic-table-report').DataTable();
	
  alert(table.column( 4 ).data().sum());
  alert( 'Column 4 sum: '+
    table
        .column( 4 )
        .data()
        .reduce( function (a,b) {
            return a + b;
        } )
);*/
</script>