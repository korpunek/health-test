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

	include('obj_config.php');	
	include('obj_crypt.php');
	include('head.php');


	function alert($msg)
	{
		echo "<script type='text/javascript'>alert('$msg');</script>";
	}


?>


    <script>


		function start()
		{
			$('#pliktab a').on('click', function (e)
				{
					e.preventDefault()
					$(this).tab('show')
				}
			)	
		}

	</script>



</HEAD>

<BODY text=#000000 bgColor=#ffffff leftMargin=0 topMargin=0 marginwidth="0" marginheight="0" onLoad="start()">


<div class="container">

	<?php
		$pozycja = 2;
		include('nav.php');
	?>

	<br>

	<div class="row">

		<div class="col-12 col-lg-12">

			<br>

			<center>
					
			<p><h2>Lista badań</h2></p><br>

            </center>
 
            

            <table class="table table-hover"> 
            <thead> 
                <tr> 
                    <th>ID</th> 
                    <th>DATA</b></th>
                    <th class='text-center'>SAM.</b></th>
                    <th class='text-center'>TLEN1</b></th> 
                    <th colspan="2" class='text-right'>CIŚNIENIE1</b></th>
                    <th class='text-right'>PULS1</b></th> 
                    <th class='text-right text-primary'>DYST.1</b></th> 

                    <th class='text-center'>TLEN2</b></th> 
                    <th colspan="2" class='text-right'>CIŚNIENIE2</b></th>
                    <th class='text-right'>PULS2</b></th> 
                    <th class='text-right text-primary'>DYST.2</b></th> 

                    <th class='text-center'>TLEN3</b></th> 
                    <th colspan="2" class='text-right'>CIŚNIENIE3</b></th>
                    <th class='text-right'>PULS3</b></th> 
                    <th class='text-right text-primary'>DYST.3</b></th> 
                </tr> 

                <tr> 
                    <th></b></th> 
                    <th></b></th> 
                    <th></b></th>
                    <th></b></th>                      
                    <th class='text-right'>Sk.</b></th>
                    <th class='text-right'>Ro.</b></th> 
                    <th></b></th> 
                    <th class='text-right text-primary'>CZAS1</b></th> 

                    <th></b></th> 
                    <th class='text-right'>Sk.</b></th>
                    <th class='text-right'>Ro.</b></th> 
                    <th></b></th> 
                    <th class='text-right text-primary'>CZAS2</b></th> 

                    <th></b></th> 
                    <th class='text-right'>Sk.</b></th>
                    <th class='text-right'>Ro.</b></th> 
                    <th></b></th> 
                    <th class='text-right text-primary'>CZAS3</b></th> 
                    
                </tr> 



            </thead> 

	        <tbody>
			
			
            <?php


                $ile = 0;
                $kolor = "";

                $tabela = 'results';
                $order = 'date DESC';
                $zakres = "*";
                $where = "userid=" . $inumer;
                
                $db = mysqli_connect($dbObj->host, $dbObj->nazwa, $dbObj->haslo, $dbObj->baza);

                $sql = "SELECT " . $zakres . " FROM " . $tabela;
                $sql .= " WHERE " . $where;
                $sql .= " ORDER BY " . $order;
                $sql .= " LIMIT 31";
          
                $res = mysqli_query($db, $sql);  

                while( $row = mysqli_fetch_assoc($res))
                {	

                    echo "<tr" . $kolor . ">";
                    
                    echo "<th class='scope='row'>" . $row["id"] . "</th>"; 
                    echo "<td><a href='results_correct.php?rekord=" . $row["id"] . "'>" . $row["date"] . "</a></td>";
                    echo "<td class='text-center'>" . $row["comfort"] . "</td>"; 
                    echo "<td class='text-center'>" . $row["oxygenation1"] . "<br>" . $row["oxygenation1e"] . "</td>"; 
                    echo "<td class='text-right'>" . $row["pressure1A"] . "<br>" . $row["pressure1Ae"] . "</td>"; 
                    echo "<td class='text-right'>" . $row["pressure1B"] . "<br>" . $row["pressure1Be"] . "</td>";
                    echo "<td class='text-right'>" . $row["pulse1"] . "<br>" . $row["pulse1e"] . "</td>"; 
                    echo "<td class='text-right'><font color='blue'>" . $row["distance1"] . "<br>" . $row["time_of_exercise1"] . "</font></td>"; 
 
                    echo "<td class='text-center'>" . $row["oxygenation2"] . "<br>" . $row["oxygenation2e"] . "</td>"; 
                    echo "<td class='text-right'>" . $row["pressure2A"] . "<br>" . $row["pressure2Ae"] . "</td>"; 
                    echo "<td class='text-right'>" . $row["pressure2B"] . "<br>" . $row["pressure2Be"] . "</td>";
                    echo "<td class='text-right'>" . $row["pulse2"] . "<br>" . $row["pulse2e"] . "</td>"; 
                    echo "<td class='text-right'><font color='blue'>" . $row["distance2"] . "<br>" . $row["time_of_exercise2"] . "</font></td>"; 

                    echo "<td class='text-center'>" . $row["oxygenation3"] . "<br>" . $row["oxygenation3e"] . "</td>"; 
                    echo "<td class='text-right'>" . $row["pressure3A"] . "<br>" . $row["pressure3Ae"] . "</td>"; 
                    echo "<td class='text-right'>" . $row["pressure3B"] . "<br>" . $row["pressure3Be"] . "</td>";
                    echo "<td class='text-right'>" . $row["pulse3"] . "<br>" . $row["pulse3e"] . "</td>"; 
                    echo "<td class='text-right'><font color='blue'>" . $row["distance3"] . "<br>" . $row["time_of_exercise3"] . "</font></td>"; 
                      
                    echo "</tr>"; 

                    $ile++;
                }

                mysqli_close($db);

                echo "</tbody>";
                echo "</table>"; 
                
                if($ile == 0){echo "<center><br><div>Brak danych do wyświetlenia.</div>";}else{echo "<center><br><div>Pozycji: " . $ile . "</div><br>";}

                echo "<br>";
                
            ?>

           

        <div>

    </div>

</div>

<br><br>

</BODY>

</HTML>




