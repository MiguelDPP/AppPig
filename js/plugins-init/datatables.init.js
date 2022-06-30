(function($) {
    var table = $('#example3, #example4, #example5').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
        },
    });
    $('#example tbody').on('click', 'tr', function() {
        var data = table.row(this).data();
    });

})(jQuery);