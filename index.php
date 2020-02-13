<?php

$tree = json_decode(file_get_contents('tree.json'), true);
$list = json_decode(file_get_contents('list.json'), true);

function get_names($data) {
    $return = array();
    foreach ($data as $r) {
        $return[$r['category_id']] = $r['translations']['pl_PL']['name'];
    }
    return $return;
}


function test($data, $i, $n) {
    
    foreach($data as $r) {
        array_push($data, array('test' => 'dupa'));
        //for ($x=0; $x<$i; $x++) echo "---";
        //echo $r['id'];
        //if (isset($n[$r['id']])) echo ": " . $n[$r['id']];
        //echo "<br>";
        
        test($r['children'], $i+1, $n);
    }
    return $data;
}


function test2($data) {
    print_r($data);
}


//print_r(test($tree, 0, get_names($list)));


//print_r(get_names($list));
//test($tree, 0, get_names($list));
//print_r(test($tree, 0, get_names($list)));
//test2($tree);
?>