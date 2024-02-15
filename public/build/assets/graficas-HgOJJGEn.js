(function(){const t=document.querySelector("#slcActivacionesAnio"),s=document.querySelector("#slcActivacionesMes"),e=document.querySelector("#slcActivacionesFecha");t&&(t.selectedIndex=0,s.selectedIndex=new Date().getMonth(),e.selectedIndex=0),t&&e&&(t.addEventListener("change",a=>{A(a.target.value,s.value,e.value),b(a.target.value,s.value,e.value),x(t.value,s.value,e.value)}),e.addEventListener("change",a=>{A(t.value,s.value,a.target.value),b(t.value,s.value,a.target.value),x(t.value,s.value,e.value)}),A(t.value,e.value)),s&&(s.addEventListener("change",a=>{x(t.value,s.value,e.value),b(t.value,a.target.value,e.value)}),x(t.value,s.value,e.value),b(t.value,s.value,e.value))})();function b(t,s,e){const a=document.querySelector('meta[name="csrf-token"]').getAttribute("content"),i=document.querySelector("#slcActivacionesSucursal"),u=i?i.value:0;fetch("/telcel/activaciones/grafica/diario",{method:"post",headers:{"Content-Type":"application/json","X-CSRF-TOKEN":a},body:JSON.stringify({anio:t??new Date().getFullYear(),mes:s??new Date().getMonth(),tipofecha:e??"preactivacion",sucursal:u})}).then(n=>n.json()).then(n=>{const o=Math.max(...Object.values(n).map(d=>d.data.length)),c=Array.from({length:o},(d,h)=>h+1),r=F(n,o);var l=O(r,c);y("#grafica-activaciones-diario",r,l)})}function x(t,s,e){const a=document.querySelector('meta[name="csrf-token"]').getAttribute("content"),i=document.querySelector("#slcActivacionesSucursal"),u=i?i.value:0;fetch("/telcel/activaciones/comparadiario",{method:"post",headers:{"Content-Type":"application/json","X-CSRF-TOKEN":a},body:JSON.stringify({anio:t??new Date().getFullYear(),mes:s??new Date().getMonth(),tipofecha:e??"preactivacion",sucursal:u})}).then(n=>n.json()).then(n=>{const o=document.getElementById("compara-mensual-diario");if(o){o.innerHTML="";const c=t.toString(),r=(parseInt(c)-1).toString(),l=n[c]||[],d=n[r]||[];l.forEach(h=>{const p=d.find(m=>m.tipo_activa===h.tipo_activa);p&&(h.anio_anterior=p.total)}),o.innerHTML=l.length==0?E(d):T(l)}})}function F(t,s){const e=[];return Object.values(t).forEach(a=>{for(;a.data.length<s;)a.data.push(0);(a.concepto==="Distribuidor"||a.concepto==="Subs")&&e.push({name:a.concepto+" "+a.name,data:a.data})}),e}function O(t,s){let e=[],a=[],i=[];const n=document.querySelector("#slcActivacionesAnio").value.toString(),o=(parseInt(n)-1).toString();return t.forEach((c,r)=>{c.name.includes(o)?(a.push(3),i.push(6),c.name.includes("Distribuidor")?e.push("#78B8E3"):e.push("#C6DE91")):(a.push(4),i.push(0),c.name.includes("Distribuidor")?e.push("#2374AB"):e.push("#9BC53D"))}),{series:t,chart:{height:320,type:"line",zoom:{enabled:!1},animations:{enabled:!1},toolbar:{show:!1}},grid:{borderColor:"#f2f5f7"},stroke:{width:a,curve:"straight",dashArray:i},colors:e,labels:s,xaxis:{labels:{show:!0,style:{colors:"#8c9097",fontSize:"11px",fontWeight:600,cssClass:"apexcharts-xaxis-label"}}},yaxis:{labels:{show:!0,style:{colors:"#8c9097",fontSize:"11px",fontWeight:600,cssClass:"apexcharts-yaxis-label"}}},noData:{text:"No hay datos para mostrar"}}}function y(t,s,e){const a=document.querySelector(t);a&&a.chartInstance?a.chartInstance.updateOptions(e):a&&(a.chartInstance=new ApexCharts(document.querySelector(t),e),a.chartInstance.render())}function T(t){return t.map((e,a)=>{let i=e.total>e.anio_anterior?((e.total-e.anio_anterior)/e.anio_anterior*100).toFixed(2):((e.anio_anterior-e.total)/e.anio_anterior*100).toFixed(2);return i=isNaN(i)?0:i,`
        <div class="d-flex align-items-center me-5">
        <span class="fs-8 text-secondary">
            <i class="mdi mdi-circle"></i>
    
        </span>
        <div class="ms-2 align-content-top  text-center">
            <p class="mb-0 fs-15">${Intl.NumberFormat("es-MX",{maximumFractionDigits:0}).format(e.total)}</p>
            <p class="mb-0 me-2 fs-13 text-muted">${e.tipo_activa}</p>
                <span class="fs-12 text-${e.total>e.anio_anterior||i==0?"success":"danger"} d-inline-flex align-items-center"
                    title="Año anterior: ${e.anio_anterior??0}">
                    <i class="ti ti-trending-${e.total>e.anio_anterior||i==0?"up":"down"} me-1"></i>
                    ${i}%
                </span>
            </div>
        </div>           
        `}).join("")}function E(t){return t.map((e,a)=>`
        <div class="d-flex align-items-center me-5">
        <div class="align-content-top  text-center">
            <p class="mb-0 fs-15">${Intl.NumberFormat("es-MX",{maximumFractionDigits:0}).format(e.total)}</p>
            <p class="mb-0 me-2 fs-13 text-muted">${e.tipo_activa}</p>
                <span class="fs-11 text-danger d-inline-flex align-items-center">
                    Año anterior
                </span>
            </div>
        </div>           
        `).join("")}function A(t,s,e){const a=document.querySelector("#slcActivacionesSucursal"),i=a?a.value:null,u=document.querySelector('meta[name="csrf-token"]').getAttribute("content");fetch("/telcel/activaciones/grafica",{method:"post",headers:{"Content-Type":"application/json","X-CSRF-TOKEN":u},body:JSON.stringify({anio:t??new Date().getFullYear(),tipofecha:e??"preactivacion",cadenas:!1,sucursal:i})}).then(n=>n.json()).then(n=>{const o=Object.values(n).map(r=>({name:r.concepto,data:r.data}));y("#grafica-activaciones-mensuales",o,S(o,["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"]))}),fetch("/telcel/activaciones/grafica",{method:"post",headers:{"Content-Type":"application/json","X-CSRF-TOKEN":u},body:JSON.stringify({anio:t??new Date().getFullYear(),tipofecha:e??"preactivacion",cadenas:!0,sucursal:i})}).then(n=>n.json()).then(n=>{const o=Object.values(n).map(r=>({name:r.concepto,data:r.data}));y("#grafica-activaciones-mensuales-cadenas",o,S(o,["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"]))}),fetch("/telcel/activaciones/compara",{method:"post",headers:{"Content-Type":"application/json","X-CSRF-TOKEN":u},body:JSON.stringify({anio:t??new Date().getFullYear(),tipofecha:e??"preactivacion",sucursal:i})}).then(n=>n.json()).then(n=>{const o=document.getElementById("compara-mensual-anual");if(o){o.innerHTML="";const c=t.toString(),r=(parseInt(c)-1).toString(),l=n[c]||[],d=n[r]||[];Object.values(l).forEach(g=>{const f=Object.values(d).find(v=>v.concepto===g.concepto);f&&(g.anio_anterior=f.total)}),o.innerHTML=I(l);let h=Math.max(...Object.keys(n)),p=[],m=[],C={"Chip Express":"Chips","Chip 0":"Chips","Amigo Chip":"Chips","Chip Cobro x Seg":"Chips","KIT Sin Limite":"KIT","TIP Kit":"KIT",KIT:"KIT","Chip Port IN":"Portas"};for(let g in n[h]){let f=n[h][g],v=C[f.concepto.trim()]||"Otros",D=p.indexOf(v);D!==-1?m[D]+=f.total:(p.push(v),m.push(f.total))}console.log(p,m),y("#grafica-activaciones-producto",m,_(m,p)),p.forEach((g,f)=>{let v=document.getElementById(`spmActiva${g}`);v&&(v.innerHTML=m[f])})}}),fetch("/telcel/activaciones/resumen",{method:"post",headers:{"Content-Type":"application/json","X-CSRF-TOKEN":u},body:JSON.stringify({anio:t??new Date().getFullYear(),mes:s??new Date().getMonth(),tipofecha:e??"preactivacion"})}).then(n=>n.json()).then(n=>{const o=document.getElementById("spnTotalActivas");if(o){const c=document.getElementById("liActivaSucursales");c.innerHTML="",o.innerHTML=n.totalActivaciones,n.results.forEach(r=>{const l=document.createElement("li");l.classList.add("mb-2");let d=`
                            <div class="d-flex align-items-center flex-wrap">
                    
                            <div class="flex-fill">
                                <span class="fs-14 d-block mb-1">   ${r.sucursal}</span>
                                <span class="text-muted fs-12"></span>
                            </div>
                            <div>
                                <span class="bg-success-transparent">   ${r.total}</span>
                            </div>
                        </div>
                    `;l.innerHTML=d,c.appendChild(l)})}})}function I(t){return Object.values(t).map((e,a)=>{let i=e.total>e.anio_anterior?((e.total-e.anio_anterior)/e.anio_anterior*100).toFixed(2):((e.anio_anterior-e.total)/e.anio_anterior*100).toFixed(2);return i=isNaN(i)?0:i,`
        <div class="d-flex align-items-center me-5">
        <span class="fs-8 text-secondary">
            <i class="mdi mdi-circle"></i>
    
        </span>
        <div class="ms-2 align-content-top  text-center">
            <p class="mb-0 fs-15">${Intl.NumberFormat("es-MX",{maximumFractionDigits:0}).format(e.total)}</p>
            <p class="mb-0 me-2 fs-13 text-muted">${e.concepto}</p>
                <span class="fs-12 text-${e.total>e.anio_anterior||i==0?"success":"danger"} d-inline-flex align-items-center"
                    title="Año anterior: ${e.anio_anterior??0}">
                    <i class="ti ti-trending-${e.total>e.anio_anterior||i==0?"up":"down"} me-1"></i>
                    ${i}%
                </span>
            </div>
        </div>           
        `}).join("")}function S(t,s){return{series:t,chart:{type:"bar",height:360,fontFamily:"Poppins, sans-serif",foreColor:"#8c9097",stacked:!0,toolbar:{show:!1},zoom:{enabled:!1}},grid:{borderColor:"#90A4AE",strokeDashArray:2},dataLabels:{enabled:!1},responsive:[{breakpoint:480,options:{legend:{position:"bottom",offsetX:-10,offsetY:0}}}],stroke:{show:!0,width:[5,5,5,5,5,5,5,5,5,5],curve:"smooth"},plotOptions:{bar:{columnWidth:"30%",horizontal:!1}},legend:{position:"right",offsetY:40},fill:{opacity:1},legend:{show:!0},tooltip:{enabled:!0,shared:!0,intersect:!1},colors:["#2374AB","#BFC0C0","#379634","#573D1C","#7D387D","#9ED8DB","#D58936","#FFB2E6","#A44200","#800080","#FF0000"],labels:s,noData:{text:"No hay datos para mostrar"}}}function _(t,s){return{series:t,chart:{width:220,height:220,type:"pie"},colors:["rgba(69, 214, 91, 0.8)","var(--primary08)","rgba(243, 156, 18, 0.8)","rgba(231, 76, 60, 0.8)"],labels:s,legend:{show:!1},stroke:{width:0},dataLabels:{enabled:!0,dropShadow:{enabled:!1}},noData:{text:"No hay datos para mostrar"}}}
