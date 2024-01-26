document.querySelectorAll(".sd-modalForm").forEach((element) => {
    const mbody = document.querySelector(".modal-body");
    const mtitle = document.querySelector(".modal-title");

    element.addEventListener("show.bs.modal", function (event) {
        const button = event.relatedTarget;
        const url = button.getAttribute("data-url");
        const title = button.getAttribute("data-title");
        const modal = this;
        mtitle.textContent = title;
        mbody.innerHTML = "";
        fetch(url)
            .then((response) => response.text())
            .then((html) => {
                mbody.innerHTML = html;
                const form = mbody.querySelector("form");
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
                            if (data.redirect) {
                                window.location.href = data.redirect;
                            } else {
                                button.innerHTML = button.data.btnhtml;
                                button.disabled = false;
                                if (data.errors) {
                                    const errors = data.errors;
                                    document
                                        .querySelectorAll("small.invalid")
                                        .forEach((element) => {
                                            element.remove();
                                        });
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
