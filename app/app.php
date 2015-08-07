<?php
    //setup dependencies
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Contact.php";

    //create and check cookie;
    //start the session and if 'list_of_contacts' is empty set it to a blank array
    session_start();
    if (empty($_SESSION['list_of_contacts'])) {
        $_SESSION['list_of_contacts'] = array();
    }
    //initialize the application
    $app = new Silex\Application();
    $app['debug'] = true;
    //tell the app where to get twig and where we will be pulling our twig files
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
      'twig.path' => __DIR__.'/../views'
    ));
    //this route is for the home page
    //twig will render our contacts twig file and we will use the getAll method for the Contact class
    $app->get("/", function() use ($app) {
      return $app['twig']->render('contacts.html.twig', array('contacts' => Contact::getAll()));
    });
    //this route is for the contact created confirmation page
    //it will post the information recieved from the form on the home page and use the save method to store to the $_SESSSION['list_of_contacts'] array

    $app->post("/create_contact", function() use ($app) {
        $contact = new Contact($_POST['name'], $_POST['number'], $_POST['address']);
        $contact->save();
        return $app['twig']->render('create_contact.html.twig', array('newcontact' => $contact));
    });
    //this is the route for the delete all confirmation page
    //we call the deleteAll() method to turn $_SESSIOn['list_of_contacts'] into an empty array
    $app->post("/delete_contacts", function() use ($app) {
        Contact::deleteAll();
        return $app['twig']->render('delete_contacts.html.twig');
    });

return $app;
?>
