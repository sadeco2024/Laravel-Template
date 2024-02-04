(function () {
    "use strict";
    if (document.querySelector("#slcActivacionesAnio")) {
        const slcAnio = document.querySelector("#slcActivacionesAnio");
        const slcFecha = document.querySelector("#slcActivacionesFecha");

        
        slcAnio.addEventListener("change", (e) => {
            const slcFecha = document.querySelector("#slcActivacionesFecha");
            
            getGraficaMensual(e.target.value, slcFecha.value);
        });
        slcFecha.addEventListener("change", (e) => {
            const slcAnio = document.querySelector("#slcActivacionesAnio");
            console.log('porfecha')
            getGraficaMensual(slcAnio.value,e.target.value);
        });
        console.log(slcAnio.value, slcFecha.value)
        getGraficaMensual(slcAnio.value, slcFecha.value);
    }
})();

function getGraficaMensual(anio,fecha) {
    if (document.querySelector("#grafica-activaciones-mensuales")) {
        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");
        fetch("/telcel/activaciones/grafica", {
            method: "post",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
            },
            body: JSON.stringify({
                anio: anio ?? new Date().getFullYear(),
                tipofecha: fecha ?? 'preactivacion',
            }),
        })
            .then((response) => response.json())
            .then((data) => {
                // Se mapea para obtener las series de la gráfica.
                const transformedData = data.map((row) => {
                    return {
                        name: row.concepto,
                        data: row.data,
                    };
                });

                var options = {
                    series: transformedData, //series obtenidas
                    chart: {
                        type: "bar",
                        height: 360,
                        fontFamily: "Poppins, sans-serif",
                        foreColor: "#8c9097",
                        stacked: true,
                        toolbar: {
                            show: false,
                        },
                        zoom: {
                            enabled: false,
                        },
                    },
                    grid: {
                        borderColor: "#90A4AE",
                        strokeDashArray: 2,
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    responsive: [
                        {
                            breakpoint: 480,
                            options: {
                                legend: {
                                    position: "bottom",
                                    offsetX: -10,
                                    offsetY: 0,
                                },
                            },
                        },
                    ],
                    stroke: {
                        show: true,
                        width: [5, 5, 5, 5,5,5,5,5,5,5],
                        curve: "smooth",
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: "30%",
                            horizontal: false,
                        },
                    },
                    legend: {
                        position: "right",
                        offsetY: 40,
                    },
                    fill: {
                        opacity: 1,
                    },
                    legend: {
                        show: true,
                    },
                    tooltip: {
                        enabled: true,
                        shared: true,
                        intersect: false,
                    },
                    colors: ["var(--primary-color)", "#FFA500", "#00FFFF", "#FFFF00", "#0000FF", "#00FF00", "#FF00FF", "#FF1493", "#32CD32", "#800080", "#FF0000"],
                    labels: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
                    noData: {  text: "No hay datos para mostrar" },
                };
                const elemento = document.querySelector(
                    "#grafica-activaciones-mensuales"
                );
                
                // Se valida si existe el gráfico. Para eso se instancia en el elemento.
                if (elemento.chartInstance) {
                    elemento.chartInstance.updateSeries(transformedData);
                } else {
                    elemento.chartInstance = new ApexCharts(
                        document.querySelector(
                            "#grafica-activaciones-mensuales"
                        ),
                        options
                    );
                    elemento.chartInstance.render();
                }
            });

        fetch("/telcel/activaciones/compara", {
            method: "post",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
            },
            body: JSON.stringify({
                anio: anio ?? new Date().getFullYear(),
                tipofecha: fecha ?? 'preactivacion',
            }),
        })
            .then((response) => response.json())
            .then((data) => {
                console.log(data)
                const spTotal = document.getElementById('spnTotalActivas');
                const ul = document.getElementById('liActivaSucursales');
                ul.innerHTML = ''; // Limpiar el contenido existente
                spTotal.innerHTML = data.totalActivaciones;
                data.results.forEach(item => {
                    const li = document.createElement('li');
                    li.classList.add('mb-2');
                    let textHtml = `
                            <div class="d-flex align-items-center flex-wrap">
                    
                            <div class="flex-fill">
                                <span class="fs-14 d-block mb-1">   ${item.sucursal}</span>
                                <span class="text-muted fs-12"></span>
                            </div>
                            <div>
                                <span class="bg-success-transparent">   ${item.total}</span>
                            </div>
                        </div>
                    `;
                    
                    li.innerHTML = textHtml;
                    console.log(li)
                    // const spanSucursal = document.createElement('span');
                    // const spanTotal = document.createElement('span');
            
                    // spanSucursal.textContent = item.sucursal;
                    // spanTotal.textContent = item.total;
            
                    // li.appendChild(spanSucursal);
                    // li.appendChild(spanTotal);
            
                    ul.appendChild(li);
                });                

            });     

        // fetch("/telcel/activaciones/compara", {
        //     method: "post",
        //     headers: {
        //         "Content-Type": "application/json",
        //         "X-CSRF-TOKEN": csrfToken,
        //     },
        //     body: JSON.stringify({
        //         concepto: "canales",
        //         descripcion: "desciprciones",
        //     }),
        // })
        //     .then((response) => response.json())
        //     .then((data) => {
            //     const currentData = data.current.map((row, index) => {
            //         const lastRow = data.last.find(
            //             (item) => item.concepto === row.concepto
            //         );
            //         if (lastRow) {
            //             const lastTotalSpan = `             
            //         <span class="fs-12 text-success d-inline-flex align-items-center">
            //             <i  class="ti ti-trending-up me-1"></i>
            //             ${lastRow.data.reduce((a, b) => a + b, 0)}
            //         </span>`;
            //         }
            //         console.log(row, lastRow);
            //         return `
            //     <div class="d-flex align-items-center me-5">
            //         <span class="fs-8 text-primary">
            //             <i class="mdi mdi-circle"></i>
            //         </span>
            //         <div class="ms-2">
            //             <p class="mb-0 fs-15    ">${row.data.reduce(
            //                 (a, b) => a + b,
            //                 0
            //             )}</p>
            //             <div class="d-flex align-items-center">
            //                 <p class="mb-0 me-2 fs-13 text-muted">${
            //                     row.concepto
            //                 }</p>
            //                 ${lastTotalSpan ?? ""} 
            //             </div>
            //         </div>
            //     </div>
            //     `;
            //     });

            //     document.getElementById("comparaMensual").innerHTML =
            //         currentData.join("");
            // });
    }
}
