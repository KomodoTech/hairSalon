<?php
    /**
    *@backupGlobals disabled
    *@backupStaticAttributes disabled
    */

    require_once("src/Client.php");
    require_once("src/Stylist.php");

    $server = "mysql:host=localhost:8889;dbname=hair_salon_test";
    $username = "root";
    $password = "root";
    $DB = new PDO($server, $username, $password);

    class ClientTest extends PHPUnit_Framework_TestCase
    {
        function tearDown()
        {
            Client::deleteAll();
            Stylist::deleteAll();
        }

        function test_getId()
        {
            //ARRANGE
            $id = 1;
            $stylist_id = 2;
            $client_name = "Papa Smurf";
            $new_client = new Client($client_name, $stylist_id, $id);
            $expected_output = 1;

            //ACT
            $result = $new_client->getId();

            //ASSERT
            $this->assertEquals($expected_output, $result);
        }

        function test_save()
        {
            //ARRANGE
            $stylist_name = "Neymar";
            $new_stylist = new Stylist($stylist_name);
            $new_stylist->save();
            $new_stylist_id = $new_stylist->getId();

            $client_name = "Rasputin Nitupsar";
            $new_client = new Client($client_name, $new_stylist_id);

            //ACT
            $new_client->save();
            $expected_output = $new_client;
            $all_clients = Client::getAll();
            $result = $all_clients[0];

            //ASSERT
            $this->assertEquals($expected_output, $result);
        }

    }


 ?>
