<?php

namespace App\Controllers;

// use App\Models\PortfolioModel;

class PortfolioController extends BaseController
{
    protected $portfolioModel;

    public function __construct()
    {
        // $this->portfolioModel = new PortfolioModel();
    }

    public function index()
    {
        $data = [
            // 'portfolios' => $this->portfolioModel->findAll(),
            'title' => 'Portfolio',
        ];
        return view('portfolio/portfolio', $data);
    }

    // public function show($id)
    // {
    //     $data['portfolio'] = $this->portfolioModel->find($id);
    //     return view('portfolio/show', $data);
    // }
}
