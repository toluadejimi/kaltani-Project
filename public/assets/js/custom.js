/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 * 
 */

"use strict";
$(document).ready(function() {
    $('#example').DataTable( {
        "searching": true,
        dom: 'Bfrtip',
         buttons: [
             'csv', 'excel', 'print',
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL'
            }
        ]
    } );
} );

$(document).ready( function () {
    $('#myTable').DataTable({
        searching: true,
    });
} );

$(document).ready(function(){
                      $(".alert").delay(5000).slideUp(300);
                });