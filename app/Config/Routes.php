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
    $routes->get('certificates', 'CertificationController::index', ['filter' => 'auth']);
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
    $routes->group('achievement', function ($routes) {
        $routes->get('/', 'AchievementController::index');
        $routes->get('create', 'AchievementController::create');
        $routes->post('store', 'AchievementController::store');
        $routes->get('show/(:num)', 'AchievementController::show/$1');
        $routes->get('edit/(:num)', 'AchievementController::edit/$1');
        $routes->post('update/(:num)', 'AchievementController::update/$1');
        $routes->get('delete/(:num)', 'AchievementController::delete/$1');
    });
    $routes->group('certificates', function ($routes) {
        $routes->get('/', 'CertificationController::index');
        $routes->get('create', 'CertificationController::create');
        $routes->post('store', 'CertificationController::store');
        $routes->get('show/(:num)', 'CertificationController::show/$1');
        $routes->get('edit/(:num)', 'CertificationController::edit/$1');
        $routes->post('update/(:num)', 'CertificationController::update/$1');
        $routes->get('delete/(:num)', 'CertificationController::delete/$1');
    });
    $routes->group('social-media', function ($routes) {
        $routes->get('/', 'SocialMediaController::index');
        $routes->post('create', 'SocialMediaController::create');
        $routes->get('edit/(:num)', 'SocialMediaController::edit/$1');
        $routes->post('update/(:num)', 'SocialMediaController::update/$1');
        $routes->get('delete/(:num)', 'SocialMediaController::delete/$1');
        $routes->post('delete/(:num)', 'SocialMediaController::delete/$1');
        $routes->post('store', 'SocialMediaController::store');
    });
    $routes->group('portfolio', function ($routes) {
        $routes->get('/', 'PortfolioController::index');
        $routes->get('create', 'PortfolioController::create');
        $routes->post('store', 'PortfolioController::store');
        $routes->get('show/(:num)', 'PortfolioController::show/$1');
        $routes->get('edit/(:num)', 'PortfolioController::edit/$1');
        $routes->post('update/(:num)', 'PortfolioController::update/$1');
        $routes->get('delete/(:num)', 'PortfolioController::delete/$1');
    });
    $routes->group('journals', function ($routes) {
        $routes->get('/', 'JournalController::index');
        $routes->get('create', 'JournalController::create');
        $routes->post('store', 'JournalController::store');
        $routes->get('edit/(:num)', 'JournalController::edit/$1');
        $routes->post('update/(:num)', 'JournalController::update/$1');
        $routes->post('delete/(:num)', 'JournalController::delete/$1');
        $routes->post('toggle/(:num)', 'JournalController::togglePublish/$1');
        $routes->post('restore/(:num)', 'JournalController::restore/$1');
        $routes->post('force-delete/(:num)', 'JournalController::forceDelete/$1');
        $routes->post('upload-image', 'JournalController::uploadImage');
    });
    $routes->group('monitoring', ['filter' => 'auth'], function ($routes) {
        $routes->get('/', 'MonitoringController::index');
        $routes->get('chart-data', 'MonitoringController::chartData');
        $routes->get('live-stats', 'MonitoringController::liveStats');
        $routes->get('export-csv', 'MonitoringController::exportCsv');
        $routes->post('purge', 'MonitoringController::purge');
    });
    $routes->get('profile', 'ProfileController::index', ['filter' => 'auth']);
});

$routes->get('work-experiences', 'ExperiencePublicController::index');
$routes->get('work-experiences/(:num)', 'ExperiencePublicController::detail/$1');

$routes->get('skills', 'SkillPublicController::index');
$routes->get('skills/(:num)', 'SkillPublicController::detail/$1');

$routes->get('achievement', 'AchievementPublicController::index');
$routes->get('achievement/(:num)', 'AchievementPublicController::detail/$1');

$routes->get('social-media', 'SocialMediaPublicController::index');
$routes->get('social-media/(:num)', 'SocialMediaPublicController::detail/$1');

$routes->get('portfolio', 'PortfolioPublicController::index');
$routes->get('portfolio/(:num)', 'PortfolioPublicController::detail/$1');
$routes->get('portfolio-filter', 'PortfolioPublicController::filter');

$routes->get('journal',          'JournalPublicController::index');
$routes->get('journal/(:any)',   'JournalPublicController::show/$1');
$routes->get('journal/(:segment)', 'JournalPublicController::show/$1');
$routes->get('file/(:segment)/(:segment)', 'FileController::serve/$1/$2');
