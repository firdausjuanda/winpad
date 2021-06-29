<!-- LINE CHART -->
<div class="card card-info">
	<div class="card-header">
	<h3 class="card-title">Line Chart</h3>

	<div class="card-tools">
		<button type="button" class="btn btn-tool" data-card-widget="collapse">
		<i class="fas fa-minus"></i>
		</button>
		<button type="button" class="btn btn-tool" data-card-widget="remove">
		<i class="fas fa-times"></i>
		</button>
	</div>
	</div>
	<div class="card-body">
	<div class="chart">
		<canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
	</div>
	</div>
</div>
<script>

	var areaChartCanvas = document.getElementById('#areaChart').getContext('2d')

	var chart = new Chart(areaChartCanvas, {
        // The type of chart we want to create
        type: 'bar',
        // The data for our dataset
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [{
                label:'Data Jurusan Mahasiswa ',
                backgroundColor: ['rgb(255, 99, 132)', 'rgba(56, 86, 255, 0.87)', 'rgb(60, 179, 113)','rgb(175, 238, 239)'],
                borderColor: ['rgb(255, 99, 132)'],
                data: [28, 48, 40, 19, 86, 27, 90]
            }]
        },
		options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }
        }
    });
</script>
	// var areaChartData = {
	// labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
	// datasets: [
	// 	{
	// 	label               : 'Digital Goods',
	// 	backgroundColor     : 'rgba(60,141,188,0.9)',
	// 	borderColor         : 'rgba(60,141,188,0.8)',
	// 	pointRadius          : false,
	// 	pointColor          : '#3b8bba',
	// 	pointStrokeColor    : 'rgba(60,141,188,1)',
	// 	pointHighlightFill  : '#fff',
	// 	pointHighlightStroke: 'rgba(60,141,188,1)',
	// 	data                : [28, 48, 40, 19, 86, 27, 90]
	// 	},
	// 	{
	// 	label               : 'Electronics',
	// 	backgroundColor     : 'rgba(210, 214, 222, 1)',
	// 	borderColor         : 'rgba(210, 214, 222, 1)',
	// 	pointRadius         : false,
	// 	pointColor          : 'rgba(210, 214, 222, 1)',
	// 	pointStrokeColor    : '#c1c7d1',
	// 	pointHighlightFill  : '#fff',
	// 	pointHighlightStroke: 'rgba(220,220,220,1)',
	// 	data                : [65, 59, 80, 81, 56, 55, 40]
	// 	},
	// ]
	// }

	// var areaChartOptions = {
	// maintainAspectRatio : false,
	// responsive : true,
	// legend: {
	// 	display: false
	// },
	// scales: {
	// 	xAxes: [{
	// 	gridLines : {
	// 		display : false,
	// 	}
	// 	}],
	// 	yAxes: [{
	// 	gridLines : {
	// 		display : false,
	// 	}
	// 	}]
	// }
	// }

	// This will get the first returned node in the jQuery collection.
	// new Chart(areaChartCanvas, {
	// type: 'line',
	// data: areaChartData,
	// options: areaChartOptions
	// });

