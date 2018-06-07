/**
  * Haulage Management System - haulage-management-charts.js
  *
  * The javascript file to load ajax data and create charts. 
  *
  *
  * 2018 (c) Rhys Evans <rhys301097@gmail.com>
  *
  * @author Rhys Evans <rhys301097@gmail.com>
  * @version 0.1
  */

$(document).ready(function(){
	$.ajax({
    dataType: "json",
		url: "/journeys/dailyJourneysData",
		method: "GET",
		success: function(data) {
			var date = [];
			var noJourneys = [];

			for(var i in data) {
				date.push(data[i].date);
				noJourneys.push(data[i].noJourneys);
			}

			var chartdata = {
				labels: date,
				datasets : [
					{
						label: 'Logged Journeys',
            backgroundColor: "rgba(2,117,216,0.2)",
            borderColor: "rgba(2,117,216,1)",
            pointBackgroundColor: "rgba(2,117,216,1)",
            pointBorderColor: "rgba(255,255,255,0.8)",
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(2,117,216,1)",
            pointHitRadius: 20,
            pointBorderWidth: 2,
						data: noJourneys
					}
				]
			};

      var charoptions = {
        legend: {
          display: false
        }
      };

			var ctx = $("#journeysChart");

			var lineGraph = new Chart(ctx, {
				type: 'line',
				data: chartdata,
        options: charoptions
			});
		},
		error: function(data) {
			console.log('error loading journey information');
		}
	});
});
