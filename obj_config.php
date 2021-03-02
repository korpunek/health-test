<?php

$def_host = 'localhost';
$def_baza = 'hti';
$def_nazwa = 'root';
$def_haslo = 'Kiszka%Winieta';

function lang($key,$language,$dbfObj)
{
    $fdb = mysqli_connect($dbfObj->host, $dbfObj->nazwa, $dbfObj->haslo, $dbfObj->baza);
    $fsql = "SELECT * FROM languages WHERE lkey = '" . $key . "'";
    $fres = mysqli_query($fdb, $fsql);
    if (! $fres)
    {
        echo "ERROR " . mysqli_errno();
        echo mysqli_error();
        echo "<PRE>$fsql</PRE>";
        mysqli_close($fdb);
 	    exit;
    }  
    if( $frow = mysqli_fetch_assoc($fres)){$fret = $frow[$language];}
    else{$fret = "* undefined *";}
    mysqli_close($fdb);
    return $fret;
//    return $fdb;

}





?>
