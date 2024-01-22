@props([
    'tables' => 'false',
    'btnAll' => 'false',
    'sweetAlert'=>'false'
])


<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

{{-- ** Carga DATATABLES --}}
@if ($tables == 'true')
    <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="//cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="//cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="//cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="//cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>
    
    {{-- Todos los botones --}}
    @if ($btnAll == 'true') 
        <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="//cdn.datatables.net/buttons/2.4.2/js/buttons.flash.min.js"></script>
    @endif;

    {{-- Configuración inicial --}}
    <script>
        //** Datatables Initial's */
        $.extend(true, $.fn.dataTable.defaults, {
            language: {
                sProcessing: "Procesando...",
                sLengthMenu: "Mostrar _MENU_",
                sZeroRecords: "No se encontraron resultados",
                sEmptyTable: "Ningún dato disponible en esta tabla",
                sInfo: "Del _START_ a _END_ de _TOTAL_ registros",
                sInfoEmpty: "Del 0 al 0 de 0 registros",
                sInfoFiltered: "(filtrado de _MAX_ registros)",
                sSearch: "Buscar:",
                sInfoThousands: ",",
                sLoadingRecords: "Cargando...",
                oPaginate: {
                    sFirst: "Primero",
                    sLast: "Último",
                    sNext: "Siguiente",
                    sPrevious: "Anterior"
                },
                oAria: {
                    sSortAscending: ": Activar para ordenar la columna de manera ascendente",
                    sSortDescending: ": Activar para ordenar la columna de manera descendente"
                },
                buttons: {
                    copy: "Copiar",
                    colvis: "Visibilidad",
                    print: "Imprimir"
                }
            }
        });
    </script>
@endif



@if($sweetAlert == 'true')
    <link rel="stylesheet" href="{{Vite::asset('resources/assets/libs/sweetalert2/sweetalert2.min.css')}}">
    <script src="{{Vite::asset('resources/assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    

@endif

{{ $slot }}





