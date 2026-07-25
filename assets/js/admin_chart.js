// assets/js/admin_chart.js
let omsetChartInstance = null; // Menyimpan grafik agar bisa dihapus/di-update

function loadChart(filter) {
    // Panggil file PHP
    fetch(`get_chart_data.php?filter=${filter}`)
        .then(response => response.json())
        .then(result => {
            const ctx = document.getElementById('omsetChart').getContext('2d');
            
            // Jika ada grafik sebelumnya, hancurkan dulu agar tidak tumpang tindih
            if (omsetChartInstance) {
                omsetChartInstance.destroy(); 
            }

            // Buat grafik baru dengan Chart.js
            omsetChartInstance = new Chart(ctx, {
                type: 'bar', // Coba ubah jadi 'line' jika Anda lebih suka grafik garis
                data: {
                    labels: result.labels,
                    datasets: [{
                        label: `Total Omset (Rp) - ${filter === 'hari' ? '7 Hari Terakhir' : 'Bulanan'}`,
                        data: result.data,
                        backgroundColor: 'rgba(211, 47, 47, 0.7)', // Merah transparan
                        borderColor: 'rgba(211, 47, 47, 1)',       // Merah solid
                        borderWidth: 2,
                        borderRadius: 5 // Membuat ujung batang grafik melengkung
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: { 
                            beginAtZero: true 
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Gagal memuat data grafik:', error));
}

// Jalankan grafik 'hari' secara otomatis saat halaman pertama kali dibuka
document.addEventListener("DOMContentLoaded", () => {
    loadChart('hari');
});