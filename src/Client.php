<?php

    class Client
    {
        private $name;
        private $stylist_id;
        private $id;

        function __construct($name, $stylist_id=null, $id=null)
        {
            $this->name = $name;
            $this->stylist_id = $stylist_id;
            $this->id = $id;
        }

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

        function getId()
        {
            return (int) $this->id;
        }


        function save()
        {
            $sql_command = "INSERT INTO clients (name, stylist_id) VALUES('";
            $name = $this->getName();
            $stylist_id = $this->getStylistId();

            $sql_command = $sql_command . $name . "', " . $stylist_id . ");";

            $GLOBALS['DB']->exec($sql_command);

            $this->id = $GLOBALS['DB']->lastInsertId();
        }

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


    }

 ?>
