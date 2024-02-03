if(document.querySelector("#grafica-activaciones-mensuales")){const o=document.querySelector('meta[name="csrf-token"]').getAttribute("content");fetch("/telcel/activaciones/grafica",{method:"post",headers:{"Content-Type":"application/json","X-CSRF-TOKEN":o},body:JSON.stringify({concepto:"canales",descripcion:"desciprciones"})}).then(e=>e.json()).then(e=>{var t={series:e.map(s=>({name:s.concepto,data:s.data})),chart:{type:"bar",height:360,fontFamily:"Poppins, sans-serif",foreColor:"#8c9097",stacked:!0,toolbar:{show:!1},zoom:{enabled:!0}},grid:{borderColor:"#90A4AE",strokeDashArray:2},dataLabels:{enabled:!1},responsive:[{breakpoint:480,options:{legend:{position:"bottom",offsetX:-10,offsetY:0}}}],stroke:{show:!0,width:[5,5,5,5],curve:"smooth"},plotOptions:{bar:{columnWidth:"10%",horizontal:!1}},legend:{position:"right",offsetY:40},fill:{opacity:1},legend:{show:!1},tooltip:{enabled:!0,shared:!0,intersect:!1},labels:["Ene","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"]},i=new ApexCharts(document.querySelector("#grafica-activaciones-mensuales"),t);i.render()}),fetch("/telcel/activaciones/compara",{method:"post",headers:{"Content-Type":"application/json","X-CSRF-TOKEN":o},body:JSON.stringify({concepto:"canales",descripcion:"desciprciones"})}).then(e=>e.json()).then(e=>{console.log(e.current);const c=e.current.map((t,i)=>{const s=e.last.find(n=>n.concepto===t.concepto);return s&&`${s.data.reduce((n,a)=>n+a,0)}`,console.log(t,s),`
            <div class="d-flex align-items-center me-5">
                <span class="fs-8 text-primary">
                    <i class="mdi mdi-circle"></i>
                </span>
                <div class="ms-2">
                    <p class="mb-0 fs-15    ">${t.data.reduce((n,a)=>n+a,0)}</p>
                    <div class="d-flex align-items-center">
                        <p class="mb-0 me-2 fs-13 text-muted">${t.concepto}</p>
                        ${lastTotalSpan??""} 
                    </div>
                </div>
            </div>
            `});document.getElementById("comparaMensual").innerHTML=c.join("")})}
