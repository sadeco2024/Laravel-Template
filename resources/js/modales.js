// import { saveLink } from './funciones.js';

// saveLink('dasdasd');
document.querySelectorAll(".sd-modalForm").forEach((element) => {
    const mbody = document.querySelector(".modal-body");
    const mtitle = document.querySelector(".modal-title");

    element.addEventListener("show.bs.modal", function (event) {
        const button = event.relatedTarget;
        const url = button.getAttribute("data-url");
        const title = button.getAttribute("data-title");
        const hidden = button.getAttribute("data-param");
        // console.log(url,title,hidden)
        const modal = this;
        mtitle.textContent = title;
        mbody.innerHTML = "";
        // Se hace la petición de la vista.
        fetch(url)
            .then((response) => response.text())
            .then((html) => {
                // Se agrega el contenido al modal
                mbody.innerHTML = html;
                // Se obtiene el formulario
                const form = mbody.querySelector("form");
                // Se agrega el campo oculto si lo tuviera
                const hiddenField = document.createElement("input");
                // Se le puede agregar un parámetro para la ruta
                hiddenField.type = "hidden";
                hiddenField.name = "param";
                hiddenField.value = hidden;
                if (!form)
                    throw new Error("Error: Falta el <form> en la vista");
                form.appendChild(hiddenField);

                // El formulario se envía por AJAX y se controla desde aca.
                form.addEventListener("submit", function (event) {
                    event.preventDefault(); // Prevenir el envío del formulario
                    const mfooter = document.querySelector(".modal-footer");
                    // Tiene que tener un botón submit
                    const button = mfooter.querySelector('[type="submit"]');
                    button.data = {
                        btnhtml: button.innerHTML,
                    };
                    button.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Procesando...`;
                    button.disabled = true;

                    // Se envía el contenido del formulario por AJAX
                    fetch(form.action, {
                        method: form.method,
                        body: new FormData(form),
                    })
                        .then((response) => response.json())
                        .then((data) => {
                            
                            erroresForm(form); // Función que quita los errores del formulario

                            if (data.table) tableResponse(data.table);
                            
                            if (data.errors) erroresResponse(data.errors);
                            
                            if (data.redirect) window.location.href = data.redirect;

                            if (data.datatable) {
                                const table =  $('#tblTelcelCanales').DataTable();
                                dataTableResponse(table,data.datatable);
                            }
                            
                            //TODO: Buscar cual controlador usea redirect y alert cuando establecí esto.
                            // if (data.alert) {
                            //     alertResponse(data);
                            // } else
                            alertResponse(data);
                            console.log("form", data);
                            

                            button.innerHTML = button.data.btnhtml;
                            button.disabled = false;
                        })
                        .catch((error) => {
                            button.innerHTML = button.data.btnhtml;
                            button.disabled = false;
                            alertResponse(error);
                        });
                });
            });
    });
});

function dataTableResponse(table,data) {
    var row = table.row((data.id-1)).data();
    table.row(data.id-1).data( data )//.draw();   
}

// ?Función que limpia los errores de los modales CRUD
function erroresForm(form) {
    form.querySelectorAll("small.invalid").forEach((element) => {
        element.remove();
    });
    const invalidElements = form.querySelectorAll("form .is-invalid");
    invalidElements.forEach((element) => {
        element.classList.remove("is-invalid");
    });
}
//?Funcion que agrega filas a las tablas, cuando vienen en el response.
// @param ["nombreTabla"=>["campo1","campo2"],...] data
function tableResponse(data) {
    console.log(data);

    if (data && typeof data === "object") {
        console.log(data, typeof data);
        for (let key in data) {
            let tablaRender = document.getElementById(key);
            // Obtén una referencia al elemento tbody dentro de la tabla
            let tbody = tablaRender.getElementsByTagName("tbody")[0];
            // Limpia el contenido del tbody
            // tbody.innerHTML = '';

            // Se agregan las filas
            if (Array.isArray(data[key])) {
                data[key].forEach((element) => {
                    let row = tbody.insertRow();
                    for (let prop in element) {
                        let cell = row.insertCell();
                        cell.innerHTML = element[prop];
                    }
                });
            } else if (typeof data[key] === "object") {
                // El valor es un objeto, lo convertimos a un array
                data[key] = Object.values(data[key]);
                let row = tbody.insertRow();
                data[key].forEach((element) => {
                    let cell = row.insertCell();
                    cell.innerHTML = element;
                });
            } else {
                console.log("type:", typeof data);
                throw new Error(
                    "Error: El tipo de dato no es un array o un objeto"
                );
            }
        }
    }
}
//? Funcion que muestra un mensaje de alerta, cuando vienen en el response.
function alertResponse(data) {
    data.status = data.status ?? 1;
    let mensaje = data.msg ?? data.alert ?? (data.status == 0 ? "Operación NO realizada." : "Operación realizada con éxito.");
    try {
        Swal.fire({
            position: "center",
            icon: data.status > 0 ? "error" : "success",
            title: mensaje,
            showConfirmButton: false,
            timer: 1500,
        });
    } catch (error) {
        throw new Error("Alert::error: Falta librería SweetAlerts2");
    }
}



//? Funcion que pone los errores de validación, cuando vienen en el response.
function erroresResponse(errors) {
    // const errors = data.errors;
    for (const field in errors) {
        const errorMessage = errors[field][0];
        const errorElement = document.createElement("small");
        errorElement.classList.add(
            "text-sm",
            "text-danger",
            "text-muted",
            "invalid"
        );
        errorElement.textContent = errorMessage;
        const input = document.getElementsByName(field)[0];
        input.classList.add("is-invalid");
        const group = input.closest(".input-group");
        group.insertAdjacentElement("afterend", errorElement);
    }
}

document.querySelectorAll(".save").forEach((element) => {
    element.addEventListener("click", (event) => {
        event.preventDefault(); // Prevenir el envío del formulario
        // Guardamos la información del botón.
        element.data = {
            btnhtml: element.innerHTML,
        };
        element.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...`;
        element.disabled = true;
        const form = element.closest("form");

        fetch(form.action, {
            method: form.method,
            body: new FormData(form),
        })
            .then((response) => response.json())
            .then((data) => {
                element.innerHTML = element.data.btnhtml;
                element.disabled = false;
                try {
                    
                    Swal.fire({
                        position: "center",
                        icon: data.status > 0 ? "error" : "success",
                        title:
                            data.msg !== ""
                                ? data.msg
                                : data.status > 0
                                ? "Operación NO realizada."
                                : "Operación realizada con éxito.",
                        showConfirmButton: false,
                        timer: 1500,
                    });
                } catch (error) {
                    // throw new Error("Error: Falta librería SweetAlerts2");
                    throw new Error("Mensaje: " + error.message);
                }
            })
            .catch((error) => {
                element.innerHTML = element.data.btnhtml;
                element.disabled = false;
                console.error("Error:", error);
            });

        // form.submit();
    });
});

document.querySelectorAll(".save-link").forEach((element) => {
    element.addEventListener("click", (event) => {
        event.preventDefault(); // Prevenir el envío del formulario
        const url = element.getAttribute("data-link");
        // Guardamos la información del botón.
        element.data = {
            btnhtml: element.innerHTML,
        };
        element.innerHTML = `<span class="spinner-border spinner-border-sm ms-1" role="status" aria-hidden="true"></span>`;
        element.disabled = true;

        fetch(url)
            .then((response) => response.json())
            .then((data) => {
                try {
                    Swal.fire({
                        position: "center",
                        icon: data.status > 0 ? "error" : "success",
                        title:
                            data.msg ??
                            (data.status
                                ? "Operación NO realizada."
                                : "Operación realizada con éxito."),
                        showConfirmButton: false,
                        timer: 1500,
                    });
                } catch (error) {
                    throw new Error("Error: Falta librería SweetAlerts2");
                }
                element.innerHTML = element.data.btnhtml;
                element.disabled = false;
            })
            .catch((error) => {
                console.error("Error:", error);
            });
    });
});
