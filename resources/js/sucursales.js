var options = {
    series: [{
    name: 'Kits',
    data: [44, 55, 41, 42, 22, 43, 21, 35, 56, 27, 43, 27]
  }, {
    name: 'Chips',
    data: [33, 21, 32, 37, 23, 32, 47, 31, 54, 32, 20, 38]
  }, 
  {
    name: 'Portas',
    data: [30, 25, 36, 30, 45, 35, 64, 51, 59, 36, 39, 51]
  },
  {
    name: 'Otros',
    data: [2, 0, 0, 1, 1, 2, 0, 0, 3, 4, 1, 5]
  }  
],
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
//   colors:['#041e85', '#d1be0f', '#f5b14c','#f08bdf'],
  labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
};
// if (document.querySelector("#grafica-activaciones-mensuales")) {
//   console.log(document.querySelector("#grafica-activaciones-mensuales").dataset.data)
//    var chart = new ApexCharts(document.querySelector("#grafica-activaciones-mensuales"), options);
//   chart.render();
// }


/* Leads By Source Chart */
var options = {
    series: [44, 55, 13, 43],
    chart: {
        width: 220,
        height: 220,
        type: "pie",
    },
    colors: ["var(--primary08)", "rgba(69, 214, 91, 0.8)", "rgba(243, 156, 18, 0.8)", "rgba(231, 76, 60, 0.8)"],
    labels: ["Mobile", "Desktop", "Laptop", "Tablet"],
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
};
if (document.querySelector("#leads-source")) {
  var chart1 = new ApexCharts(document.querySelector("#leads-source"), options);
  chart1.render();
  
}