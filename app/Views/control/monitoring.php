<?= $this->extend('control/layout/admin_layout') ?>

<?= $this->section('content') ?>

<!-- Flash -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<!-- Statistik Kunjungan -->
<div class="row g-4 mb-4">
    <div class="col-md-4 col-xl">
        <div class="stat-card">
            <div class="icon" style="background-color: #ffebee; color: #e53935;">
                <i class="bi bi-broadcast"></i>
            </div>
            <h3 id="statOnline"><?= number_format($stat_online) ?></h3>
            <p>Online Sekarang</p>
            <small class="text-muted">5 menit terakhir · <span id="liveTime">live</span></small>
        </div>
    </div>

    <div class="col-md-4 col-xl">
        <div class="stat-card">
            <div class="icon" style="background-color: #e7f3ff; color: #0d6efd;">
                <i class="bi bi-eye-fill"></i>
            </div>
            <h3 id="statToday"><?= number_format($stat_today) ?></h3>
            <p>Kunjungan Hari Ini</p>
            <small class="text-muted"><i class="bi bi-person-fill"></i> <span id="statUnique"><?= number_format($stat_unique) ?></span> pengunjung unik</small>
        </div>
    </div>

    <div class="col-md-4 col-xl">
        <div class="stat-card">
            <div class="icon" style="background-color: #fff3e0; color: #ff9800;">
                <i class="bi bi-calendar-week-fill"></i>
            </div>
            <h3><?= number_format($stat_week) ?></h3>
            <p>7 Hari Terakhir</p>
        </div>
    </div>

    <div class="col-md-4 col-xl">
        <div class="stat-card">
            <div class="icon" style="background-color: #e8f5e9; color: #4caf50;">
                <i class="bi bi-calendar-month-fill"></i>
            </div>
            <h3><?= number_format($stat_month) ?></h3>
            <p>30 Hari Terakhir</p>
        </div>
    </div>

    <div class="col-md-4 col-xl">
        <div class="stat-card">
            <div class="icon" style="background-color: #f3e5f5; color: #9c27b0;">
                <i class="bi bi-bar-chart-fill"></i>
            </div>
            <h3><?= number_format($stat_total) ?></h3>
            <p>Total Kunjungan</p>
        </div>
    </div>
</div>

<!-- Grafik Harian & Jam Ramai -->
<div class="row g-4 mb-4">
    <div class="col-xl-7">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-graph-up text-primary"></i> Kunjungan Harian</h5>
                <select id="chartRange" class="form-select form-select-sm" style="width:auto;">
                    <option value="7">7 hari</option>
                    <option value="30" selected>30 hari</option>
                    <option value="90">90 hari</option>
                </select>
            </div>
            <div class="card-body">
                <canvas id="visitsChart" height="120"></canvas>
            </div>
        </div>
    </div>

    <div class="col-xl-5">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-clock-fill text-warning"></i> Jam Ramai (30 hari)</h5>
            </div>
            <div class="card-body">
                <canvas id="hourlyChart" height="150"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Perangkat, Browser, Referrer -->
<div class="row g-4 mb-4">
    <div class="col-xl-4 col-md-6">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-phone-fill text-success"></i> Perangkat (30 hari)</h5>
            </div>
            <div class="card-body">
                <?php if (empty($device_breakdown)): ?>
                    <p class="text-muted mb-0">Belum ada data.</p>
                <?php else: ?>
                    <canvas id="deviceChart" height="200"></canvas>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-browser-chrome text-primary"></i> Browser (30 hari)</h5>
            </div>
            <div class="card-body">
                <?php if (empty($browser_breakdown)): ?>
                    <p class="text-muted mb-0">Belum ada data.</p>
                <?php else: ?>
                    <canvas id="browserChart" height="200"></canvas>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-xl-4">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-box-arrow-in-right text-info"></i> Top Referrer (30 hari)</h5>
            </div>
            <div class="card-body p-0">
                <?php if (empty($top_referrers)): ?>
                    <p class="text-muted p-3 mb-0">Belum ada data.</p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover table-sm align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Sumber</th>
                                    <th class="text-end">Kunjungan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($top_referrers as $ref): ?>
                                    <tr>
                                        <td>
                                            <small class="text-truncate d-inline-block" style="max-width:200px;">
                                                <?php if ($ref['host'] === 'Direct / Bookmark'): ?>
                                                    <i class="bi bi-bookmark-fill text-secondary me-1"></i>
                                                <?php else: ?>
                                                    <i class="bi bi-globe2 text-primary me-1"></i>
                                                <?php endif; ?>
                                                <?= esc($ref['host']) ?>
                                            </small>
                                        </td>
                                        <td class="text-end fw-bold"><?= number_format($ref['total']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Top Pages & Recent Visits -->
<div class="row g-4 mb-4">
    <div class="col-xl-5">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-fire text-danger"></i> Halaman Terpopuler (30 hari)</h5>
            </div>
            <div class="card-body p-0">
                <?php if (empty($top_pages)): ?>
                    <p class="text-muted p-3 mb-0">Belum ada data kunjungan.</p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Halaman</th>
                                    <th class="text-end">Kunjungan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($top_pages as $i => $page): ?>
                                    <tr>
                                        <td><?= $i + 1 ?></td>
                                        <td>
                                            <a href="<?= base_url(ltrim($page['page_url'], '/')) ?>" target="_blank"
                                                class="text-decoration-none text-truncate d-inline-block" style="max-width:230px;">
                                                <?= esc($page['page_url']) ?>
                                            </a>
                                        </td>
                                        <td class="text-end fw-bold"><?= number_format($page['total']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-xl-7">
        <div class="card shadow-sm h-100">
            <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap gap-2">
                <h5 class="mb-0"><i class="bi bi-clock-history text-secondary"></i> Kunjungan Terbaru</h5>
                <div class="d-flex gap-2">
                    <a href="<?= base_url('admin/monitoring/export-csv') ?>" class="btn btn-sm btn-outline-success">
                        <i class="bi bi-filetype-csv"></i> Export CSV
                    </a>
                    <form action="<?= base_url('admin/monitoring/purge') ?>" method="post"
                        onsubmit="return confirm('Hapus log kunjungan yang lebih lama dari 180 hari?');">
                        <?= csrf_field() ?>
                        <button class="btn btn-sm btn-outline-danger">
                            <i class="bi bi-trash"></i> Bersihkan Log Lama
                        </button>
                    </form>
                </div>
            </div>
            <div class="card-body p-0">
                <?php if (empty($recent_visits)): ?>
                    <p class="text-muted p-3 mb-0">Belum ada kunjungan tercatat. Buka halaman publik (mis. <a href="<?= base_url('/') ?>" target="_blank">homepage</a>) lalu refresh halaman ini.</p>
                <?php else: ?>
                    <div class="table-responsive" style="max-height:420px; overflow-y:auto;">
                        <table class="table table-hover table-sm align-middle mb-0">
                            <thead class="table-light" style="position:sticky; top:0;">
                                <tr>
                                    <th>Waktu</th>
                                    <th>Halaman</th>
                                    <th>Perangkat</th>
                                    <th>Referrer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recent_visits as $v): ?>
                                    <tr>
                                        <td class="text-nowrap"><small><?= date('d M H:i', strtotime($v['visited_at'])) ?></small></td>
                                        <td><small class="text-truncate d-inline-block" style="max-width:220px;"><?= esc($v['page_url']) ?></small></td>
                                        <td>
                                            <?php
                                            $badge = match ($v['device']) {
                                                'mobile'  => 'bg-success',
                                                'tablet'  => 'bg-info',
                                                'bot'     => 'bg-secondary',
                                                default   => 'bg-primary',
                                            };
                                            ?>
                                            <span class="badge <?= $badge ?>"><?= esc($v['device'] ?? '-') ?></span>
                                        </td>
                                        <td><small class="text-muted text-truncate d-inline-block" style="max-width:160px;"><?= esc($v['referrer'] ?: '—') ?></small></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Error Log -->
<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="bi bi-bug-fill text-danger"></i> Error Log Aplikasi <small class="text-muted fw-normal">(hari ini & kemarin, 50 entri terakhir)</small></h5>
                <select id="logFilter" class="form-select form-select-sm" style="width:auto;">
                    <option value="">Semua level</option>
                    <option value="CRITICAL">Critical</option>
                    <option value="ERROR">Error</option>
                    <option value="WARNING">Warning</option>
                    <option value="INFO">Info</option>
                    <option value="DEBUG">Debug</option>
                </select>
            </div>
            <div class="card-body p-0">
                <?php if (empty($error_logs)): ?>
                    <p class="text-success p-3 mb-0"><i class="bi bi-check-circle-fill"></i> Tidak ada log error — aplikasi berjalan bersih.</p>
                <?php else: ?>
                    <div class="table-responsive" style="max-height:360px; overflow-y:auto;">
                        <table class="table table-hover table-sm align-middle mb-0" id="logTable">
                            <thead class="table-light" style="position:sticky; top:0;">
                                <tr>
                                    <th style="width:110px;">Level</th>
                                    <th style="width:160px;">Waktu</th>
                                    <th>Pesan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($error_logs as $log): ?>
                                    <?php
                                    $logBadge = match ($log['level']) {
                                        'CRITICAL', 'EMERGENCY', 'ALERT' => 'bg-danger',
                                        'ERROR'                          => 'bg-danger',
                                        'WARNING'                        => 'bg-warning text-dark',
                                        'NOTICE', 'INFO'                 => 'bg-info text-dark',
                                        default                          => 'bg-secondary',
                                    };
                                    ?>
                                    <tr data-level="<?= esc($log['level']) ?>">
                                        <td><span class="badge <?= $logBadge ?>"><?= esc($log['level']) ?></span></td>
                                        <td class="text-nowrap"><small><?= esc($log['time']) ?></small></td>
                                        <td><small class="font-monospace"><?= esc($log['message']) ?></small></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Info Sistem -->
<div class="row g-4">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="bi bi-hdd-rack-fill text-info"></i> Info Sistem</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3 col-6">
                        <small class="text-muted d-block">PHP</small>
                        <span class="fw-semibold"><?= esc($system_info['php_version']) ?></span>
                    </div>
                    <div class="col-md-3 col-6">
                        <small class="text-muted d-block">CodeIgniter</small>
                        <span class="fw-semibold"><?= esc($system_info['ci_version']) ?></span>
                    </div>
                    <div class="col-md-3 col-6">
                        <small class="text-muted d-block">Database</small>
                        <span class="fw-semibold"><?= esc($system_info['db_driver']) ?> <?= esc($system_info['db_version']) ?></span>
                        <span class="badge <?= $system_info['db_status'] === 'Connected' ? 'bg-success' : 'bg-danger' ?> ms-1">
                            <?= esc($system_info['db_status']) ?>
                        </span>
                    </div>
                    <div class="col-md-3 col-6">
                        <small class="text-muted d-block">Server OS</small>
                        <span class="fw-semibold"><?= esc($system_info['server_os']) ?></span>
                    </div>
                    <div class="col-md-3 col-6">
                        <small class="text-muted d-block">Memory (peak)</small>
                        <span class="fw-semibold"><?= esc($system_info['memory_used']) ?></span>
                    </div>
                    <div class="col-md-3 col-6">
                        <small class="text-muted d-block">Disk</small>
                        <span class="fw-semibold"><?= esc($system_info['disk_free']) ?> free / <?= esc($system_info['disk_total']) ?></span>
                        <?php if ($system_info['disk_used_pct'] !== null): ?>
                            <div class="progress mt-1" style="height:6px;">
                                <div class="progress-bar <?= $system_info['disk_used_pct'] > 85 ? 'bg-danger' : 'bg-info' ?>"
                                    style="width: <?= $system_info['disk_used_pct'] ?>%"></div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-3 col-6">
                        <small class="text-muted d-block">Environment</small>
                        <span class="badge <?= $system_info['environment'] === 'production' ? 'bg-success' : 'bg-warning text-dark' ?>">
                            <?= esc($system_info['environment']) ?>
                        </span>
                    </div>
                    <div class="col-md-3 col-6">
                        <small class="text-muted d-block">Waktu Server</small>
                        <span class="fw-semibold"><?= esc($system_info['server_time']) ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    // ── Grafik kunjungan harian ──
    let visitsChart = null;

    async function loadVisitsChart(days) {
        const res = await fetch('<?= base_url('admin/monitoring/chart-data') ?>?days=' + days);
        const data = await res.json();

        const ctx = document.getElementById('visitsChart').getContext('2d');

        if (visitsChart) visitsChart.destroy();

        visitsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: data.labels,
                datasets: [{
                    label: 'Kunjungan',
                    data: data.values,
                    borderColor: '#0d6efd',
                    backgroundColor: 'rgba(13, 110, 253, 0.08)',
                    fill: true,
                    tension: 0.35,
                    pointRadius: 2,
                    pointHoverRadius: 5,
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
            }
        });
    }

    document.getElementById('chartRange').addEventListener('change', e => loadVisitsChart(e.target.value));
    loadVisitsChart(30);

    // ── Grafik jam ramai ──
    new Chart(document.getElementById('hourlyChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_map(static fn($h) => sprintf('%02d', $h['jam']), $hourly)) ?>,
            datasets: [{
                label: 'Kunjungan',
                data: <?= json_encode(array_column($hourly, 'total')) ?>,
                backgroundColor: 'rgba(255, 152, 0, 0.55)',
                borderColor: '#ff9800',
                borderWidth: 1,
                borderRadius: 4,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: { callbacks: { title: items => 'Jam ' + items[0].label + ':00' } }
            },
            scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
        }
    });

    // ── Grafik perangkat ──
    <?php if (!empty($device_breakdown)): ?>
        new Chart(document.getElementById('deviceChart').getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: <?= json_encode(array_map(static fn($d) => ucfirst($d['device'] ?? '-'), $device_breakdown)) ?>,
                datasets: [{
                    data: <?= json_encode(array_map(static fn($d) => (int) $d['total'], $device_breakdown)) ?>,
                    backgroundColor: ['#0d6efd', '#4caf50', '#ff9800', '#9c27b0', '#6c757d'],
                }]
            },
            options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
        });
    <?php endif; ?>

    // ── Grafik browser ──
    <?php if (!empty($browser_breakdown)): ?>
        new Chart(document.getElementById('browserChart').getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: <?= json_encode(array_column($browser_breakdown, 'browser')) ?>,
                datasets: [{
                    data: <?= json_encode(array_map(static fn($b) => (int) $b['total'], $browser_breakdown)) ?>,
                    backgroundColor: ['#0d6efd', '#ff9800', '#4caf50', '#e53935', '#9c27b0', '#6c757d', '#00bcd4'],
                }]
            },
            options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
        });
    <?php endif; ?>

    // ── Auto-refresh statistik live (tiap 60 detik) ──
    async function refreshLiveStats() {
        try {
            const res = await fetch('<?= base_url('admin/monitoring/live-stats') ?>');
            if (!res.ok) return;
            const d = await res.json();
            document.getElementById('statOnline').textContent = d.online.toLocaleString('id-ID');
            document.getElementById('statToday').textContent = d.today.toLocaleString('id-ID');
            document.getElementById('statUnique').textContent = d.unique.toLocaleString('id-ID');
            document.getElementById('liveTime').textContent = 'update ' + d.time;
        } catch (e) {
            /* abaikan kegagalan polling */
        }
    }
    setInterval(refreshLiveStats, 60000);

    // ── Filter level error log ──
    const logFilter = document.getElementById('logFilter');
    if (logFilter) {
        logFilter.addEventListener('change', () => {
            const level = logFilter.value;
            document.querySelectorAll('#logTable tbody tr').forEach(tr => {
                tr.style.display = (!level || tr.dataset.level === level) ? '' : 'none';
            });
        });
    }
</script>
<?= $this->endSection() ?>