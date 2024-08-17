<?php

session_start();
$_SESSION['redirect_url'] = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';

$_SESSION['show-title'] = false; // defini si le titre doit $etre afficher non
define('DEV', true); // si nous somme encore en mode dev == true sinon mettre a false pour PRODUCTION
define('TEMPLATES_VIEWS', './views/'); // base chemin vers les views

define('TEMPLATE_LAYOUTS', TEMPLATES_VIEWS . 'layouts/'); // Le chemin vers les layer, partials et composants
define('MAIN_VIEW_PATH', TEMPLATE_LAYOUTS . 'app.php'); // Le chemin vers le template principal.
define('TEMPLATE_VIEW_PATH', TEMPLATES_VIEWS . 'templates/'); // Le chemin vers les views 'home', 'administrattion', 'error'

define('DB_HOST', 'localhost');
define('DB_NAME', '2024_oc_p6_tomtroc');
define('DB_USER', 'root');
define('DB_PASS', '');
