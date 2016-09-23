<?php

    class Stylist
    {
        private $name;
        private $id;

        /*==CONSTRUCTOR========================================*/
        function __construct($name, $id=null)
        {
            $this->name = $name;
            $this->id = $id;
        }

        /*==GETTERS/SETTERS========================================*/
        function getName()
        {
            return (string) $this->name;
        }

        //TODO: update database after calling setName
        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getId()
        {
            return (int) $this->id;
        }

        /*==METHODS===============================================*/
        function save()
        {
            $sql_command = "INSERT INTO stylists (name) VALUES ('";
            $name = $this->getName();

            $sql_command = $sql_command . $name . "');";

            $GLOBALS['DB']->exec($sql_command);

            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function getClients()
        {
            $clients_of_stylist = [];
            $stylist_id = $this->getId();

            $sql_command = "SELECT * FROM clients WHERE stylist_id = " . $stylist_id . ";";

            $clients_PDOStatement = $GLOBALS['DB']->query($sql_command);

            if ($clients_PDOStatement)
            {
                $clients_array = $clients_PDOStatement->fetchAll();

                for ($client_index = 0; $client_index < count($clients_array); $client_index++)
                {
                    $current_client = $clients_array[$client_index];
                    $name = $current_client['name'];
                    $stylist_id = $current_client['stylist_id'];
                    $id = $current_client['id'];

                    $current_client_object = new Client($name, $stylist_id, $id);
                    $clients_of_stylist[] = $current_client_object;
                }
            }
            return $clients_of_stylist;
        }

        function update($new_name)
        {
            $id = $this->getId();
            $sql_command = "UPDATE stylists SET name = '" . $new_name . "' WHERE id = " . $id . ";";
            $GLOBALS['DB']->exec($sql_command);

            $this->setName($new_name);
        }


        /*==STATIC METHODS==========================================*/
        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stylists");
        }

        static function getAll()
        {
            $stylists = [];

            $stylists_PDOStatement = $GLOBALS['DB']->query("SELECT * FROM stylists;");

            if ($stylists_PDOStatement)
            {
                $stylists_data = $stylists_PDOStatement->fetchAll();

                for ($stylist_index = 0; $stylist_index < count($stylists_data); $stylist_index++)
                {
                    $current_stylist = $stylists_data[$stylist_index];
                    $stylist_name = $current_stylist['name'];
                    $stylist_id = $current_stylist['id'];

                    $stylist_object = new Stylist($stylist_name, $stylist_id);
                    $stylists[] = $stylist_object;
                }
            }
            return $stylists;
        }



        static function findById($search_id)
        {
            $found_stylist = null;
            $stylists_in_database = Stylist::getAll();

            for ($stylist_index = 0; $stylist_index < count($stylists_in_database); $stylist_index++)
            {
                $current_stylist = $stylists_in_database[$stylist_index];
                $current_stylist_id = $current_stylist->getId();

                if ($current_stylist_id == $search_id)
                {
                    $found_stylist = $current_stylist;
                }
            }

            if (!$found_stylist)
            {
                print("Could not find stylist with id of " . $search_id . "\n");
            }
            return $found_stylist;
        }

        static function findByName($search_name)
        {
            $found_stylists = [];

            $stylists_in_database = Stylist::getAll();

            for ($stylist_index = 0; $stylist_index < count($stylists_in_database); $stylist_index++)
            {
                $current_stylist = $stylists_in_database[$stylist_index];
                $current_stylist_name = $current_stylist->getName();

                if ($current_stylist_name == $search_name)
                {
                    $found_stylists[] = $current_stylist;
                }
            }

            if (!count($found_stylists))
            {
                print("Could not find stylist with name of " . $search_name . "\n");
            }
            return $found_stylists;
        }

    }


 ?>
