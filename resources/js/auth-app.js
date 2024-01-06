// import './bootstrap.js';

function hideLoader() {
  setTimeout(() => {
  const loader = document.getElementById("loader");
  loader.classList.add("d-none")
  }, 1);
}
window.addEventListener("load", hideLoader);


import '../assets/libs/choices.js/public/assets/scripts/choices.min.js';
import '../assets/js/main.js';

import '../assets/libs/bootstrap/css/bootstrap.min.css';
import '../assets/css/styles.css';

import '../assets/css/icons.css';
import '../assets/libs/node-waves/waves.min.css';
import '../assets/libs/simplebar/simplebar.min.css';
import '../assets/libs/flatpickr/flatpickr.min.css';
import '../assets/libs/@simonwep/pickr/themes/nano.min.css';
import '../assets/libs/choices.js/public/assets/styles/choices.min.css';


