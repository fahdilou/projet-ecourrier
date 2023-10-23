// Importation de Chart.js
import Chart from 'chart.js/auto';

// Récupération des données depuis le backend (exemple)
const data = {
    labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin'],
    datasets: [{
        label: 'Ventes',
        data: [12, 19, 3, 5, 2, 3],
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1,
    }]
};

// Création du graphique à colonnes
const ctx = document.getElementById('columnChart').getContext('2d');
const columnChart = new Chart(ctx, {
    type: 'bar',
    data: data,
    options: {
        scales: {
            y: {
                beginAtZero: true,
            },
        },
    },
});
