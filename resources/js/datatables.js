if (document.getElementById("tblTelcelCanales")) {
    const tableCanales = $("#tblTelcelCanales").DataTable({
        dom: "Brtip",
        buttons: ["copy", "excel", "print"],
        pageLength: 10,
        resposive: true,
        // processing: true,
        // serverSide: true,
        // deferRender: true,
    });
    // Selecciona todos los botones en la tabla actual para cambiar estilos
    const buttons = Array.from(tableCanales.buttons().nodes());
    buttons.forEach((button) => {
        button.classList.remove("btn-secondary");
        button.classList.add(
            "btn-sm",
            "btn-outline-info",
            "btn-wave",
            "waves-effect",
            "waves-light"
        );
    });
    // Cambia el color del texto de lso tds
    $("thead", tableCanales.table).addClass("text-info");
    $(".pagination", tableCanales.table).addClass("my-2");

    // Cambia de posición los botones
    tableCanales.buttons().container().appendTo("#btnTelcelCanales");

    // Cambia de posición el input de búsqueda
    $("#src_telcel_canal").on("keyup", function () {
        tableCanales.search(this.value).draw();
    });


    //TODO: Que se cargue el data actual al modal, para que al cerrar se reestableza. Ya lo hace, pero el detalle que no se muestra el botón, porque no se renderíza por datatable, se hace en php
    //
    // var clickedRow = null;
    // $('#tblTelcelCanales tbody').on('click', 'tr', function () {
    //     clickedRow = tableCanales.row(this).index();
    //     clickedRow = tableCanales.row(this).data();
    //     // Remove HTML from the last column
    //     clickedRow[clickedRow.length - 1] = $(clickedRow[clickedRow.length - 1]).text();
    //     console.log(clickedRow);
    // });

    // $('#modalCanales').on('hidden.bs.modal', function () {
    //     if (clickedRow !== null) {
    //         var newData = // obtén los nuevos datos del formulario aquí
    //         tableCanales.row(clickedRow).data(clickedRow).draw();
    //     }
    // });


}
