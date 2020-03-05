<?php
error_reporting(0);
require 'db/connect.php';

/*if ($result = $db->query("SELECT * FROM people")) {
    if ($result->num_rows){


        while ($row = $result->fetch_object()) {
            echo $row->first_name , ' ', $row->last_name , '<br>';
        }

        $result->free();
    }    
}*/

/*$name = $_POST["name"];*/

/*echo $name;*/

/*if ($update = $db->query("UPDATE people SET created = NOW() WHERE first_name = '$name'")){
    echo $db->affected_rows;
}*/

/*if ($update = $db->query("DELETE FROM people WHERE id = 1")){
    echo $db->affected_rows;
}*/

if ($insert = $db->query("INSERT INTO people (first_name, last_name, bio, created) VALUES ('Alex', 'Garret', 'I\'m a web developer', NOW())")){
    echo $db->affected_rows;
}
?>