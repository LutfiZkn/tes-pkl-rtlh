import Chart from "chart.js/auto";

// Grafik Kondisi Rumah
const canvas = document.getElementById("kondisiChart");

if (canvas) {
    new Chart(canvas, {
        type: "bar",

        data: {
            labels: ["Rusak Ringan", "Rusak Sedang", "Rusak Berat"],
            datasets: [
                {
                    label: "Jumlah Rumah",
                    data: [
                        Number(canvas.dataset.ringan),
                        Number(canvas.dataset.sedang),
                        Number(canvas.dataset.berat),
                    ],
                    borderWidth: 1,
                },
            ],
        },

        options: {
            responsive: true,
            maintainAspectRatio: false,

            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0,
                    },
                },
            },

            plugins: {
                legend: {
                    display: false,
                },
            },
        },
    });
}

// Grafik Verifikasi Rumah
const statusCanvas = document.getElementById("statusChart");

if (statusCanvas) {
    new Chart(statusCanvas, {
        type: "pie",

        data: {
            labels: ["Belum Diverifikasi (Pending)", "Terverifikasi", "Ditolak"],

            datasets: [
                {
                    data: [
                        Number(statusCanvas.dataset.belum),
                        Number(statusCanvas.dataset.terverifikasi),
                        Number(statusCanvas.dataset.ditolak),
                    ],

                    backgroundColor: [
                        "rgb(247, 149, 13)", // Belum Verif
                        "rgb(18, 160, 226)", // Teverif
                        "rgb(255, 1, 1)", // Ditolak
                    ],
                    borderWidth: 1,
                },
            ],
        },

        options: {
            responsive: true,
            maintainAspectRatio: false,

            plugins: {
                legend: {
                    position: "bottom",
                },
            },
        },
    });
}
