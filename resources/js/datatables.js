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

function setEstatus(estatus) {
    let color = "";
    switch (estatus) {
        case "Suspendido":
            color = "warning";
            break;
        case "Baja":
            color = "danger";
            break;
        default:
            color = "success"
            break;
    }
    return color;
}

//** TABLA DE EMPLEADOS */
if (document.getElementById("tblEmpleados")) {
    const tableEmpleados = $("#tblEmpleados").DataTable({
        dom: "Brtip",
        buttons: ["copy", "excel", "print"],
        pageLength: 10,
        resposive: true,
        columnDefs: [
            {
                targets: 3, // Esto apunta a la tercera columna (la indexación es desde 0)
                render: function(data, type, row, meta) {

                    let color = setEstatus(row[3]);
                    return `
                    <span class="badge bg-${color}-transparent" />
                        ${row[3]}
                    </span>
                    `;
                }
            }
        ],
    });

    // Cambiar la renderización de la columna de estatus
    // tableEmpleados
    //     .column(3)
    //     .render(function (data, type, row) {
    //         return `<x-badge :text="'${row.estatus.estatus}'" class="bg-success-transparent" />`;
    //     });

    const buttons = Array.from(tableEmpleados.buttons().nodes());
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
    $("thead", tableEmpleados.table).addClass("text-info");
    $(".pagination", tableEmpleados.table).addClass("my-2");

    // Cambia de posición los botones
    tableEmpleados.buttons().container().appendTo("#tblEmpleadosBtn");

    // Cambia de posición el input de búsqueda
    $("#tblEmpleadosInput").on("keyup", function () {
        tableEmpleados.search(this.value).draw();
    });
}
