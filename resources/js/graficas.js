if (document.querySelector("#grafica-activaciones-mensuales")) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


    fetch('/telcel/activaciones/grafica', {
        method: "post",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken,
        },
        body: JSON.stringify({
            concepto: 'canales',
            descripcion: 'desciprciones',
        }),
    })
    .then(response => response.json())
    .then(data => {
        // console.log(data)

        const transformedData = data.map(row => {
            return {
                name: row.concepto,
                data: row.data
            };
        });
    
        // console.log(transformedData);

        var options = {
            series:  transformedData,
            chart: {
            type: 'bar',
            height: 360,
            fontFamily: 'Poppins, sans-serif',
              foreColor: '#8c9097',
            stacked: true,
            toolbar: {
              show: false
            },
            zoom: {
              enabled: true
            },
          },
          grid: {
            borderColor: '#90A4AE',
            strokeDashArray: 2,
          },
          dataLabels: {
            enabled: false,
          },
          responsive: [{
            breakpoint: 480,
            options: {
              legend: {
                position: 'bottom',
                offsetX: -10,
                offsetY: 0
              }
            }
          }],
          stroke: {
            show: true,
            width: [5, 5, 5, 5],
                  curve: 'smooth',
          },
          plotOptions: {
            bar: {
              columnWidth: "10%",
              horizontal: false,
            },
          },
          legend: {
            position: 'right',
            offsetY: 40
          },
          fill: {
            opacity: 1
          },
          legend: {
            show: false
          },
          tooltip: {
            enabled: true,
            shared: true,
            intersect: false,
          },
        //   colors: ['var(--primary-color)', 'var(--cian)', 'rgb(46, 204, 113)'],
        //   colors:['#65B741','#FFB534','#EEF296','#C1F2B0','#FF8F8F','#EEF296','#9ADE7B'],
          labels: ["Ene", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        };        
        // console.log(options)

        var chart = new ApexCharts(document.querySelector("#grafica-activaciones-mensuales"), options);
        chart.render();
    })

    // const  grafica = document.querySelector ("#grafica-activaciones-mensuales");
    // console.log(grafica.dataset.grafica)
    // var options = {
    //     series: [
    //         {
    //     name: 'Kits',
    //     data: [44, 55, 41, 42, 38, 43, 21, 35, 56, 27, 43, 27]
    //   }, {
    //     name: 'Chips',
    //     data: [33, 21, 32, 37, 23, 32, 47, 31, 54, 32, 20, 38]
    //   }, 
    //   {
    //     name: 'Portas',
    //     data: [30, 25, 36, 30, 45, 35, 64, 51, 59, 36, 39, 51]
    //   },
    //   {
    //     name: 'Otros',
    //     data: [2, 0, 0, 1, 1, 2, 0, 0, 3, 4, 1, 5]
    //   }  
    // ],
    //     chart: {
    //     type: 'bar',
    //     height: 360,
    //     fontFamily: 'Poppins, sans-serif',
    //       foreColor: '#8c9097',
    //     stacked: true,
    //     toolbar: {
    //       show: false
    //     },
    //     zoom: {
    //       enabled: true
    //     },
    //   },
    //   grid: {
    //     borderColor: '#90A4AE',
    //     strokeDashArray: 2,
    //   },
    //   dataLabels: {
    //     enabled: false,
    //   },
    //   responsive: [{
    //     breakpoint: 480,
    //     options: {
    //       legend: {
    //         position: 'bottom',
    //         offsetX: -10,
    //         offsetY: 0
    //       }
    //     }
    //   }],
    //   stroke: {
    //     show: true,
    //     width: [5, 5, 5, 5],
    //           curve: 'smooth',
    //   },
    //   plotOptions: {
    //     bar: {
    //       columnWidth: "10%",
    //       horizontal: false,
    //     },
    //   },
    //   legend: {
    //     position: 'right',
    //     offsetY: 40
    //   },
    //   fill: {
    //     opacity: 1
    //   },
    //   legend: {
    //     show: false
    //   },
    //   tooltip: {
    //     enabled: true,
    //     shared: true,
    //     intersect: false,
    //   },
    // //   colors: ['var(--primary-color)', 'var(--cian)', 'rgb(46, 204, 113)'],
    // //   colors:['#041e85', '#d1be0f', '#f5b14c','#f08bdf'],
    //   labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    // };

    // var chart = new ApexCharts(document.querySelector("#grafica-activaciones-mensuales"), options);
    // chart.render();

    fetch('/telcel/activaciones/compara', {
        method: "post",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken,
        },
        body: JSON.stringify({
            concepto: 'canales',
            descripcion: 'desciprciones',
        }),
    })
    .then(response => response.json())
    .then(data => {
        console.log(data.current)

        const currentData = data.current.map((row, index) => {
            const lastRow = data.last.find(item => item.concepto === row.concepto);
            if (lastRow) {
                const lastTotalSpan = `             
                <span class="fs-12 text-success d-inline-flex align-items-center">
                    <i  class="ti ti-trending-up me-1"></i>
                    ${lastRow.data.reduce((a, b) => a + b, 0)}
                </span>`;
                
            }            
            console.log(row, lastRow)
            return `
            <div class="d-flex align-items-center me-5">
                <span class="fs-8 text-primary">
                    <i class="mdi mdi-circle"></i>
                </span>
                <div class="ms-2">
                    <p class="mb-0 fs-15    ">${ row.data.reduce((a, b) => a + b, 0) }</p>
                    <div class="d-flex align-items-center">
                        <p class="mb-0 me-2 fs-13 text-muted">${row.concepto}</p>
                        ${lastTotalSpan ?? ''} 
                    </div>
                </div>
            </div>
            `;
            const div = document.createElement('div');
        
            const conceptoSpan = document.createElement('span');
            conceptoSpan.textContent = row.concepto;
            div.appendChild(conceptoSpan);
        
            const totalSpan = document.createElement('span');
            totalSpan.textContent = row.data.reduce((a, b) => a + b, 0);
            div.appendChild(totalSpan);
        
            const lastRowsd = data.last.find(item => item.concepto === row.concepto);
            if (lastRow) {
                const lastTotalSpan = document.createElement('span');
                lastTotalSpan.textContent = lastRow.data.reduce((a, b) => a + b, 0);
                div.appendChild(lastTotalSpan);
            }
            console.log(div)
            return div;
        });

        document.getElementById('comparaMensual').innerHTML = currentData.join('');


    })


 }