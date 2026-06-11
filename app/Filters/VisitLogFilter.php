<?php

namespace App\Filters;

use App\Models\VisitModel;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Throwable;

/**
 * VisitLogFilter
 *
 * Mencatat setiap kunjungan halaman publik (GET) ke tabel `visits`
 * untuk ditampilkan di halaman Admin > Monitoring.
 *
 * - Halaman admin, login, dan asset tidak dicatat (lihat $globals di Config\Filters).
 * - IP di-hash (SHA-256 + salt harian) demi privasi pengunjung.
 * - Kegagalan logging tidak boleh mengganggu request — dibungkus try/catch.
 */
class VisitLogFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        try {
            // Hanya catat GET request biasa (bukan AJAX/asset)
            if (strtoupper($request->getMethod()) !== 'GET') {
                return;
            }

            if (method_exists($request, 'isAJAX') && $request->isAJAX()) {
                return;
            }

            $path = '/' . ltrim($request->getUri()->getPath(), '/');

            // Lewati path yang bukan "halaman" (asset, favicon, dll.)
            if (preg_match('#\.(css|js|png|jpe?g|webp|gif|svg|ico|woff2?|ttf|map|txt|xml)$#i', $path)) {
                return;
            }

            $userAgent = (string) $request->getUserAgent();

            // Hash IP dengan salt harian: tetap bisa hitung unique visitor harian,
            // tapi IP asli tidak pernah tersimpan.
            $ipHash = hash('sha256', $request->getIPAddress() . '|' . date('Y-m-d'));

            (new VisitModel())->insert([
                'page_url'   => mb_substr($path, 0, 500),
                'ip_hash'    => $ipHash,
                'user_agent' => mb_substr($userAgent, 0, 255),
                'referrer'   => mb_substr((string) $request->getServer('HTTP_REFERER'), 0, 500) ?: null,
                'device'     => $this->detectDevice($userAgent),
                'visited_at' => date('Y-m-d H:i:s'),
            ]);
        } catch (Throwable $e) {
            // Jangan pernah mematikan request hanya karena logging gagal
            log_message('warning', 'VisitLogFilter gagal mencatat kunjungan: ' . $e->getMessage());
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }

    private function detectDevice(string $ua): string
    {
        $ua = strtolower($ua);

        if ($ua === '' || preg_match('/bot|crawl|spider|slurp|curl|wget|httpclient|python-requests/', $ua)) {
            return 'bot';
        }
        if (preg_match('/ipad|tablet/', $ua)) {
            return 'tablet';
        }
        if (preg_match('/mobi|android|iphone/', $ua)) {
            return 'mobile';
        }

        return 'desktop';
    }
}
