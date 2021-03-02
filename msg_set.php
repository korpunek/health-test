<?php

    session_start();

    $inumer = $_SESSION["numer"];
    $inazwa = $_SESSION["nazwa"];

    $dhost = $_SESSION["dbhost"];
    $dbaza = $_SESSION["dbbaza"];
    $dnazwa = $_SESSION["dbnazwa"];
    $dhaslo = $_SESSION["dbhaslo"];

    if ($inazwa == "" or $inumer == "") {header("Location: blad.htm");}

    $prekord = $_REQUEST['rekord'];

    $dbm = mysqli_connect($dhost, $dnazwa, $dhaslo, $dbaza);
    // mysql_select_db($dbaza, $db);
    
    $sqlm = "UPDATE messages SET status = 0 WHERE id = " . $prekord;

    if( ! mysqli_query($dbm, $sqlm))
    {
        $ERR_NO = mysql_errno();
        $ERR_OP = mysql_error();
        mysqli_close($dbm);

        echo "BŁĄD POPRAWIANIA REKORDU ! \n" . $sqlm . "\nNR BŁĘDU : " . $ERR_NO . "\nOPIS BŁĘDU : " . $ERR_OP;
    }
    else
    {
        mysqli_close($dbm);

        echo str_repeat("<br>", 13);        

    }  

?>
