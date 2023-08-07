//Ajax GET request to json.php
var request = new XMLHttpRequest();
request.open("GET", "./gastosv2/php/json.php", false);
request.send(null);
var json = JSON.parse(request.responseText);
console.log(json);

values = json.actual;
days = json.days;
planned = json.planned;
objective = planned[0];
barColors = json.colors;
balance = json.balance;
Chart.register(ChartDataLabels);

const ctx = document.getElementById("chart1");

var myChart = new Chart(ctx, {
  type: "bar",
  data: {
    datasets: [
      {
        type: "bar",
        label: "Balanço: " + balance + "K",
        data: values,
        backgroundColor: barColors,
        order: 1,
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
      legend: {
        display: false,
        position: "top",
        align: "end",
        labels: {
          boxWidth: 0,
          color: "#fff",
          padding: 20,
          font: {
            family: "Montserrat Black",
            size: 28,
          },
          filter: function (item, chart) {
            // Logic to remove a particular legend item goes here
            if (!item.text.includes("label to remove")) {
              //If label contains minus "-"
              if (item.text.includes("-")) {
                //Color it red
                item.fontColor = "#ff0000";
                //Font size 24
                return true;
              } else {
                //Color it green
                item.fontColor = "#088708";
                return true;
              }
            }
          },
        },
      },
      datalabels: {
        formatter: (val) => {
          return val + "K";
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
          stepSize: objective,
          callback: function (value, index, ticks) {
            return "  " + value + "K";
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

//Create element that sits on top right of scene to show balance
var balanceDiv = document.createElement("div");
balanceDiv.id = "balanceDiv";
balanceDiv.style.position = "absolute";
balanceDiv.style.top = "80px";
balanceDiv.style.right = "50px";
balanceDiv.style.width = "300px";
balanceDiv.style.height = "100px";
//If balance is negative, color it red
if (balance < 0) {
  balanceDiv.style.color = "#ff0000";
} else {
  balanceDiv.style.color = "#088708";
}
balanceDiv.style.fontFamily = "Montserrat Black";
balanceDiv.style.fontSize = "28px";
balanceDiv.style.textAlign = "center";
balanceDiv.style.zIndex = "1000";
balanceDiv.innerHTML =
  "<p style='color:white;margin:0;padding:0;'>Balanço:</p> " + balance + "K";
//Append .scene-3
document.getElementsByClassName("scene-3")[0].appendChild(balanceDiv);
