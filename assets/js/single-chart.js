Chart.defaults.font.family = "Poppins, sans-serif";
Chart.defaults.color = "#073b4c";

const chart = global_obj.chart;

const data = {
	labels: chart.labels,
	datasets: [
		{
			label: chart.legends.legend1,
			data: chart.bars.bar1,
			backgroundColor: "#dc3545",
		},
		{
			label: chart.legends.legend2,
			data: chart.bars.bar2,
			backgroundColor: "#198754",
		},
	],
};

const config = {
	type: "bar",
	data,
	options: {
		plugins: {
			title: {
				display: true,
				text: chart.title,
				position: "top",
				font: {
					size: 25,
				},
				padding: {
					top: 15,
					bottom: 15,
				},
			},
			legend: {
				position: "bottom",
				labels: {
					padding: 30,
					font: {
						size: 14,
					},
				},
			},
			tooltip: {
				enabled: false,
			},
		},
		scales: {
			y: {
				ticks: {
					crossAlign: "left",
					callback: function (val) {
						return `${val}%`;
					},
				},
			},
		},
	},
};

const ctx = document.getElementById("myChart").getContext("2d");
new Chart(ctx, config);
