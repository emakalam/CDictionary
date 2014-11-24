<?php
session_start();
    
    $table =  getTable( $_SESSION["search"]{0} );
    $word = mysqli_real_escape_string($conn, $_SESSION["search"]);
    $rawdata = mysqli_query($conn, "SELECT * FROM $table WHERE WORD='$word'");  //returns false on no match

    if (isset($_SESSION["check"])) {
        if($rawdata)
            echo mysqli_num_rows($rawdata);
        else echo -1;
        session_unset();
        session_destroy();
        die();
     }
    
    if ($rawdata) {
        $i = 0;
        $fulljson = '{';
        while ($row = mysqli_fetch_array($rawdata, MYSQLI_ASSOC)) {
            $json = '{';
            unset($row["WORD"]);
            foreach ($row as $k=>$v) {
                $json .= '"'.$k.'":"';
                $json .= $v.'",';
            }
            
            $json{strrpos($json, ",")} = '}';
            $fulljson .= '"W'.++$i.'":'.$json.',' ;            
        }
        if ($i == 0) {
            $comment = '"Word '.$word.' not found. Consider a contribution"';
            $fulljson = '{"KEYS":0,"WORD":"","DICTIONARY":{},"COMMENT":'.$comment.'}';
        } else {
            $fulljson{strrpos($fulljson, ",")} = '}';
            $fulljson = '{"KEYS":'.$i.',"WORD":"'.$word.'","DICTIONARY":'.$fulljson.',"COMMENT":""}';
        }
    }

    else  $fulljson = '{"KEYS":0,"WORD":"","DICTIONARY":{},"COMMENT":"An error occured while browsing database"}';
    echo strtr($fulljson, array("\'" => "'"));
?>
