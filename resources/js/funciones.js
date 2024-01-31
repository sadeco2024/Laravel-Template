

window.saveLink = function(element) {
    console.log(element);
    const url = element.getAttribute("data-link");
    element.data = {
        btnhtml: element.innerHTML,
    };
    element.innerHTML = `<span class="spinner-border spinner-border-sm ms-1" role="status" aria-hidden="true"></span>`;
    element.disabled = true;

    fetch(url)
        .then((response) => response.json())
        .then((data) => {
            console.log(data,data.status);

            // Si se manda la propiedad form, se llenan los campos del formulario.
            if (data.form && typeof data.form === "object") {
                for (let key in data.form) {
                    let value = data.form[key];
                    document.getElementsByName(key)[0].value = value;
                }
            }
            // Si se manda para cambiar alguna tabla.
            if (data.table && typeof data.table === "object") {
                for (let key in data.table) {
                    // let value = data.table[key];
                    let tablaRender = document.getElementById(key);
                    // Obtén una referencia al elemento tbody dentro de la tabla
                    let tbody = tablaRender.getElementsByTagName('tbody')[0];
                    // Limpia el contenido del tbody
                    tbody.innerHTML = '';
                    // Se agregan las filas
                    if (Array.isArray(data.table[key])) {
                        data.table[key].forEach((element) => {
                            let row = tbody.insertRow();
                            for (let prop in element) {
                                let cell = row.insertCell();
                                cell.innerHTML = element[prop];
                            }
                        });
                    }

                }
            }            
            try {
                Swal.fire({
                    position: "center",
                    icon: (data.status>0 ? "error" : "success"),
                    title: data.msg ?? (data.status ? "Operación NO realizada." : "Operación realizada con éxito."),
                    showConfirmButton: false,
                    timer: 1500,
                });
            } catch (error) {
                throw new Error(
                    "Error: Falta librería SweetAlerts2"
                );
            }
            element.innerHTML = element.data.btnhtml;
            element.disabled = false;
        })
        .catch((error) => {
            console.error("Error:", error);
        });    
}