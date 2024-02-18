const tabEls = document.querySelectorAll('button[data-bs-toggle="tab"]');
Chart.defaults.font.family = "Poppins, sans-serif";
Chart.defaults.color = "#073b4c";

initializeSingleChart(0);

tabEls.forEach(function (tabEl) {
  tabEl.addEventListener("shown.bs.tab", function (event) {
    const index = Array.from(tabEls).indexOf(event.target);
    initializeSingleChart(index);
  });
});

function initializeSingleChart(index) {
  const chart = global_obj.charts[index];
  const chartEl = `myChart${++index}`;
  const chartInstance = Chart.getChart(chartEl);

  if (chartInstance !== undefined) {
    chartInstance.destroy();
  }

  const data = {
    labels: chart.labels,
    datasets: [
      {
        label: chart.legends.legend1,
        data: chart.bars.bar1,
        backgroundColor: "#dc3545"
      },
      {
        label: chart.legends.legend2,
        data: chart.bars.bar2,
        backgroundColor: "#198754"
      }
    ]
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
            size: 25
          },
          padding: {
            top: 15,
            bottom: 15
          }
        },
        legend: {
          position: "bottom",
          labels: {
            padding: 30,
            font: {
              size: 14
            }
          }
        },
        tooltip: {
          enabled: false
        }
      },
      scales: {
        y: {
          ticks: {
            crossAlign: "left",
            callback: function (val) {
              return `${val}%`;
            }
          }
        }
      }
    }
  };

  const ctx = document.getElementById(chartEl).getContext("2d");
  new Chart(ctx, config);
}
