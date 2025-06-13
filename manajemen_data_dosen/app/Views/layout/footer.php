    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
const toggleBtn = document.getElementById('toggleSidebar');
const sidebar = document.querySelector('.sidebar');
const mainContent = document.getElementById('mainContent');

// Saat tombol diklik, toggle class collapsed
toggleBtn?.addEventListener('click', () => {
    sidebar.classList.toggle('collapsed');
    mainContent.classList.toggle('collapsed');
});

// Klik di luar sidebar → tutup jika mobile
document.addEventListener('click', function(event) {
    if (
        window.innerWidth < 992 &&
        !sidebar.contains(event.target) &&
        !toggleBtn.contains(event.target) &&
        !sidebar.classList.contains('collapsed')
    ) {
        sidebar.classList.add('collapsed');
        mainContent.classList.remove('collapsed');
    }
});

// Otomatis collapse saat resize ke mobile
window.addEventListener('resize', () => {
    if (window.innerWidth < 992) {
        sidebar.classList.add('collapsed');
        mainContent.classList.remove('collapsed');
    } else {
        sidebar.classList.remove('collapsed');
        mainContent.classList.remove('collapsed');
    }
});

const themeToggle = document.getElementById('toggleTheme');
if (localStorage.getItem('theme') === 'dark') {
    document.body.classList.add('dark-mode');
}
themeToggle?.addEventListener('click', () => {
    document.body.classList.toggle('dark-mode');
    localStorage.setItem('theme', document.body.classList.contains('dark-mode') ? 'dark' : 'light');
});
    </script>

    <?php if (!empty($evaluasi)): ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
const ctx = document.getElementById('grafikEvaluasi')?.getContext('2d');
if (ctx) {
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?= json_encode(array_map(fn($e) => date('d M Y', strtotime($e['tanggal_evaluasi'])), $evaluasi)) ?>,
            datasets: [{
                label: 'Skor Evaluasi',
                data: <?= json_encode(array_map(fn($e) => (float) $e['skor'], $evaluasi)) ?>,
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                tension: 0.3,
                fill: true
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    suggestedMax: 100,
                    title: {
                        display: true,
                        text: 'Skor (%)'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Tanggal'
                    }
                }
            }
        }
    });
}
    </script>
    <?php endif; ?>

    <footer class="text-center py-3 bg-light border-top mt-auto">
        <div class="container">
            <p class="mb-0">&copy; <?= date('Y') ?> Sistem Dosen. All rights reserved.</p>
        </div>
    </footer>
    </body>

    </html>