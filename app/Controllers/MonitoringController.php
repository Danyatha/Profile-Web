<?php

namespace App\Controllers;

use App\Models\VisitModel;
use CodeIgniter\CodeIgniter;

/**
 * MonitoringController
 *
 * Halaman Admin > Monitoring:
 * - Statistik kunjungan + pengunjung online (auto-refresh)
 * - Grafik harian & jam ramai (Chart.js)
 * - Top halaman, top referrer, komposisi perangkat & browser
 * - Error log viewer (writable/logs)
 * - Export CSV log kunjungan
 */
class MonitoringController extends BaseAdminController
{
    public function index()
    {
        $visits = new VisitModel();

        return view('control/monitoring', [
            'title'             => 'Web Monitoring',
            'stat_today'        => $visits->countToday(),
            'stat_week'         => $visits->countLastDays(7),
            'stat_month'        => $visits->countLastDays(30),
            'stat_total'        => $visits->countAll(),
            'stat_unique'       => $visits->uniqueToday(),
            'stat_online'       => $visits->onlineNow(5),
            'top_pages'         => $visits->topPages(10, 30),
            'top_referrers'     => $visits->topReferrers(10, 30),
            'recent_visits'     => $visits->recentVisits(20),
            'device_breakdown'  => $visits->deviceBreakdown(30),
            'browser_breakdown' => $visits->browserBreakdown(30),
            'hourly'            => $visits->visitsPerHour(30),
            'error_logs'        => $this->readErrorLogs(50),
            'system_info'       => $this->systemInfo(),
        ]);
    }

    /**
     * Endpoint JSON untuk Chart.js (kunjungan per hari).
     * GET /admin/monitoring/chart-data?days=30
     */
    public function chartData()
    {
        $days = (int) ($this->request->getGet('days') ?? 30);
        $days = max(7, min($days, 90)); // batasi 7-90 hari

        $data = (new VisitModel())->visitsPerDay($days);

        return $this->response->setJSON([
            'labels' => array_map(
                static fn ($row) => date('d M', strtotime($row['tanggal'])),
                $data
            ),
            'values' => array_column($data, 'total'),
        ]);
    }

    /**
     * Endpoint JSON untuk auto-refresh kartu statistik.
     * GET /admin/monitoring/live-stats
     */
    public function liveStats()
    {
        $visits = new VisitModel();

        return $this->response->setJSON([
            'online' => $visits->onlineNow(5),
            'today'  => $visits->countToday(),
            'unique' => $visits->uniqueToday(),
            'time'   => date('H:i:s'),
        ]);
    }

    /**
     * Export log kunjungan 30 hari terakhir sebagai CSV.
     * GET /admin/monitoring/export-csv
     */
    public function exportCsv()
    {
        $rows     = (new VisitModel())->exportRows(30);
        $filename = 'log-kunjungan-' . date('Ymd-His') . '.csv';

        $out = fopen('php://temp', 'r+');
        fputcsv($out, ['Waktu', 'Halaman', 'Perangkat', 'Referrer', 'User Agent']);

        foreach ($rows as $row) {
            fputcsv($out, [
                $row['visited_at'],
                $row['page_url'],
                $row['device'],
                $row['referrer'],
                $row['user_agent'],
            ]);
        }

        rewind($out);
        $csv = stream_get_contents($out);
        fclose($out);

        return $this->response
            ->setHeader('Content-Type', 'text/csv; charset=UTF-8')
            ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->setBody("\xEF\xBB\xBF" . $csv); // BOM agar Excel membaca UTF-8 dengan benar
    }

    /**
     * Hapus log kunjungan lama (> 180 hari).
     */
    public function purge()
    {
        $deleted = (new VisitModel())->purgeOlderThan(180);

        return $this->redirectSuccess(
            'admin/monitoring',
            "Berhasil menghapus {$deleted} log kunjungan yang lebih lama dari 180 hari."
        );
    }

    // ----------------------------------------------------------------

    /**
     * Baca error log CodeIgniter (hari ini + kemarin), ambil N entri terakhir.
     * Format baris CI4: "LEVEL - YYYY-MM-DD HH:MM:SS --> pesan"
     */
    private function readErrorLogs(int $limit = 50): array
    {
        $files = [
            WRITEPATH . 'logs/log-' . date('Y-m-d') . '.log',
            WRITEPATH . 'logs/log-' . date('Y-m-d', strtotime('-1 day')) . '.log',
        ];

        $entries = [];

        foreach ($files as $file) {
            if (! is_file($file) || ! is_readable($file)) {
                continue;
            }

            $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) ?: [];

            foreach ($lines as $line) {
                // Baris entri baru selalu diawali level log
                if (preg_match('/^(CRITICAL|EMERGENCY|ALERT|ERROR|WARNING|NOTICE|INFO|DEBUG)\s*-\s*([\d\-: ]+)\s*-->\s*(.*)$/', $line, $m)) {
                    $entries[] = [
                        'level'   => $m[1],
                        'time'    => trim($m[2]),
                        'message' => mb_substr(trim($m[3]), 0, 300),
                    ];
                } elseif (!empty($entries)) {
                    // Lanjutan stack trace: tempel ke entri terakhir (dibatasi)
                    $last = count($entries) - 1;
                    if (mb_strlen($entries[$last]['message']) < 300) {
                        $entries[$last]['message'] = mb_substr(
                            $entries[$last]['message'] . ' ' . trim($line),
                            0,
                            300
                        );
                    }
                }
            }
        }

        // Terbaru dulu
        usort($entries, static fn ($a, $b) => strcmp($b['time'], $a['time']));

        return array_slice($entries, 0, $limit);
    }

    private function systemInfo(): array
    {
        $db = db_connect();

        try {
            $dbVersion = $db->getVersion();
            $dbStatus  = 'Connected';
        } catch (\Throwable $e) {
            $dbVersion = '-';
            $dbStatus  = 'Error: ' . $e->getMessage();
        }

        $diskTotal = @disk_total_space(FCPATH);
        $diskFree  = @disk_free_space(FCPATH);

        return [
            'php_version' => PHP_VERSION,
            'ci_version'  => CodeIgniter::CI_VERSION,
            'db_driver'   => $db->getPlatform(),
            'db_version'  => $dbVersion,
            'db_status'   => $dbStatus,
            'server_os'   => php_uname('s') . ' ' . php_uname('r'),
            'memory_used' => $this->formatBytes(memory_get_peak_usage(true)),
            'disk_free'   => $diskFree !== false ? $this->formatBytes($diskFree) : '-',
            'disk_total'  => $diskTotal !== false ? $this->formatBytes($diskTotal) : '-',
            'disk_used_pct' => ($diskTotal && $diskFree)
                ? round(($diskTotal - $diskFree) / $diskTotal * 100, 1)
                : null,
            'server_time' => date('d M Y H:i:s'),
            'environment' => ENVIRONMENT,
        ];
    }

    private function formatBytes(float $bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $i     = 0;

        while ($bytes >= 1024 && $i < count($units) - 1) {
            $bytes /= 1024;
            $i++;
        }

        return round($bytes, 1) . ' ' . $units[$i];
    }
}