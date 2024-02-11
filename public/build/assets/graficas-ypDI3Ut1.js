(function(){const a=document.querySelector("#slcActivacionesAnio"),s=document.querySelector("#slcActivacionesMes"),e=document.querySelector("#slcActivacionesFecha");a.selectedIndex=0,s.selectedIndex=new Date().getMonth(),e.selectedIndex=0,a&&e&&(a.addEventListener("change",n=>{f(n.target.value,s.value,e.value),p(n.target.value,s.value,e.value)}),e.addEventListener("change",n=>{f(a.value,s.value,n.target.value),p(a.value,n.target.value,e.value)}),f(a.value,e.value)),s&&(s.addEventListener("change",n=>{p(a.value,n.target.value,e.value)}),p(a.value,s.value,e.value))})();function p(a,s,e){const n=document.querySelector('meta[name="csrf-token"]').getAttribute("content");fetch("/telcel/activaciones/grafica/diario",{method:"post",headers:{"Content-Type":"application/json","X-CSRF-TOKEN":n},body:JSON.stringify({anio:a??new Date().getFullYear(),mes:s??new Date().getMonth(),tipofecha:e??"preactivacion"})}).then(t=>t.json()).then(t=>{const o=Math.max(...Object.values(t).map(l=>l.data.length)),r=Array.from({length:o},(l,u)=>u+1),i=v(t,o);var c=b(i,r);h("#grafica-activaciones-diario",i,c)}),fetch("/telcel/activaciones/comparadiario",{method:"post",headers:{"Content-Type":"application/json","X-CSRF-TOKEN":n},body:JSON.stringify({anio:a??new Date().getFullYear(),mes:s??new Date().getMonth(),tipofecha:e??"preactivacion"})}).then(t=>t.json()).then(t=>{const o=document.getElementById("compara-mensual-diario");o.innerHTML="";const r=a.toString(),i=(parseInt(r)-1).toString(),c=t[r]||[],l=t[i]||[];c.forEach(u=>{const d=l.find(m=>m.tipo_activa===u.tipo_activa);d&&(u.anio_anterior=d.total)}),o.innerHTML=c.length==0?y(l):x(c)})}function v(a,s){const e=[];return Object.values(a).forEach(n=>{for(;n.data.length<s;)n.data.push(0);(n.concepto==="Distribuidor"||n.concepto==="Subs")&&e.push({name:n.concepto+" "+n.name,data:n.data})}),e}function b(a,s){let e=[],n=[],t=[];const o=new Date().getFullYear().toString(),r=(parseInt(o)-1).toString();return a.forEach((i,c)=>{i.name.includes(r)?(n.push(3),t.push(6),i.name.includes("Distribuidor")?e.push("#78B8E3"):e.push("#C6DE91")):(n.push(4),t.push(0),i.name.includes("Distribuidor")?e.push("#2374AB"):e.push("#9BC53D"))}),{series:a,chart:{height:320,type:"line",zoom:{enabled:!1},animations:{enabled:!1},toolbar:{show:!1}},grid:{borderColor:"#f2f5f7"},stroke:{width:n,curve:"straight",dashArray:t},colors:e,labels:s,xaxis:{labels:{show:!0,style:{colors:"#8c9097",fontSize:"11px",fontWeight:600,cssClass:"apexcharts-xaxis-label"}}},yaxis:{labels:{show:!0,style:{colors:"#8c9097",fontSize:"11px",fontWeight:600,cssClass:"apexcharts-yaxis-label"}}},noData:{text:"No hay datos para mostrar"}}}function h(a,s,e){const n=document.querySelector(a);n.chartInstance?n.chartInstance.updateOptions(e):(n.chartInstance=new ApexCharts(document.querySelector(a),e),n.chartInstance.render())}function x(a){return a.map((e,n)=>{let t=e.total>e.anio_anterior?((e.total-e.anio_anterior)/e.anio_anterior*100).toFixed(2):((e.anio_anterior-e.total)/e.anio_anterior*100).toFixed(2);return t=isNaN(t)?0:t,e.total=Intl.NumberFormat("es-MX",{maximumFractionDigits:0}).format(e.total),`
        <div class="d-flex align-items-center me-5">
        <span class="fs-8 text-secondary">
            <i class="mdi mdi-circle"></i>
    
        </span>
        <div class="ms-2 align-content-top  text-center">
            <p class="mb-0 fs-15">${e.total}</p>
            <p class="mb-0 me-2 fs-13 text-muted">${e.tipo_activa}</p>
                <span class="fs-12 text-${e.total>e.anio_anterior||t==0?"success":"danger"} d-inline-flex align-items-center"
                    title="Año anterior: ${e.anio_anterior??0}">
                    <i class="ti ti-trending-${e.total>e.anio_anterior||t==0?"up":"down"} me-1"></i>
                    ${t}%
                </span>
            </div>
        </div>           
        `}).join("")}function y(a){return a.map((e,n)=>(e.total=Intl.NumberFormat("es-MX",{maximumFractionDigits:0}).format(e.total),`
        <div class="d-flex align-items-center me-5">
        <div class="align-content-top  text-center">
            <p class="mb-0 fs-15">${e.total}</p>
            <p class="mb-0 me-2 fs-13 text-muted">${e.tipo_activa}</p>
                <span class="fs-11 text-danger d-inline-flex align-items-center">
                    Año anterior
                    
                </span>
            </div>
        </div>           
        `)).join("")}function f(a,s,e){document.querySelector("#grafica-activaciones-mensuales");const n=document.querySelector('meta[name="csrf-token"]').getAttribute("content");fetch("/telcel/activaciones/grafica",{method:"post",headers:{"Content-Type":"application/json","X-CSRF-TOKEN":n},body:JSON.stringify({anio:a??new Date().getFullYear(),tipofecha:e??"preactivacion",cadenas:!1})}).then(t=>t.json()).then(t=>{const o=t.map(i=>({name:i.concepto,data:i.data}));h("#grafica-activaciones-mensuales",o,g(o,["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"]))}),fetch("/telcel/activaciones/grafica",{method:"post",headers:{"Content-Type":"application/json","X-CSRF-TOKEN":n},body:JSON.stringify({anio:a??new Date().getFullYear(),tipofecha:e??"preactivacion",cadenas:!0})}).then(t=>t.json()).then(t=>{const o=t.map(i=>({name:i.concepto,data:i.data}));h("#grafica-activaciones-mensuales-cadenas",o,g(o,["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"]))}),fetch("/telcel/activaciones/compara",{method:"post",headers:{"Content-Type":"application/json","X-CSRF-TOKEN":n},body:JSON.stringify({anio:a??new Date().getFullYear(),tipofecha:e??"preactivacion"})}).then(t=>t.json()).then(t=>{console.log("compara:",t);const o=document.getElementById("compara-mensual-anual");o.innerHTML="";const r=a.toString(),i=(parseInt(r)-1).toString(),c=t[r]||[],l=t[i]||[];console.log("data currrent:",c),console.log(typeof c),Object.values(c).forEach(u=>{const d=Object.values(l).find(m=>m.concepto===u.concepto);d&&(u.anio_anterior=d.total)}),console.log(c),o.innerHTML=D(c)}),fetch("/telcel/activaciones/resumen",{method:"post",headers:{"Content-Type":"application/json","X-CSRF-TOKEN":n},body:JSON.stringify({anio:a??new Date().getFullYear(),mes:s??new Date().getMonth(),tipofecha:e??"preactivacion"})}).then(t=>t.json()).then(t=>{console.log("resumen",t);const o=document.getElementById("spnTotalActivas"),r=document.getElementById("liActivaSucursales");r.innerHTML="",o.innerHTML=t.totalActivaciones,t.results.forEach(i=>{const c=document.createElement("li");c.classList.add("mb-2");let l=`
                            <div class="d-flex align-items-center flex-wrap">
                    
                            <div class="flex-fill">
                                <span class="fs-14 d-block mb-1">   ${i.sucursal}</span>
                                <span class="text-muted fs-12"></span>
                            </div>
                            <div>
                                <span class="bg-success-transparent">   ${i.total}</span>
                            </div>
                        </div>
                    `;c.innerHTML=l,r.appendChild(c)})})}function D(a){return console.log("analisis",a),Object.values(a).map((e,n)=>{let t=e.total>e.anio_anterior?((e.total-e.anio_anterior)/e.anio_anterior*100).toFixed(2):((e.anio_anterior-e.total)/e.anio_anterior*100).toFixed(2);return t=isNaN(t)?0:t,`
        <div class="d-flex align-items-center me-5">
        <span class="fs-8 text-secondary">
            <i class="mdi mdi-circle"></i>
    
        </span>
        <div class="ms-2 align-content-top  text-center">
            <p class="mb-0 fs-15">${Intl.NumberFormat("es-MX",{maximumFractionDigits:0}).format(e.total)}</p>
            <p class="mb-0 me-2 fs-13 text-muted">${e.concepto}</p>
                <span class="fs-12 text-${e.total>e.anio_anterior||t==0?"success":"danger"} d-inline-flex align-items-center"
                    title="Año anterior: ${e.anio_anterior??0}">
                    <i class="ti ti-trending-${e.total>e.anio_anterior||t==0?"up":"down"} me-1"></i>
                    ${t}%
                </span>
            </div>
        </div>           
        `}).join("")}function g(a,s){return{series:a,chart:{type:"bar",height:360,fontFamily:"Poppins, sans-serif",foreColor:"#8c9097",stacked:!0,toolbar:{show:!1},zoom:{enabled:!1}},grid:{borderColor:"#90A4AE",strokeDashArray:2},dataLabels:{enabled:!1},responsive:[{breakpoint:480,options:{legend:{position:"bottom",offsetX:-10,offsetY:0}}}],stroke:{show:!0,width:[5,5,5,5,5,5,5,5,5,5],curve:"smooth"},plotOptions:{bar:{columnWidth:"30%",horizontal:!1}},legend:{position:"right",offsetY:40},fill:{opacity:1},legend:{show:!0},tooltip:{enabled:!0,shared:!0,intersect:!1},colors:["#2374AB","#BFC0C0","#379634","#573D1C","#7D387D","#9ED8DB","#D58936","#FFB2E6","#A44200","#800080","#FF0000"],labels:s,noData:{text:"No hay datos para mostrar"}}}
