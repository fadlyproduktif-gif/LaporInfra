import { Chart } from "chart.js/auto";
console.log("chart js berahasil di import");

const canvas = document.getElementById("laporanChart");
console.log(window.dataGrafik);
// console.log(canvas);

const labels = window.dataGrafik.map((item) => item.kategori);
const values = window.dataGrafik.map((item) => item.total);

new Chart(canvas, {
    type: "bar",
    data: {
        labels: labels,
        datasets: [
            {
                label: "jumlah data",
                data: values,
                backgroundColor: "#78b7e5",
                borderRadius: 5,
                maxBarThickness: 80,
            },
        ],
    },
   options: {
    responsive: true,
    maintainAspectRatio: false,

    plugins: {
        legend: {
            display: false
        }
    },

    scales: {
        y: {
            beginAtZero: true,

            ticks: {
                precision: 0
            },

            grid: {
                color: '#e6eaf0'
            }
        },

        x: {
            grid: {
                display: false
            }
        }
    }
},
});
