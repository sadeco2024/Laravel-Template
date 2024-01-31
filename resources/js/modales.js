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

        const modal = this;
        mtitle.textContent = title;
        mbody.innerHTML = "";
        fetch(url)
            .then((response) => response.text())
            .then((html) => {
                mbody.innerHTML = html;
                const form = mbody.querySelector("form");
                // Se agrega el campo oculto si lo tuviera
                const hiddenField = document.createElement("input");
                // Se le puede agregar un parámetro para la ruta
                hiddenField.type = "hidden";
                hiddenField.name = "param";
                hiddenField.value = hidden;
                form.appendChild(hiddenField);

                form.addEventListener("submit", function (event) {
                    event.preventDefault(); // Prevenir el envío del formulario
                    const mfooter = document.querySelector(".modal-footer");
                    const button = mfooter.querySelector('[type="submit"]');
                    button.data = {
                        btnhtml: button.innerHTML,
                    };
                    button.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...`;
                    button.disabled = true;
                    // Se hace la petición
                    fetch(form.action, {
                        method: form.method,
                        body: new FormData(form),
                    })
                        .then((response) => response.json())
                        .then((data) => {
                            limpiarErrores();
                            if (data.redirect) {
                                if (data.alert) {
                                    // Si se requiere un alerta nada más.
                                    try {
                                        Swal.fire({
                                            position: "center",
                                            icon: "success",
                                            title: data.alert,
                                            showConfirmButton: false,
                                            timer: 1500,
                                        });
                                    } catch (error) {
                                        throw new Error(
                                            "Error: Falta librería SweetAlerts2"
                                        );
                                    }
                                    button.innerHTML = button.data.btnhtml;
                                    button.disabled = false;
                                } else window.location.href = data.redirect;
                            } else {
                                button.innerHTML = button.data.btnhtml;
                                button.disabled = false;
                                if (data.errors) {
                                    const errors = data.errors;
                                    for (const field in errors) {
                                        const errorMessage = errors[field][0];
                                        const errorElement =
                                            document.createElement("small");
                                        errorElement.classList.add(
                                            "text-sm",
                                            "text-danger",
                                            "text-muted",
                                            "invalid"
                                        );
                                        errorElement.textContent = errorMessage;
                                        const input =
                                            document.getElementsByName(
                                                field
                                            )[0];
                                        input.classList.add("is-invalid");
                                        const group =
                                            input.closest(".input-group");
                                        group.insertAdjacentElement(
                                            "afterend",
                                            errorElement
                                        );
                                    }
                                }
                            }
                        })
                        .catch((error) => {
                            button.innerHTML = button.data.btnhtml;
                            button.disabled = false;
                            console.error("Error:", error);
                        });
                });
            });
    });
});

function limpiarErrores() {
    document.querySelectorAll("small.invalid").forEach((element) => {
        element.remove();
    });
    const invalidElements = document.querySelectorAll("form .is-invalid");
    invalidElements.forEach((element) => {
        element.classList.remove("is-invalid");
    });
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
                    console.log(data.status)
                    Swal.fire({
                        position: "center",
                        icon: (data.status>0 ? "error" : "success"),
                        title: data.msg !== '' ? data.msg : (data.status > 0 ? "Operación NO realizada." : "Operación realizada con éxito."),
                        showConfirmButton: false,
                        timer: 1500,
                    });
                } catch (error) {
                    // throw new Error("Error: Falta librería SweetAlerts2");
                    throw new Error("Mensaje: "+error.message);
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
        console.log(element);
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
                        icon: (data.status>0 ? "error" : "success"),
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
