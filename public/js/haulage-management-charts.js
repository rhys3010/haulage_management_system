var ctx = document.getElementById("hauliersPieChart");
var myPieChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["SJTL", "KNO", "DHLNE", "KAM"],
    datasets: [{
      data: [51, 29, 40, 34],
      backgroundColor: ['#007bff', '#dc3545', '#ffc107', '#28a745'],
    }],
  },
});

var ctx = document.getElementById("journeysChart");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: ["May 1", "May 2", "May 3", "May 4", "May 5", "May 6", "May 7", "May 8", "May 9", "May 10", "May 11", "May 12", "May 13"],
    datasets: [{
      label: "Logged Journeys",
      lineTension: 0.3,
      backgroundColor: "rgba(2,117,216,0.2)",
      borderColor: "rgba(2,117,216,1)",
      pointRadius: 5,
      pointBackgroundColor: "rgba(2,117,216,1)",
      pointBorderColor: "rgba(255,255,255,0.8)",
      pointHoverRadius: 5,
      pointHoverBackgroundColor: "rgba(2,117,216,1)",
      pointHitRadius: 20,
      pointBorderWidth: 2,
      data: [57, 63, 90, 87, 78, 98, 100, 120, 55, 97, 63, 78, 53],
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          max: 130,
          maxTicksLimit: 5
        },
        gridLines: {
          color: "rgba(0, 0, 0, .125)",
        }
      }],
    },
    legend: {
      display: false
    }
  }
});
