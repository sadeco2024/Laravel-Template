"use strict";

// total revenue chart
var options = {
  series: [
    {
      name: "Expenses",
      data: [
        [1327359600000, 20.95],
        [1327446000000, 21.34],
        [1327532400000, 21.18],
        [1327618800000, 21.05],
        [1327878000000, 21.0],
        [1327964400000, 20.95],
        [1328050800000, 21.24],
        [1328137200000, 21.29],
        [1328223600000, 21.85],
        [1328482800000, 21.86],
        [1328569200000, 22.28],
        [1328655600000, 22.1],
        [1328742000000, 22.65],
        [1328828400000, 22.21],
        [1329087600000, 22.35],
        [1329174000000, 22.44],
        [1329260400000, 22.46],
        [1329346800000, 22.86],
        [1329433200000, 22.75],
        [1329778800000, 22.54],
        [1329865200000, 22.33],
        [1329951600000, 22.97],
        [1330038000000, 23.41],
        [1330297200000, 23.27],
        [1330383600000, 23.27],
        [1330470000000, 22.89],
        [1330556400000, 23.1],
        [1330642800000, 23.73],
        [1330902000000, 23.22],
        [1330988400000, 21.99],
        [1331074800000, 22.41],
        [1331161200000, 23.05],
        [1331247600000, 23.64],
        [1331506800000, 23.56],
        [1331593200000, 24.22],
        [1331679600000, 23.77],
        [1331766000000, 24.17],
        [1331852400000, 23.82],
        [1332111600000, 24.51],
        [1332198000000, 23.16],
        [1332284400000, 23.56],
        [1332370800000, 23.71],
        [1332457200000, 23.81],
        [1332712800000, 24.4],
        [1332799200000, 24.63],
        [1332885600000, 24.46],
        [1332972000000, 24.48],
        [1333058400000, 24.31],
        [1333317600000, 24.7],
        [1333404000000, 24.31],
        [1333490400000, 23.46],
        [1333576800000, 23.59],
        [1333922400000, 23.22],
        [1334008800000, 22.61],
        [1334095200000, 23.01],
        [1334181600000, 23.55],
        [1334268000000, 23.18],
        [1334527200000, 22.84],
        [1334613600000, 23.84],
        [1334700000000, 23.39],
        [1334786400000, 22.91],
        [1334872800000, 23.06],
        [1335132000000, 22.62],
        [1335218400000, 22.4],
        [1335304800000, 23.13],
        [1335391200000, 23.26],
        [1335477600000, 23.58],
        [1335736800000, 23.55],
        [1335823200000, 23.77],
        [1335909600000, 23.76],
        [1335996000000, 23.32],
        [1336082400000, 22.61],
        [1336341600000, 22.52],
        [1336428000000, 22.67],
        [1336514400000, 22.52],
        [1336600800000, 21.92],
        [1336687200000, 22.2],
        [1336946400000, 22.23],
        [1337032800000, 22.33],
        [1337119200000, 22.36],
        [1337205600000, 22.01],
        [1337292000000, 21.31],
        [1337551200000, 22.01],
        [1337637600000, 22.01],
        [1337724000000, 22.18],
        [1337810400000, 21.54],
        [1337896800000, 21.6],
        [1338242400000, 22.05],
        [1338328800000, 21.29],
        [1338415200000, 21.05],
        [1338501600000, 25.2],
        [1338760800000, 20.31],
        [1338847200000, 20.7],
        [1338933600000, 21.69],
        [1339020000000, 21.32],
        [1339106400000, 21.65],
        [1339365600000, 21.13],
        [1339452000000, 21.77],
        [1339538400000, 21.79],
        [1339624800000, 21.67],
        [1339711200000, 22.39],
        [1339970400000, 22.63],
        [1340056800000, 22.89],
        [1340143200000, 21.99],
        [1340229600000, 21.23],
        [1340316000000, 21.57],
        [1340575200000, 20.84],
        [1340661600000, 21.07],
        [1340748000000, 21.41],
        [1340834400000, 21.17],
        [1340920800000, 22.37],
        [1341180000000, 22.19],
        [1341266400000, 22.51],
        [1341439200000, 22.53],
        [1341525600000, 21.37],
        [1341784800000, 20.43],
        [1341871200000, 20.44],
        [1341957600000, 20.2],
        [1342044000000, 20.14],
        [1342130400000, 20.65],
        [1342389600000, 20.4],
        [1342476000000, 20.65],
        [1342562400000, 21.43],
        [1342648800000, 21.89],
        [1342735200000, 21.38],
        [1342994400000, 20.64],
        [1343080800000, 20.02],
        [1343167200000, 20.33],
        [1343253600000, 20.95],
        [1343340000000, 21.89],
        [1343599200000, 21.01],
        [1343685600000, 20.88],
        [1343772000000, 20.69],
        [1343858400000, 20.58],
        [1343944800000, 22.02],
        [1344204000000, 22.14],
        [1344290400000, 22.37],
        [1344376800000, 22.51],
        [1344463200000, 22.65],
        [1344549600000, 22.64],
        [1344808800000, 22.27],
        [1344895200000, 22.1],
        [1344981600000, 22.91],
        [1345068000000, 23.65],
        [1345154400000, 23.8],
        [1345413600000, 23.92],
        [1345500000000, 23.75],
        [1345586400000, 23.84],
        [1345672800000, 23.5],
        [1345759200000, 22.26],
        [1346018400000, 22.32],
        [1346104800000, 22.06],
        [1346191200000, 21.96],
        [1346277600000, 21.46],
        [1346364000000, 21.27],
        [1346709600000, 21.43],
        [1346796000000, 22.26],
        [1346882400000, 22.79],
        [1346968800000, 22.46],
        [1347228000000, 22.13],
        [1347314400000, 22.43],
        [1347400800000, 22.42],
        [1347487200000, 22.81],
        [1347573600000, 23.34],
        [1347832800000, 23.41],
        [1347919200000, 22.57],
        [1348005600000, 23.12],
        [1348092000000, 24.53],
        [1348178400000, 23.83],
        [1348437600000, 23.41],
        [1348524000000, 22.9],
        [1348610400000, 22.53],
        [1348696800000, 22.8],
        [1348783200000, 22.44],
        [1349042400000, 22.62],
        [1349128800000, 22.57],
        [1349215200000, 22.6],
        [1349301600000, 22.68],
        [1349388000000, 22.47],
        [1349647200000, 22.23],
        [1349733600000, 21.68],
        [1349820000000, 21.51],
        [1349906400000, 21.78],
        [1349992800000, 21.94],
        [1350252000000, 22.33],
        [1350338400000, 23.24],
        [1350424800000, 23.44],
        [1350511200000, 23.48],
        [1350597600000, 23.24],
        [1350856800000, 23.49],
        [1350943200000, 23.31],
        [1351029600000, 23.36],
        [1351116000000, 23.4],
        [1351202400000, 24.01],
        [1351638000000, 24.02],
        [1351724400000, 24.36],
        [1351810800000, 24.39],
        [1352070000000, 24.24],
        [1352156400000, 24.39],
        [1352242800000, 23.47],
        [1352329200000, 22.98],
        [1352415600000, 22.9],
        [1352674800000, 22.7],
        [1352761200000, 22.54],
        [1352847600000, 22.23],
        [1352934000000, 22.64],
        [1353020400000, 22.65],
        [1353279600000, 22.92],
        [1353366000000, 22.64],
        [1353452400000, 22.84],
        [1353625200000, 23.4],
        [1353884400000, 23.3],
        [1353970800000, 23.18],
        [1354057200000, 23.88],
        [1354143600000, 24.09],
        [1354230000000, 24.61],
        [1354489200000, 24.7],
        [1354575600000, 25.3],
        [1354662000000, 25.4],
        [1354748400000, 25.14],
        [1354834800000, 25.48],
        [1355094000000, 25.75],
        [1355180400000, 25.54],
        [1355266800000, 25.96],
        [1355353200000, 25.53],
        [1355439600000, 27.56],
        [1355698800000, 27.42],
        [1355785200000, 27.49],
        [1355871600000, 28.09],
        [1355958000000, 27.87],
        [1356044400000, 27.71],
        [1356303600000, 27.53],
        [1356476400000, 27.55],
        [1356562800000, 27.3],
        [1356649200000, 26.9],
        [1356908400000, 27.68],
        [1357081200000, 28.34],
        [1357167600000, 27.75],
        [1357254000000, 28.13],
        [1357513200000, 27.94],
        [1357599600000, 28.14],
        [1357686000000, 28.66],
        [1357772400000, 28.62],
        [1357858800000, 28.09],
        [1358118000000, 28.16],
        [1358204400000, 28.15],
        [1358290800000, 27.88],
        [1358377200000, 27.73],
        [1358463600000, 27.98],
        [1358809200000, 27.95],
        [1358895600000, 28.25],
        [1358982000000, 28.1],
        [1359068400000, 28.32],
        [1359327600000, 28.24],
        [1359414000000, 28.52],
        [1359500400000, 27.94],
        [1359586800000, 27.83],
        [1359673200000, 28.34],
        [1359932400000, 28.1],
        [1360018800000, 28.51],
        [1360105200000, 28.4],
        [1360191600000, 28.07],
        [1360278000000, 29.12],
        [1360537200000, 28.64],
        [1360623600000, 28.89],
        [1360710000000, 28.81],
        [1360796400000, 28.61],
        [1360882800000, 28.63],
        [1361228400000, 28.99],
        [1361314800000, 28.77],
        [1361401200000, 28.34],
        [1361487600000, 28.55],
        [1361746800000, 28.11],
        [1361833200000, 28.59],
        [1361919600000, 29.6],
      ],
    },
    {
      name: "Income",
      data: [
        [1327359600000, 25.59],
        [1327446000000, 21.43],
        [1327532400000, 22.81],
        [1327618800000, 23.5],
        [1327878000000, 25.0],
        [1327964400000, 29.59],
        [1328050800000, 37.42],
        [1328137200000, 35.92],
        [1328223600000, 35.58],
        [1328482800000, 33.68],
        [1328569200000, 37.82],
        [1328655600000, 38.1],
        [1328742000000, 39.56],
        [1328828400000, 35.12],
        [1329087600000, 31.53],
        [1329174000000, 35.44],
        [1329260400000, 33.64],
        [1329346800000, 32.68],
        [1329433200000, 32.57],
        [1329778800000, 32.45],
        [1329865200000, 32.33],
        [1329951600000, 32.79],
        [1330038000000, 33.14],
        [1330297200000, 33.72],
        [1330383600000, 33.72],
        [1330470000000, 32.98],
        [1330556400000, 33.1],
        [1330642800000, 33.37],
        [1330902000000, 33.22],
        [1330988400000, 31.99],
        [1331074800000, 32.14],
        [1331161200000, 33.5],
        [1331247600000, 33.46],
        [1331506800000, 33.65],
        [1331593200000, 34.22],
        [1331679600000, 33.77],
        [1331766000000, 34.71],
        [1331852400000, 33.28],
        [1332111600000, 34.15],
        [1332198000000, 33.61],
        [1332284400000, 33.65],
        [1332370800000, 33.17],
        [1332457200000, 33.18],
        [1332712800000, 34.4],
        [1332799200000, 34.36],
        [1332885600000, 34.64],
        [1332972000000, 34.84],
        [1333058400000, 34.13],
        [1333317600000, 34.7],
        [1333404000000, 34.13],
        [1333490400000, 33.64],
        [1333576800000, 33.95],
        [1333922400000, 33.22],
        [1334008800000, 32.16],
        [1334095200000, 33.1],
        [1334181600000, 35.55],
        [1334268000000, 33.81],
        [1334527200000, 32.48],
        [1334613600000, 33.48],
        [1334700000000, 33.93],
        [1334786400000, 32.19],
        [1334872800000, 33.6],
        [1335132000000, 32.26],
        [1335218400000, 32.4],
        [1335304800000, 33.31],
        [1335391200000, 33.62],
        [1335477600000, 33.85],
        [1335736800000, 33.55],
        [1335823200000, 33.77],
        [1335909600000, 33.67],
        [1335996000000, 33.23],
        [1336082400000, 32.16],
        [1336341600000, 32.25],
        [1336428000000, 32.76],
        [1336514400000, 32.25],
        [1336600800000, 31.29],
        [1336687200000, 32.2],
        [1336946400000, 32.32],
        [1337032800000, 32.33],
        [1337119200000, 32.63],
        [1337205600000, 32.1],
        [1337292000000, 31.13],
        [1337551200000, 32.1],
        [1337637600000, 32.1],
        [1337724000000, 32.81],
        [1337810400000, 31.45],
        [1337896800000, 31.6],
        [1338242400000, 32.5],
        [1338328800000, 31.92],
        [1338415200000, 31.5],
        [1338501600000, 29.28],
        [1338760800000, 30.13],
        [1338847200000, 30.7],
        [1338933600000, 31.96],
        [1339020000000, 31.23],
        [1339106400000, 31.56],
        [1339365600000, 31.31],
        [1339452000000, 31.77],
        [1339538400000, 31.97],
        [1339624800000, 31.76],
        [1339711200000, 32.93],
        [1339970400000, 32.36],
        [1340056800000, 32.98],
        [1340143200000, 31.99],
        [1340229600000, 31.32],
        [1340316000000, 31.75],
        [1340575200000, 30.48],
        [1340661600000, 31.7],
        [1340748000000, 31.14],
        [1340834400000, 31.71],
        [1340920800000, 32.73],
        [1341180000000, 32.91],
        [1341266400000, 32.15],
        [1341439200000, 32.35],
        [1341525600000, 31.73],
        [1341784800000, 30.34],
        [1341871200000, 30.44],
        [1341957600000, 30.2],
        [1342044000000, 30.41],
        [1342130400000, 30.56],
        [1342389600000, 30.4],
        [1342476000000, 30.56],
        [1342562400000, 31.34],
        [1342648800000, 31.98],
        [1342735200000, 31.83],
        [1342994400000, 30.46],
        [1343080800000, 30.2],
        [1343167200000, 30.33],
        [1343253600000, 30.59],
        [1343340000000, 31.98],
        [1343599200000, 31.1],
        [1343685600000, 30.88],
        [1343772000000, 30.96],
        [1343858400000, 30.85],
        [1343944800000, 32.2],
        [1344204000000, 32.41],
        [1344290400000, 32.73],
        [1344376800000, 32.15],
        [1344463200000, 32.56],
        [1344549600000, 32.46],
        [1344808800000, 32.72],
        [1344895200000, 32.1],
        [1344981600000, 32.19],
        [1345068000000, 33.56],
        [1345154400000, 33.8],
        [1345413600000, 33.29],
        [1345500000000, 33.57],
        [1345586400000, 33.48],
        [1345672800000, 33.5],
        [1345759200000, 32.62],
        [1346018400000, 32.23],
        [1346104800000, 32.6],
        [1346191200000, 31.69],
        [1346277600000, 31.64],
        [1346364000000, 31.72],
        [1346709600000, 31.34],
        [1346796000000, 32.62],
        [1346882400000, 32.97],
        [1346968800000, 32.64],
        [1347228000000, 32.31],
        [1347314400000, 32.34],
        [1347400800000, 32.24],
        [1347487200000, 32.18],
        [1347573600000, 33.43],
        [1347832800000, 33.14],
        [1347919200000, 32.75],
        [1348005600000, 33.21],
        [1348092000000, 34.35],
        [1348178400000, 33.38],
        [1348437600000, 33.14],
        [1348524000000, 32.9],
        [1348610400000, 32.35],
        [1348696800000, 32.8],
        [1348783200000, 32.44],
        [1349042400000, 32.26],
        [1349128800000, 32.75],
        [1349215200000, 32.6],
        [1349301600000, 32.86],
        [1349388000000, 32.74],
        [1349647200000, 32.32],
        [1349733600000, 31.86],
        [1349820000000, 31.15],
        [1349906400000, 31.87],
        [1349992800000, 31.49],
        [1350252000000, 32.33],
        [1350338400000, 33.42],
        [1350424800000, 33.44],
        [1350511200000, 33.84],
        [1350597600000, 33.42],
        [1350856800000, 33.94],
        [1350943200000, 33.13],
        [1351029600000, 33.63],
        [1351116000000, 33.4],
        [1351202400000, 34.1],
        [1351638000000, 34.2],
        [1351724400000, 34.63],
        [1351810800000, 34.93],
        [1352070000000, 34.42],
        [1352156400000, 34.93],
        [1352242800000, 33.74],
        [1352329200000, 32.89],
        [1352415600000, 32.9],
        [1352674800000, 32.7],
        [1352761200000, 32.45],
        [1352847600000, 32.32],
        [1352934000000, 32.46],
        [1353020400000, 32.56],
        [1353279600000, 32.29],
        [1353366000000, 32.46],
        [1353452400000, 32.48],
        [1353625200000, 33.4],
        [1353884400000, 33.3],
        [1353970800000, 33.81],
        [1354057200000, 33.88],
        [1354143600000, 34.9],
        [1354230000000, 34.16],
        [1354489200000, 34.7],
        [1354575600000, 35.3],
        [1354662000000, 35.4],
        [1354748400000, 35.41],
        [1354834800000, 35.84],
        [1355094000000, 35.57],
        [1355180400000, 35.45],
        [1355266800000, 35.69],
        [1355353200000, 35.35],
        [1355439600000, 37.65],
        [1355698800000, 37.24],
        [1355785200000, 37.94],
        [1355871600000, 38.9],
        [1355958000000, 37.78],
        [1356044400000, 37.17],
        [1356303600000, 37.35],
        [1356476400000, 37.55],
        [1356562800000, 37.3],
        [1356649200000, 36.9],
        [1356908400000, 37.86],
        [1357081200000, 38.43],
        [1357167600000, 37.57],
        [1357254000000, 38.31],
        [1357513200000, 37.49],
        [1357599600000, 38.41],
        [1357686000000, 38.66],
        [1357772400000, 38.26],
        [1357858800000, 38.9],
        [1358118000000, 38.61],
        [1358204400000, 38.51],
        [1358290800000, 37.88],
        [1358377200000, 37.37],
        [1358463600000, 37.89],
        [1358809200000, 37.59],
        [1358895600000, 38.52],
        [1358982000000, 38.1],
        [1359068400000, 38.23],
        [1359327600000, 38.42],
        [1359414000000, 38.25],
        [1359500400000, 37.49],
        [1359586800000, 37.38],
        [1359673200000, 38.43],
        [1359932400000, 38.1],
        [1360018800000, 38.15],
        [1360105200000, 38.4],
        [1360191600000, 38.7],
        [1360278000000, 39.21],
        [1360537200000, 38.46],
        [1360623600000, 38.98],
        [1360710000000, 38.18],
        [1360796400000, 38.16],
        [1360882800000, 38.36],
        [1361228400000, 38.99],
        [1361314800000, 38.77],
        [1361401200000, 38.43],
        [1361487600000, 38.55],
        [1361746800000, 38.11],
        [1361833200000, 38.95],
        [1361919600000, 39.6],
      ],
    },
  ],
  chart: {
    id: "area",
    fontFamily: "Poppins, Arial, sans-serif",
    type: "area",
    foreColor: "#8c9097",
    height: 260,
    horizontal: true,
    zoom: {
      autoScaleYaxis: true,
    },
    toolbar: {
      show: false,
    },
  },
  legend: {
    show: false,
  },
  grid: {
    borderColor: "#edeef1",
    strokeDashArray: 2,
  },
  dataLabels: {
    enabled: false,
  },
  markers: {
    size: 0,
    style: "hollow",
  },
  xaxis: {
    type: "datetime",
    min: new Date("01 Mar 2012").getTime(),
    tickAmount: 6,
    axisBorder: {
      show: false,
    },
    crosshairs: {
      show: false,
    },
    axisTicks: {
      show: false,
    },
    labels: {
      style: {
        fontSize: "10px",
      },
    },
    tooltip: {
      enabled: false,
    },
  },
  yaxis: {
    labels: {
      style: {
        fontSize: "10px",
      },
    },
  },
  tooltip: {
    markers: {
      show: false,
    },
    enabled: true,
    shared: true,
    intersect: false,
    x: {
      format: "dd-MM-yyyy",
    },
  },
  colors: ["var(--primary-color)", "rgb(69, 214, 91)"],
  stroke: {
    width: [1, 1],
    curve: "smooth",
  },
  fill: {
    type: "gradient",
    gradient: {
      shadeIntensity: 1,
      opacityFrom: 0.7,
      opacityTo: 0.2,
      stops: [0, 100],
    },
  },
};
const generateDayWiseTimeSeries = function(baseval, count, yrange) {
  var i = 0;
  var series = [];
  while (i < count) {
    var x = baseval;
    var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;
    series.push([x, y]);
    baseval += 86400000;
    i++;
  }
  return series;
};
var options = {
  series: [
    {
      name: "Income",
      data: generateDayWiseTimeSeries(
        new Date("11 Feb 2017 GMT").getTime(),
        20,
        {
          min: 10,
          max: 60
        }
      )
    }, 
    {
      name: "Expenses",
      data: generateDayWiseTimeSeries(
        new Date("11 Feb 2017 GMT").getTime(),
        20,
        {
          min: 10,
          max: 15
        }
      )
    }
  ],
  chart: {
    type: "area",
    fontFamily: "Poppins, Arial, sans-serif",
    type: "area",
    foreColor: "#8c9097",
    height: 260,
    horizontal: true,
    zoom: {
      autoScaleYaxis: true,
    },
    toolbar: {
      show: false,
    },
    stacked: true,
    events: {
      selection: function(chart, e) {
        console.log(new Date(e.xaxis.min));
      }
    }
  },
  grid: {
    borderColor: "#edeef1",
    strokeDashArray: 2,
  },
  colors: ["var(--primary-color)", "rgb(69, 214, 91)"],
  dataLabels: {
    enabled: false,
  },
  markers: {
    size: 0,
    style: "hollow",
  },
  stroke: {
    width: 1,
    curve: "smooth",
  },
  fill: {
    type: "gradient",
    gradient: {
      opacityFrom: 0.5,
      opacityTo: 0.3,
      colorStops: [
        [
          {
            offset: 0,
            color: "var(--primary02)",
            opacity: 50
          },
          {
            offset: 75,
            color: "var(--primary02)",
            opacity: 0.1
          },
          {
            offset: 100,
            color: 'transparent',
            opacity: 0.1
          }
        ],
        [
          {
            offset: 0,
            color: 'rgba(69, 214, 91, 0.2)',
            opacity: 1
          },
          {
            offset: 75,
            color: 'rgba(69, 214, 91, 0.2)',
            opacity: 0.1
          },
          {
            offset: 100,
            color: 'transparent',
            opacity: 1
          }
        ]
      ]
    }
  },
  legend: {
      show: true,
      position: "top",
      horizontalAlign: "right",
      offsetX: 0,
      offsetY: 8,
      markers: {
          width: 5,
          height: 5,
          strokeWidth: 0,
          strokeColor: '#fff',
          fillColors: undefined,
          radius: 12,
          customHTML: undefined,
          onClick: undefined,
          offsetX: 0,
          offsetY: 0
      },
  },
  xaxis: {
    type: "datetime",
    tickAmount: 6,
    axisBorder: {
      show: false,
    },
    crosshairs: {
      show: false,
    },
    axisTicks: {
      show: false,
    },
    labels: {
      style: {
        fontSize: "10px",
      },
    },
    tooltip: {
      enabled: false,
    },
  },
  yaxis: {
    labels: {
      style: {
        fontSize: "10px",
      },
    },
  },
  tooltip: {
    markers: {
      show: false,
    },
    enabled: true,
    shared: true,
    intersect: false,
  },
};
var chart = new ApexCharts(document.querySelector("#totalRevenue"), options);
chart.render();

// premium recruiters chart
var options = {
  series: [
    {
      name: "Revenue",
      data: [44, 55, 41, 42, 22, 43, 21, 35, 56, 27, 43, 27],
    },
  ],
  chart: {
    height: 40,
    type: "area",
    fontFamily: "Poppins, sans-serif",
    foreColor: "#8c9097",
    toolbar: {
      enabled: false,
      show: false,
    },
    sparkline: {
      enabled: true,
    },
  },
  grid: {
    borderColor: "#edeef1",
    strokeDashArray: 2,
  },
  dataLabels: {
    enabled: false,
  },
  stroke: {
    width: 1,
    curve: ["smooth"],
  },
  fill: {
    opacity: 0.38,
  },
  yaxis: {
    show: false,
  },
  xaxis: {
    show: false,
    crosshairs: {
      show: false,
    },
    axisBorder: {
      show: false,
    },
    axisTicks: {
      show: false,
    },
    labels: {
      style: {
        fontSize: "10px",
      },
    },
    tooltip: {
      enabled: false,
    },
  },
  legend: {
    show: false,
  },
  labels: [
    "Jan",
    "Feb",
    "Mar",
    "Apr",
    "May",
    "Jun",
    "Jul",
    "Aug",
    "Sep",
    "Oct",
    "Nov",
    "Dec",
  ],
  markers: {
    size: 0,
  },
  tooltip: {
    enabled: false,
  },
  colors: ["#ffffff"],
};
var chart1 = new ApexCharts(document.querySelector("#premiumRecruiters"), options);
chart1.render();
// premium recruiters chart

// subscriptions analysis chart
var options = {
  series: [14, 23, 21],
  chart: {
    type: "polarArea",
    height: 200,
    width: 200,
    fontFamily: "Poppins, sans-serif",
    foreColor: "#8c9097",
    sparkline: {
      enabled: true,
    }
  },
  grid: {
    borderColor: "#edeef1",
    strokeDashArray: 2,
  },
  stroke: {
    colors: ["#fff"],
  },
  colors: ['var(--primary08)', 'rgba(69, 214, 91, 0.8)', 'rgba(52, 152, 219, 0.8)'],
  legend: {
    show: false,
  },
  fill: {
    opacity: 0.9,
  },
  labels: ['Starter', 'Pro', 'Premium'],
  responsive: [
    {
      breakpoint: 480,
      options: {
        chart: {
          width: 200,
        },
      },
    },
  ],
};
var chart2 = new ApexCharts(document.querySelector("#subscriptionAnalysis"), options);
chart2.render();
// subscriptions analysis chart