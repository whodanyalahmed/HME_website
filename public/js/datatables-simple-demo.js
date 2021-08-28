// window.addEventListener('DOMContentLoaded', event => {
//     // Simple-DataTables
//     // https://github.com/fiduswriter/Simple-DataTables/wiki

//     const datatablesSimple = document.getElementById('');
//     if (datatablesSimple) {
//         new simpleDatatables.DataTable(datatablesSimple,
//     //           {  "columnDefs": [
//     //     {"targets": [9,10], "orderable": false},
//     // ]}

//             );
//     }
// });

$(document).ready( function () {
    $('#datatablesSimple').DataTable({
    "columnDefs": [
        {bSortable: false, targets: [-1,-2]} ,
    ]
});
} );