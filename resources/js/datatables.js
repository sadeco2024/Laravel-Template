(function () {
    "use strict";

    //** TABLA DE CANALES */
    if (document.getElementById("tblTelcelCanales")) {
        var url = $("#tblTelcelCanales").data("url");

        const tableCanales = $("#tblTelcelCanales").DataTable({
            dom: "Brtip",
            buttons: ["copy", "excel", "print"],
            pageLength: 10,
            // resposive: true,
            ajax: {
                url: url,
                dataSrc: "",
            },
            scrollX: true,
            columns: [
                { data: "nombre" },
                {
                    data: "clave",
                    render: function (data, type, row) {
                        return `<span class="badge border bg-light text-default custom-badge px-2">${row.clave}</span>`;
                    },
                },
                { data: "acox" },
                { data: "concepto.concepto" },
                { data: "sucursal.nombre" },
                {
                    data: "sucursal.empleados",
                    render: function (data, type, row) {
                        return data.length;
                    },
                },
                {
                    data: null,
                    render: function (data, type, row) {
                        let qColor = row.question==1 ? 'success' : 'warning';
                        // console.log(row)
                        return `
                        <div class="btn-group btn-group-sm">
                            <a class="modal-effect btn btn-sm btn-outline-${qColor} waves-effect waves-light"
                                data-bs-effect="effect-slide-in-right" 
                                data-bs-toggle="modal" 
                                href="#modalCanales" 
                                data-url="${row.ruta_editar}"
                                data-title="Editar canal"
                                data-param="${row.id}"
                            >
                                <i class="bi bi-gear"></i>
                            </a>
               
                        </div>
                        `;
                    },
                },
            ],
            columnDefs: [
                {
                    targets: 3,
                    className: "text-center",
                    render: function (data, type, row, meta) {
                        let color =
                            row.concepto.concepto === "Distribuidor"
                                ? "primary" : ( row.concepto.concepto === "Subs" ? 'success' : "warning");
                        color = row.id == 1 ? "danger" : color;
                        return `
                        <span class="badge bg-${color}-transparent" />
                            ${row.concepto.concepto}
                        </span>
                        `;
                    },
                },
            ],
        });
        moveOptions(tableCanales, "src_telcel_canal", "btnTelcelCanales");
    }
})();

function moveOptions(table, search, botones) {
    $("thead", table).addClass("text-info");
    $(".pagination", table).addClass("my-2");
    // Selecciona todos los botones en la tabla actual para cambiar estilos
    const buttons = Array.from(table.buttons().nodes());
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
    table
        .buttons()
        .container()
        .appendTo("#" + botones);

    $("#" + search)
        .val("")
        .on("keyup", function () {
            table.search(this.value).draw();
        });
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
            color = "success";
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
                render: function (data, type, row, meta) {
                    let color = setEstatus(row[3]);
                    return `
                    <span class="badge bg-${color}-transparent" />
                        ${row[3]}
                    </span>
                    `;
                },
            },
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
