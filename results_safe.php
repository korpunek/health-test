<?php

	session_start();
	
	$inumer = $_SESSION["numer"];
	$inazwa = $_SESSION["nazwa"];
 
	$dhost = $_SESSION["dbhost"];
	$dbaza = $_SESSION["dbbaza"];
	$dnazwa = $_SESSION["dbnazwa"];
	$dhaslo = $_SESSION["dbhaslo"];

 
	if ($inazwa == "" or $inumer == "") {header("Location: errror.htm");}

	$db = mysqli_connect($dhost, $dnazwa, $dhaslo, $dbaza);

	$sql = "INSERT INTO results SET ";
	$sql .= "id = NULL,";
	$sql .= "userid = " . $inumer . ",";
	$sql .= "oxygenation1 = " . $_POST["oxy1"] . ",";
	$sql .= "pressure1A = " . $_POST["presureA1"] . ",";
	$sql .= "pressure1B = " . $_POST["presureB1"] . ",";
	$sql .= "pulse1 = " . $_POST["pulse1"] . ",";

$dist = $_POST["distance1"];
$etime = $_POST["time1"];
$ilive = $dist/($etime*5);

	$sql .= "distance1 = " . $dist . ",";
	$sql .= "time_of_exercise1 = " . $etime . ",";
	$sql .= "liveindex1 = " . $ilive . ",";
	$sql .= "oxygenation1e = " . $_POST["oxy1e"] . ",";
	$sql .= "pressure1Ae = " . $_POST["presureA1e"] . ",";
	$sql .= "pressure1Be = " . $_POST["presureB1e"] . ",";
	$sql .= "pulse1e = " . $_POST["pulse1e"] . ",";

	$sql .= "oxygenation2 = " . $_POST["oxy2"] . ",";
	$sql .= "pressure2A = " . $_POST["presureA2"] . ",";
	$sql .= "pressure2B = " . $_POST["presureB2"] . ",";
	$sql .= "pulse2 = " . $_POST["pulse2"] . ",";

$dist = $_POST["distance2"];
$etime = $_POST["time2"];
$ilive = $dist/($etime*5);
	
	$sql .= "distance2 = " . $dist . ",";
	$sql .= "time_of_exercise2 = " . $etime . ",";
	$sql .= "liveindex2 = " . $ilive . ",";
	$sql .= "oxygenation2e = " . $_POST["oxy2e"] . ",";
	$sql .= "pressure2Ae = " . $_POST["presureA2e"] . ",";
	$sql .= "pressure2Be = " . $_POST["presureB2e"] . ",";
	$sql .= "pulse2e = " . $_POST["pulse2e"] . ",";

	$sql .= "oxygenation3 = " . $_POST["oxy3"] . ",";
	$sql .= "pressure3A = " . $_POST["presureA3"] . ",";
	$sql .= "pressure3B = " . $_POST["presureB3"] . ",";
	$sql .= "pulse3 = " . $_POST["pulse3"] . ",";

$dist = $_POST["distance3"];
$etime = $_POST["time3"];
$ilive = $dist/($etime*5);
	
	$sql .= "distance3 = " . $dist . ",";
	$sql .= "time_of_exercise3 = " . $etime . ",";
	$sql .= "liveindex3 = " . $ilive . ",";
	$sql .= "oxygenation3e = " . $_POST["oxy3e"] . ",";
	$sql .= "pressure3Ae = " . $_POST["presureA3e"] . ",";
	$sql .= "pressure3Be = " . $_POST["presureB3e"] . ",";
	$sql .= "pulse3e = " . $_POST["pulse3e"] . ",";

	$sql .= "comfort = " . $_POST["comfort"] . ",";
	$sql .= "date = " . "'" . $_POST["date"] . "',";
    $sql .= "delivered = " . "'" . date("Y-m-d G:i:s") . "',";
	$sql .= "ip = " . "'" . $_SERVER["REMOTE_ADDR"] . "'";
   
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

		header("Location: results_list.php");
	}

?>
