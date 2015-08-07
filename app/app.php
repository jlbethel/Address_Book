<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Contact.php";

// Silex and Twig framworks for organization
    session_start();

    if (empty($_SESSSION['list_of_contacts'])) {
    	$_SESSION['list_of_contacts'] = array();
    }

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
             'twig.path' => __DIR__.'/../views'
    	));



?>