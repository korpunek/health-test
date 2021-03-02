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

//	alert(date('n'));

	if($_POST['nrrok'] == 0)
	{
		$prok = date('Y');
		$pmiesiac = date('n');
		$pfaza = 0;
		$pbadanie = 0;
		$legend = "['Dzień', 'Tlen', 'Puls'],";
	}
	else
	{
		$prok = (int)$_POST['nrrok'];
		$pmiesiac = (int)$_POST['nrmiesiac'];
		$pfaza = (int)$_POST['nrfaza'];
		$pbadanie = (int)$_POST['nrbadania'];
	}

	$buffaza = $pfaza + 1;

	switch ($pbadanie)
	{
		case 0:
			$legend1 = "['Dzień', 'Tlen', 'Puls'],";
			$legend2 = "['Dzień', 'Tlen', 'Puls'],";
			$dana1 = "oxygenation{$buffaza}";
			$dana2 = "pulse{$buffaza}";
			$dana3 = "oxygenation{$buffaza}e";
			$dana4 = "pulse{$buffaza}e";
			break;
		case 1:
			$legend1 = "['Dzień', 'Skurczowe', 'Rozkurczowe'],";
			$legend2 = "['Dzień', 'Skurczowe', 'Rozkurczowe'],";
			$dana1 = "pressure{$buffaza}A";
			$dana2 = "pressure{$buffaza}B";
			$dana3 = "pressure{$buffaza}Ae";
			$dana4 = "pressure{$buffaza}Be";
			break;
		case 2:
			$legend1 = "['Dzień', 'Dystans', 'Czas'],";
			$legend2 = "['Dzień', 'Komfort', 'Live Index'],";
			$dana1 = "distance{$buffaza}";
			$dana2 = "time_of_exercise{$buffaza}";
			$dana3 = "comfort";
			$dana4 = "liveindex{$buffaza}";
			break;
	}


	$db = mysqli_connect($dbObj->host, $dbObj->nazwa, $dbObj->haslo, $dbObj->baza);

	$sql1 = "SELECT * FROM results WHERE (userid = " . $inumer . ") AND (YEAR(date) = " . $prok . ") AND (MONTH(date) = " . $pmiesiac . ") LIMIT 31";
	$sql2 = "SELECT * FROM results WHERE (userid = " . $inumer . ") AND (YEAR(date) = " . $prok . ") AND (MONTH(date) = " . $pmiesiac . ") LIMIT 31";


	$tabmiesiace[1] = 'styczeń';
	$tabmiesiace[2] = 'luty';
	$tabmiesiace[3] = 'marzec';
	$tabmiesiace[4] = 'kwiecień';
	$tabmiesiace[5] = 'maj';
	$tabmiesiace[6] = 'czerwiec';
	$tabmiesiace[7] = 'lipiec';
	$tabmiesiace[8] = 'sierpień';
	$tabmiesiace[9] = 'wrzesień';
	$tabmiesiace[10] = 'październik';
	$tabmiesiace[11] = 'listopad';
	$tabmiesiace[12] = 'grudzień';
		
		
	include('obj_config.php');	
	include('obj_crypt.php');
	include('head.php');

	function alert($msg)
	{
		echo "<script type='text/javascript'>alert('$msg');</script>";
	}


?>


  <script type="text/javascript">

		function wykonaj()
		{
			forma.nrrok.value = forma.rok.value;
			forma.nrmiesiac.value = forma.miesiac.selectedIndex + 1;
			forma.nrfaza.value = forma.faza.selectedIndex;
			forma.nrbadania.value = forma.badanie.selectedIndex;
			forma.submit();
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

	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  
	<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
 
					<?php

						$res = mysqli_query($db, $sql1);

						echo $legend1;

						while( $row = mysqli_fetch_assoc($res))
						{
//							echo "['" . substr($row['date'],8,2) . "'," . $row['oxygenation1'] . "," . $row['pulse1'] . "],";	

							echo "['" . substr($row['date'],8,2) . "'," . $row[$dana1] . "," . $row[$dana2] . "],";	

						}

//						mysqli_close($db);

						/*
						echo "['Year', 'Fales', 'trpes', 'Expenses'],";
						echo "['2004',  1000,  700,    400],";
						echo "['2005',  1170,  990,    460],";
						echo "['2006',  2660,  1500,     1120],";
						echo "['2007',  1030,  800,    540]";
						*/

					?>	
	
		    ]);

        var options = {
          title: 'Wykres wyników  -  Faza ' + <?php echo $pfaza + 1; ?> + ' przed',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart1'));

        chart.draw(data, options);
      }

	</script>



<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
 
					<?php

						$res = mysqli_query($db, $sql2);

						echo $legend2;

						while( $row = mysqli_fetch_assoc($res))
						{
							echo "['" . substr($row['date'],8,2) . "'," . $row[$dana3] . "," . $row[$dana4] . "],";	
//							echo "['" . substr($row['date'],8,2) . "'," . $row['oxygenation1e'] . "," . $row['pulse1e'] . "],";	
						}

						mysqli_close($db);

						/*
						echo "['Year', 'Fales', 'trpes', 'Expenses'],";
						echo "['2004',  1000,  700,    400],";
						echo "['2005',  1170,  990,    460],";
						echo "['2006',  2660,  1500,     1120],";
						echo "['2007',  1030,  800,    540]";
						*/

					?>	
	
		    ]);

        var options = {
          title: 'Wykres wyników  -  Faza ' + <?php echo $pfaza + 1; ?> + ' po',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart2'));

        chart.draw(data, options);
      }

	</script>





</HEAD>

<BODY text=#000000 bgColor=#ffffff leftMargin=0 topMargin=0 marginwidth="0" marginheight="0" onLoad="start()">


<div class="container">

	<?php
		$pozycja = 3;
		include('nav.php');
	?>

	<br><br><br>

	<FORM NAME="forma" METHOD="POST" ACTION="results_chart.php" class="form-horizontal">
			<INPUT TYPE="HIDDEN" NAME="nrrok" VALUE=0>
			<INPUT TYPE="HIDDEN" NAME="nrmiesiac" VALUE=0>
			<INPUT TYPE="HIDDEN" NAME="nrfaza" VALUE=0>
			<INPUT TYPE="HIDDEN" NAME="nrbadania" VALUE=0>	
	
		<div class="row">
		
			<div class="col"></div>		


			<div class="col">
				<?php
					echo '<SELECT NAME="rok" class="form-control" id="tenrok">';

					for($i=date('Y');$i>2010;$i--)
					{
						echo '	<OPTION'; 
							if($prok==$i){ echo ' SELECTED';}
						echo '>' . $i . '</OPTION>';
					}
					echo '</SELECT>';
				?>
			</div>

			<div class="col">
				<?php
					echo '<SELECT NAME="miesiac" class="form-control" id="tenmiesiac">';

					for($i=1;$i<13;$i++)
					{
						echo '	<OPTION'; 
							if($pmiesiac==$i){ echo ' SELECTED';}
						echo '>' . $tabmiesiace[$i] . '</OPTION>';
					}
					echo '</SELECT>';
				?>
			</div>

			<div class="col">
				<select NAME="faza" class="form-control" id="tafaza">
					<option value="1" <?php if($pfaza==0){ echo ' SELECTED';} ?>>Faza1</option>
					<option value="2" <?php if($pfaza==1){ echo ' SELECTED';} ?>>Faza2</option>
					<option value="3" <?php if($pfaza==2){ echo ' SELECTED';} ?>>Faza3</option>
				</select>
			</div>

			<div class="col">
				<select name="badanie" class="form-control" id="tlenppuls">
					<option value="1" <?php if($pbadanie==0){ echo ' SELECTED';} ?>>Tlen, Puls</option>
					<option value="2" <?php if($pbadanie==1){ echo ' SELECTED';} ?>>Ciśnienie</option>
					<option value="4" <?php if($pbadanie==2){ echo ' SELECTED';} ?>>Live Index</option>
				</select>
			</div>
			<div class="col"></div>

			<div class="col">
				<button class="btn btn-warning" OnClick="wykonaj()">Pokaż</button>
			</div>

		</div>


	</FORM>

  <div id="curve_chart1" style="width: 1200px; height: 400px"></div>

  <div id="curve_chart2" style="width: 1200px; height: 400px"></div>


</div>

<br><br>

</BODY>

</HTML>