<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/main', 'MusicController::main');
$routes->post('/upload', 'MusicController::upload');
$routes->post('/create_playlist', 'MusicController::create_playlist');
$routes->get('/edit_playlist/(:any)', 'MusicController::edit_playlist/$1');
$routes->get('/delete_playlist/(:any)', 'MusicController::delete_playlist/$1');
$routes->post('/addtoplaylist', 'MusicController::addToPlaylist');
$routes->get('/playlist/(:any)', 'MusicController::viewPlaylist/$1');
$routes->get('/search', 'MusicController::search');