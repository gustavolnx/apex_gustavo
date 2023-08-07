// App interactions
$(document).ready(function () {
  $(".btn.back").click(function () {
    window.history.back();
  });
});

//Chart creation based on csv file

//Ajax GET request to json.php
var request = new XMLHttpRequest();
request.open("GET", "json.php", false);
request.send(null);
var json = JSON.parse(request.responseText);
console.log(json);

var ctx = document.getElementById("chart");

Chart.register(ChartDataLabels);
var myChart = new Chart(ctx, {
  data: {
    datasets: [
      {
        type: "bar",
        label: "LIBERADO",
        data: json.ready,
        backgroundColor: "#088708",
        datalabels: {
          labels: {
            title: {
              display: function (context) {
                return context.dataset.data[context.dataIndex] > 0;
              },
              color: "#fff",
            },
          },
        },
      },
      {
        type: "bar",
        label: "PENDENTE",
        data: json.notready,
        backgroundColor: "#ff6c00",
        datalabels: {
          labels: {
            title: {
              display: function (context) {
                return context.dataset.data[context.dataIndex] > 0;
              },
              color: "#fff",
            },
          },
        },
      },
    ],
    labels: json.days,
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        position: "top",
        align: "center",
        labels: {
          color: "#fff",
          font: {
            family: "MontserratRegular",
            size: 20,
            weight: "bold",
          },
          filter: function (item, chart) {
            // Logic to remove a particular legend item goes here
            return !item.text.includes("label to remove");
          },
        },
      },
      datalabels: {
        formatter: (val) => {
          return val + "";
        },
        anchor: "end",
        align: "top",
        font: {
          family: "MontserratRegular",
          weight: "bold",
          size: 25,
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
        ticks: {
          stepSize: 10,
          callback: function (value, index, ticks) {
            return "  " + value + "";
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
