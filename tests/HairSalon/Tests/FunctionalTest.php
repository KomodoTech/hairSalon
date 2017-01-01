<?php
    namespace HairSalon\Tests;

    //NOTE: found in vendor/silex/src
    use Silex\WebTestCase;

    /*==== Variables to check with site crawler ===*/

    // Client/Stylist list and search display
    $no_clients_display_message = "No Clients Found";
    $no_stylists_display_message = "No Stylists Found";

    // Text for create stylist/client forms
    $add_stylist_input_placeholder = "stylist name";
    $add_stylist_button_text = "Create Stylist";

    $add_client_input_placeholder = "client name";
    $add_client_button_text = "Create Client";



    class FunctionalTest extends WebTestCase
    {
        public function createApplication()
        {
            $app = require(__DIR__.'/../../../app/app.php');
            $app['debug'] = true;
            unset($app['exception_handler']);

            return $app;
        }

/*===========================TEST FRONT PAGE==================================*/

        public function testFrontPageNoData()
        {
            //ARRANGE
            $client = $this->createClient();

            //ACT
            $crawler = $client->request('GET', '/');

            //ASSERT
            // Recieved correct http response
            $this->assertTrue($client->getResponse()->isOk());

            // Display message No Clients/Stylists Found
            $this->assertCount(1, $crawler->filter('#database-contents-list:contains(' . $GLOBALS['no_clients_display_message'] . ')'));
            $this->assertCount(1, $crawler->filter('#database-contents-list:contains(' . $GLOBALS['no_stylists_display_message'] . ')'));

            // Display option to create stylist
            $this->assertCount(1, $crawler->filter('input:contains(' . $GLOBALS['add_stylist_input_placeholder'] . ')'));
            $this->assertCount(1, $crawler->filter('button:contains(' . $GLOBALS['add_stylist_button_text'] . ')'));

            // DO NOT display option to create client
            $this->assertCount(0, $crawler->filter('input:contains(' . $GLOBALS['add_client_input_placeholder'] . ')'));
            $this->assertCount(0, $crawler->filter('button:contains(' . $GLOBALS['add_client_button_text'] . ')'));

        }
    }
?>
