<?php

$iblad = 0;

include('obj_config.php');

// include('obj_crypt.php');

$db = mysqli_connect($def_host, $def_nazwa, $def_haslo, $def_baza);
// mysql_select_db($def_baza, $db);

$sql = "SELECT * FROM users WHERE name='" . $_POST["name"] . "' AND active = 1";

$res = mysqli_query($db, $sql);

if (!$res)
{
	echo "ERROR " . mysql_errno();
	echo "<PRE>$sql</PRE>";
	echo mysql_error();
	exit;
}


if ($row = mysqli_fetch_assoc($res))
{
	if($row["blockade"] > 3)
	{
		$iblad = 2;
	}
	else
	{

		$tpass = hash('sha256', $_POST["pass"]);
		$tkey = substr($tpass, 15, 32);

//		if ($row["password"] == $_POST["pass"])

		if ($row["password"] == $tpass)
		{

			$inumer = $row['id'];
			$inazwa = $row['name'];
			$iaktywny = $row['active'];
			$iprawa =  $row['permissions'];
			$ilang =  $row['lang'];
			
			if($iaktywny == 0)
			{
				$iblad = 4;
			}
			else
			{
				session_start();

				$_SESSION["dbhost"] = $def_host;
				$_SESSION["dbbaza"] = $def_baza;
				$_SESSION["dbnazwa"] = $def_nazwa;
				$_SESSION["dbhaslo"] = $def_haslo;
				
				$_SESSION["tshark"] = $tkey;

				$_SESSION["numer"] = $inumer;
				$_SESSION["nazwa"] = $inazwa;			
				$_SESSION["prawa"] = $iprawa;
				$_SESSION["lang"] = $ilang;							

/*
				numkod = Session.SessionId & now()

				SQL = "INSERT INTO logi(KOD, USER, FIRMA, WEJSCIE, IP) "
				SQL = SQL & "VALUES ("
				SQL = SQL & "'" & numkod & "',"
				SQL = SQL & "'" & inazwa & "',"
				SQL = SQL & inumer & ","
				SQL = SQL & "'" & Now() & "',"
				SQL = SQL & "'" & Request.ServerVariables("REMOTE_ADDR") & "')"
				Conn.Execute(SQL)
*/
			}
		}	
		else
		{
			$iblad = 3;
		}

	}

}
else
{
	$iblad = 1;
}


mysqli_close($db);


If ($iblad > 100)
{
	$imessage = "ERROR NUMBER " . $iblad;

	header("Location: error.php?error={$imessage}");
}
else
{

		header("Location:hti_view.php");
	
}


?>
