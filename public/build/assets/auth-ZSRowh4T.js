import{a as L}from"./axios-zOJ20UaM.js";window.saveLink=function(e){const a=e.getAttribute("data-link");e.data={btnhtml:e.innerHTML},e.innerHTML='<span class="spinner-border spinner-border-sm ms-1" role="status" aria-hidden="true"></span>',e.disabled=!0,L.get(a).then(t=>{console.log(t.data),t=t.data,e.innerHTML=e.data.btnhtml,e.disabled=!1,t.form&&O(t),t.table&&M(t.table),C(t)}).catch(t=>{console.error("Error:",t),C(t)})};function O(e){if(e.form&&typeof e.form=="object")for(let a in e.form){let t=e.form[a];document.getElementsByName(a)[0].value=t}else throw new Error("Funciones::Error: No se recibió ningún formulario")}function M(e){if(console.log(e),e&&typeof e=="object"){console.log(e,typeof e);for(let a in e){let n=document.getElementById(a).getElementsByTagName("tbody")[0];if(Array.isArray(e[a]))e[a].forEach(o=>{let s=n.insertRow();for(let r in o){let i=s.insertCell();i.innerHTML=o[r]}});else if(typeof e[a]=="object"){e[a]=Object.values(e[a]);let o=n.insertRow();e[a].forEach(s=>{let r=o.insertCell();r.innerHTML=s})}else throw console.log("type:",typeof e),new Error("Error: El tipo de dato no es un array o un objeto")}}}function C(e){console.log("funciones::alert",e);try{Swal.fire({position:"center",icon:e.status>0?"error":"success",title:e.msg!==""?e.msg:e.status>0?"Operación NO realizada.":"Operación realizada con éxito.",showConfirmButton:!1,timer:1500})}catch{throw new Error("Error: Falta librería SweetAlerts2")}}document.querySelectorAll(".sd-modalForm").forEach(e=>{const a=document.querySelector(".modal-body"),t=document.querySelector(".modal-title");e.addEventListener("show.bs.modal",function(n){const o=n.relatedTarget,s=o.getAttribute("data-url"),r=o.getAttribute("data-title"),i=o.getAttribute("data-param");t.textContent=r,a.innerHTML="",fetch(s).then(u=>u.text()).then(u=>{a.innerHTML=u;const l=a.querySelector("form"),p=document.createElement("input");if(p.type="hidden",p.name="param",p.value=i,!l)throw new Error("Error: Falta el <form> en la vista");l.appendChild(p),l.addEventListener("submit",function(f){f.preventDefault();const d=document.querySelector(".modal-footer").querySelector('[type="submit"]');d.data={btnhtml:d.innerHTML},d.innerHTML='<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Procesando...',d.disabled=!0,fetch(l.action,{method:l.method,body:new FormData(l)}).then(c=>c.json()).then(c=>{if(k(l),c.table&&j(c.table),c.errors&&N(c.errors),c.redirect&&(window.location.href=c.redirect),c.datatable){const x=$("#tblTelcelCanales").DataTable();F(x,c.datatable)}w(c),console.log("form",c),d.innerHTML=d.data.btnhtml,d.disabled=!1}).catch(c=>{d.innerHTML=d.data.btnhtml,d.disabled=!1,w(c)})})})})});function F(e,a){e.row(a.id-1).data(),e.row(a.id-1).data(a)}function k(e){e.querySelectorAll("small.invalid").forEach(t=>{t.remove()}),e.querySelectorAll("form .is-invalid").forEach(t=>{t.classList.remove("is-invalid")})}function j(e){if(console.log(e),e&&typeof e=="object"){console.log(e,typeof e);for(let a in e){let n=document.getElementById(a).getElementsByTagName("tbody")[0];if(Array.isArray(e[a]))e[a].forEach(o=>{let s=n.insertRow();for(let r in o){let i=s.insertCell();i.innerHTML=o[r]}});else if(typeof e[a]=="object"){e[a]=Object.values(e[a]);let o=n.insertRow();e[a].forEach(s=>{let r=o.insertCell();r.innerHTML=s})}else throw console.log("type:",typeof e),new Error("Error: El tipo de dato no es un array o un objeto")}}}function w(e){e.status=e.status??1;let a=e.msg??e.alert??(e.status==0?"Operación NO realizada.":"Operación realizada con éxito.");try{Swal.fire({position:"center",icon:e.status>0?"error":"success",title:a,showConfirmButton:!1,timer:1500})}catch{throw new Error("Alert::error: Falta librería SweetAlerts2")}}function N(e){for(const a in e){const t=e[a][0],n=document.createElement("small");n.classList.add("text-sm","text-danger","text-muted","invalid"),n.textContent=t;const o=document.getElementsByName(a)[0];o.classList.add("is-invalid"),o.closest(".input-group").insertAdjacentElement("afterend",n)}}document.querySelectorAll(".save").forEach(e=>{e.addEventListener("click",a=>{a.preventDefault(),e.data={btnhtml:e.innerHTML},e.innerHTML='<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...',e.disabled=!0;const t=e.closest("form");fetch(t.action,{method:t.method,body:new FormData(t)}).then(n=>n.json()).then(n=>{e.innerHTML=e.data.btnhtml,e.disabled=!1;try{Swal.fire({position:"center",icon:n.status>0?"error":"success",title:n.msg!==""?n.msg:n.status>0?"Operación NO realizada.":"Operación realizada con éxito.",showConfirmButton:!1,timer:1500})}catch(o){throw new Error("Mensaje: "+o.message)}}).catch(n=>{e.innerHTML=e.data.btnhtml,e.disabled=!1,console.error("Error:",n)})})});document.querySelectorAll(".save-link").forEach(e=>{e.addEventListener("click",a=>{a.preventDefault();const t=e.getAttribute("data-link");e.data={btnhtml:e.innerHTML},e.innerHTML='<span class="spinner-border spinner-border-sm ms-1" role="status" aria-hidden="true"></span>',e.disabled=!0,fetch(t).then(n=>n.json()).then(n=>{try{Swal.fire({position:"center",icon:n.status>0?"error":"success",title:n.msg??(n.status?"Operación NO realizada.":"Operación realizada con éxito."),showConfirmButton:!1,timer:1500})}catch{throw new Error("Error: Falta librería SweetAlerts2")}e.innerHTML=e.data.btnhtml,e.disabled=!1}).catch(n=>{console.error("Error:",n)})})});document.querySelectorAll("input.daterange").forEach(e=>{try{flatpickr(e,{mode:"range",dateFormat:"d-m-Y",locale:"es"})}catch{throw"Error al cargar el Datepicker"}});document.querySelectorAll(".confirm-delete").forEach(e=>{e.addEventListener("click",a=>{a.preventDefault();let t=e.closest("form");try{Swal.fire({title:e.dataset.title||"¿Esta usted seguro?",text:e.dataset.text||"Esta acción no se puede deshacer",icon:e.dataset.icon||"warning",showCancelButton:!0,cancelButtonText:"Cancelar",confirmButtonColor:"#3085d6",cancelButtonColor:"#d33",confirmButtonText:e.dataset.btntext||"Eliminar"}).then(n=>{n.isConfirmed&&(Swal.fire("Eliminado!","El registro ha sido eliminad.","success"),t.submit())})}catch{throw new Error("Error: Falta librería SweetAlerts2")}})});document.querySelectorAll(".rhExtras").forEach(e=>{e.addEventListener("click",a=>{a.preventDefault();let t=e.closest("div.input-group");t=t.querySelector("select");const n=document.querySelector('meta[name="csrf-token"]').getAttribute("content");Swal.fire({title:"¿Nombre del "+e.dataset.concepto+"?",input:"text",inputAttributes:{autocapitalize:"on"},showCancelButton:!0,confirmButtonText:"Guardar",showLoaderOnConfirm:!0,preConfirm:o=>fetch("/generales/setRhExtras",{method:"post",headers:{"Content-Type":"application/json","X-CSRF-TOKEN":n},body:JSON.stringify({concepto:e.dataset.concepto,descripcion:o})}).then(s=>s.ok?s.json():s.json().then(r=>{throw console.log(r.message),new Error(r.message)})).catch(s=>{Swal.showValidationMessage(`${s}`)}),allowOutsideClick:()=>!Swal.isLoading()}).then(o=>{if(o.isConfirmed){Swal.fire({position:"center",icon:"success",title:"El concepto ha sido agregado.",showConfirmButton:!1,timer:1500});let s=document.createElement("option");s.text=o.value.descripcion,s.value=o.value.id,t.add(s),t.value=o.value.id}})})});var D={series:[{name:"Kits",data:[44,55,41,42,22,43,21,35,56,27,43,27]},{name:"Chips",data:[33,21,32,37,23,32,47,31,54,32,20,38]},{name:"Portas",data:[30,25,36,30,45,35,64,51,59,36,39,51]},{name:"Otros",data:[2,0,0,1,1,2,0,0,3,4,1,5]}],chart:{type:"bar",height:360,fontFamily:"Poppins, sans-serif",foreColor:"#8c9097",stacked:!0,toolbar:{show:!1},zoom:{enabled:!0}},grid:{borderColor:"#90A4AE",strokeDashArray:2},dataLabels:{enabled:!1},responsive:[{breakpoint:480,options:{legend:{position:"bottom",offsetX:-10,offsetY:0}}}],stroke:{show:!0,width:[5,5,5,5],curve:"smooth"},plotOptions:{bar:{columnWidth:"10%",horizontal:!1}},legend:{position:"right",offsetY:40},fill:{opacity:1},legend:{show:!1},tooltip:{enabled:!0,shared:!0,intersect:!1},labels:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"]},D={series:[44,55,13,43],chart:{width:220,height:220,type:"pie"},colors:["var(--primary08)","rgba(69, 214, 91, 0.8)","rgba(243, 156, 18, 0.8)","rgba(231, 76, 60, 0.8)"],labels:["Chips","Kits","Portas","Otros"],legend:{show:!1},stroke:{width:0},dataLabels:{enabled:!0,dropShadow:{enabled:!1}}};if(document.querySelector("#leads-source")){var q=new ApexCharts(document.querySelector("#leads-source"),D);q.render()}(function(){if(document.getElementById("tblTelcelCanales")){var e=$("#tblTelcelCanales").data("url");const a=$("#tblTelcelCanales").DataTable({dom:"Brtip",buttons:["copy","excel","print"],pageLength:10,ajax:{url:e,dataSrc:""},scrollX:!0,columns:[{data:"nombre"},{data:"clave",render:function(t,n,o){return`<span class="badge border bg-light text-default custom-badge px-2">${o.clave}</span>`}},{data:"acox"},{data:"concepto.concepto"},{data:"sucursal.nombre"},{data:"sucursal.empleados",render:function(t,n,o){return t.length}},{data:null,render:function(t,n,o){return`
                        <div class="btn-group btn-group-sm">
                            <a class="modal-effect btn btn-sm btn-outline-${o.question==1?"success":"warning"} waves-effect waves-light"
                                data-bs-effect="effect-slide-in-right" 
                                data-bs-toggle="modal" 
                                href="#modalCanales" 
                                data-url="${o.ruta_editar}"
                                data-title="Editar canal"
                                data-param="${o.id}"
                            >
                                <i class="bi bi-gear"></i>
                            </a>
               
                        </div>
                        `}}],columnDefs:[{targets:3,className:"text-center",render:function(t,n,o,s){let r=o.concepto.concepto==="Distribuidor"?"primary":o.concepto.concepto==="Subs"?"success":"warning";return r=o.id==1?"danger":r,`
                        <span class="badge bg-${r}-transparent" />
                            ${o.concepto.concepto}
                        </span>
                        `}}]});B(a,"src_telcel_canal","btnTelcelCanales")}})();function B(e,a,t){$("thead",e).addClass("text-info"),$(".pagination",e).addClass("my-2"),Array.from(e.buttons().nodes()).forEach(o=>{o.classList.remove("btn-secondary"),o.classList.add("btn-sm","btn-outline-info","btn-wave","waves-effect","waves-light")}),e.buttons().container().appendTo("#"+t),$("#"+a).val("").on("keyup",function(){e.search(this.value).draw()})}function H(e){let a="";switch(e){case"Suspendido":a="warning";break;case"Baja":a="danger";break;default:a="success";break}return a}if(document.getElementById("tblEmpleados")){const e=$("#tblEmpleados").DataTable({dom:"Brtip",buttons:["copy","excel","print"],pageLength:10,resposive:!0,columnDefs:[{targets:3,render:function(t,n,o,s){return`
                    <span class="badge bg-${H(o[3])}-transparent" />
                        ${o[3]}
                    </span>
                    `}}]});Array.from(e.buttons().nodes()).forEach(t=>{t.classList.remove("btn-secondary"),t.classList.add("btn-sm","btn-outline-info","btn-wave","waves-effect","waves-light")}),$("thead",e.table).addClass("text-info"),$(".pagination",e.table).addClass("my-2"),e.buttons().container().appendTo("#tblEmpleadosBtn"),$("#tblEmpleadosInput").on("keyup",function(){e.search(this.value).draw()})}(function(){const e=document.querySelector("#slcActivacionesAnio"),a=document.querySelector("#slcActivacionesMes"),t=document.querySelector("#slcActivacionesFecha");e&&(e.selectedIndex=0,a.selectedIndex=new Date().getMonth(),t.selectedIndex=0),e&&t&&(e.addEventListener("change",n=>{A(n.target.value,a.value,t.value),v(n.target.value,a.value,t.value),y(e.value,a.value,t.value)}),t.addEventListener("change",n=>{A(e.value,a.value,n.target.value),v(e.value,a.value,n.target.value),y(e.value,a.value,t.value)}),A(e.value,t.value)),a&&(a.addEventListener("change",n=>{y(e.value,a.value,t.value),v(e.value,n.target.value,t.value)}),y(e.value,a.value,t.value),v(e.value,a.value,t.value))})();function v(e,a,t){const n=document.querySelector('meta[name="csrf-token"]').getAttribute("content"),o=document.querySelector("#slcActivacionesSucursal"),s=o?o.value:0;fetch("/telcel/activaciones/grafica/diario",{method:"post",headers:{"Content-Type":"application/json","X-CSRF-TOKEN":n},body:JSON.stringify({anio:e??new Date().getFullYear(),mes:a??new Date().getMonth(),tipofecha:t??"preactivacion",sucursal:s})}).then(r=>r.json()).then(r=>{const i=Math.max(...Object.values(r).map(f=>f.data.length)),u=Array.from({length:i},(f,m)=>m+1),l=I(r,i);var p=_(l,u);E("#grafica-activaciones-diario",l,p)})}function y(e,a,t){const n=document.querySelector('meta[name="csrf-token"]').getAttribute("content"),o=document.querySelector("#slcActivacionesSucursal"),s=o?o.value:0;fetch("/telcel/activaciones/comparadiario",{method:"post",headers:{"Content-Type":"application/json","X-CSRF-TOKEN":n},body:JSON.stringify({anio:e??new Date().getFullYear(),mes:a??new Date().getMonth(),tipofecha:t??"preactivacion",sucursal:s})}).then(r=>r.json()).then(r=>{const i=document.getElementById("compara-mensual-diario");if(i){i.innerHTML="";const u=e.toString(),l=(parseInt(u)-1).toString(),p=r[u]||[],f=r[l]||[];p.forEach(m=>{const d=f.find(c=>c.tipo_activa===m.tipo_activa);d&&(m.anio_anterior=d.total)}),i.innerHTML=p.length==0?Y(f):R(p)}})}function I(e,a){const t=[];return Object.values(e).forEach(n=>{for(;n.data.length<a;)n.data.push(0);(n.concepto==="Distribuidor"||n.concepto==="Subs")&&t.push({name:n.concepto+" "+n.name,data:n.data})}),t}function _(e,a){let t=[],n=[],o=[];const r=document.querySelector("#slcActivacionesAnio").value.toString(),i=(parseInt(r)-1).toString();return e.forEach((u,l)=>{u.name.includes(i)?(n.push(3),o.push(6),u.name.includes("Distribuidor")?t.push("#78B8E3"):t.push("#C6DE91")):(n.push(4),o.push(0),u.name.includes("Distribuidor")?t.push("#2374AB"):t.push("#9BC53D"))}),{series:e,chart:{height:320,type:"line",zoom:{enabled:!1},animations:{enabled:!1},toolbar:{show:!1}},grid:{borderColor:"#f2f5f7"},stroke:{width:n,curve:"straight",dashArray:o},colors:t,labels:a,xaxis:{labels:{show:!0,style:{colors:"#8c9097",fontSize:"11px",fontWeight:600,cssClass:"apexcharts-xaxis-label"}}},yaxis:{labels:{show:!0,style:{colors:"#8c9097",fontSize:"11px",fontWeight:600,cssClass:"apexcharts-yaxis-label"}}},noData:{text:"No hay datos para mostrar"}}}function E(e,a,t){const n=document.querySelector(e);n&&n.chartInstance?n.chartInstance.updateOptions(t):n&&(n.chartInstance=new ApexCharts(document.querySelector(e),t),n.chartInstance.render())}function R(e){return e.map((t,n)=>{let o=t.total>t.anio_anterior?((t.total-t.anio_anterior)/t.anio_anterior*100).toFixed(2):((t.anio_anterior-t.total)/t.anio_anterior*100).toFixed(2);return o=isNaN(o)?0:o,`
        <div class="d-flex align-items-center me-5">
        <span class="fs-8 text-secondary">
            <i class="mdi mdi-circle"></i>
    
        </span>
        <div class="ms-2 align-content-top  text-center">
            <p class="mb-0 fs-15">${Intl.NumberFormat("es-MX",{maximumFractionDigits:0}).format(t.total)}</p>
            <p class="mb-0 me-2 fs-13 text-muted">${t.tipo_activa}</p>
                <span class="fs-12 text-${t.total>t.anio_anterior||o==0?"success":"danger"} d-inline-flex align-items-center"
                    title="Año anterior: ${t.anio_anterior??0}">
                    <i class="ti ti-trending-${t.total>t.anio_anterior||o==0?"up":"down"} me-1"></i>
                    ${o}%
                </span>
            </div>
        </div>           
        `}).join("")}function Y(e){return e.map((t,n)=>`
        <div class="d-flex align-items-center me-5">
        <div class="align-content-top  text-center">
            <p class="mb-0 fs-15">${Intl.NumberFormat("es-MX",{maximumFractionDigits:0}).format(t.total)}</p>
            <p class="mb-0 me-2 fs-13 text-muted">${t.tipo_activa}</p>
                <span class="fs-11 text-danger d-inline-flex align-items-center">
                    Año anterior
                </span>
            </div>
        </div>           
        `).join("")}function A(e,a,t){const n=document.querySelector("#slcActivacionesSucursal"),o=n?n.value:0,s=document.querySelector('meta[name="csrf-token"]').getAttribute("content");fetch("/telcel/activaciones/grafica",{method:"post",headers:{"Content-Type":"application/json","X-CSRF-TOKEN":s},body:JSON.stringify({anio:e??new Date().getFullYear(),tipofecha:t??"preactivacion",cadenas:!1,sucursal:o})}).then(r=>r.json()).then(r=>{const i=Object.values(r).map(l=>({name:l.concepto,data:l.data}));E("#grafica-activaciones-mensuales",i,T(i,["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"]))}),fetch("/telcel/activaciones/grafica",{method:"post",headers:{"Content-Type":"application/json","X-CSRF-TOKEN":s},body:JSON.stringify({anio:e??new Date().getFullYear(),tipofecha:t??"preactivacion",cadenas:!0,sucursal:o})}).then(r=>r.json()).then(r=>{const i=Object.values(r).map(l=>({name:l.concepto,data:l.data}));E("#grafica-activaciones-mensuales-cadenas",i,T(i,["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"]))}),fetch("/telcel/activaciones/compara",{method:"post",headers:{"Content-Type":"application/json","X-CSRF-TOKEN":s},body:JSON.stringify({anio:e??new Date().getFullYear(),tipofecha:t??"preactivacion",sucursal:o})}).then(r=>r.json()).then(r=>{const i=document.getElementById("compara-mensual-anual");if(i){i.innerHTML="";const u=e.toString(),l=(parseInt(u)-1).toString(),p=r[u]||[],f=r[l]||[];Object.values(p).forEach(g=>{const h=Object.values(f).find(b=>b.concepto===g.concepto);h&&(g.anio_anterior=h.total)}),i.innerHTML=z(p);let m=Math.max(...Object.keys(r)),d=[],c=[],x={"Chip Express":"Chips","Chip 0":"Chips","Amigo Chip":"Chips","Chip Cobro x Seg":"Chips","KIT Sin Limite":"KIT","TIP Kit":"KIT",KIT:"KIT","Chip Port IN":"Portas"};for(let g in r[m]){let h=r[m][g],b=x[h.concepto.trim()]||"Otros",S=d.indexOf(b);S!==-1?c[S]+=h.total:(d.push(b),c.push(h.total))}E("#grafica-activaciones-producto",c,K(c,d)),d.forEach((g,h)=>{let b=document.getElementById(`spmActiva${g}`);b&&(b.innerHTML=c[h])})}}),fetch("/telcel/activaciones/resumen",{method:"post",headers:{"Content-Type":"application/json","X-CSRF-TOKEN":s},body:JSON.stringify({anio:e??new Date().getFullYear(),mes:a??new Date().getMonth(),tipofecha:t??"preactivacion"})}).then(r=>r.json()).then(r=>{const i=document.getElementById("spnTotalActivas");if(i){const u=document.getElementById("liActivaSucursales");u.innerHTML="",i.innerHTML=r.totalActivaciones,r.results.forEach(l=>{const p=document.createElement("li");p.classList.add("mb-2");let f=`
                            <div class="d-flex align-items-center flex-wrap">
                    
                            <div class="flex-fill">
                                <span class="fs-14 d-block mb-1">   ${l.sucursal}</span>
                                <span class="text-muted fs-12"></span>
                            </div>
                            <div>
                                <span class="bg-success-transparent">   ${l.total}</span>
                            </div>
                        </div>
                    `;p.innerHTML=f,u.appendChild(p)})}})}function z(e){return Object.values(e).map((t,n)=>{let o=t.total>t.anio_anterior?((t.total-t.anio_anterior)/t.anio_anterior*100).toFixed(2):((t.anio_anterior-t.total)/t.anio_anterior*100).toFixed(2);return o=isNaN(o)?0:o,`
        <div class="d-flex align-items-center me-5">
        <span class="fs-8 text-secondary">
            <i class="mdi mdi-circle"></i>
    
        </span>
        <div class="ms-2 align-content-top  text-center">
            <p class="mb-0 fs-15">${Intl.NumberFormat("es-MX",{maximumFractionDigits:0}).format(t.total)}</p>
            <p class="mb-0 me-2 fs-13 text-muted">${t.concepto}</p>
                <span class="fs-12 text-${t.total>t.anio_anterior||o==0?"success":"danger"} d-inline-flex align-items-center"
                    title="Año anterior: ${t.anio_anterior??0}">
                    <i class="ti ti-trending-${t.total>t.anio_anterior||o==0?"up":"down"} me-1"></i>
                    ${o}%
                </span>
            </div>
        </div>           
        `}).join("")}function T(e,a){return{series:e,chart:{type:"bar",height:360,fontFamily:"Poppins, sans-serif",foreColor:"#8c9097",stacked:!0,toolbar:{show:!1},zoom:{enabled:!1}},grid:{borderColor:"#90A4AE",strokeDashArray:2},dataLabels:{enabled:!1},responsive:[{breakpoint:480,options:{legend:{position:"bottom",offsetX:-10,offsetY:0}}}],stroke:{show:!0,width:[5,5,5,5,5,5,5,5,5,5],curve:"smooth"},plotOptions:{bar:{columnWidth:"30%",horizontal:!1}},legend:{position:"right",offsetY:40},fill:{opacity:1},legend:{show:!0},tooltip:{enabled:!0,shared:!0,intersect:!1},colors:["#2374AB","#BFC0C0","#379634","#573D1C","#7D387D","#9ED8DB","#D58936","#FFB2E6","#A44200","#800080","#FF0000"],labels:a,noData:{text:"No hay datos para mostrar"}}}function K(e,a){return{series:e,chart:{width:220,height:220,type:"pie"},colors:["var(--primary08)","rgba(69, 214, 91, 0.8)","rgba(243, 156, 18, 0.8)","rgba(231, 76, 60, 0.8)"],labels:a,legend:{show:!1},stroke:{width:0},dataLabels:{enabled:!0,dropShadow:{enabled:!1}},noData:{text:"No hay datos para mostrar"}}}document.querySelectorAll("textarea.noenter").forEach(e=>{e.addEventListener("keydown",a=>{a.key==="Enter"&&a.preventDefault()})});document.querySelectorAll('[type="submit"].btn-submit').forEach(e=>{e.addEventListener("click",a=>{e.data={btnhtml:e.innerHTML},e.innerHTML='<span class="spinner-border spinner-border-sm ms-1" role="status" aria-hidden="true"></span> Guardando...',e.disabled=!0,e.closest("form").submit()}),console.log(e)});document.querySelectorAll("input.importe").forEach(e=>{e.addEventListener("input",a=>{const t=a.target.value;/^[0-9.]*$/.test(t)||(a.target.value=t.replace(/[^0-9.]/g,""))})});document.querySelectorAll("input.numeros").forEach(e=>{e.addEventListener("input",a=>{const t=a.target.value;/^[0-9]*$/.test(t)||(a.target.value=t.replace(/[^0-9]/g,""));const o=a.target.getAttribute("maxlength");o&&t.length>o&&(a.target.value=t.slice(0,o))})});document.querySelectorAll("input.upper").forEach(e=>{e.addEventListener("input",a=>{const t=a.target.value;a.target.value=t.toUpperCase()})});
