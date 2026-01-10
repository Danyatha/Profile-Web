<?php

namespace App\Controllers;

use App\Models\PortfolioModel;
use CodeIgniter\Controller;

class PortfolioPublicController extends Controller
{
    protected $portfolioModel;

    public function __construct()
    {
        $this->portfolioModel = new PortfolioModel();
    }

    // Halaman utama portfolio public
    public function index()
    {
        $rows = $this->portfolioModel
            ->select('technologies_used')
            ->findAll();

        $technologies = [];

        foreach ($rows as $row) {
            if (! empty($row['technologies_used'])) {
                $techs = array_map('trim', explode(',', $row['technologies_used']));
                $technologies = array_merge($technologies, $techs);
            }
        }

        $technologies = array_unique($technologies);
        sort($technologies);

        $data = [
            'title'        => 'Portfolio',
            'subtitle'     => 'All portfolios that i have done so far',
            'portfolios'   => $this->portfolioModel->findAll(),
            'technologies' => $technologies,
            'tech_filter'  => null
        ];

        return view('portfolio/portfolio', $data);
    }

    // Detail portfolio untuk public
    public function detail($id)
    {
        $portfolio = $this->portfolioModel->getPortfolioById($id);

        if (!$portfolio) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Portfolio tidak ditemukan'
            ])->setStatusCode(404);
        }

        return $this->response->setJSON([
            'success' => true,
            'data' => $portfolio
        ]);
    }
    // Filter berdasarkan teknologi
    public function filter()
    {
        $tech = $this->request->getGet('tech');

        // ambil semua technologies_used
        $rows = $this->portfolioModel
            ->select('technologies_used')
            ->findAll();

        // olah jadi array unik
        $technologies = [];

        foreach ($rows as $row) {
            if (! empty($row['technologies_used'])) {
                $techs = array_map('trim', explode(',', $row['technologies_used']));
                $technologies = array_merge($technologies, $techs);
            }
        }

        $technologies = array_unique($technologies);
        sort($technologies);

        // filter portfolio
        if ($tech) {
            $portfolios = $this->portfolioModel
                ->like('technologies_used', $tech)
                ->findAll();
        } else {
            $portfolios = $this->portfolioModel->findAll();
        }

        $data = [
            'title'        => 'Portfolio',
            'subtitle'     => $tech
                ? 'Filtered by technology: ' . $tech
                : 'All portfolios',
            'portfolios'   => $portfolios,
            'technologies' => $technologies,
            'tech_filter'  => $tech
        ];

        return view('portfolio/portfolio', $data);
    }
}
