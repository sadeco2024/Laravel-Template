document.querySelectorAll(".sd-modalForm").forEach(i=>{const o=document.querySelector(".modal-body"),m=document.querySelector(".modal-title");i.addEventListener("show.bs.modal",function(u){const l=u.relatedTarget,f=l.getAttribute("data-url"),b=l.getAttribute("data-title");m.textContent=b,o.innerHTML="",fetch(f).then(s=>s.text()).then(s=>{o.innerHTML=s;const r=o.querySelector("form");r.addEventListener("submit",function(h){h.preventDefault();const e=document.querySelector(".modal-footer").querySelector('[type="submit"]');e.data={btnhtml:e.innerHTML},e.innerHTML='<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...',e.disabled=!0,fetch(r.action,{method:r.method,body:new FormData(r)}).then(t=>t.json()).then(t=>{if(t.redirect)window.location.href=t.redirect;else if(e.innerHTML=e.data.btnhtml,e.disabled=!1,t.errors){const a=t.errors;document.querySelectorAll("small.invalid").forEach(n=>{n.remove()});for(const n in a){const y=a[n][0],d=document.createElement("small");d.classList.add("text-sm","text-danger","text-muted","invalid"),d.textContent=y;const c=document.getElementsByName(n)[0];c.classList.add("is-invalid"),c.closest(".input-group").insertAdjacentElement("afterend",d)}}}).catch(t=>{e.innerHTML=e.data.btnhtml,e.disabled=!1,console.error("Error:",t)})})})})});