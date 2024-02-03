import './funciones.js';
import './modales.js';
import './alerts.js';
import './sucursales.js';
import './datatables.js';
import './graficas.js';


//** Textarea SIN enters */
document.querySelectorAll("textarea.noenter").forEach((element) => {
    element.addEventListener("keydown", (event) => {
        if (event.key === "Enter") {
            event.preventDefault();
        }
    });
});
document.querySelectorAll('[type="submit"].btn-submit').forEach((element) => {
    element.addEventListener("click", (e) => {
        element.data = {
            btnhtml: element.innerHTML,
        };
        element.innerHTML = `<span class="spinner-border spinner-border-sm ms-1" role="status" aria-hidden="true"></span> Guardando...`;
        element.disabled = true;
        let Form = element.closest("form");
        Form.submit();
        // console.log(Form)
    })
    console.log(element);
});


//** Inputs con solo IMPORTE */
document.querySelectorAll("input.importe").forEach((element) => {
    element.addEventListener("input", (event) => {
        const value = event.target.value;
        const regex = /^[0-9.]*$/;
        if (!regex.test(value)) {
            event.target.value = value.replace(/[^0-9.]/g, "");
        }
    });
});

//** Inputs con solo NUMEROS */
document.querySelectorAll("input.numeros").forEach((element) => {
    element.addEventListener("input", (event) => {
        const value = event.target.value;
        const regex = /^[0-9]*$/;
        if (!regex.test(value)) {
            event.target.value = value.replace(/[^0-9]/g, "");
        }
        // Verificar si se ha alcanzado el límite de caracteres
        const maxLength = event.target.getAttribute("maxlength");
        if (maxLength && value.length > maxLength) {
            event.target.value = value.slice(0, maxLength);
        }
    });
});

//** Inputs en mayúsculas */
document.querySelectorAll("input.upper").forEach((element) => {
    element.addEventListener("input", (event) => {
        const value = event.target.value;
        event.target.value = value.toUpperCase();
    });
});