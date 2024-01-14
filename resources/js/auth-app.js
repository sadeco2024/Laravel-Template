import '../assets/css/icons.css';
import '../assets/libs/node-waves/waves.min.css';
import '../assets/libs/simplebar/simplebar.min.css';
import '../assets/libs/flatpickr/flatpickr.min.css';
import '../assets/libs/@simonwep/pickr/themes/nano.min.css';
import '../assets/libs/choices.js/public/assets/styles/choices.min.css';
import '../css/app.css';


//** Oculta el loader */
function hideLoader() {
  const loader = document.getElementById("loader");
  loader.classList.add("d-none")
}
window.addEventListener("load", hideLoader);

//** Textarea SIN enters */
document.querySelectorAll('textarea.noenter').forEach((element) => {
  element.addEventListener('keydown', (event) => {
    if (event.key === 'Enter') {
      event.preventDefault();
    }
  });
});

//** Botones de submit */
document.querySelectorAll('[type="submit"]').forEach((element) => {
  element.addEventListener("click", () => {
    element.prevendDefault;
    element.data = {
      btnhtml: element.innerHTML
    }
    element.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...`;
    element.disabled = true;
  
    if (element.closest('form'))
      element.closest('form').submit();
    else // Por su atributo
      document.getElementById(element.getAttribute('form')).submit();
  });
});