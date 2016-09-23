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

        function getId()
        {
            //ARRANGE
            $id = 1;
            $stylist_id = 2;
            $name = 'Papa Smurf';
            $new_client = new Client($name, $stylist_id, $id);
            $expected_output = 1;

            //ACT
            $result = $new_client->getId();

            //ASSERT
            $this->assertEquals($expected_output, $result);
        }

    }


 ?>
