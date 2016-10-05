<?php
    /**
    *@backupGlobals disabled
    *@backupStaticAttributes disabled
    */
    date_default_timezone_set('America/New_York');

    require_once(__DIR__ . "/../vendor/autoload.php");
    require_once(__DIR__ . "/../src/Stylist.php");
    require_once(__DIR__ . "/../src/Client.php");

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();


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
        $display_clients = Client::getAll();
        $display_stylists = Stylist::getAll();

        return $app["twig"]->render("home.html.twig",
            array(
                "display_clients" => $display_clients,
                "display_stylists" => $display_stylists,
                "all_stylists" => $display_stylists,
                "home_name" => $home_name
            )
        );
    });

    $app->post("/", function() use($app)
    {
        $home_name = "Chez Proot";

        if (isset($_POST["delete_all"]))
        {
            $delete_all = (int) $_POST["delete_all"];
            if ($delete_all)
            {
                Client::deleteAll();
                Stylist::deleteAll();

                $display_stylists = Stylist::getAll();
                $display_clients = Client::getAll();

                $_POST["delete_all"] = 0;
            }
        }
        else if (isset($_POST["delete_client_id"]))
        {
            $delete_client_id = (int) $_POST["delete_client_id"];
            if ($delete_client_id)
            {
                $client_to_delete = Client::findById($delete_client_id);
                $client_to_delete->delete();
            }

            $display_stylists = Stylist::getAll();
            $display_clients = Client::getAll();

            $_POST["delete_client_id"] = 0;
        }
        else if (isset($_POST["delete_stylist_id"]))
        {
            $delete_stylist_id = (int) $_POST["delete_stylist_id"];
            if ($delete_stylist_id)
            {
                $stylist_to_delete = Stylist::findById($delete_stylist_id);
                $stylist_to_delete->delete();
            }

            $display_stylists = Stylist::getAll();
            $display_clients = Client::getAll();

            $_POST["delete_stylist_id"] = 0;
        }
        else
        {
            if (isset($_POST["new_stylist"]))
            {
                $new_stylist_name = $_POST["new_stylist"];

                if ($new_stylist_name)
                {
                    $new_stylist = new Stylist($new_stylist_name);
                    $new_stylist->save();
                }
            }

            $display_stylists = Stylist::getAll();

            if (isset($_POST["new_client"]) && isset($_POST["stylist_id"]))
            {
                $new_client_name = $_POST["new_client"];
                $new_client_stylist_id = (int) $_POST["stylist_id"];

                if ($new_client_name && $new_client_stylist_id)
                {
                    $new_client = new Client($new_client_name, $new_client_stylist_id);
                    $new_client->save();
                    /*
                        RESET stylist_id in $_POST SO that submitting new client without
                        choosing a stylist does not save a new client to the database
                    */
                    $_POST["stylist_id"] = 0;
                }
            }

            $display_clients = Client::getAll();
        }

        return $app["twig"]->render("home.html.twig",
            array(
                "display_clients" => $display_clients,
                "display_stylists" => $display_stylists,
                "all_stylists" => $display_stylists,
                "home_name" => $home_name
            )
        );
    });

    $app->get("/client/{client_id}", function($client_id) use($app) {
        $home_name = "Chez Proot";
        $display_clients = Client::getAll();
        $display_stylists = Stylist::getAll();

        $client = Client::findById($client_id);
        $client_stylist = Stylist::findById($client->getStylistId());
        return $app["twig"]->render("home.html.twig",
            array(
                "display_clients" => $display_clients,
                "display_stylists" => $display_stylists,
                "all_stylists" => $display_stylists,
                "home_name" => $home_name,
                "client" => $client,
                "client_stylist" => $client_stylist,
                "show_details" => 1
            )
        );
    });

    $app->get("/stylist/{stylist_id}", function($stylist_id) use($app) {
        $home_name = "Chez Proot";
        $display_clients = Client::getAll();
        $display_stylists = Stylist::getAll();

        $stylist = Stylist::findById($stylist_id);
        return $app["twig"]->render("home.html.twig",
            array(
                "display_clients" => $display_clients,
                "display_stylists" => $display_stylists,
                "all_stylists" => $display_stylists,
                "home_name" => $home_name,
                "stylist" => $stylist,
                "show_details" => 1
            )
        );
    });

    $app->get("/search_results" , function() use($app) {
        $home_name = "Chez Proot";

        /*
        NOTE: this route should only be reached when $_GET["search_term"] exists
        */
        $search_term = $_GET["search_term"];
        $all_stylists = Stylist::getAll();
        $all_clients = Client::getAll();

        //EMPTY SEARCH TERM
        if (!$search_term)
        {
            $found_clients = Client::getAll();
            $found_stylists = Stylist::getAll();
        }
        //SEARCHING BY ID
        else if (is_numeric($search_term))
        {
            $found_clients = array(Client::findById($search_term));
            $found_stylists = array(Stylist::findById($search_term));
        }
        //SEARCHING BY NAME
        else
        {
            $found_clients = Client::findByName($search_term);
            $found_stylists = Stylist::findByName($search_term);
        }

        return $app["twig"]->render("home.html.twig",
            array(
                "home_name" => $home_name,
                "display_clients" => $found_clients,
                "display_stylists" => $found_stylists,
                "all_stylists" => $all_stylists,
                "all_clients" => $all_clients,
                "search_term" => $search_term
            )
        );
    });

    return $app;
 ?>
