function getTablaEmpleados(data) {
    console.log(data);

    let acts = 0;
    susps = 0;
    bajas = 0;
    imgs = "";

    data.forEach((row) => {
        //** Totales de estatuses */
        switch (row.estatus) {
            case "activo":
                acts++;
                break;
            case "suspendido":
                susps++;
                break;
            case "baja":
                bajas++;
                break;
        }

        //** Imagenes de avatares */
        row.puesto = row.puesto.replace(/\s/g, "");
        let avatares = document.querySelector(
            '[puesto="' + row.puesto.replace(/\s/g, "") + '"]'
        );
        avatares.innerHTML =
            avatares.innerHTML +
            '<img src="./resources/assets/images/faces/9.jpg" class="avatar avatar-sm rounded-circle" alt="Avatar' +
            'title="'+row.empleado+'">';

    });
    $("#totActivos").html(acts);
    $("#totSuspendidos").html(susps);
    $("#totBaja").html(bajas);

    //** Tabla de empleados */


    new gridjs.Grid({
        language: {
            search: {
                placeholder: "🔍 Buscar...",
            },
            pagination: {
                previous: "Anterior",
                next: "Siguiente",
                showing: "Mostrando",
                results: () => "Registros",
            },
        },
        pagination: true,
        search: true,
        sort: true,
        autoWidth: true,
        // fixedHeader: true,
        className: {
            th: "bg-dark text-center",
        },
        style: {
            table: {
                "white-space": "nowrap",
            },
        },
        columns: [
            {
                name: "Name",
            },

            {
                id: "email",
                name: "Correo",
            },
            {
                name: "Puesto",
            },
            {
                name: "Sucursal",
                // width: "100px",
            },
            {
                name: "Estatus",
                width: "100px",
                formatter: (_, row) =>
                    gridjs.html(
                        `<span class="badge ${
                            row.cells[4].data == "activo"
                                ? "bg-success-transparent"
                                : row.cells[4].data == "suspendido"
                                ? "bg-warning-transparent"
                                : "bg-danger-transparent"
                        }">${row.cells[4].data}</span>`
                    ),
            },
            {
                id:"estatus",
                name: "",
                sort: false,
                formatter: (_, row) =>
                    gridjs.html(
                        `<div class="w-100 d-flex justify-content-center">  
                        
                        <button rol="button" class="btnCrud btn btn-icon btn-sm btn-info rounded-pill" data-bs-effect="effect-slide-in-bottom" data-bs-toggle="modal" data-bs-target="#staticBackdrop"  onclick="btnCrud(this)" >
                        <i class="ri-edit-line"></i></button>
                    </div>`
                    ),
            },
        ],
        data: data,
    }).render(document.getElementById("grid-empleados"));
}





function btnCrud(element) {
    let row = element?.closest("tr");
    let data = Array.from(row.cells, cell => cell.textContent)
    console.log(data);
    
    

}
