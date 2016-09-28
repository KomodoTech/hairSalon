<?php
    /**
    *@backupGlobals disabled
    *@backupStaticAttributes disabled
    */
    date_default_timezone_set('America/New_York');

    require_once(__DIR__ . "/../vendor/autoload.php");
    require_once(__DIR__ . "/../src/Stylist.php");
    require_once(__DIR__ . "/../src/Client.php");

    /*=GLOBAL VARIABLES=======================================================*/

    $server = "mysql:host=localhost:8889;dbname=hair_salon";
    $username = "root";
    $password = "root";
    $DB = new PDO($server, $username, $password);

    $app = new Silex\Application();
    $app->register(new Silex\Provider\TwigServiceProvider(), array("twig.path" => __DIR__ . "/../views"));

    //TODO: Ask diane about twig namespace, modifying the loader etc.



    /*=ROUTES=================================================================*/
    $app->get("/", function() use($app)
    {
        $home_name = "Chez Proot";
        $all_clients = Client::getAll();
        $all_stylists = Stylist::getAll();

        return $app["twig"]->render("home.html.twig",
            array(
                "all_clients" => $all_clients,
                "all_stylists" => $all_stylists,
                "home_name" => $home_name
            )
        );
    });

    $app->post("/", function() use($app)
    {
        $home_name = "Chez Proot";
        $new_stylist_name = $_POST["new_stylist"];
        $new_client_name = $_POST["new_client"];
        $new_client_stylist_id = (int) $_POST["stylist_id"];

        if ($new_stylist_name)
        {
            $new_stylist = new Stylist($new_stylist_name);
            $new_stylist->save();
        }

        $all_stylists = Stylist::getAll();

        if ($new_client_name && $new_client_stylist_id)
        {
            $new_client = new Client($new_client_name, $new_client_stylist_id);
            $new_client->save();
        }

        $all_clients = Client::getAll();

        return $app["twig"]->render("home.html.twig",
            array(
                "all_clients" => $all_clients,
                "all_stylists" => $all_stylists,
                "home_name" => $home_name
            )
        );
    });

    return $app;
 ?>
