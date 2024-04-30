<?php 
    include ("users.php");
    $q = $_REQUEST["q"];
    $res = "";
    if ($q !== "") {
        $q = strtolower($q);
        $len=strlen($q);
        foreach($countries as $name) {
            if (stristr($q, substr($name, 0, $len))) {
                if ($res === "") {
                    $res = $name;
                    
                }
                else {
                $res .= ", $name";
                }
                if(array_key_exists($name,$capitales)){
                    $res .=" (Capitale: ".$capitales[$name].")";
                }
            }
        }
    }
   
?>