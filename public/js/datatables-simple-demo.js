// window.addEventListener('DOMContentLoaded', event => {
//     // Simple-DataTables
//     // https://github.com/fiduswriter/Simple-DataTables/wiki

//     const datatablesSimple = document.getElementById('');
//     if (datatablesSimple) {
//         new simpleDatatables.DataTable(datatablesSimple);
//     }
// });

$(document).ready( function () {
    $('#datatablesSimple').DataTable({
    "columnDefs": [
        {"targets": [9,10], "orderable": false},
    ]
});
} );