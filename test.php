<?php

    class treeJson {
        public $tree;
        public $list;
        public $names;
        public $buf = array();

        //Contructor
        function __construct() {
            $this->tree = json_decode(file_get_contents('tree.json'), true);
            $this->list = json_decode(file_get_contents('list.json'), true);
            $this->names = $this->get_names();
        }

        //Create array with pairs 'customer_id' : 'name'
        function get_names() {
            $return = array();
            foreach ($this->list as $r) {
                $return[$r['category_id']] = $r['translations']['pl_PL']['name'];
            }
            return $return;
        }

        //Add names to array
        function add_names(&$data) {
            foreach($data as &$d) {
                if (isset($this->names[$d['id']]))                  //Check if there is 'name' with this 'id' in $names
                    $d = ['name' => $this->names[$d['id']]] + $d;   //Add 'name' with value to the begining of array
                else $d = ['name' => null] + $d;                    //If there is no name for this 'id' put null instead
                $this->add_names($d['children']);               //Do these same for children
                
            }
            return $data;

        }
    }

    //Create class object
    $t = new treeJson;

    //Create variable with json data
    $json = json_encode($t->add_names($t->tree));       //Function add_names with data from 'tree'
    file_put_contents('names.json', $json);            //Save new json with names to a file
?>