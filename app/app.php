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

// Home Page with search form
    $app->get("/", function() use ($app) {
    	return $app['twig']->render('contacts.html.twig', array('contacts' => Contact::getALL()));
    });

// Confirmation Page for adding a contact
    $app->post("/add_contacts", function() use ($app) {
    	$contact = new Contact($_POST['name'], $_POST['phone_number'], $_POST['address']);
    	$contact->save();
    	return $app ['twig']->render('add_confirmation.html.twig', array('newcontact' => $contact));
    });


// Confirmation Page for deleting contacts
    $app->post("/delete_contacts", function() use ($app) {
    	Task::deleteAll();
    	return $app['twig']->render('delete_confirmation.html.twig');
    });


    return $app;
?>