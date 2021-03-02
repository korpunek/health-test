<?php

	session_start();
	
	$inumer = $_SESSION["numer"];
	$inazwa = $_SESSION["nazwa"];
 
	$dhost = $_SESSION["dbhost"];
	$dbaza = $_SESSION["dbbaza"];
	$dnazwa = $_SESSION["dbnazwa"];
	$dhaslo = $_SESSION["dbhaslo"];
    $ukey = $_SESSION["tshark"];
 
	if ($inazwa == "" or $inumer == "") {header("Location: errror.htm");}

//    include('obj_config.php');	
    include('obj_crypt.php');
    
    $urekord = $_REQUEST['rekord'];
        
	$db = mysqli_connect($dhost, $dnazwa, $dhaslo, $dbaza);

	$sql = "UPDATE users SET ";
	$sql .= "firstname = '" . encrypt($_POST["firstname"], $ukey) . "',";
	$sql .= "lastname = '" . encrypt($_POST["lastname"], $ukey) . "',";
	$sql .= "rank = '" . encrypt($_POST["rank"], $ukey) . "',";
	$sql .= "idnumber = '" . encrypt($_POST["idnumber"], $ukey) . "',";
	$sql .= "status = '" . encrypt($_POST["status"], $ukey) . "',";
	$sql .= "recommended = '" . encrypt($_POST["recommended"], $ukey) . "',";
	$sql .= "approved = '" . encrypt($_POST["approved"], $ukey) . "',";
	$sql .= "doctorid = '" . encrypt($_POST["doctorid"], $ukey) . "',";
	$sql .= "ip = '" . encrypt($_POST["ip"], $ukey) . "'";
    $sql .= " WHERE id  = " . $urekord;
   
	if( ! mysqli_query($db, $sql))
	{
		$ERR_NO = mysqli_errno($db);
		$ERR_OP = mysqli_error($db);
        mysqli_close($db);
        header("Location: error.php?error=" . "BŁĄD ZAPISU DO BAZY BADAŃ ! <br>" . $sql . '<br>NR BŁĘDU : ' . $ERR_NO . '<br>OPIS BŁĘDU : ' . $ERR_OP);
	}
	else
	{
		mysqli_close($db);

		header("Location: reszyfr.php");
	}

?>
