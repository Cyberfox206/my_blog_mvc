<?php

session_start();

require '../src/config/config.php';
require '../vendor/autoload.php';
require SRC . 'helper.php';

$router = new BlogMvc\Router($_SERVER["REQUEST_URI"]);
$router->get('/login/', "UserController@showLogin");
$router->get('/register/', "UserController@showRegister");
$router->get('/logout/', "UserController@logout");
$router->get('/', 'ArticleController@getall_art');
$router->get('/newart/', 'ArticleController@formulaire_for_add_art');
$router->get('/:post/modif_formulaire/', 'ArticleController@formulaire_for_modif_art');

$router->post('/login/', "UserController@login");
$router->post('/register/', "UserController@register");
$router->post('/add/', 'ArticleController@add_article_in_db');
$router->post('/delate/', 'ArticleController@delate');
$router->post('/:post/modif', 'ArticleController@update_art');

$router->run();
