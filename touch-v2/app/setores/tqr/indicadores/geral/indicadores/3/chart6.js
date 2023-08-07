//Ajax GET request to json.php
var request = new XMLHttpRequest();
request.open("GET", "json6.php", false);
request.send(null);
var json = JSON.parse(request.responseText);
console.log(json);
var objective = json.objective;
var values = json.values;
//Days from 03 to 28
var days = json.days;

// For lenght of days, create an array with the objective value
var planned = new Array(days.length).fill(objective);

//For lenght of days, create an array with the color of the bar
var barColors = json.colors;

Chart.register(ChartDataLabels);

const ctx2 = document.getElementById("chart2");

var myChart = new Chart(ctx2, {
  type: "bar",
  data: {
    datasets: [
      {
        type: "bar",
        label: "%",
        data: values,
        backgroundColor: barColors,
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
              font: {
                family: "MontserratRegular",
                size: 16,
              },
              color: "#fff",
            },
          },
        },
      },
      {
        type: "line",
        label: "label to remove",
        data: planned,
        backgroundColor: "#737373",
        borderColor: "#737373",
        pointStyle: false,
        xAxisID: "x2",
        order: 0,
        animation: {
          duration: 0,
        },
        datalabels: {
          labels: {
            title: {
              display: false,
            },
          },
        },
      },
    ],
    labels: days,
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      //TOOLTIPS
      tooltip: {
        padding: 10,
        caretPadding: 10,
        caretSize: 0,
        titleColor: "#fff",
        bodyColor: "#fff",
        titleFont: {
          size: 18,
          family: "Montserrat Black",
        },
        bodyFont: {
          size: 18,
        },
        boxWidth: 15,
        boxHeight: 15,
        boxPadding: 5,
      },
      legend: {
        position: "top",
        align: "end",
        labels: {
          boxWidth: 0,
          color: "rgba(0,0,0,0)",
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
          return val + "%";
        },
        anchor: "end",
        align: "top",
        font: {
          weight: "bold",
          size: 16,
        },
      },
    },
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
          stepSize: objective,
          callback: function (value, index, ticks) {
            return "  " + value + "%";
          },
          font: {
            family: "Montserrat Black",
            size: 16,
          },
          color: "#fff",
        },
        beginAtZero: false,
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
          chartArea: { left, bottom, top, width },
        } = chart;

        //Draw background color
        ctx.beginPath();
        ctx.rect(left, bottom, width, canvas.height - bottom);
        ctx.rect(left, bottom, width, canvas.height - bottom);
        ctx.fillStyle = opts.color || "white";
        ctx.fill();
        //Draw Y axis background color
        ctx.beginPath();
        ctx.rect(left, top, 5, bottom + top);
        ctx.fillStyle = opts.color || "#437cba";
        ctx.fill();
      },
    },
  ],
});
