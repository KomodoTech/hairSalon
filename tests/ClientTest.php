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
            $client_name = "C_Papa Smurf";
            $new_client = new Client($client_name, $stylist_id, $id);
            $expected_output = 1;

            //ACT
            $result = $new_client->getId();

            //ASSERT
            $this->assertEquals($expected_output, $result);
        }

        function test_getStylistId()
        {
            //ARRANGE
            $id = 1;
            $stylist_id = 2;
            $client_name = "C_Burning Smurf Village";
            $new_client = new Client($client_name, $stylist_id, $id);
            $expected_output = 2;

            //ACT
            $result = $new_client->getStylistId();

            //ASSERT
            $this->assertEquals($expected_output, $result);
        }

        function test_getName()
        {
            //ARRANGE
            $id = 1;
            $stylist_id = 2;
            $client_name = "C_Witnessed Cavemen";
            $new_client = new Client($client_name, $stylist_id, $id);
            $expected_output = $client_name;

            //ACT
            $result = $new_client->getName();

            //ASSERT
            $this->assertEquals($expected_output, $result);
        }

        function test_setName()
        {
            //ARRANGE
            $id = 1;
            $stylist_id = 2;
            $client_name = "C_Hocus Pocus";
            $new_client = new Client($client_name, $stylist_id, $id);

            $new_client_name = "C_Lateness Incarnate";
            $expected_output = $new_client_name;

            //ACT
            $new_client->setName($new_client_name);
            $result = $new_client->getName();

            //ASSERT
            $this->assertEquals($expected_output, $result);
        }

        function test_setStylistId()
        {
            //ARRANGE
            $id = 1;
            $stylist_id = 2;
            $client_name = "C_Molten Cheese";
            $new_client = new Client($client_name, $stylist_id, $id);

            $new_stylist_id = 3;
            $new_stylist_name = "S_Offal Pizza";
            $new_stylist = new Stylist($new_stylist_name, $new_stylist_id);
            $expected_output = $new_stylist->getId();

            //ACT
            $new_client->setStylistId($new_stylist_id);
            $result = $new_client->getStylistId();

            //ASSERT
            $this->assertEquals($expected_output, $result);
        }

        function test_save()
        {
            //ARRANGE
            $stylist_name = "S_Neymar";
            $new_stylist = new Stylist($stylist_name);
            $new_stylist->save();
            $new_stylist_id = $new_stylist->getId();

            $client_name = "C_Rasputin Nitupsar";
            $new_client = new Client($client_name, $new_stylist_id);

            //ACT
            $new_client->save();
            $expected_output = $new_client;
            $all_clients = Client::getAll();
            $result = $all_clients[0];

            //ASSERT
            $this->assertEquals($expected_output, $result);
        }

        function test_updateStylistId()
        {
            //ARRANGE
            $stylist_name = "S_Known Unknown";
            $new_stylist = new Stylist($stylist_name);
            $new_stylist->save();
            $new_stylist_id = $new_stylist->getId();

            $client_name = "C_Block Parsnip";
            $new_client = new Client($client_name, $new_stylist_id);
            $new_client->save();

            $stylist_name2 = "S_Confused Cowbell";
            $new_stylist2 = new Stylist($stylist_name2);
            $new_stylist2->save();
            $new_stylist2_id = $new_stylist2->getId();
            $expected_output = $new_stylist2_id;

            //ACT
            $new_client->updateStylistId($new_stylist2_id);
            $result = $new_client->getStylistId();

            //ASSERT
            $this->assertEquals($expected_output, $result);
        }

        function test_getAll()
        {
            //ARRANGE
            $stylist_name = "S_Sweeney Todd";
            $new_stylist = new Stylist($stylist_name);
            $new_stylist->save();
            $new_stylist_id = $new_stylist->getId();

            $stylist_name2 = "S_Chernobyl Corn";
            $new_stylist2 = new Stylist($stylist_name2);
            $new_stylist2->save();
            $new_stylist_id2 = $new_stylist2->getId();

            $client_name = "C_Meat Pire";
            $new_client = new Client($client_name, $new_stylist_id);
            $new_client->save();

            $client_name2 = "C_Ordinary Lint";
            $new_client2 = new Client($client_name2, $new_stylist_id);
            $new_client2->save();

            $client_name3 = "C_Ostrich Lover";
            $new_client3 = new Client($client_name3, $new_stylist_id2);
            $new_client3->save();

            $client_name4 = "C_Wardrobe Warfare";
            $new_client4 = new Client($client_name4, $new_stylist_id2);
            $new_client4->save();

            $expected_output = [$new_client, $new_client2, $new_client3, $new_client4];

            //ACT
            $result = Client::getAll();

            //ASSERT
            $this->assertEquals($expected_output, $result);
        }

        function test_deleteAll()
        {
            //ARRANGE
            $stylist_name = "S_Dirtface Kale";
            $new_stylist = new Stylist($stylist_name);
            $new_stylist->save();
            $new_stylist_id = $new_stylist->getId();

            $stylist_name2 = "S_Lord Lichtenstein";
            $new_stylist2 = new Stylist($stylist_name2);
            $new_stylist2->save();
            $new_stylist_id2 = $new_stylist2->getId();

            $client_name = "C_Swedish Chefts";
            $new_client = new Client($client_name, $new_stylist_id);
            $new_client->save();

            $client_name2 = "C_Moar Lumber";
            $new_client2 = new Client($client_name2, $new_stylist_id);
            $new_client2->save();

            $client_name3 = "C_Winter Smells";
            $new_client3 = new Client($client_name3, $new_stylist_id2);
            $new_client3->save();

            $client_name4 = "C_Outright Snake";
            $new_client4 = new Client($client_name4, $new_stylist_id2);
            $new_client4->save();

            $expected_output = [];

            //ACT
            Client::deleteAll();
            $result = Client::getAll();

            //ASSERT
            $this->assertEquals($expected_output, $result);
        }

        function test_findById()
        {
            //ARRANGE
            $stylist_name = "S_Whistful Whale";
            $new_stylist = new Stylist($stylist_name);
            $new_stylist->save();
            $new_stylist_id = $new_stylist->getId();

            $stylist_name2 = "S_Hornbeaked Breaker";
            $new_stylist2 = new Stylist($stylist_name2);
            $new_stylist2->save();
            $new_stylist_id2 = $new_stylist2->getId();

            $client_name = "C_Fruitful Fist";
            $new_client = new Client($client_name, $new_stylist_id);
            $new_client->save();

            $client_name2 = "C_Spurned Porridge";
            $new_client2 = new Client($client_name2, $new_stylist_id);
            $new_client2->save();

            $client_name3 = "C_Journey Steak";
            $new_client3 = new Client($client_name3, $new_stylist_id2);
            $new_client3->save();

            $client_name4 = "C_Sloth HitnRun";
            $new_client4 = new Client($client_name4, $new_stylist_id2);
            $new_client4->save();

            $new_client_id2 = $new_client2->getId();
            $expected_output = $new_client2;

            //ACT
            $result = Client::findById($new_client_id2);

            //ASSERT
            $this->assertEquals($expected_output, $result);
        }

        function test_findByName()
        {
            //ARRANGE
            $stylist_name = "S_Whimsical Warthog";
            $new_stylist = new Stylist($stylist_name);
            $new_stylist->save();
            $new_stylist_id = $new_stylist->getId();

            $stylist_name2 = "S_Spanish Fly";
            $new_stylist2 = new Stylist($stylist_name2);
            $new_stylist2->save();
            $new_stylist_id2 = $new_stylist2->getId();

            $client_name = "C_Unattainable Paralysis";
            $new_client = new Client($client_name, $new_stylist_id);
            $new_client->save();

            $client_name2 = "C_Kitchen Hands";
            $new_client2 = new Client($client_name2, $new_stylist_id);
            $new_client2->save();

            $client_name3 = "C_Orchid Summer";
            $new_client3 = new Client($client_name3, $new_stylist_id2);
            $new_client3->save();

            $client_name4 = "C_Kitchen Hands";
            $new_client4 = new Client($client_name4, $new_stylist_id2);
            $new_client4->save();

            $expected_output = [$new_client2, $new_client4];

            //ACT
            $result = Client::findByName($client_name2);

            //ASSERT
            $this->assertEquals($expected_output, $result);
        }
    }
 ?>
