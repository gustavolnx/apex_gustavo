// Ajax GET request to json.php
var request = new XMLHttpRequest();
console.log(request);
request.open("GET", "scrap.php", false);
request.send(null);
var json = JSON.parse(request.responseText);
console.log(json);

var days = json.days;
var real = json.real;
var objective = json.objetivo;

// var days = ["01/01", "02/01", "03/01", "04/01", "05/01", "06/01", "07/01"];
// var real = [50, 0, 0, 0, 0, 0, 0];
// var objective = 100;

var max = objective[objective.length - 1];

Chart.register(ChartDataLabels);

const ctxval1 = document.getElementById("chart_1");

var myChart1 = new Chart(ctxval1, {
  type: "line",
  data: {
    labels: days,
    datasets: [
      {
        label: "Real",
        data: real,
        backgroundColor: "#008dff",
        borderColor: "#008dff",
        borderWidth: 6,
        pointRadius: 6,
        pointHoverRadius: 10,
      },
      {
        label: "Planejado",
        data: objective,
        backgroundColor: "#a8a8a8",
        borderColor: "#a8a8a8",
        borderWidth: 6,
        pointRadius: 6,
        pointHoverRadius: 10,
        pointHitRadius: 20,
      },
    ],
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      //DATA LABELS
      datalabels: {
        display: false,
      },
      //TOOLTIPS
      tooltip: {
        padding: 10,
        caretPadding: 10,
        caretSize: 0,
        titleColor: "#fff",
        bodyColor: "#fff",
        titleFont: {
          size: 20,
          family: "Montserrat Black",
        },
        bodyFont: {
          size: 20,
        },
        boxWidth: 10,
        boxHeight: 10,
        boxPadding: 5,
      },
      //LEGEND
      legend: {
        display: true,
        position: "top",
        align: "center",
        labels: {
          padding: 20,
          color: "#fff",
          usePointStyle: true,
          font: {
            size: 20,
            family: "Arial",
          },
        },
      },
    },
    //SCALES
    scales: {
      x: {
        //Padding
        offset: true,
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
      y: {
        //Max value
        suggestedMax: max,
        min: 0,
        ticks: {
          stepSize: max / 5,
          callback: function (value, index, ticks) {
            //To round value we have to remove the decimal part
            value = value.toString();
            value = value.split(".");
            value = value[0];
            //Then we try to round it using division by 1000
            if (value > 1000) {
              value = value / 1000;
              value = value.toString();
              value = value.split(".");
              value = value[0];
              value = value + "K";
            }

            return " R$" + value + " ";
          },
          font: {
            family: "Montserrat Black",
            size: 16,
          },
          color: "#fff",
        },
      },
    },
    options: {
      animation: {
        duration: 0,
      },
      hover: {
        animationDuration: 0,
      },
      responsiveAnimationDuration: 0,
    },
  },
  plugins: [
    //CustomPlugin for background color
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
