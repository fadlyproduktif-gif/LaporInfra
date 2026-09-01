import { Chart } from 'chart.js/auto';
console.log('chart js berahasil di import');

const canvas = document.getElementById('laporanChart');
console.log(window.dataGrafik);
console.log(canvas);

const labels = window.dataGrafik.map(item => item.kategori);
const values = window.dataGrafik.map(item => item.total);

new Chart(canvas, {
    type: 'Bar',
    data: {
        labels : labels,
        datasets : [
        {
            label:'jumlah data',
            data: values
        }
        ]
    },
    options:{
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
            }
        }
    }

});