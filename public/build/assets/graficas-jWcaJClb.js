(function(){if(document.querySelector("#slcActivacionesAnio")){const o=document.querySelector("#slcActivacionesAnio"),n=document.querySelector("#slcActivacionesFecha");o.addEventListener("change",s=>{const e=document.querySelector("#slcActivacionesFecha");r(s.target.value,e.value)}),n.addEventListener("change",s=>{const e=document.querySelector("#slcActivacionesAnio");console.log("porfecha"),r(e.value,s.target.value)}),console.log(o.value,n.value),r(o.value,n.value)}})();function r(o,n){if(document.querySelector("#grafica-activaciones-mensuales")){const s=document.querySelector('meta[name="csrf-token"]').getAttribute("content");fetch("/telcel/activaciones/grafica",{method:"post",headers:{"Content-Type":"application/json","X-CSRF-TOKEN":s},body:JSON.stringify({anio:o??new Date().getFullYear(),tipofecha:n??"preactivacion"})}).then(e=>e.json()).then(e=>{const c=e.map(a=>({name:a.concepto,data:a.data}));var l={series:c,chart:{type:"bar",height:360,fontFamily:"Poppins, sans-serif",foreColor:"#8c9097",stacked:!0,toolbar:{show:!1},zoom:{enabled:!1}},grid:{borderColor:"#90A4AE",strokeDashArray:2},dataLabels:{enabled:!1},responsive:[{breakpoint:480,options:{legend:{position:"bottom",offsetX:-10,offsetY:0}}}],stroke:{show:!0,width:[5,5,5,5,5,5,5,5,5,5],curve:"smooth"},plotOptions:{bar:{columnWidth:"30%",horizontal:!1}},legend:{position:"right",offsetY:40},fill:{opacity:1},legend:{show:!0},tooltip:{enabled:!0,shared:!0,intersect:!1},colors:["var(--primary-color)","#FFA500","#00FFFF","#FFFF00","#0000FF","#00FF00","#FF00FF","#FF1493","#32CD32","#800080","#FF0000"],labels:["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"],noData:{text:"No hay datos para mostrar"}};const t=document.querySelector("#grafica-activaciones-mensuales");t.chartInstance?t.chartInstance.updateSeries(c):(t.chartInstance=new ApexCharts(document.querySelector("#grafica-activaciones-mensuales"),l),t.chartInstance.render())}),fetch("/telcel/activaciones/compara",{method:"post",headers:{"Content-Type":"application/json","X-CSRF-TOKEN":s},body:JSON.stringify({anio:o??new Date().getFullYear(),tipofecha:n??"preactivacion"})}).then(e=>e.json()).then(e=>{console.log(e);const c=document.getElementById("spnTotalActivas"),l=document.getElementById("liActivaSucursales");l.innerHTML="",c.innerHTML=e.totalActivaciones,e.results.forEach(t=>{const a=document.createElement("li");a.classList.add("mb-2");let i=`
                            <div class="d-flex align-items-center flex-wrap">
                    
                            <div class="flex-fill">
                                <span class="fs-14 d-block mb-1">   ${t.sucursal}</span>
                                <span class="text-muted fs-12"></span>
                            </div>
                            <div>
                                <span class="bg-success-transparent">   ${t.total}</span>
                            </div>
                        </div>
                    `;a.innerHTML=i,console.log(a),l.appendChild(a)})})}}
