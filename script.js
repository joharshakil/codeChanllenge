jQuery(document).ready(function(){
  
    var dataTable = jQuery('#empTable').DataTable({
    
        drawCallback: function () {
            var sum = jQuery('#empTable').DataTable().column(3).data().sum();
            jQuery('#totalAmount').text(sum);
          },
             
      'processing': true,
      'serverSide': true,
      'searching': false ,
      'info': false,      
      "sDom": "lfrti",
      'serverMethod': 'post',
      'ajax': {
         'url':'filter.php',
         'data': function(data){
            // Read values
            var employee_name = jQuery('#searchByEmployeeName').val();
            var event_name = jQuery('#searchByEventName').val();
            var search_date =  jQuery('#searchByDate').val();
           
            // Append to data
            data.searchByEmployeeName = employee_name;
            data.searchByEventName = event_name;
            data.searchByDate = search_date;
         }
      },
      'columns': [
         { data: 'emp_name' }, 
         { data: 'email' },
         { data: 'event_name' },
         { data: 'event_fees' },
         { data: 'event_date' },
      ] ,
    });
  
    jQuery('#searchByEmployeeName').keyup(function(){
        dataTable.draw();
      });

      jQuery('#searchByEventName').keyup(function(){
      dataTable.draw();
    });
  
    jQuery('#searchByDate').change(function(){
      dataTable.draw();
    });
    
  });
 