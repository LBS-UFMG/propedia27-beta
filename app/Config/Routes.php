<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/clusters', 'Clusters::index');
$routes->get('/documentation', 'Home::documentation');
$routes->get('/download', 'Home::download');
$routes->get('/explore', 'Home::explore');
$routes->get('/explore/data', 'Home::exploreData');
$routes->get('/explore/export', 'Home::exploreExport');
$routes->post('/blast', 'Blast::index');
$routes->post('/run', 'Project::create');
$routes->get('/export/pymol/(:any)', 'Export::pymol/$1');
$routes->get('/export/pdb-to-pymol/(:any)', 'Export::pdb_to_pymol/$1');

$routes->get('/entry/(:any)', 'Entry::entry/$1');
$routes->get('/multipro/(:any)', 'Entry::multipro/$1');
$routes->post('/probis', 'Search::probis');
$routes->get('/project/(:any)', 'Search::project/$1');
