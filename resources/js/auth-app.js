// import "../assets/css/icons.css";
// import "../assets/libs/node-waves/waves.min.css";
// import "../assets/libs/simplebar/simplebar.min.css";
// import "../assets/libs/flatpickr/flatpickr.min.css";
// import "../assets/libs/@simonwep/pickr/themes/nano.min.css";
// import "../assets/libs/choices.js/public/assets/styles/choices.min.css";
// import "../css/app.css";


//** Oculta el loader */
function hideLoader() {
    const loader = document.getElementById("loader");
    loader.classList.add("d-none");
}
window.addEventListener("load", hideLoader);

//** Textarea SIN enters */
document.querySelectorAll("textarea.noenter").forEach((element) => {
    element.addEventListener("keydown", (event) => {
        if (event.key === "Enter") {
            event.preventDefault();
        }
    });
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

//** Botones de submit */
document.querySelectorAll('[type="submit"]').forEach((element) => {
    element.addEventListener("click", () => {
        // Prevenimos y guardamos la información del botón.
        element.prevendDefault;
        element.data = {
            btnhtml: element.innerHTML,
        };
        element.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...`;
        element.disabled = true;

        // Se localiza el form, y se validan tipos de formularios para modales.
        const form =document.getElementById(element.getAttribute("form"))
        if(form && !form.classList.contains('form-modal'))
          form.submit();
        else {
          // .form-modal:  Envía el formulario por ajax.
          $.ajax({
            url: form.action,
            type: form.method,
            data: new FormData(form),
            processData: false,
            contentType: false, 
            success: function (response) {
              element.innerHTML = element.data.btnhtml;
              element.disabled = false;
              // Se quitan todos los errores anteriores.
              document.querySelectorAll('small.invalid').forEach((element) => {
                element.remove();
              });                
              if (response.errors) {
                const errors = response.errors;
                for (const field in errors) {
                     const errorMessage = errors[field][0];
                     const errorElement = document.createElement("small");
                     errorElement.classList.add('text-sm','text-danger','text-muted' ,'invalid');
                     errorElement.textContent = errorMessage;
                     const input = document.getElementsByName(field)[0]; 
                     input.classList.add('is-invalid'); 
                     input.insertAdjacentElement('afterend', errorElement);                      
                   }              
              }
              else if (response.success) {
                if (form.classList.contains('form-modal')) {
                  $('#modal').modal('hide');
                  $('#modal').on('hidden.bs.modal', function (e) {
                    
                  })
                }
                else {
                  // location.reload();
                }
              }
            },
            error: function (xhr) {
              element.innerHTML = element.data.btnhtml;
              element.disabled = false;
              
              // // Leer los mensajes de error
              const response = JSON.parse(xhr.responseText);
              const errors = response.errors;
              console.log(errors)
              // // Pasar los mensajes de error a la vista
              // const errorContainer = document.getElementById("error-container");
              // errorContainer.innerHTML = "";
              
              // for (const field in errors) {
              //   const errorMessage = errors[field][0];
              //   const errorElement = document.createElement("p");
              //   errorElement.textContent = errorMessage;
              //   errorContainer.appendChild(errorElement);
              // }
            },
          });
        }
        // if (element.closest("form")) element.closest("form").submit();
        // else document.getElementById(element.getAttribute("form")).submit();
    });
});
