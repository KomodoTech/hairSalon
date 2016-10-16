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

            $this->id = (int) $GLOBALS['DB']->lastInsertId();
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

        function updateName($new_name)
        {
            $id = $this->getId();
            $sql_command = "UPDATE stylists SET name = '" . $new_name . "' WHERE id = " . $id . ";";
            $GLOBALS['DB']->exec($sql_command);

            $this->setName($new_name);
        }

        function delete()
        {
            $id = $this->getId();
            $sql_command = "DELETE FROM stylists WHERE id = " . $id . ";";
            $GLOBALS['DB']->exec($sql_command);
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
                    $stylist_id = (int) $current_stylist['id'];

                    $stylist_object = new Stylist($stylist_name, $stylist_id);
                    $stylists[] = $stylist_object;
                }
            }
            return $stylists;
        }



        static function findById($search_id)
        {
            $search_id = (int) $search_id;

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
                // print("Could not find stylist with id of " . $search_id . "\n");
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
                // print("Could not find stylist with name of " . $search_name . "\n");
            }
            return $found_stylists;
        }

        /*TODO:
         * REVISIT MERIT OF LAZY INSTANTIATE HERE. SEEMS TO MAKE LITTLE
         * SENSE IN THIS CASE
         */
        /*==LAZY INSTANTIATE UNASSIGNED STYLIST================*/
        static function getUnassignedStylist()
        {
            $unassigned = Stylist::findByName("UNASSIGNED");

            if ($unassigned)
            {
                $unassigned_stylist = $unassigned[0];
                return $unassigned_stylist;
            }
            else
            {
                $sql_command = "INSERT INTO stylists (name) VALUES ('UNASSIGNED');";

                $GLOBALS['DB']->exec($sql_command);

                //NOTE: figure out why recursion returned twice
                $unassigned = Stylist::findByName("UNASSIGNED");

                if ($unassigned)
                {
                    $unassigned_stylist = $unassigned[0];
                    return $unassigned_stylist;
                }
            }
            return NULL;
        }

        /*NOTE:
         * If no UNASSIGNED stylist has been created then returns null.
         * If UNASSIGNED stylist exists and is unique, then an unmodified array
         * of stylists is returned.
         * If UNASSIGNED stylist existes but is not unique, first stylist with the
         * name UNASSIGNED is designated official, and all clients belonging to
         * "unoffical" UNASSIGNED stylists are reassigned to the "official" one.
         * Finally, all unoffical UNASSIGNED stylists are deleted once they are no
         * longer linked to any clients. The modified array is returned;
         */
        static function makeUnassignedStylistUnique($stylists)
        {
            $unassigned_counter = 0;
            $unassigned_stylist = NULL;
            $modified_stylists = [];
            for ($stylist_index = 0; $stylist_index < count($stylists); $stylist_index++)
            {
                $current_stylist = $stylists[$stylist_index];
                if ($current_stylist->getName() === "UNASSIGNED")
                {
                    // CHECK IF THERE ARE MULTIPLE UNASSIGNED STYLISTS
                    if (!$unassigned_counter)
                    {
                        $unassigned_stylist = $current_stylist;
                        $modified_stylists[] = $current_stylist;
                    }
                    // REASSIGN CLIENTS OF UNOFFICIAL UNASSIGNED STYLIST TO OFFICIAL
                    // AKA FIRST UNASSIGNED STYLIST
                    else
                    {
                        $unassigned_stylist_id = $unassigned_stylist->getId();

                        // NOTE: this creates new clients based on data in the database
                        // This will NOT return a reference to existing local client objects
                        $unassigned_clients = $current_stylist->getClients();

                        for ($client_index = 0; $client_index < count($unassigned_clients); $client_index++)
                        {
                            $current_client = $unassigned_clients[$client_index];
                            /* NOTE:
                             * CLIENT CAN ONLY HAVE ONE STYLIST SO OVERLAP SHOULD NOT
                             * BE A PROBLEM
                             */
                             $current_client->updateStylistId($unassigned_stylist_id);
                        }
                        /* AFTER ALL CLIENTS REASSIGNED DELETE DUPLICATED UNASSIGNED
                         * STYLIST.
                         */
                         $current_stylist->delete();
                    }
                    $unassigned_counter++;
                }
                // CURRENT STYLIST IS NOT SPECIAL UNASSIGNED STYLIST
                else
                {
                    $modified_stylists[] = $current_stylist;
                }
            }
            return $modified_stylists;
        }


        // FOR REORDERING STYLISTS TO HAVE UNASSIGNED AT INDEX 0
        static function moveUnassignedStylistToBeginning($stylists)
        {
            $stylists = self::makeUnassignedStylistUnique($stylists);

            $unique_unassigned_stylist = Stylist::findByName("UNASSIGNED")[0];

            if ($unique_unassigned_stylist)
            {
                // CREATE NEW TEMP ARRAY WITH UNASSIGNED AT THE BEGINNING
                $stylists_temp = [$unique_unassigned_stylist];

                // REORDER STYLISTS SO THAT UNASSIGNED IS ALWAYS FIRST
                for ($stylist_index = 0; $stylist_index < count($stylists); $stylist_index++)
                {
                    $current_stylist = $stylists[$stylist_index];
                    // IF UNASSIGNED STYLIST MOVE ON
                    if ($current_stylist != $unique_unassigned_stylist)
                    {
                        $stylists_temp[] = $current_stylist;
                    }
                }

                $stylists = $stylists_temp;
            }
            return $stylists;
        }
    }
 ?>
