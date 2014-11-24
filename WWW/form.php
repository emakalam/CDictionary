<?php
    
if (isset( $_GET["search"])) {
    if(preg_match('/[^-\'\d\p{L}]+/', $_GET["search"])){
        if (isset($_GET["check"]))
            echo -1;
        else echo '{"KEYS":0,"WORD":"","DICTIONARY":{},"COMMENT":"Invalid String"}';
        die();
    }
    $next = "search";
}

else if (isset($_POST["WORD"]) ){
    if(isset($_POST["MEAN"])){
        if(preg_match('/[^-\'\d\p{L}]+/', $_POST["WORD"])){
            echo "0";
            die();
        }
    }
    else header('location:Contribute.html');
}

else {
    header('location:Search.html');
}

require('connect.php');
session_start();
if($next == "search"){
    $_SESSION["search"] = $_GET["search"];
    if(isset($_GET["check"]))
        $_SESSION["check"] = 1;
    require ('search.php');
}
else {
    $_SESSION["WORD"] = $_POST["WORD"];
    $_SESSION["MEAN"] = $_POST["MEAN"];
    $_SESSION["EX"] = isset($_POST["EX"]) ? $_POST["EX"] : "";
    require('add.php');
}

$conn->close();
session_unset();
session_destroy();

function getTable($c) 
{
    switch($c)
    {
    case 't' : { $table = "t"; break; 
        }
    case 'a' : {$table = "a"; break;
        }
    case 's': case 'h': {$table = "sh"; break;
        }
    case 'w': case 'i': {$table = "wi"; break;
        }
    case 'b': case 'e': case 'm': case 'o': {$table = "bemo"; break;
        }
    default: $table = "rest";
    }

    return $table;
}
?>
