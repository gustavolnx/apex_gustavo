//Ajax GET request to json.php
var request = new XMLHttpRequest();
request.open("GET", "./gastosv2/php/json2.php", false);
request.send(null);
var json = JSON.parse(request.responseText);
console.log(json);

services = ["MANUTENÇÃO", "SERVIÇOS", "SUPRIMENTOS", "FERRAMENTARIA"];
objective = 10;
planned = [10, 10, 10, 10];
barColors = ["#fff", "#fff", "#fff", "#fff"];

Chart.register(ChartDataLabels);

const ctx2 = document.getElementById("chart2");

var myChart = new Chart(ctx2, {
  type: "bar",
  data: {
    datasets: [
      {
        type: "bar",
        label: "label to remove",
        data: json.spendings,
        backgroundColor: "#088708",
        order: 1,
        datalabels: {
          labels: {
            title: {
              display: function (context) {
                //If last bar is 0, show it anyway
                if (context.dataIndex == context.dataset.data.length - 1) {
                  return true;
                }
                return context.dataset.data[context.dataIndex] !== 0;
              },
              color: "#fff",
            },
          },
        },
      },
      {
        type: "bar",
        label: "label to remove",
        data: json.limit,
        backgroundColor: "#0c40b6",
        order: 1,
        datalabels: {
          labels: {
            title: {
              display: function (context) {
                //If last bar is 0, show it anyway
                if (context.dataIndex == context.dataset.data.length - 1) {
                  return true;
                }
                return context.dataset.data[context.dataIndex] !== 0;
              },
              color: "#fff",
            },
          },
        },
      },
    ],
    labels: json.account,
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        position: "top",
        align: "end",
        labels: {
          boxWidth: 0,
          color: "#fff",
          font: {
            family: "MontserratRegular",
            size: 14,
          },
          filter: function (item, chart) {
            // Logic to remove a particular legend item goes here
            return !item.text.includes("label to remove");
          },
        },
      },
      datalabels: {
        formatter: (val) => {
          return "R$" + val + "K";
        },
        anchor: "end",
        align: "top",
        font: {
          weight: "bold",
          size: 16,
        },
      },
    },
    events: null,
    scales: {
      x: {
        ticks: {
          //Change font
          font: {
            family: "Montserrat Black",
            size: 16,
          },
          color: "#447dbb",
          backdropColor: "#fff",
        },
      },
      x2: {
        display: false,
        offset: false,
      },
      y: {
        suggestedMax: objective * 2,
        min: 0,
        ticks: {
          display: false,
          callback: function (value, index, ticks) {
            return "  " + value + "%";
          },
          font: {
            family: "Montserrat Black",
            size: 16,
          },
          color: "#fff",
        },
        beginAtZero: true,
      },
    },
  },
  plugins: [
    {
      id: "scaleBackgroundColor",
      beforeDraw: (chart, args, opts) => {
        const {
          ctx,
          canvas,
          chartArea: { left, bottom, width },
        } = chart;

        ctx.beginPath();
        ctx.rect(left, bottom, width, canvas.height - bottom);
        ctx.rect(left, bottom, width, canvas.height - bottom);
        ctx.fillStyle = opts.color || "white";
        ctx.fill();
      },
    },
  ],
});
