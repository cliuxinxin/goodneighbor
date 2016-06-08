@section('header')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.css">
@endsection

@section('footer')
    <script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#{{$table_name}}').DataTable( {
                stateSave: true,
                "order": [[ 0, "desc" ]],
                "lengthMenu": [ 25, 50],
                initComplete: function () {
                    var api = this.api();
                    api.columns({{$columns}}).indexes().flatten().each( function ( i ) {
                        var column = api.column( i );
                        var select = $('<select><option value=""></option></select>')
                                .appendTo( $(column.header()) )
                                .on( 'change', function () {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                            $(this).val()
                                    );
                                    column
                                            .search( val ? '^'+val+'$' : '', true, false )
                                            .draw();
                                } );
                        column.data().unique().sort().each( function ( d, j ) {
                            select.append( '<option value="'+d+'">'+d+'</option>' )
                        } );
                    } );
                }
            } );
        } );
    </script>
@endsection