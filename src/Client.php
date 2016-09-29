<?php

    class Client
    {
        private $name;
        private $stylist_id;
        private $id;

        /*==CONSTRUCTOR========================================*/
        function __construct($name, $stylist_id=null, $id=null)
        {
            $this->name = (string) $name;
            $this->stylist_id = (int) $stylist_id;
            $this->id = (int) $id;
        }

        /*==GETTERS/SETTERS========================================*/
        function getName()
        {
            return (string) $this->name;
        }


        //TODO: update database when calling setName
        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getStylistId()
        {
            return (int) $this->stylist_id;
        }

        function setStylistId($new_stylist_id)
        {
            $this->stylist_id = (int) $new_stylist_id;
        }

        function getId()
        {
            return (int) $this->id;
        }


        /*==METHODS===============================================*/
        function save()
        {
            $sql_command = "INSERT INTO clients (name, stylist_id) VALUES ('";
            $name = $this->getName();
            $stylist_id = $this->getStylistId();

            $sql_command = $sql_command . $name . "', " . $stylist_id . ");";

            $GLOBALS['DB']->exec($sql_command);

            $this->id = (int) $GLOBALS['DB']->lastInsertId();
        }

        function delete()
        {
            $id = $this->getId();
            $sql_command = "DELETE FROM clients WHERE id = " . $id . ";";
            $GLOBALS['DB']->exec($sql_command);
        }

        function updateName($new_name)
        {
            $id = $this->getId();
            $sql_command = "UPDATE clients SET name = '" . $new_name . "' WHERE id = " . $id . ";";
            $GLOBALS['DB']->exec($sql_command);

            $this->setName($new_name);
        }

        
        function updateStylistId($new_stylist_id)
        {
            $id = $this->getId();

            $sql_command = "UPDATE clients SET stylist_id = '" . $new_stylist_id . "' WHERE id = " . $id . ";";
            $GLOBALS['DB']->exec($sql_command);

            $this->setStylistId($new_stylist_id);
        }

        /*==STATIC METHODS==========================================*/
        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM clients");
        }

        static function getAll()
        {
            $clients = [];

            $clients_PDOStatement = $GLOBALS['DB']->query("SELECT * FROM clients;");

            if ($clients_PDOStatement)
            {
                $clients_data = $clients_PDOStatement->fetchAll();

                for ($client_index = 0; $client_index < count($clients_data); $client_index++)
                {
                    $current_client = $clients_data[$client_index];
                    $client_name = $current_client['name'];
                    $client_stylist_id = $current_client['stylist_id'];
                    $client_id = $current_client['id'];

                    $client_object = new Client($client_name, $client_stylist_id, $client_id);

                    $clients[] = $client_object;
                }
            }
            return $clients;
        }

        static function findById($search_id)
        {
            $found_client = null;
            $clients_in_database = Client::getAll();

            for ($client_index = 0; $client_index < count($clients_in_database); $client_index++)
            {
                $current_client = $clients_in_database[$client_index];
                $current_client_id = $current_client->getId();

                if ($current_client_id == $search_id)
                {
                    $found_client = $current_client;
                }
            }

            if (!$found_client)
            {
                print("Could not find client with id of " . $search_id . "\n");
            }
            return $found_client;
        }

        static function findByName($search_name)
        {
            $found_clients = [];

            $clients_in_database = Client::getAll();

            for ($client_index = 0; $client_index < count($clients_in_database); $client_index++)
            {
                $current_client = $clients_in_database[$client_index];
                $current_client_name = $current_client->getName();

                if ($current_client_name == $search_name)
                {
                    $found_clients[] = $current_client;
                }
            }

            if (!count($found_clients))
            {
                print("Could not find client with name of " . $search_name . "\n");
            }
            return $found_clients;
        }


    }

 ?>
