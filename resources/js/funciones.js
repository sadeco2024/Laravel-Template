
import axios from "axios";

window.saveLink = function(element) {
    const url = element.getAttribute("data-link");
    element.data = {
        btnhtml: element.innerHTML,
    };
    element.innerHTML = `<span class="spinner-border spinner-border-sm ms-1" role="status" aria-hidden="true"></span>`;
    element.disabled = true;

    axios.get(url)
        .then((data) => {
            console.log(data.data);
            data = data.data
            element.innerHTML = element.data.btnhtml;
            element.disabled = false;
            if (data.form) formResponse(data);
            if (data.table) tableResponse(data.table);
            alertResponse(data)
        })
        .catch((error) => {
            console.error("Error:", error);
            alertResponse(error)
        });    
}

// TODO: Estas funciones se repoten en modales.js, ponerlas en uno y exportarlas.
//? Función que rellena un form con los datos que vienen en el response.
function formResponse(data) {
    if (data.form && typeof data.form === "object") {
        for (let key in data.form) {
            let value = data.form[key];
            document.getElementsByName(key)[0].value = value;
        }
    } else{
        throw new Error("Funciones::Error: No se recibió ningún formulario");
    }
}
//?Funcion que agrega filas a las tablas, cuando vienen en el response.
// @param ["nombreTabla"=>["campo1","campo2"],...] data 
function tableResponse(data) {
    console.log(data)

    if (data && typeof data === "object") {
        console.log(data,typeof data);
        for (let key in data) {
            let tablaRender = document.getElementById(key);
            // Obtén una referencia al elemento tbody dentro de la tabla
            let tbody = tablaRender.getElementsByTagName('tbody')[0];
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
            } else if (typeof data[key] === 'object') {
                // El valor es un objeto, lo convertimos a un array
                data[key] = Object.values(data[key]);
                let row = tbody.insertRow();
                data[key].forEach((element) => {
                    let cell = row.insertCell();
                    cell.innerHTML = element;
                });
            }
            else {
               console.log('type:',typeof data)
               throw new Error("Error: El tipo de dato no es un array o un objeto");
            }
        }
    }  
}
//? Funcion que muestra un mensaje de alerta, cuando vienen en el response.
function alertResponse(data) {
    console.log("funciones::alert", data);
    try {
        Swal.fire({
            position: "center",
            icon: data.status > 0 ? "error" : "success",
            title:
                data.msg !== ""
                    ? data.msg
                    : (data.status > 0
                    ? "Operación NO realizada."
                    : "Operación realizada con éxito."),
            showConfirmButton: false,
            timer: 1500,
        });
    } catch (error) {
        throw new Error("Error: Falta librería SweetAlerts2");
    }
}