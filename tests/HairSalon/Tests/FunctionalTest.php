<?php
    namespace HairSalon\Tests;

    //NOTE: found in vendor/silex/src
    use Silex\WebTestCase;

    /*==== Variables to check with site crawler ===*/

    //Global scope necessary here even though it is already defined in app.php
    $home_name = "Chez Root";

    // Client/Stylist list and search display
    $no_clients_display_message = "No Clients Found";
    $no_stylists_display_message = "No Stylists Found";

    // Text for create stylist/client forms
    $add_stylist_input_placeholder = "stylist name";
    $add_stylist_button_text = "Create Stylist";
    $add_stylist_button_id = "create-stylist";

    $add_client_input_placeholder = "client name";
    $add_client_button_text = "Create Client";
    $add_client_button_id = "create-client";



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
        //NOTE: BE VERY CAREFUL WITH EMPLOYING QUOTATION MARKS SO THAT CRAWLER
        // CAN FILTER FOR FULL VALUE NOT JUST UP TO THE WHITE SPACE!
        public function testFrontPageNoData()
        {
            //ARRANGE
            $client = $this->createClient();
            $client->followRedirects(true);

            //ACT
            $crawler = $client->request('GET', '/');

            //ASSERT
            // Recieved correct http response
            $this->assertTrue($client->getResponse()->isOk());

            // Display message No Clients/Stylists Found
            $this->assertCount(1, $crawler->filter('#database-contents-list:contains("' . $GLOBALS['no_clients_display_message'] . '")'));
            $this->assertCount(1, $crawler->filter('#database-contents-list:contains("' . $GLOBALS['no_stylists_display_message'] . '")'));

            // Display option to create stylist
            $this->assertCount(1, $crawler->filter('#add-stylist-form'));
            $this->assertCount(1, $crawler->filter('input[placeholder="' . $GLOBALS['add_stylist_input_placeholder'] . '"]'));
            $this->assertCount(1, $crawler->filter('button:contains("' . $GLOBALS['add_stylist_button_text'] . '")'));

            // DO NOT display option to create client
            $this->assertCount(0, $crawler->filter('#add-client-form'));
            $this->assertCount(0, $crawler->filter('input[placeholder="' . $GLOBALS['add_client_input_placeholder'] . '"]'));
            $this->assertCount(0, $crawler->filter('button:contains("' . $GLOBALS['add_client_button_text'] . '")'));

        }

        public function testCreateStylist()
        {
            //ARRANGE
            $client = $this->createClient();
            $client->followRedirects(true);

            //ACT
            $crawler = $client->request('GET', '/');

            //SUBMIT NEW STYLIST FORM
            $buttonCrawlerNode = $crawler->selectButton($GLOBALS['add_stylist_button_id']);

            /*TODO: It seems that we are not actually modifying any values of the input, so maybe this won't actually work*/
            $form = $buttonCrawlerNode->form(
                array(
                    'new_stylist' => 'stylist_name',
                ),
                'POST'
            );

            // var_dump($form->getMethod());
            $crawler = $client->submit($form);
            // var_dump($client->getResponse());

            //ASSERT
            // Recieved correct http response
            $this->assertTrue($client->getResponse()->isOk());

            // Display message No Clients Found
            $this->assertCount(1, $crawler->filter('#database-contents-list:contains("' . $GLOBALS['no_clients_display_message'] . '")'));
            // Display stylist_name under Stylists
            $this->assertCount(1, $crawler->filter('#database-contents-list:contains("stylist_name")'));

            // Display option to create stylist
            $this->assertCount(1, $crawler->filter('#add-stylist-form'));
            $this->assertCount(1, $crawler->filter('input[placeholder="' . $GLOBALS['add_stylist_input_placeholder'] . '"]'));
            $this->assertCount(1, $crawler->filter('button:contains("' . $GLOBALS['add_stylist_button_text'] . '")'));

            // Display option to create client
            $this->assertCount(1, $crawler->filter('#add-client-form'));
            $this->assertCount(1, $crawler->filter('input[placeholder="' . $GLOBALS['add_client_input_placeholder'] . '"]'));
            $this->assertCount(1, $crawler->filter('button:contains("' . $GLOBALS['add_client_button_text'] . '")'));

        }
    }
?>
