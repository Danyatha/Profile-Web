<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('profile', 'ProfileController::index');

service('auth')->routes($routes);

$routes->group('admin', function ($routes) {
    $routes->get('dashboard', 'DashboardController::dashboard', ['filter' => 'auth']);
    $routes->get('portfolio', 'PortfolioController::index', ['filter' => 'auth']);
    $routes->get('skills', 'SkillController::index', ['filter' => 'auth']);
    $routes->get('certificates', 'CertificatesController::index', ['filter' => 'auth']);
    $routes->get('experiences', 'WorkExperienceController::index', ['filter' => 'auth']);
    $routes->group('experiences', function ($routes) {
        $routes->get('create', 'WorkExperienceController::create');
        $routes->post('store', 'WorkExperienceController::store');
        $routes->get('show/(:num)', 'WorkExperienceController::show/$1');
        $routes->get('edit/(:num)', 'WorkExperienceController::edit/$1');
        $routes->put('update/(:num)', 'WorkExperienceController::update/$1');
        $routes->post('update/(:num)', 'WorkExperienceController::update/$1');
        $routes->delete('delete/(:num)', 'WorkExperienceController::delete/$1');
        $routes->post('delete/(:num)', 'WorkExperienceController::delete/$1');
        $routes->post('delete-image', 'WorkExperienceController::deleteImage');
        $routes->get('json', 'WorkExperienceController::getWorkExperienceJson');
    });
    $routes->group('skills', function ($routes) {
        $routes->get('create', 'SkillController::create');
        $routes->post('store', 'SkillController::store');
        $routes->get('show/(:num)', 'SkillController::show/$1');
        $routes->get('edit/(:num)', 'SkillController::edit/$1');
        $routes->put('update/(:num)', 'SkillController::update/$1');
        $routes->post('update/(:num)', 'SkillController::update/$1');
        $routes->delete('delete/(:num)', 'SkillController::delete/$1');
        $routes->post('delete/(:num)', 'SkillController::delete/$1');
        $routes->get('delete/(:num)', 'SkillController::delete/$1');
    });
    $routes->get('profile', 'ProfileController::index', ['filter' => 'auth']);
});

$routes->get('work-experiences', 'ExperiencePublicController::index');
$routes->get('work-experiences/(:num)', 'ExperiencePublicController::detail/$1');

$routes->get('skills', 'SkillPublicController::index');
$routes->get('skills/(:num)', 'SkillPublicController::detail/$1');
