  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <style>
#sidebar {
    transition: all 0.3s ease;
    z-index: 1030;
}

#sidebar.collapsed {
    margin-left: -250px;
}

#mainContent.collapsed {
    margin-left: 0;
}

@media (max-width: 991.98px) {
    #sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        background: #f8f9fa;
        z-index: 1040;
    }

    #sidebar.showing {
        margin-left: 0 !important;
    }

    #sidebar.collapsed {
        margin-left: -250px !important;
    }

    #mainContent {
        margin-left: 0 !important;
    }

    #toggleSidebar {
        z-index: 1050;
    }
}
  </style>

  <script>
const sidebar = document.querySelector('.d-flex.flex-column'); // sidebar.php tetap asli
sidebar.id = 'sidebar';

const toggleBtn = document.getElementById('toggleSidebar');
const mainContent = document.getElementById('mainContent');

let collapsed = false;

const updateSidebar = () => {
    sidebar.classList.toggle('collapsed');
    mainContent.classList.toggle('collapsed');
    toggleBtn.textContent = sidebar.classList.contains('collapsed') ? '☰' : '✖';
};

toggleBtn?.addEventListener('click', () => {
    updateSidebar();
});

// Auto-collapse on small screens
window.addEventListener('resize', () => {
    if (window.innerWidth < 992) {
        if (!sidebar.classList.contains('collapsed')) updateSidebar();
    } else {
        if (sidebar.classList.contains('collapsed')) updateSidebar();
    }
});

// Collapse on click outside sidebar (mobile only)
document.addEventListener('click', function(event) {
    if (
        window.innerWidth < 992 &&
        !sidebar.contains(event.target) &&
        !toggleBtn.contains(event.target) &&
        !sidebar.classList.contains('collapsed')
    ) {
        updateSidebar();
    }
});
  </script>

  <?php if (!empty($evaluasi)): ?>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
const ctx = document.getElementById('grafikEvaluasi').getContext('2d');

const dataEvaluasi = {
    labels: <?= json_encode(array_map(fn($e) => date('d M Y', strtotime($e['tanggal_evaluasi'])), $evaluasi)) ?>,
    datasets: [{
        label: 'Skor Evaluasi',
        data: <?= json_encode(array_map(fn($e) => (float) $e['skor'], $evaluasi)) ?>,
        borderColor: 'rgba(75, 192, 192, 1)',
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        tension: 0.3,
        fill: true,
    }]
};

const config = {
    type: 'line',
    data: dataEvaluasi,
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                mode: 'index',
                intersect: false
            }
        },
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
};

new Chart(ctx, config);
  </script>
  <?php endif; ?>


  </body>
  <footer class="text-center py-3">
      <div class="container">
          <p class="mb-0">© <?= date('Y') ?> Sistem Dosen. All rights reserved.</p>
      </div>
  </footer>

  </html>