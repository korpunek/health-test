
<?php
	session_start();

	$inumer = $_SESSION["numer"];
	$inazwa = $_SESSION["nazwa"];
	
	$dbObj->host = $_SESSION["dbhost"];
	$dbObj->baza = $_SESSION["dbbaza"];
	$dbObj->nazwa = $_SESSION["dbnazwa"];
	$dbObj->haslo = $_SESSION["dbhaslo"];

	if ($inazwa == "" or $inumer == "") {header("Location: blad.htm");}

	include('obj_config.php');
	include('obj_crypt.php');
	include('head.php');

?>

<script type="text/javascript">


function szyfruj()
{

	// INIT
	var myString   = "blablabla dziabać blabać w dzień Card game bla";
	var myPassword = "myPassword1";

	// PROCESS
	var encrypted = CryptoJS.AES.encrypt(myString, myPassword);
	var decrypted = CryptoJS.AES.decrypt(encrypted, myPassword);
	document.getElementById("demo0").innerHTML = myPassword;
	document.getElementById("demo1").innerHTML = myString;
	document.getElementById("demo2").innerHTML = encrypted;
	document.getElementById("demo3").innerHTML = decrypted;
	document.getElementById("demo4").innerHTML = decrypted.toString(CryptoJS.enc.Utf8);


}


function zapisz()
{

	localStorage.setItem('myElement', 'Przykładowa wartość');
	
	document.getElementById("demo0").innerHTML = localStorage.getItem('myElement');	

}

function skasuj()
{

	localStorage.removeItem('myElement');

	document.getElementById("demo0").innerHTML = localStorage.getItem('myElement');	

}

function pokaz()
{

	document.getElementById("demo0").innerHTML = sessionStorage.getItem('has');	

}



function showUser(str)
{
	if (str == "")
	{
		document.getElementById("popcje").innerHTML = "";
		return;
	}
	else
	{ 
		if (window.XMLHttpRequest)
		{
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		}
		else
		{
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function()
		{
			if (this.readyState == 4 && this.status == 200)
			{
				document.getElementById("popcje").innerHTML = this.responseText;
			}
		};

		xmlhttp.open("GET","opcja_get.php?q="+str,true);
		xmlhttp.send();

		scroll(0,0);

	}
}

</script>
	
</HEAD>

<?php

//    $hid = new Crypt('Kapiszon89');

//    $text1 = $hid->encrypt('Litwo ojczyzno moja ty jesteś jak zdrowie');
//    $text2 = $hid->decrypt($text1);

// $tiv = 	substr(hash('sha256', random_bytes(32)), 0, 16);


//$tkey = hash('sha256', random_bytes(64));

//$tkey = 'c6a507a4f249eb00b4d4e8473b69ff325a71a33363b9dc029df4379b04b77988';

$secret_key = 'Rzymsko2019';

//$tkey = substr(hash('sha256', $secret_key), 15, 32);

$tkey = hash('sha256', $secret_key);


$text0 = 'Litwo ojczyzno moja ty jesteś jak zdrowie';
$text1 = encrypt($text0 , $tkey);
$text2 = decrypt($text1 , $tkey);

?>


<BODY text=#000000 bgColor=#ffffff leftMargin=0 topMargin=0 marginwidth="0" marginheight="0">

<div class="container">

<?php
		$pozycja = 4;
		include('nav.php');
?>

<br>

<br>

<center>
		
<p><h2>Szyfrowanie</h2></p><br>

</center>			

<FORM NAME="forma" METHOD="POST" ACTION="rejestracja_dodaj.php" class="form-horizontal">

	<div class="form-group row">
		<label for="inputIV" class="col-12 col-lg-2 control-label">IV</label>
		<div class="col-12 col-lg-5">
            <textarea class="form-control" rows="2" name="text" id="inputIV"><?php echo $secret_key; ?></textarea>
		</div>

		<div class="col-12 col-lg-5">
            <textarea class="form-control" rows="2" name="text" id="demo0"></textarea>
		</div>

	</div>	

	<div class="form-group row">
		<label for="inputKEY" class="col-12 col-lg-2 control-label">KEY</label>
		<div class="col-12 col-lg-5">
            <textarea class="form-control" rows="3" name="text" id="inputKEY"><?php echo $tkey; ?></textarea>
		</div>

		<div class="col-12 col-lg-5">
            <textarea class="form-control" rows="3" name="text" id="demo1"></textarea>
		</div>

	</div>	

	<div class="form-group row">
		<label for="inputText" class="col-12 col-lg-2 control-label">Text</label>
		<div class="col-12 col-lg-5">
            <textarea class="form-control" rows="3" name="text" id="inputText"><?php echo $text0; ?></textarea>
		</div>

		<div class="col-12 col-lg-5">
            <textarea class="form-control" rows="3" name="text" id="demo2"></textarea>
		</div>

  </div>	
    
	<div class="form-group row">
		<label for="inputSzyfr" class="col-12 col-lg-2 control-label">Szyfrowany</label>
		<div class="col-12 col-lg-5">
            <textarea class="form-control" rows="3" name="szyfr" id="inputSzyfr"><?php echo $text1; ?></textarea>
		</div>

		<div class="col-12 col-lg-5">
            <textarea class="form-control" rows="3" name="text" id="demo3"></textarea>
		</div>

	</div>	
	
	<div class="form-group row">
		<label for="inputWynik" class="col-12 col-lg-2 control-label">Text</label>
		<div class="col-12 col-lg-5">
        	<textarea class="form-control" rows="3" name="wynik" id="inputWynik"><?php echo $text2; ?></textarea>        
		</div>

		<div class="col-12 col-lg-5">
            <textarea class="form-control" rows="3" name="text" id="demo4"></textarea>
		</div>

	</div>	

</FORM>


	<div class="row">

		<div class="col-6">
		
		</div>

		<div class="col-2">
			<button class="btn btn-warning" OnClick="szyfruj()">Zaszyfruj JS</button>
		</div>
			
		<div class="col-2">
			<button class="btn btn-warning" OnClick="zapisz()">Zapisz storage</button>
		</div>

		<div class="col-2">
			<button class="btn btn-warning" OnClick="skasuj()">Skasuj storage</button>
		</div>

	</div>

	<div class="row">

		<div class="col-6">
		
		</div>

		<div class="col-2">
			<button class="btn btn-warning" OnClick="pokaz()">Pokaż sessionStorage</button>
		</div>


	</div>



<br>

</div>
	
</BODY>

</HTML>


