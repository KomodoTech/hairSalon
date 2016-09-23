<?php

    class Stylist
    {
        private $name;
        private $id;

        function __construct($name, $id=null)
        {
            $this->name = $name;
            $this->id = $id;
        }

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


        function save()
        {
            $sql_command = "INSERT INTO stylists (name) VALUES ('";
            $name = $this->getName();

            $sql_command = $sql_command . $name . "');";

            $GLOBALS['DB']->exec($sql_command);

            $this->id = $GLOBALS['DB']->lastInsertId();
        }

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
