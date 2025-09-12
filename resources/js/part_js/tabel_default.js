$(function() {
    $("#example1").DataTable({
        "responsive": true,
        "lengthMenu": [10, 20, 50],
        "autoWidth": false,
        "searching": true,
        "ordering": false, //untuk sorting data
        "info": true,
    });
});