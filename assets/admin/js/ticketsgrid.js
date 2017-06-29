var baseURL = $("#hdnBase").val();
var ticketTableAjax;

$(document).ready(function(){
    ticketTableAjax = $("#ticketTable").DataTable({
        "ajax": baseURL + "index.php/administrator/tickets/all/"
    });
});