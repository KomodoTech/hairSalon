<?php
    namespace HairSalon\Tests;

    //NOTE: found in vendor/silex/src
    use Silex\WebTestCase;

    class FunctionalTest extends WebTestCase
    {
        public function createApplication()
        {
            $app = require(__DIR__.'/../../../app/app.php');
            $app['debug'] = true;
            unset($app['exception_handler']);

            return $app;
        }


        public function testInitialPage()
        {
            $client = $this->createClient();
            $crawler = $client->request('GET', '/');

            $this->assertTrue($client->getResponse()->isOk());
            $this->assertCount(1, $crawler->filter('h1:contains("Contact us")'));
            $this->assertCount(1, $crawler->filter('form'));
        }
    }
?>
