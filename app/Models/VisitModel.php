<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitModel extends Model
{
    protected $table            = 'visits';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useTimestamps    = false;

    protected $allowedFields = [
        'page_url',
        'ip_hash',
        'user_agent',
        'referrer',
        'device',
        'visited_at',
    ];

    // ----------------------------------------------------------------
    // Statistik dasar
    // ----------------------------------------------------------------

    public function countToday(): int
    {
        return $this->where('visited_at >=', date('Y-m-d 00:00:00'))->countAllResults();
    }

    public function countLastDays(int $days): int
    {
        return $this->where('visited_at >=', date('Y-m-d 00:00:00', strtotime("-{$days} days")))
            ->countAllResults();
    }

    public function countAll(): int
    {
        return $this->countAllResults();
    }

    /**
     * Pengunjung unik hari ini (berdasarkan ip_hash).
     */
    public function uniqueToday(): int
    {
        return $this->select('ip_hash')
            ->where('visited_at >=', date('Y-m-d 00:00:00'))
            ->groupBy('ip_hash')
            ->countAllResults();
    }

    /**
     * Pengunjung "online" = ip_hash unik dalam N menit terakhir.
     */
    public function onlineNow(int $minutes = 5): int
    {
        return $this->select('ip_hash')
            ->where('visited_at >=', date('Y-m-d H:i:s', strtotime("-{$minutes} minutes")))
            ->groupBy('ip_hash')
            ->countAllResults();
    }

    // ----------------------------------------------------------------
    // Data grafik
    // ----------------------------------------------------------------

    /**
     * Jumlah kunjungan per hari, N hari terakhir.
     * Hari tanpa kunjungan tetap diisi 0 agar chart tidak bolong.
     */
    public function visitsPerDay(int $days = 30): array
    {
        $start = date('Y-m-d 00:00:00', strtotime('-' . ($days - 1) . ' days'));

        $rows = $this->select("DATE(visited_at) AS tanggal, COUNT(*) AS total")
            ->where('visited_at >=', $start)
            ->groupBy('DATE(visited_at)')
            ->orderBy('tanggal', 'ASC')
            ->findAll();

        $map = array_column($rows, 'total', 'tanggal');

        $result = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $date     = date('Y-m-d', strtotime("-{$i} days"));
            $result[] = [
                'tanggal' => $date,
                'total'   => (int) ($map[$date] ?? 0),
            ];
        }

        return $result;
    }

    /**
     * Distribusi kunjungan per jam (0-23), N hari terakhir.
     * Untuk mengetahui jam ramai.
     */
    public function visitsPerHour(int $days = 30): array
    {
        $start = date('Y-m-d 00:00:00', strtotime("-{$days} days"));

        $rows = $this->select('HOUR(visited_at) AS jam, COUNT(*) AS total')
            ->where('visited_at >=', $start)
            ->groupBy('HOUR(visited_at)')
            ->findAll();

        $map = array_column($rows, 'total', 'jam');

        $result = [];
        for ($h = 0; $h < 24; $h++) {
            $result[] = [
                'jam'   => $h,
                'total' => (int) ($map[$h] ?? 0),
            ];
        }

        return $result;
    }

    // ----------------------------------------------------------------
    // Breakdown
    // ----------------------------------------------------------------

    /**
     * Halaman paling sering dikunjungi.
     */
    public function topPages(int $limit = 10, int $days = 30): array
    {
        return $this->select('page_url, COUNT(*) AS total')
            ->where('visited_at >=', date('Y-m-d 00:00:00', strtotime("-{$days} days")))
            ->groupBy('page_url')
            ->orderBy('total', 'DESC')
            ->findAll($limit);
    }

    /**
     * Referrer teratas, digabung per domain (host).
     * Kunjungan tanpa referrer dihitung sebagai "Direct / Bookmark".
     */
    public function topReferrers(int $limit = 10, int $days = 30): array
    {
        $rows = $this->select('referrer, COUNT(*) AS total')
            ->where('visited_at >=', date('Y-m-d 00:00:00', strtotime("-{$days} days")))
            ->groupBy('referrer')
            ->findAll();

        $hosts = [];

        foreach ($rows as $row) {
            $host = 'Direct / Bookmark';

            if (!empty($row['referrer'])) {
                $parsed = parse_url($row['referrer'], PHP_URL_HOST);
                $host   = $parsed ? preg_replace('/^www\./', '', $parsed) : $row['referrer'];
            }

            $hosts[$host] = ($hosts[$host] ?? 0) + (int) $row['total'];
        }

        arsort($hosts);

        $result = [];
        foreach (array_slice($hosts, 0, $limit, true) as $host => $total) {
            $result[] = ['host' => $host, 'total' => $total];
        }

        return $result;
    }

    /**
     * Komposisi perangkat (desktop/mobile/tablet/bot), N hari terakhir.
     */
    public function deviceBreakdown(int $days = 30): array
    {
        return $this->select('device, COUNT(*) AS total')
            ->where('visited_at >=', date('Y-m-d 00:00:00', strtotime("-{$days} days")))
            ->groupBy('device')
            ->orderBy('total', 'DESC')
            ->findAll();
    }

    /**
     * Komposisi browser, dideteksi dari user agent via SQL CASE.
     * Urutan pengecekan penting: UA Edge/Opera juga mengandung kata "Chrome".
     */
    public function browserBreakdown(int $days = 30): array
    {
        $start = date('Y-m-d 00:00:00', strtotime("-{$days} days"));

        $sql = "SELECT
                    CASE
                        WHEN user_agent LIKE '%Edg%'                                THEN 'Edge'
                        WHEN user_agent LIKE '%OPR%' OR user_agent LIKE '%Opera%'   THEN 'Opera'
                        WHEN user_agent LIKE '%SamsungBrowser%'                     THEN 'Samsung Internet'
                        WHEN user_agent LIKE '%Firefox%'                            THEN 'Firefox'
                        WHEN user_agent LIKE '%Chrome%'                             THEN 'Chrome'
                        WHEN user_agent LIKE '%Safari%'                             THEN 'Safari'
                        ELSE 'Lainnya'
                    END AS browser,
                    COUNT(*) AS total
                FROM {$this->table}
                WHERE visited_at >= ?
                GROUP BY browser
                ORDER BY total DESC";

        return $this->db->query($sql, [$start])->getResultArray();
    }

    // ----------------------------------------------------------------
    // Lain-lain
    // ----------------------------------------------------------------

    /**
     * Kunjungan terbaru.
     */
    public function recentVisits(int $limit = 20): array
    {
        return $this->orderBy('visited_at', 'DESC')->findAll($limit);
    }

    /**
     * Baris untuk export CSV.
     */
    public function exportRows(int $days = 30): array
    {
        return $this->select('visited_at, page_url, device, referrer, user_agent')
            ->where('visited_at >=', date('Y-m-d 00:00:00', strtotime("-{$days} days")))
            ->orderBy('visited_at', 'DESC')
            ->findAll();
    }

    /**
     * Hapus log lebih lama dari N hari (housekeeping).
     */
    public function purgeOlderThan(int $days = 180): int
    {
        $this->where('visited_at <', date('Y-m-d 00:00:00', strtotime("-{$days} days")))
            ->delete();

        return $this->db->affectedRows();
    }
}