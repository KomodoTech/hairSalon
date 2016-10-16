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

        //DNE = DOES NOT EXIST
        function test_getUnassignedStylistDNE()
        {
            //ARRANGE
            $stylist_name = "S_Damn Daniel";
            $new_stylist = new Stylist($stylist_name);
            $new_stylist->save();

            $stylist_name2 = "S_Norf Thace";
            $new_stylist2 = new Stylist($stylist_name2);
            $new_stylist2->save();

            $expected_output = "UNASSIGNED";

            //ACT
            $unassigned_stylist = Stylist::getUnassignedStylist();
            $result = $unassigned_stylist->getName();

            //ASSERT
            $this->assertEquals($expected_output, $result);
        }

        //EAU = EXISTS AND UNIQUE
        function test_getUnassignedStylistEAU()
        {
            //ARRANGE
            $stylist_name = "S_Gone Giraffe";
            $new_stylist = new Stylist($stylist_name);
            $new_stylist->save();

            $stylist_name2 = "UNASSIGNED";
            $new_stylist2 = new Stylist($stylist_name2);
            $new_stylist2->save();
            $new_stylist_id2 = $new_stylist2->getId();


            $expected_output = $new_stylist_id2;

            //ACT
            $unassigned_stylist = Stylist::getUnassignedStylist();
            $result = $unassigned_stylist->getId();

            //ASSERT
            $this->assertEquals($expected_output, $result);
        }

        //EANU = EXISTS AND NOT UNIQUE
        function test_getUnassignedStylistEANU()
        {
            //ARRANGE
            $stylist_name = "S_Helper Scalper";
            $new_stylist = new Stylist($stylist_name);
            $new_stylist->save();

            $stylist_name2 = "UNASSIGNED";
            $new_stylist2 = new Stylist($stylist_name2);
            $new_stylist2->save();
            $new_stylist_id2 = $new_stylist2->getId();

            $stylist_name3 = "UNASSIGNED";
            $new_stylist3 = new Stylist($stylist_name3);
            $new_stylist3->save();

            $expected_output = $new_stylist_id2;

            //ACT
            $unassigned_stylist = Stylist::getUnassignedStylist();
            $result = $unassigned_stylist->getId();

            //ASSERT
            $this->assertEquals($expected_output, $result);
        }

        //DNE = UNASSIGNED STYLIST DOES NOT EXIST
        function test_makeUnassignedStylistUniqueDNE()
        {
            //ARRANGE
            $stylist_name = "S_Lifts McGee";
            $new_stylist = new Stylist($stylist_name);
            $new_stylist->save();

            $stylist_name2 = "S_Full Swervice";
            $new_stylist2 = new Stylist($stylist_name2);
            $new_stylist2->save();

            $stylists = [$new_stylist, $new_stylist2];

            $expected_output = $stylists;

            //ACT
            $result = Stylist::makeUnassignedStylistUnique($stylists);

            //ASSERT
            $this->assertEquals($expected_output, $result);
        }

        //EAU = UNASSIGNED STYLIST EXISTS AND UNIQUE
        function test_makeUnassignedStylistUniqueEAU()
        {
            //ARRANGE
            $stylist_name = "S_Horticulture Fiend";
            $new_stylist = new Stylist($stylist_name);
            $new_stylist->save();

            $stylist_name2 = "UNASSIGNED";
            $new_stylist2 = new Stylist($stylist_name2);
            $new_stylist2->save();

            $stylists = [$new_stylist, $new_stylist2];

            $expected_output = [$new_stylist, $new_stylist2];

            //ACT
            $result = Stylist::makeUnassignedStylistUnique($stylists);

            //ASSERT
            $this->assertEquals($expected_output, $result);
        }

        //EANU = UNASSIGNED STYLIST EXISTS AND NOT UNIQUE
        function test_makeUnassignedStylistUniqueEANU()
        {
            //ARRANGE
            $unassigned_name = "UNASSIGNED";

            $stylist_name = "S_Helper Scalper";
            $new_stylist = new Stylist($stylist_name);
            $new_stylist->save();
            $new_stylist_id = $new_stylist->getId();

            $client_name = "C_Moose Gamut";
            $new_client = new Client($client_name, $new_stylist_id);
            $new_client->save();

            // OFFICIAL UNASSIGNED
            $official_unassigned_stylist = new Stylist($unassigned_name);
            $official_unassigned_stylist->save();
            $official_unassigned_stylist_id = $official_unassigned_stylist->getId();

            $client_name2 = "C_Official Lemon";
            $new_client2 = new Client($client_name2, $official_unassigned_stylist_id);
            $new_client2->save();

            $client_name3 = "C_Official Lime";
            $new_client3 = new Client($client_name3, $official_unassigned_stylist_id);
            $new_client3->save();

            //UNOFFICIAL UNASSIGNED
            $unofficial_unassigned_stylist = new Stylist($unassigned_name);
            $unofficial_unassigned_stylist->save();
            $unofficial_unassigned_stylist_id = $unofficial_unassigned_stylist->getId();

            $client_name4 = "C_Unofficial Lemon";
            $new_client4 = new Client($client_name4, $unofficial_unassigned_stylist_id);
            $new_client4->save();

            $client_name5 = "C_Unofficial Lime";
            $new_client5 = new Client($client_name5, $unofficial_unassigned_stylist_id);
            $new_client5->save();


            /* HACK: TO DEAL WITH LOCAL CLIENTS NOT BEING UPDATED CORRECTLY DUE TO
             * getClients METHOD GRABBING INFO FROM DATABASE AND MAKING NEW CLIENT INSTANCES.
             * ASK DIANE FOR RECOMMENDATIONS
             */
            $new_client4_updated = new Client($client_name4, $official_unassigned_stylist_id, $new_client4->getId());
            $new_client5_updated = new Client($client_name5, $official_unassigned_stylist_id, $new_client5->getId());


            $stylists = [$new_stylist, $official_unassigned_stylist, $unofficial_unassigned_stylist];

            /*NOTE:
            * just checking $official_unassigned_stylist would not guarantee that clients
            * were reassigned properly in the database. Also, getClients will return new
            * Client objects created from the database with the updated information. THE
            * WARN: PREVIOUSLY EXISTING CLIENTS HAVE NEVER BEEN UPDATED WITH THE CORRECT
            * INFORMATION!!
            */
            $expected_output =[[$new_stylist, $official_unassigned_stylist], [$new_client2, $new_client3, $new_client4_updated, $new_client5_updated]];

            //ACT
            $modified_stylists = Stylist::makeUnassignedStylistUnique($stylists);
            $result = [$modified_stylists, $official_unassigned_stylist->getClients()];

            //ASSERT
            $this->assertEquals($expected_output, $result);
        }


        function test_moveUnassignedStylistToBeginning()
        {
            //ARRANGE
            $stylist_name = "S_Satchel Charge";
            $new_stylist = new Stylist($stylist_name);
            $new_stylist->save();

            $stylist_name2 = "S_Wormy Cereal";
            $new_stylist2 = new Stylist($stylist_name2);
            $new_stylist2->save();

            $stylist_name3 = "UNASSIGNED";
            $new_stylist3 = new Stylist($stylist_name3);
            $new_stylist3->save();

            $stylist_name4 = "S_Meager Genocide";
            $new_stylist4 = new Stylist($stylist_name4);
            $new_stylist4->save();

            $stylist_name5 = "UNASSIGNED";
            $new_stylist5 = new Stylist($stylist_name5);
            $new_stylist5->save();

            $stylist_name6 = "S_Wendnesday Latrine";
            $new_stylist6 = new Stylist($stylist_name6);
            $new_stylist6->save();

            $stylists = [$new_stylist, $new_stylist2, $new_stylist3, $new_stylist4, $new_stylist5, $new_stylist6];

            $expected_output = [$new_stylist3, $new_stylist, $new_stylist2, $new_stylist4, $new_stylist6];

            //ACT
            $result = Stylist::moveUnassignedStylistToBeginning($stylists);

            //ASSERT
            $this->assertEquals($expected_output, $result);
        }
    }
 ?>
