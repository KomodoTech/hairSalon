<?php
    /**
    *@backupGlobals disabled
    *@backupStaticAttributes disabled
    */
    namespace HairSalon\Tests;

    //NOTE: found in vendor/silex/src
    use Silex\WebTestCase;

    require_once("src/Stylist.php");
    require_once("src/Client.php");

    $server = "mysql:host=localhost:8889;dbname=hair_salon_test";
    $username = "root";
    $password = "root";
    $DB = new PDO($server, $username, $password);

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
            $client = $this->createClient();
            $crawler = $client->request('GET', '/');

            $this->assertTrue($client->getResponse()->isOk());
            $this->assertCount(1, $crawler->filter('h1:contains("Contact us")'));
            $this->assertCount(1, $crawler->filter('form'));
        }
    }
?>
