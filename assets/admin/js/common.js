/* Formatting function for row details - modify as you need */
function format ( d ) {
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td>Ticket:</td>'+
            '<td>1</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Date Issued:</td>'+
            '<td>12/12/2015</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Status</td>'+
            '<td>Paid</td>'+
        '</tr>'+
    '</table>';
}
 
$(document).ready(function() {
    var tableObj = $('#ticketTable').DataTable();
     
    // Add event listener for opening and closing details
    $('#ticketTable tbody').on('click', 'tr', function () {
        var tr = $(this);
        var row = tableObj.row(tr);
        //alert(row);
 
        if ( row.child.isShown() ) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            // Open this row
            row.child( format(row.data()) ).show();
            tr.addClass('shown');
        }
    } );
} );