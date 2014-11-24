<?php

session_start();
    $K1 = "WORD";
    $K2 = "MEAN";
    $K3 = "EX";
    $V1 = strtolower($_SESSION[$K1]);
    $V2 = strtr($_SESSION[$K2], array("\n"=>"<br>", "\r"=>"")); 
    $V3 = strtr($_SESSION[$K3], array("\n"=>"<br>", "\r"=>"")); 
    $table = getTable($V1{0});  // char_at($v1, 0)
    
    if(!empty($V1) && !empty($V2)){
        global $conn;        
        $V1 = mysqli_real_escape_string($conn, $V1);
        $V2 = mysqli_real_escape_string($conn, $V2);
        $V3 = mysqli_real_escape_string($conn, $V3);

        $query = "INSERT INTO $table ($K1, $K2, $K3 ) VALUES ('$V1', '$V2', '$V3')"; 
        if(mysqli_query($conn, $query))
            echo "1";     //success
        else echo "0";  //failed, error querying database
    
    }   else echo "0";

    
?>

