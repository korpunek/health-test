<?php
	session_start();

	$inumer = $_SESSION["numer"];
	$inazwa = $_SESSION["nazwa"];
	$ilang = $_SESSION["lang"];
		

	$dbObj->host = $_SESSION["dbhost"];
	$dbObj->baza = $_SESSION["dbbaza"];
	$dbObj->nazwa = $_SESSION["dbnazwa"];
	$dbObj->haslo = $_SESSION["dbhaslo"];
	
	if ($inazwa == "" or $inumer == "") {header("Location: error.htm");}

    $prekord = $_REQUEST['rekord'];

	$db = mysqli_connect($dbObj->host, $dbObj->nazwa, $dbObj->haslo, $dbObj->baza);
	
	$sql = "SELECT * FROM users WHERE id = 1";
	$res = mysqli_query($db, $sql);

	if (! $res)
	{
			echo "ERROR " . mysqli_errno();
			echo mysqli_error();
			echo "<PRE>$sql</PRE>";
	}

	$row = mysqli_fetch_assoc($res);
		

	include('obj_config.php');	
	include('obj_crypt.php');
	include('head.php');


	function alert($msg)
	{
		echo "<script type='text/javascript'>alert('$msg');</script>";
	}


?>

    <script type="text/javascript">

		function start()
		{
			$('#pliktab a').on('click', function (e)
				{
					e.preventDefault()
					$(this).tab('show')
				}
			)	
	
			//			document.getElementById(lista).innerHTML = "";	
		}


	</script>


</HEAD>

<BODY text=#000000 bgColor=#ffffff leftMargin=0 topMargin=0 marginwidth="0" marginheight="0" onLoad="start()">


<div class="container">

	<?php
		$pozycja = 1;
		include('nav.php');
	?>

	<br>

	<div class="row">

		<div class="col-12 col-lg-12">

			<br>

			<center>
					
			<p><h2>Reszyfrowanie danych</h2></p><br>

			</center>			

		
			<FORM NAME="forma" METHOD="POST" ACTION="reszyfr_update.php?rekord=1" class="form-horizontal">

					<div class="form-group row">
						<label for="inputOxy1" class="col-12 col-lg-2 control-label">Imię</label>
						<div class="col-12 col-lg-5">
							<input type="text" class="form-control" name="firstname" id="inputOxy1" placeholder="" value="<?php echo $row['firstname']; ?>" autofocus>
						</div>
						<label for="inputOxy1" class="col-12 col-lg-5 control-label">
							Wpisz wynik z oksymetru przed ćwiczeniem.
						</label>
					</div>	

					<div class="form-group row">
						<label for="inputPulse1" class="col-12 col-lg-2 control-label">Nazwisko</label>
						<div class="col-12 col-lg-5">
							<input type="text" class="form-control" name="lastname" id="inputPulse1" placeholder="" value="<?php echo $row['lastname']; ?>">
						</div>
						<label for="inputPulse1" class="col-12 col-lg-5 control-label">
							Wpisz puls przed ćwiczeniem.
						</label>
					</div>	
					
					<div class="form-group row">
						<label for="inputDistance1" class="col-12 col-lg-2 control-label">Stopień</label>
						<div class="col-12 col-lg-5">
							<input type="text" class="form-control" name="rank" id="inputDistance1" placeholder="" value="<?php echo $row['rank']; ?>">
						</div>
						<label for="inputDistance1" class="col-12 col-lg-5 control-label">
							Wpisz dystans przebyty w czasie ćwiczenia w metrach.
						</label>
					</div>	

					<div class="form-group row">
						<label for="inputTime1" class="col-12 col-lg-2 control-label">Nr legitymacji</label>
						<div class="col-12 col-lg-5">
							<input type="text" class="form-control" name="idnumber" id="inputTime1" placeholder="" value="<?php echo $row['idnumber']; ?>">
						</div>
						<label for="inputTime1" class="col-12 col-lg-5 control-label">
							Wpisz czas ćwiczenia w minutach.
						</label>
					</div>	
					
					<div class="form-group row">
						<label for="inputOxy1e" class="col-12 col-lg-2 control-label">Status</label>
						<div class="col-12 col-lg-5">
							<input type="text" class="form-control" name="status" id="inputOxy1e" placeholder="" value="<?php echo $row['status']; ?>">
						</div>
						<label for="inputOxy1e" class="col-12 col-lg-5 control-label">
							Wpisz wynik z oksymetru po ćwiczeniu.
						</label>
					</div>	

					<div class="form-group row">
						<label for="inputPresureA1e" class="col-12 col-lg-2 control-label">Rekomendował</label>
						<div class="col-12 col-lg-5">
							<input type="text" class="form-control" name="recommended" id="inputPresureA1e" placeholder="" value="<?php echo $row['recommended']; ?>">
						</div>
						<label for="inputPresureA1e" class="col-12 col-lg-5 control-label">
							Wpisz ciśnienie skurczowe i rozkurczowe po ćwiczeniu.
						</label>
					</div>	

					<div class="form-group row">
						<label for="inputPulse1e" class="col-12 col-lg-2 control-label">Aprobował</label>
						<div class="col-12 col-lg-5">
							<input type="text" class="form-control" name="approved" id="inputPulse1e" placeholder="" value="<?php echo $row['approved']; ?>">
						</div>
						<label for="inputPulse1e" class="col-12 col-lg-5 control-label">
							Wpisz puls po ćwiczeniu.
						</label>
					</div>	

					<div class="form-group row">
						<label for="inputPulse1e" class="col-12 col-lg-2 control-label">Lekarz</label>
						<div class="col-12 col-lg-5">
							<input type="text" class="form-control" name="doctorid" id="inputPulse1e" placeholder="" value="<?php echo $row['doctorid']; ?>">
						</div>
						<label for="inputPulse1e" class="col-12 col-lg-5 control-label">
							Wpisz puls po ćwiczeniu.
						</label>
					</div>	

					<div class="form-group row">
						<label for="inputPulse1e" class="col-12 col-lg-2 control-label">IP</label>
						<div class="col-12 col-lg-5">
							<input type="text" class="form-control" name="ip" id="inputPulse1e" placeholder="" value="<?php echo $row['ip']; ?>">
						</div>
						<label for="inputPulse1e" class="col-12 col-lg-5 control-label">
							Wpisz puls po ćwiczeniu.
						</label>
					</div>	

                    <div>

                        <div class="col-12">
            			    <button type="submit" class="btn btn-warning">Zapisz</button>
		                </div>
                    
                    </div>




	    			<br>
			
			</FORM>

		</div>

	</div>




    <?php mysqli_close($db); ?>



</div>

<br><br>

</BODY>

</HTML>
`