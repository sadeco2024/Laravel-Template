/* empty css              */function l(){document.getElementById("loader").classList.add("d-none")}window.addEventListener("load",l);document.querySelectorAll("textarea.noenter").forEach(t=>{t.addEventListener("keydown",e=>{e.key==="Enter"&&e.preventDefault()})});document.querySelectorAll("input.importe").forEach(t=>{t.addEventListener("input",e=>{const r=e.target.value;/^[0-9.]*$/.test(r)||(e.target.value=r.replace(/[^0-9.]/g,""))})});document.querySelectorAll("input.numeros").forEach(t=>{t.addEventListener("input",e=>{const r=e.target.value;/^[0-9]*$/.test(r)||(e.target.value=r.replace(/[^0-9]/g,""));const o=e.target.getAttribute("maxlength");o&&r.length>o&&(e.target.value=r.slice(0,o))})});document.querySelectorAll("input.upper").forEach(t=>{t.addEventListener("input",e=>{const r=e.target.value;e.target.value=r.toUpperCase()})});document.querySelectorAll('[type="submit"]').forEach(t=>{t.addEventListener("click",()=>{t.prevendDefault,t.data={btnhtml:t.innerHTML},t.innerHTML='<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...',t.disabled=!0;const e=document.getElementById(t.getAttribute("form"));e&&!e.classList.contains("form-modal")?e.submit():(console.log(e),console.log(e.action),$.ajax({url:e.action,type:e.method,data:new FormData(e),processData:!1,contentType:!1,success:function(r){if(t.innerHTML=t.data.btnhtml,t.disabled=!1,document.querySelectorAll("small.invalid").forEach(a=>{a.remove()}),r.errors){const a=r.errors;for(const o in a){const d=a[o][0],n=document.createElement("small");n.classList.add("text-sm","text-danger","text-muted","invalid"),n.textContent=d;const s=document.getElementsByName(o)[0];s.classList.add("is-invalid"),s.insertAdjacentElement("afterend",n)}}else r.success&&e.classList.contains("form-modal")&&($("#modal").modal("hide"),$("#modal").on("hidden.bs.modal",function(a){}))},error:function(r){t.innerHTML=t.data.btnhtml,t.disabled=!1;const o=JSON.parse(r.responseText).errors;console.log(o)}}))})});