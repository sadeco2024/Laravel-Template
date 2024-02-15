(function () {
    "use strict";
    const slcActivacionesAnio = document.querySelector("#slcActivacionesAnio");
    const slcActivacionesMes = document.querySelector("#slcActivacionesMes");
    const slcActivacionesFecha = document.querySelector(
        "#slcActivacionesFecha"
    );

    if (slcActivacionesAnio) {
        slcActivacionesAnio.selectedIndex = 0;
        slcActivacionesMes.selectedIndex = new Date().getMonth();
        slcActivacionesFecha.selectedIndex = 0;
    }

    if (slcActivacionesAnio && slcActivacionesFecha) {
        slcActivacionesAnio.addEventListener("change", (e) => {
            graficaAnual(
                e.target.value,
                slcActivacionesMes.value,
                slcActivacionesFecha.value
            );
            graficaMensual(
                e.target.value,
                slcActivacionesMes.value,
                slcActivacionesFecha.value
            );
            comparativoDiario(
                slcActivacionesAnio.value,
                slcActivacionesMes.value,
                slcActivacionesFecha.value
            );
        });
        slcActivacionesFecha.addEventListener("change", (e) => {
            graficaAnual(
                slcActivacionesAnio.value,
                slcActivacionesMes.value,
                e.target.value
            );
            graficaMensual(
                slcActivacionesAnio.value,
                slcActivacionesMes.value,
                e.target.value
            );
            comparativoDiario(
                slcActivacionesAnio.value,
                slcActivacionesMes.value,
                slcActivacionesFecha.value
            );
        });
        graficaAnual(slcActivacionesAnio.value, slcActivacionesFecha.value);
    }

    if (slcActivacionesMes) {
        slcActivacionesMes.addEventListener("change", (e) => {
            comparativoDiario(
                slcActivacionesAnio.value,
                slcActivacionesMes.value,
                slcActivacionesFecha.value
            );

            graficaMensual(
                slcActivacionesAnio.value,
                e.target.value,
                slcActivacionesFecha.value
            );
        });
        comparativoDiario(
            slcActivacionesAnio.value,
            slcActivacionesMes.value,
            slcActivacionesFecha.value
        );
        graficaMensual(
            slcActivacionesAnio.value,
            slcActivacionesMes.value,
            slcActivacionesFecha.value
        );
    }
})();

//** GRAFICA MENSUAL (DISTS Y SUBS) */
function graficaMensual(anio, mes, fecha) {
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
    const slcActivacionesSucursal = document.querySelector(
        "#slcActivacionesSucursal"
    );
    const sucursal_id = slcActivacionesSucursal
        ? slcActivacionesSucursal.value
        : 0;
    //** Gráfica de activaciones diarias */
    fetch("/telcel/activaciones/grafica/diario", {
        method: "post",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken,
        },
        body: JSON.stringify({
            anio: anio ?? new Date().getFullYear(),
            mes: mes ?? new Date().getMonth(),
            tipofecha: fecha ?? "preactivacion",
            sucursal: sucursal_id,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            const maxLength = Math.max(
                ...Object.values(data).map((element) => element.data.length)
            );
            const dias = Array.from(
                { length: maxLength },
                (_, index) => index + 1
            );
            const transformedData = transformData(data, maxLength);
            var options = createChartOptions(transformedData, dias);
            renderGrafica(
                "#grafica-activaciones-diario",
                transformedData,
                options
            );
        });
}

//? Funcion para el comparativo de las activaciones diarias
function comparativoDiario(anio, mes, fecha) {
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");
    const slcActivacionesSucursal = document.querySelector(
        "#slcActivacionesSucursal"
    );
    const sucursal_id = slcActivacionesSucursal
        ? slcActivacionesSucursal.value
        : 0;
    //** Datos de comparativa diaria */
    fetch("/telcel/activaciones/comparadiario", {
        method: "post",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken,
        },
        body: JSON.stringify({
            anio: anio ?? new Date().getFullYear(),
            mes: mes ?? new Date().getMonth(),
            tipofecha: fecha ?? "preactivacion",
            sucursal: sucursal_id,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            const element = document.getElementById("compara-mensual-diario");
            if (element) {
                element.innerHTML = "";

                // Obtener el año actual y el año anterior
                const currentYear = anio.toString();
                const previousYear = (parseInt(currentYear) - 1).toString();

                // Obtener los arrays correspondientes al año actual y al año anterior
                const currentYearData = data[currentYear] || [];
                const previousYearData = data[previousYear] || [];

                currentYearData.forEach((obj) => {
                    const matchingObj = previousYearData.find(
                        (prevObj) => prevObj.tipo_activa === obj.tipo_activa
                    );
                    if (matchingObj) {
                        obj.anio_anterior = matchingObj.total;
                    }
                });
                element.innerHTML =
                    currentYearData.length == 0
                        ? drawAnalisisAnterior(previousYearData)
                        : drawAnalisis(currentYearData);
            }
        });
}

//? Funcion para transformar los datos de la gráfica diaria
function transformData(data, maxLength) {
    const transformedData = [];
    Object.values(data).forEach((row) => {
        while (row.data.length < maxLength) {
            row.data.push(0);
        }
        if (row.concepto === "Distribuidor" || row.concepto === "Subs")
            transformedData.push({
                name: row.concepto + " " + row.name,
                data: row.data,
            });
    });
    return transformedData;
}

//? Función para dibujar la gráfica de activaciones diarias
function createChartOptions(series, dias) {
    let colors = [];
    let optWith = [];
    let optDash = [];
    const slcActivacionesAnio = document.querySelector("#slcActivacionesAnio");

    const currentYear = slcActivacionesAnio.value.toString();
    const previousYear = (parseInt(currentYear) - 1).toString();
    series.forEach((item, index) => {
        if (item.name.includes(previousYear)) {
            optWith.push(3);
            optDash.push(6);
            if (item.name.includes("Distribuidor")) colors.push("#78B8E3");
            else colors.push("#C6DE91");
        } else {
            optWith.push(4);
            optDash.push(0);
            if (item.name.includes("Distribuidor")) colors.push("#2374AB");
            else colors.push("#9BC53D");
        }
    });

    return {
        series: series,
        chart: {
            height: 320,
            type: "line",
            zoom: { enabled: false },
            animations: { enabled: false },
            toolbar: { show: false },
        },
        grid: { borderColor: "#f2f5f7" },
        stroke: { width: optWith, curve: "straight", dashArray: optDash },
        colors: colors,
        labels: dias,
        xaxis: {
            labels: {
                show: true,
                style: {
                    colors: "#8c9097",
                    fontSize: "11px",
                    fontWeight: 600,
                    cssClass: "apexcharts-xaxis-label",
                },
            },
        },
        yaxis: {
            labels: {
                show: true,
                style: {
                    colors: "#8c9097",
                    fontSize: "11px",
                    fontWeight: 600,
                    cssClass: "apexcharts-yaxis-label",
                },
            },
        },
        noData: { text: "No hay datos para mostrar" },
    };
}
//? Función para renderizar la gráfica de activaciones diarias
function renderGrafica(id, series, options) {
    const elemento = document.querySelector(id);
    if (elemento && elemento.chartInstance) {
        elemento.chartInstance.updateOptions(options);
    } else if (elemento) {
        elemento.chartInstance = new ApexCharts(
            document.querySelector(id),
            options
        );
        elemento.chartInstance.render();
    }
}


//? Función para dibujar el análisis de activaciones diarias
function drawAnalisis(data) {
    const currentData = data.map((row, index) => {
        let diff =
            row.total > row.anio_anterior
                ? (
                      ((row.total - row.anio_anterior) / row.anio_anterior) *
                      100
                  ).toFixed(2)
                : (
                      ((row.anio_anterior - row.total) / row.anio_anterior) *
                      100
                  ).toFixed(2);

        diff = isNaN(diff) ? 0 : diff;
        let total = Intl.NumberFormat("es-MX", {
            maximumFractionDigits: 0,
        }).format(row.total);

        return `
        <div class="d-flex align-items-center me-5">
        <span class="fs-8 text-secondary">
            <i class="mdi mdi-circle"></i>
    
        </span>
        <div class="ms-2 align-content-top  text-center">
            <p class="mb-0 fs-15">${total}</p>
            <p class="mb-0 me-2 fs-13 text-muted">${row.tipo_activa}</p>
                <span class="fs-12 text-${
                    row.total > row.anio_anterior || diff == 0
                        ? "success"
                        : "danger"
                } d-inline-flex align-items-center"
                    title="Año anterior: ${row.anio_anterior ?? 0}">
                    <i class="ti ti-trending-${
                        row.total > row.anio_anterior || diff == 0
                            ? "up"
                            : "down"
                    } me-1"></i>
                    ${diff}%
                </span>
            </div>
        </div>           
        `;
    });
    return currentData.join("");
}
//? Función para dibujar el análisis del año anterior de activaciones diarias
function drawAnalisisAnterior(data) {
    const currentData = data.map((row, index) => {
        let total = Intl.NumberFormat("es-MX", {
            maximumFractionDigits: 0,
        }).format(row.total);
        return `
        <div class="d-flex align-items-center me-5">
        <div class="align-content-top  text-center">
            <p class="mb-0 fs-15">${total}</p>
            <p class="mb-0 me-2 fs-13 text-muted">${row.tipo_activa}</p>
                <span class="fs-11 text-danger d-inline-flex align-items-center">
                    Año anterior
                </span>
            </div>
        </div>           
        `;
    });
    return currentData.join("");
}

//** GRÁFICA ANUAL (DISTS) */
function graficaAnual(anio, mes, fecha) {
    // if (document.querySelector("#grafica-activaciones-mensuales")) {
    // const element = document.querySelector("#grafica-activaciones-mensuales")
    const slcActivacionesSucursal = document.querySelector(
        "#slcActivacionesSucursal"
    );
    const sucursal_id = slcActivacionesSucursal
        ? slcActivacionesSucursal.value
        : null;
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    // ** GRÁFICA ANUAL - DISTRIBUIDOR
    fetch("/telcel/activaciones/grafica", {
        method: "post",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken,
        },
        body: JSON.stringify({
            anio: anio ?? new Date().getFullYear(),
            tipofecha: fecha ?? "preactivacion",
            cadenas: false,
            sucursal: sucursal_id,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            // Se mapea para obtener las series de la gráfica.
            const transformedData = Object.values(data).map((row) => {
                return {
                    name: row.concepto,
                    data: row.data,
                };
            });
            // Se valida si existe el gráfico. Para eso se instancia en el elemento.
            let labels = [
                "Ene",
                "Feb",
                "Mar",
                "Abr",
                "May",
                "Jun",
                "Jul",
                "Ago",
                "Sep",
                "Oct",
                "Nov",
                "Dic",
            ];
            renderGrafica(
                "#grafica-activaciones-mensuales",
                transformedData,
                createChartOptions2(transformedData, labels)
            );
        });

    // ** GRÁFICA ANUAL - CADENAS
    fetch("/telcel/activaciones/grafica", {
        method: "post",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken,
        },
        body: JSON.stringify({
            anio: anio ?? new Date().getFullYear(),
            tipofecha: fecha ?? "preactivacion",
            cadenas: true,
            sucursal: sucursal_id,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            // Se mapea para obtener las series de la gráfica.
            const transformedData = Object.values(data).map((row) => {
                return {
                    name: row.concepto,
                    data: row.data,
                };
            });
            // Se valida si existe el gráfico. Para eso se instancia en el elemento.
            let labels = [
                "Ene",
                "Feb",
                "Mar",
                "Abr",
                "May",
                "Jun",
                "Jul",
                "Ago",
                "Sep",
                "Oct",
                "Nov",
                "Dic",
            ];
            renderGrafica(
                "#grafica-activaciones-mensuales-cadenas",
                transformedData,
                createChartOptions2(transformedData, labels)
            );
        });

    fetch("/telcel/activaciones/compara", {
        method: "post",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken,
        },
        body: JSON.stringify({
            anio: anio ?? new Date().getFullYear(),
            tipofecha: fecha ?? "preactivacion",
            sucursal: sucursal_id,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            const element = document.getElementById("compara-mensual-anual");
            if (element) {
                element.innerHTML = "";

                // // Obtener el año actual y el año anterior
                const currentYear = anio.toString();
                const previousYear = (parseInt(currentYear) - 1).toString();

                // // Obtener los arrays correspondientes al año actual y al año anterior
                const currentYearData = data[currentYear] || [];
                const previousYearData = data[previousYear] || [];

                Object.values(currentYearData).forEach((obj) => {
                    const matchingObj = Object.values(previousYearData).find(
                        (prevObj) => prevObj.concepto === obj.concepto
                    );
                    if (matchingObj) {
                        obj.anio_anterior = matchingObj.total;
                    }
                });
                element.innerHTML = drawAnalisisAnual(currentYearData);

                // Gráfica por Producto.
                let maxYear = Math.max(...Object.keys(data));
                let newData = [];

                let conceptos = [];
                let totales = [];
                
                let conceptoMap = {
                    'Chip Express': 'Chips',
                    'Chip 0': 'Chips',
                    'Amigo Chip': 'Chips',
                    'Chip Cobro x Seg': 'Chips',
                    'KIT Sin Limite': 'KIT',
                    'TIP Kit': 'KIT',
                    'KIT': 'KIT',
                    'Chip Port IN': 'Portas'
                };
                
                for (let key in data[maxYear]) {
                    let row = data[maxYear][key];
                    let newConcepto = conceptoMap[row.concepto.trim()] || 'Otros';
                    let existingIndex = conceptos.indexOf(newConcepto);
                    if (existingIndex !== -1) {
                        totales[existingIndex] += row.total;
                    } else {
                        conceptos.push(newConcepto);
                        totales.push(row.total);
                    }
                }

                console.log(conceptos, totales)

                renderGrafica(
                    "#grafica-activaciones-producto",
                    totales,
                    createChartOptions3(totales, conceptos)
                );       
                conceptos.forEach((concepto, index) => {
                    let span = document.getElementById(`spmActiva${concepto}`);
                    if (span) {
                        span.innerHTML = totales[index];
                    }
                });
                
                
                


            }
        });

    //** Análisis de activaciones por sucursal. */
    fetch("/telcel/activaciones/resumen", {
        method: "post",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken,
        },
        body: JSON.stringify({
            anio: anio ?? new Date().getFullYear(),
            mes: mes ?? new Date().getMonth(),
            tipofecha: fecha ?? "preactivacion",
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            const spTotal = document.getElementById("spnTotalActivas");
            if (spTotal) {
                const ul = document.getElementById("liActivaSucursales");
                ul.innerHTML = ""; // Limpiar el contenido existente
                spTotal.innerHTML = data.totalActivaciones;
                data.results.forEach((item) => {
                    const li = document.createElement("li");
                    li.classList.add("mb-2");
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
                    ul.appendChild(li);
                });
            }
        });
    // }
}

function drawAnalisisAnual(data) {
    const currentData = Object.values(data).map((row, index) => {
        let diff =
            row.total > row.anio_anterior
                ? (
                      ((row.total - row.anio_anterior) / row.anio_anterior) *
                      100
                  ).toFixed(2)
                : (
                      ((row.anio_anterior - row.total) / row.anio_anterior) *
                      100
                  ).toFixed(2);

        diff = isNaN(diff) ? 0 : diff;
        let total = Intl.NumberFormat("es-MX", {
            maximumFractionDigits: 0,
        }).format(row.total);

        return `
        <div class="d-flex align-items-center me-5">
        <span class="fs-8 text-secondary">
            <i class="mdi mdi-circle"></i>
    
        </span>
        <div class="ms-2 align-content-top  text-center">
            <p class="mb-0 fs-15">${total}</p>
            <p class="mb-0 me-2 fs-13 text-muted">${row.concepto}</p>
                <span class="fs-12 text-${
                    row.total > row.anio_anterior || diff == 0
                        ? "success"
                        : "danger"
                } d-inline-flex align-items-center"
                    title="Año anterior: ${row.anio_anterior ?? 0}">
                    <i class="ti ti-trending-${
                        row.total > row.anio_anterior || diff == 0
                            ? "up"
                            : "down"
                    } me-1"></i>
                    ${diff}%
                </span>
            </div>
        </div>           
        `;
    });
    return currentData.join("");
}

function createChartOptions2(series, labels) {
    return {
        series: series,
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
            width: [5, 5, 5, 5, 5, 5, 5, 5, 5, 5],
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
        colors: [
            "#2374AB",
            "#BFC0C0",
            "#379634",
            "#573D1C",
            "#7D387D",
            "#9ED8DB",
            "#D58936",
            "#FFB2E6",
            "#A44200",
            "#800080",
            "#FF0000",
        ],
        labels: labels,
        noData: { text: "No hay datos para mostrar" },
    };
}

function createChartOptions3(series,labels) {
    return  {
        series: series,
        chart: {
            width: 220,
            height: 220,
            type: "pie",
        },
        colors: [ "rgba(69, 214, 91, 0.8)","var(--primary08)", "rgba(243, 156, 18, 0.8)", "rgba(231, 76, 60, 0.8)"],
        labels: labels,
        legend: {
            show: false,
        },
        stroke: {
            width: 0
        },
        dataLabels: {
            enabled: true,
            dropShadow: {
                enabled: false,
            },
        },
        noData: { text: "No hay datos para mostrar" },
    };    
}
