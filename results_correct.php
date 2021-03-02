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
	
	$sql = "SELECT * FROM results WHERE id = " . $prekord;
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

        const zakresy = [];

        zakresy[0] = [100,10000,"Wartość dystansu jest nieprawidłowa, powinna zawierać się w przedziale 100 - 10000 metrów !"];
        zakresy[1] = [80,99,"Wartość natlenienia organizmu jest nieprawidłowa, jeżeli to nie jest błędny wpis Twoje życie jest zagrożone - udaj się do lekarza !"];
        zakresy[2] = [40,160,"Wartość ciśnienia skurczowego jest nieprawidłowa, jeżeli to nie jest błędny wpis Twoje życie jest zagrożone - udaj się do lekarza !"];
        zakresy[3] = [40,160,"Wartość ciśnienia rozskurczowego jest nieprawidłowa, jeżeli to nie jest błędny wpis Twoje życie jest zagrożone - udaj się do lekarza !"];
        zakresy[4] = [30,200,"Wartość pulsu jest nieprawidłowa, jeżeli to nie jest błędny wpis Twoje życie jest zagrożone - udaj się do lekarza !"];
        zakresy[5] = [10,240,"Wartość czasu ćwiczenia jest nieprawidłowa,  powinna zawierać się w przedziale 10 - 240 minut !"];


		function test(pole,obiekt)
		{
			obiekt.style.backgroundColor='white';

			if((obiekt.value < zakresy[pole][0]) || (obiekt.value > zakresy[pole][1]))
			{
				document.getElementById("modal_text").innerHTML = zakresy[pole][2];
				obiekt.style.backgroundColor='red';
				$('#exampleModal').modal();
			}			
		}

		function sprawdz()
		{
			var j = 0;
			var i = 0;
			var k = 0;

			if(document.getElementById("inputZapis").checked){ k = 1; }

			for(i=0; i<document.forma.length; i++)
			{
				if(isNaN(parseInt(document.forma.elements[i].value,10)))
				{
					if((k == 1) && (i > 4))
					{
						document.forma.elements[i].value = 0;
					}
					else
					{
						document.forma.elements[i].style.backgroundColor='red';					
					 	j++;
					}	 
				}
			}	

			if( j == 0 )
			{
				forma.submit();				
			}
			else
			{
				alert( j + " pola nie zostały prawidłowo wypełnione ! Proszę poprawić wartości w polach zaznaczonych na czerwono.");
			}

		}


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
					
			<p><h2>Popraw dane</h2></p><br>

			</center>			

		
			<FORM NAME="forma" METHOD="POST" ACTION="results_update.php?rekord=<?php echo $prekord?>" class="form-horizontal">

				<div class="bg-light">
					<div class="form-group row bg-warning align-items-center">
						<label for="inputDate" class="col-12 col-lg-2 control-label">Data badania</label>
						<div class="col-12 col-lg-5">
							<input type="text" class="form-control" name="date" id="inputDate" placeholder="" value="<?php echo $row['date'];?>">
						</div>
						<label for="inputDate" class="col-12 col-lg-5 control-label">
							Bieżąca data wpisywana jest automatycznie, jeżeli data ma być inna zmień ją.
						</label>
					</div>	

					<br>
					<p><h4>Faza 1 ( do godz. 10.00 )</h4></p><br>
					<br>
					
					<div class="form-group row">
						<label for="inputOxy1" class="col-12 col-lg-2 control-label">Natlenienie krwi 1</label>
						<div class="col-12 col-lg-5">
							<input type="text" class="form-control" name="oxy1" id="inputOxy1" placeholder="" onChange="test(1,this)" value="<?php echo $row['oxygenation1']; ?>" autofocus>
						</div>
						<label for="inputOxy1" class="col-12 col-lg-5 control-label">
							Wpisz wynik z oksymetru przed ćwiczeniem.
						</label>
					</div>	

					<div class="form-group row">
						<label for="inputPresureA1" class="col-12 col-lg-2 control-label">Ciśnienie krwi 1</label>
						<div class="col-6 col-lg-2">
							<input type="text" class="form-control" name="presureA1" id="inputPresureA1" placeholder="skurczowe" onChange="test(2,this)" value="<?php echo $row['pressure1A']; ?>">
						</div>
						<div class="col-6 col-lg-3">
							<input type="text" class="form-control" name="presureB1" id="inputPresureB1" placeholder="rozkurczowe" onChange="test(3,this)" value="<?php echo $row['pressure1B']; ?>">
						</div>
						<label for="inputPresureA1" class="col-12 col-lg-5 control-label">
							Wpisz ciśnienie skurczowe i rozkurczowe przed ćwiczeniem.
						</label>
					</div>	

					<div class="form-group row">
						<label for="inputPulse1" class="col-12 col-lg-2 control-label">Puls 1</label>
						<div class="col-12 col-lg-5">
							<input type="text" class="form-control" name="pulse1" id="inputPulse1" placeholder="" onChange="test(4,this)" value="<?php echo $row['pulse1']; ?>">
						</div>
						<label for="inputPulse1" class="col-12 col-lg-5 control-label">
							Wpisz puls przed ćwiczeniem.
						</label>
					</div>	
					
					<div class="form-group row">
						<label for="inputDistance1" class="col-12 col-lg-2 control-label">Przebyty dystans</label>
						<div class="col-12 col-lg-5">
							<input type="text" class="form-control" name="distance1" id="inputDistance1" placeholder="" onChange="test(0,this)" value="<?php echo $row['distance1']; ?>">
						</div>
						<label for="inputDistance1" class="col-12 col-lg-5 control-label">
							Wpisz dystans przebyty w czasie ćwiczenia w metrach.
						</label>
					</div>	

					<div class="form-group row">
						<label for="inputTime1" class="col-12 col-lg-2 control-label">Czas ćwiczenia</label>
						<div class="col-12 col-lg-5">
							<input type="text" class="form-control" name="time1" id="inputTime1" placeholder="" onChange="test(5,this)" value="<?php echo $row['time_of_exercise1']; ?>">
						</div>
						<label for="inputTime1" class="col-12 col-lg-5 control-label">
							Wpisz czas ćwiczenia w minutach.
						</label>
					</div>	
					
					<div class="form-group row">
						<label for="inputOxy1e" class="col-12 col-lg-2 control-label">Natlenienie krwi 2</label>
						<div class="col-12 col-lg-5">
							<input type="text" class="form-control" name="oxy1e" id="inputOxy1e" placeholder="" onChange="test(1,this)" value="<?php echo $row['oxygenation1e']; ?>">
						</div>
						<label for="inputOxy1e" class="col-12 col-lg-5 control-label">
							Wpisz wynik z oksymetru po ćwiczeniu.
						</label>
					</div>	

					<div class="form-group row">
						<label for="inputPresureA1e" class="col-12 col-lg-2 control-label">Ciśnienie krwi 2</label>
						<div class="col-6 col-lg-2">
							<input type="text" class="form-control" name="presureA1e" id="inputPresureA1e" placeholder="skurczowe" onChange="test(2,this)" value="<?php echo $row['pressure1Ae']; ?>">
						</div>
						<div class="col-6 col-lg-3">
							<input type="text" class="form-control" name="presureB1e" id="inputPresureB1e" placeholder="rozkurczowe" onChange="test(3,this)" value="<?php echo $row['pressure1Be']; ?>">
						</div>
						<label for="inputPresureA1e" class="col-12 col-lg-5 control-label">
							Wpisz ciśnienie skurczowe i rozkurczowe po ćwiczeniu.
						</label>
					</div>	

					<div class="form-group row">
						<label for="inputPulse1e" class="col-12 col-lg-2 control-label">Puls 2</label>
						<div class="col-12 col-lg-5">
							<input type="text" class="form-control" name="pulse1e" id="inputPulse1e" placeholder="" onChange="test(4,this)" value="<?php echo $row['pulse1e']; ?>">
						</div>
						<label for="inputPulse1e" class="col-12 col-lg-5 control-label">
							Wpisz puls po ćwiczeniu.
						</label>
					</div>	
					<br>

				</div>

				<br>
				
				<div>
					<div class="form-group row bg-info align-items-center">
					
						<label for="inputComfort1" class="col-12 col-lg-2 control-label">Samopoczucie</label>

						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="comfort" id="inputComfort1" value="1" <?php if($row['comfort']==1){echo 'checked';} ?>>
							<label class="form-check-label" for="inlineRadio1">Bardzo złe</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="comfort" id="inputComfort2" value="2" <?php if($row['comfort']==2){echo 'checked';} ?>>
							<label class="form-check-label" for="inlineRadio2">Złe</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="comfort" id="inputComfort3" value="3" <?php if($row['comfort']==3){echo 'checked';} ?>>
							<label class="form-check-label" for="inlineRadio3">Trudno powiedzieć</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="comfort" id="inputComfort4" value="4" <?php if($row['comfort']==4){echo 'checked';} ?>>
							<label class="form-check-label" for="inlineRadio4">Dobre</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="comfort" id="inputComfort5" value="5" <?php if($row['comfort']==5){echo 'checked';} ?>>
							<label class="form-check-label" for="inlineRadio5">Bardzo dobre</label>
						</div>
					</div>
				<div>

				<div class="bg-warning">
					<br>
					<p><h4>Faza 2 ( do godz. 16.00 )</h4></p><br>
					<br>
					
					<div class="form-group row">
						<label for="inputOxy2" class="col-12 col-lg-2 control-label">Natlenienie krwi 1</label>
						<div class="col-12 col-lg-5">
							<input type="text" class="form-control" name="oxy2" id="inputOxy2" placeholder="" onChange="test(1,this)" value="<?php echo $row['oxygenation2']; ?>">
						</div>
						<label for="inputOxy2" class="col-12 col-lg-5 control-label">
							Wpisz wynik z oksymetru przed ćwiczeniem.
						</label>
					</div>	

					<div class="form-group row">
						<label for="inputPresureA2" class="col-12 col-lg-2 control-label">Ciśnienie krwi 1</label>
						<div class="col-6 col-lg-2">
							<input type="text" class="form-control" name="presureA2" id="inputPresureA2" placeholder="skurczowe" onChange="test(2,this)" value="<?php echo $row['pressure2A']; ?>">
						</div>
						<div class="col-6 col-lg-3">
							<input type="text" class="form-control" name="presureB2" id="inputPresureB2" placeholder="rozkurczowe" onChange="test(3,this)" value="<?php echo $row['pressure2B']; ?>">
						</div>
						<label for="inputPresureA2" class="col-12 col-lg-5 control-label">
							Wpisz ciśnienie skurczowe i rozkurczowe przed ćwiczeniem.
						</label>
					</div>	

					<div class="form-group row">
						<label for="inputPulse2" class="col-12 col-lg-2 control-label">Puls 1</label>
						<div class="col-12 col-lg-5">
							<input type="text" class="form-control" name="pulse2" id="inputPulse2" placeholder="" onChange="test(4,this)" value="<?php echo $row['pulse2']; ?>">
						</div>
						<label for="inputPulse2" class="col-12 col-lg-5 control-label">
							Wpisz puls przed ćwiczeniem.
						</label>
					</div>	
					
					<div class="form-group row">
						<label for="inputDistance2" class="col-12 col-lg-2 control-label">Przebyty dystans</label>
						<div class="col-12 col-lg-5">
							<input type="text" class="form-control" name="distance2" id="inputDistance2" placeholder="" onChange="test(0,this)" value="<?php echo $row['distance2']; ?>">
						</div>
						<label for="inputDistance2" class="col-12 col-lg-5 control-label">
							Wpisz dystans przebyty w czasie ćwiczenia w metrach.
						</label>
					</div>	

					<div class="form-group row">
						<label for="inputTime2" class="col-12 col-lg-2 control-label">Czas ćwiczenia</label>
						<div class="col-12 col-lg-5">
							<input type="text" class="form-control" name="time2" id="inputTime2" placeholder="" onChange="test(5,this)" value="<?php echo $row['time_of_exercise2']; ?>">
						</div>
						<label for="inputTime2" class="col-12 col-lg-5 control-label">
							Wpisz czas ćwiczenia w minutach.
						</label>
					</div>	
					
					<div class="form-group row">
						<label for="inputOxy2e" class="col-12 col-lg-2 control-label">Natlenienie krwi 2</label>
						<div class="col-12 col-lg-5">
							<input type="text" class="form-control" name="oxy2e" id="inputOxy2e" placeholder="" onChange="test(1,this)" value="<?php echo $row['oxygenation2e']; ?>">
						</div>
						<label for="inputOxy2e" class="col-12 col-lg-5 control-label">
							Wpisz wynik z oksymetru po ćwiczeniu.
						</label>
					</div>	

					<div class="form-group row">
						<label for="inputPresureA2e" class="col-12 col-lg-2 control-label">Ciśnienie krwi 2</label>
						<div class="col-6 col-lg-2">
							<input type="text" class="form-control" name="presureA2e" id="inputPresureA2e" placeholder="skurczowe" onChange="test(2,this)" value="<?php echo $row['pressure2Ae']; ?>">
						</div>
						<div class="col-6 col-lg-3">
							<input type="text" class="form-control" name="presureB2e" id="inputPresureB2e" placeholder="rozkurczowe" onChange="test(3,this)" value="<?php echo $row['pressure2Be']; ?>">
						</div>
						<label for="inputPresureA2e" class="col-12 col-lg-5 control-label">
							Wpisz ciśnienie skurczowe i rozkurczowe po ćwiczeniu.
						</label>
					</div>	

					<div class="form-group row">
						<label for="inputPulse2e" class="col-12 col-lg-2 control-label">Puls 2</label>
						<div class="col-12 col-lg-5">
							<input type="text" class="form-control" name="pulse2e" id="inputPulse2e" placeholder="" onChange="test(4,this)" value="<?php echo $row['pulse2e']; ?>">
						</div>
						<label for="inputPulse2e" class="col-12 col-lg-5 control-label">
							Wpisz puls po ćwiczeniu.
						</label>
					</div>	
					<br>

				</div>

				<div class="bg-secondary">
					<br>
					<p><h4>Faza 3 ( do godz. 22.00 )</h4></p><br>
					<br>

					<div class="form-group row">
						<label for="inputOxy3" class="col-12 col-lg-2 control-label">Natlenienie krwi 1</label>
						<div class="col-12 col-lg-5">
							<input type="text" class="form-control" name="oxy3" id="inputOxy3" placeholder="" onChange="test(1,this)" value="<?php echo $row['oxygenation3']; ?>">
						</div>
						<label for="inputOxy3" class="col-12 col-lg-5 control-label">
							Wpisz wynik z oksymetru przed ćwiczeniem.
						</label>
					</div>	

					<div class="form-group row">
						<label for="inputPresureA3" class="col-12 col-lg-2 control-label">Ciśnienie krwi 1</label>
						<div class="col-6 col-lg-2">
							<input type="text" class="form-control" name="presureA3" id="inputPresureA3" placeholder="skurczowe" onChange="test(2,this)" value="<?php echo $row['pressure3A']; ?>">
						</div>
						<div class="col-6 col-lg-3">
							<input type="text" class="form-control" name="presureB3" id="inputPresureB3" placeholder="rozkurczowe" onChange="test(3,this)" value="<?php echo $row['pressure3B']; ?>">
						</div>
						<label for="inputPresureA3" class="col-12 col-lg-5 control-label">
							Wpisz ciśnienie skurczowe i rozkurczowe przed ćwiczeniem.
						</label>
					</div>	

					<div class="form-group row">
						<label for="inputPulse3" class="col-12 col-lg-2 control-label">Puls 1</label>
						<div class="col-12 col-lg-5">
							<input type="text" class="form-control" name="pulse3" id="inputPulse3" placeholder="" onChange="test(4,this)" value="<?php echo $row['pulse3']; ?>">
						</div>
						<label for="inputPulse3" class="col-12 col-lg-5 control-label">
							Wpisz puls przed ćwiczeniem.
						</label>
					</div>	
					
					<div class="form-group row">
						<label for="inputDistance3" class="col-12 col-lg-2 control-label">Przebyty dystans</label>
						<div class="col-12 col-lg-5">
							<input type="text" class="form-control" name="distance3" id="inputDistance3" placeholder="" onChange="test(0,this)" value="<?php echo $row['distance3']; ?>">
						</div>
						<label for="inputDistance3" class="col-12 col-lg-5 control-label">
							Wpisz dystans przebyty w czasie ćwiczenia w metrach.
						</label>
					</div>	

					<div class="form-group row">
						<label for="inputTime3" class="col-12 col-lg-2 control-label">Czas ćwiczenia</label>
						<div class="col-12 col-lg-5">
							<input type="text" class="form-control" name="time3" id="inputTime3" placeholder="" onChange="test(5,this)" value="<?php echo $row['time_of_exercise3']; ?>">
						</div>
						<label for="inputTime3" class="col-12 col-lg-5 control-label">
							Wpisz czas ćwiczenia w minutach.
						</label>
					</div>	
					
					<div class="form-group row">
						<label for="inputOxy3e" class="col-12 col-lg-2 control-label">Natlenienie krwi 2</label>
						<div class="col-12 col-lg-5">
							<input type="text" class="form-control" name="oxy3e" id="inputOxy3e" placeholder="" onChange="test(1,this)" value="<?php echo $row['oxygenation3e']; ?>">
						</div>
						<label for="inputOxy3e" class="col-12 col-lg-5 control-label">
							Wpisz wynik z oksymetru po ćwiczeniu.
						</label>
					</div>	

					<div class="form-group row">
						<label for="inputPresureA3e" class="col-12 col-lg-2 control-label">Ciśnienie krwi 2</label>
						<div class="col-6 col-lg-2">
							<input type="text" class="form-control" name="presureA3e" id="inputPresureA3e" placeholder="skurczowe" onChange="test(2,this)" value="<?php echo $row['pressure3Ae']; ?>">
						</div>
						<div class="col-6 col-lg-3">
							<input type="text" class="form-control" name="presureB3e" id="inputPHaslo" placeholder="rozkurczowe" onChange="test(2,this)" value="<?php echo $row['pressure3Be']; ?>">
						</div>
						<label for="inputPresureA3e" class="col-12 col-lg-5 control-label">
							Wpisz ciśnienie skurczowe i rozkurczowe po ćwiczeniu.
						</label>
					</div>	

					<div class="form-group row">
						<label for="inputPulse3e" class="col-12 col-lg-2 control-label">Puls 2</label>
						<div class="col-12 col-lg-5">
							<input type="text" class="form-control" name="pulse3e" id="inputPulse3e" placeholder="" onChange="test(4,this)" value="<?php echo $row['pulse3e']; ?>">
						</div>
						<label for="inputPulse3e" class="col-12 col-lg-5 control-label">
							Wpisz puls po ćwiczeniu.
						</label>
					</div>	

					<br>

				</div>
				
			</FORM>

		</div>

	</div>

	<?php mysqli_close($db); ?>

    <center><br>

	<div class="col-12">
		<input class="form-check-input" type="checkbox" name="comfort" id="inputZapis" value="">
		<label class="form-check-label" for="inputZapis">Zapisz bez sprawdzania </label>
	</div>	

	<br>

	<div>
		<div class="col-12">
			<button class="btn btn-warning" OnClick="sprawdz()">Zapisz badanie</button>
		</div>
	</div>

	<br><br>


</div>

<br><br>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger" id="exampleModalLabel"><b>Ostrzeżenie</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body bg-warning" id="modal_text">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zrozumiałem</button>
      </div>
    </div>
  </div>
</div>


</BODY>

</HTML>
