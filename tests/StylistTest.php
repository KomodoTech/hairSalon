<?php
    /**
    *@backupGlobals disabled
    *@backupStaticAttributes disabled
    */

    require_once("src/Stylist.php");
    require_once("src/Client.php");

    $server = "mysql:host=localhost:8889;dbname=hair_salon_test";
    $username = "root";
    $password = "root";
    $DB = new PDO($server, $username, $password);

    class StylistTest extends PHPUnit_Framework_TestCase
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
            $stylist_name = "S_Papa Smurf";
            $new_stylist = new Stylist($stylist_name, $id);
            $expected_output = 1;

            //ACT
            $result = $new_stylist->getId();

            //ASSERT
            $this->assertEquals($expected_output, $result);
        }

        function test_getName()
        {
            //ARRANGE
            $id = 1;
            $stylist_name = "S_Witnessed Cavemen";
            $new_stylist = new Stylist($stylist_name, $id);
            $expected_output = $stylist_name;

            //ACT
            $result = $new_stylist->getName();

            //ASSERT
            $this->assertEquals($expected_output, $result);
        }

        function test_setName()
        {
            //ARRANGE
            $id = 1;
            $stylist_name = "S_Hocus Pocus";
            $new_stylist = new Client($stylist_name, $id);

            $new_stylist_name = "S_Lateness Incarnate";
            $expected_output = $new_stylist_name;

            //ACT
            $new_stylist->setName($new_stylist_name);
            $result = $new_stylist->getName();

            //ASSERT
            $this->assertEquals($expected_output, $result);
        }

        function test_save()
        {
            //ARRANGE
            $stylist_name = "S_Neymar";
            $new_stylist = new Stylist($stylist_name);

            //ACT
            $new_stylist->save();
            $expected_output = $new_stylist;
            $all_stylists = Stylist::getAll();
            $result = $all_stylists[0];

            //ASSERT
            $this->assertEquals($expected_output, $result);
        }

        function test_delete()
        {
            //ARRANGE
            $stylist_name = "S_El Capitan";
            $new_stylist = new Stylist($stylist_name);
            $new_stylist->save();
            $expected_output = null;

            //ACT
            $new_stylist->delete();
            $all_stylists = Stylist::getAll();
            $result = $all_stylists[0];

            //ASSERT
            $this->assertEquals($expected_output, $result);
        }

        function test_updateName()
        {
            //ARRANGE
            $stylist_name = "S_Neymar";
            $new_stylist = new Stylist($stylist_name);
            $new_stylist->save();

            $new_stylist_name = "S_Talented Tortoise";

            //ACT
            $new_stylist->updateName($new_stylist_name);
            $expected_output = $new_stylist;

            $all_stylists = Stylist::getAll();
            $result = $all_stylists[0];

            //ASSERT
            $this->assertEquals($expected_output, $result);
        }

        function test_getAll()
        {
            //ARRANGE
            $stylist_name = "S_Sweeney Todd";
            $new_stylist = new Stylist($stylist_name);
            $new_stylist->save();

            $stylist_name2 = "S_Chernobyl Corn";
            $new_stylist2 = new Stylist($stylist_name2);
            $new_stylist2->save();

            $stylist_name3 = "S_Meat Pire";
            $new_stylist3 = new Stylist($stylist_name3);
            $new_stylist3->save();

            $stylist_name4 = "S_Ordinary Lint";
            $new_stylist4 = new Stylist($stylist_name4);
            $new_stylist4->save();

            $expected_output = [$new_stylist, $new_stylist2, $new_stylist3, $new_stylist4];

            //ACT
            $result = Stylist::getAll();

            //ASSERT
            $this->assertEquals($expected_output, $result);
        }

        function test_deleteAll()
        {
            //ARRANGE
            $stylist_name = "S_Dirtface Kale";
            $new_stylist = new Stylist($stylist_name);
            $new_stylist->save();

            $stylist_name2 = "S_Lord Lichtenstein";
            $new_stylist2 = new Stylist($stylist_name2);
            $new_stylist2->save();

            $stylist_name3 = "S_Outright Snake";
            $new_stylist3 = new Stylist($stylist_name3);
            $new_stylist3->save();

            $stylist_name4 = "S_Winter Smells";
            $new_stylist4 = new Stylist($stylist_name4);
            $new_stylist4->save();


            $expected_output = [];

            //ACT
            Stylist::deleteAll();
            $result = Stylist::getAll();

            //ASSERT
            $this->assertEquals($expected_output, $result);
        }

        function test_findById()
        {
            //ARRANGE
            $stylist_name = "S_Whistful Whale";
            $new_stylist = new Stylist($stylist_name);
            $new_stylist->save();

            $stylist_name2 = "S_Hornbeaked Breaker";
            $new_stylist2 = new Stylist($stylist_name2);
            $new_stylist2->save();

            $stylist_name3 = "S_Spurned Porridge";
            $new_stylist3 = new Stylist($stylist_name3);
            $new_stylist3->save();

            $stylist_name4 = "S_Journey Steak";
            $new_stylist4 = new Stylist($stylist_name4);
            $new_stylist4->save();


            $new_stylist_id2 = $new_stylist2->getId();
            $expected_output = $new_stylist2;

            //ACT
            $result = Stylist::findById($new_stylist_id2);

            //ASSERT
            $this->assertEquals($expected_output, $result);
        }

        function test_findByName()
        {
            //ARRANGE
            $stylist_name = "S_Whimsical Warthog";
            $new_stylist = new Stylist($stylist_name);
            $new_stylist->save();

            $stylist_name2 = "S_Spanish Fly";
            $new_stylist2 = new Stylist($stylist_name2);
            $new_stylist2->save();

            $stylist_name3 = "S_Unattainable Paralysis";
            $new_stylist3 = new Stylist($stylist_name3);
            $new_stylist3->save();

            $stylist_name4 = "S_Unattainable Paralysis";
            $new_stylist4 = new Stylist($stylist_name4);
            $new_stylist4->save();


            $expected_output = [$new_stylist3, $new_stylist4];

            //ACT
            $result = Stylist::findByName($stylist_name3);

            //ASSERT
            $this->assertEquals($expected_output, $result);
        }

        function test_getClients()
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

            $client_name4 = "C_Farmstand Armstrong";
            $new_client4 = new Client($client_name4, $new_stylist_id2);
            $new_client4->save();

            $expected_output = [$new_client, $new_client2];

            //ACT
            $result = $new_stylist->getClients();

            //ASSERT
            $this->assertEquals($expected_output, $result);
        }
    }
 ?>
