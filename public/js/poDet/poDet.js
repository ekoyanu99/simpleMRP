if (!window.jQuery) {
    location.reload();
}

$(document).ready(function() {

    $('#poDetTable').DataTable({
        "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
        "order": [[ 1, "asc" ]],
        "deferRender": true,
        "scrollX": true,
        "scrollY": 375,
    });

});