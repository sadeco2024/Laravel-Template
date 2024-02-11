
//** DATEPICKER   */ 

//** Rango de fechas */
document.querySelectorAll("input.daterange").forEach((element) => {
    try {
        flatpickr(element, {
            mode: "range",
            dateFormat: "d-m-Y",
            'locale': 'es',
        });
    } catch {
        throw "Error al cargar el Datepicker";
    }
});




//*** ALERTS */

//** Cualquier componente que requiera confirmación dentro de un form. */
document.querySelectorAll(".confirm-delete").forEach((element) => {
    element.addEventListener("click", (e) => {
        e.preventDefault();
        let Form = element.closest("form");
        try {
            Swal.fire({
                title: element.dataset.title || "¿Esta usted seguro?",
                text:  element.dataset.text || "Esta acción no se puede deshacer",
                icon:  element.dataset.icon || "warning",
                showCancelButton: true,
                cancelButtonText: "Cancelar",
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: element.dataset.btntext ||  "Eliminar",
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire("Eliminado!", "El registro ha sido eliminad.", "success");
                    Form.submit();
                }
            });
        } catch (error) {
            throw new Error("Error: Falta librería SweetAlerts2");
        }
    });
});

document.querySelectorAll(".rhExtras").forEach((element) => {
    element.addEventListener("click", (e) => {
        e.preventDefault();

        let select = element.closest('div.input-group') //.closest('select');
        select = select.querySelector('select');
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        Swal.fire({
            title: "¿Nombre del " + element.dataset.concepto + "?",
            input: "text",
            inputAttributes: {
                autocapitalize: "on",
            },
            showCancelButton: true,
            confirmButtonText: "Guardar",
            showLoaderOnConfirm: true,
            preConfirm: (nombre) => {
                return fetch('/generales/setRhExtras', {
                    method: "post",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    body: JSON.stringify({
                        concepto: element.dataset.concepto,
                        descripcion: nombre,
                    }),
                })
                .then((response) => {
                    if (!response.ok) {
                        return response.json().then((error) => {
                            console.log(error.message);
                            throw new Error(error.message);
                        });
                    }
                    return response.json();
                })
                .catch((error) => {
                    Swal.showValidationMessage(`${error}`);
                });
            },
            allowOutsideClick: () => !Swal.isLoading(),
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    position: "center",
                    icon:"success",
                    title: "El concepto ha sido agregado.",
                    showConfirmButton: false,
                    timer: 1500,
                });                
                let option = document.createElement("option");
                option.text = result.value.descripcion;
                option.value = result.value.id;
                select.add(option);
                select.value = result.value.id;
            }
        });



    });
});


function alertSuccess(message) {
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: message,
        showConfirmButton: false,
        timer: 1500,
    });
}

function alertError(message) {
    Swal.fire({
        position: "top-end",
        icon: "error",
        title: message,
        showConfirmButton: false,
        timer: 1500,
    });
}

function alertConfirm(message) {
    Swal.fire({
        title: "Are you sure?",
        text: message,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire("Deleted!", "Your file has been deleted.", "success");
        }
    });
}


