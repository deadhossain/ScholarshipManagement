var staticPage = '/ScholarshipManagement';
/*$(document).ready(function(){
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
     		$(".modalLink").hide();
     	}
    });

    $('.submenu li').click(function(){
    	$('li').removeClass('active');
    	$(this).addClass('active');
    	$(this).parents('li').addClass('active');
    });
});*/

/*$(document).ready(function () {     
    var url = $('.dynamic-table').attr('data-source');
    $.ajax({
        type: 'GET',
        url: url,
        dataType:'json',
        success:function(data) {
            $('.dynamic-table tbody').html(data);
            $('.dynamic-table').DataTable();
        }
    })
    
});*/

$(document).ready(function() {
    var url = $('.dynamic-table').attr('data-source');

    var msg = $('.pageHeader').text();

    // $('.dynamic-table tbody').html(data);
    var myTable = $('.dynamic-table')
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
            exportOptions: {
                columns: 'th:not(:last-child)'
            }
          },
          
          {
            "extend": "print",
            "text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
            "className": "btn btn-white btn-primary btn-bold",
            title: function(){
                return msg
            },
            exportOptions: {
                columns: 'th:not(:last-child)'
            }
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
    // body...
});




// $(document).ready(function(){
//    $(document).on("click", ".modalLink", function (e) {
// 	    var modal_size = $(this).attr('data-modal-size');
// 	    if($(this).attr('modalUrl')=="")
//         {
//             return;
//         }
            
// 	    var url = staticPage + $(this).attr('modalUrl');
// 	    // if ( modal_size!=='' && typeof modal_size !== typeof undefined && modal_size !== false ) {
// 	    //   $("#modalSize").addClass(modal_size);
// 	    // }
// 	    // else{
// 	    //   $("#modalSize").addClass('modal-lg');
// 	    // }
// 	    $("#modalSize").addClass(modal_size);
// 	    /*$("#showDetaildModal").modal('show');*/
// 	    // var title = $(this).attr('title');
// 	    // $("#showDetaildModalTile").text(title);
// 	    // var data_title = $(this).attr('data-original-title');
// 	    // $("#showDetaildModalTile").text(data_title);

// 	    $("#showDetaildModalBody").load(url);
// 	    $("#showDetaildModal").modal('show');

// 	});
// });






















            
                
            
                
                
