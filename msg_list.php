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

        function msg_view(title,body)
        {
                document.getElementById("exampleModalLabel").innerHTML = title;
                document.getElementById("modal_text").innerHTML = body;
				$('#exampleModal').modal();
        }


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
					
			<p><h2>Lista komunikatów</h2></p><br>

            </center>
 
            

            <table class="table table-hover"> 
            <thead> 
                <tr> 
                    <th class='text-left'>ID</th> 
                    <th class='text-left'>DATA</b></th>
                    <th class='text-left'>TEMAT</b></th>
                    <th class='text-left'>AUTOR</b></th> 
                </tr> 


            </thead> 

	        <tbody>
			
			
            <?php


                $ile = 0;
                $kolor = "";

                $tabela = 'messages';
                $order = 'delivered DESC';
                $zakres = "*";
                $where = "(type = 0) OR (type = " . $inumer . ")";
                
                $db = mysqli_connect($dbObj->host, $dbObj->nazwa, $dbObj->haslo, $dbObj->baza);

                $sql = "SELECT " . $zakres . " FROM " . $tabela;
                $sql .= " WHERE " . $where;
                $sql .= " ORDER BY " . $order;
          
                $res = mysqli_query($db, $sql);  

                while( $row = mysqli_fetch_assoc($res))
                {	

                    $btitle = $row["title"];
                    $bbody = $row["body"];

                    echo "<tr" . $kolor . " OnClick='msg_view(" . '"' . $btitle . '","' . $bbody . '");' . "'>";
                    
                    echo "<th class='scope=row text-left'>" . $row["id"] . "</th>"; 
                    echo "<td class='text-left'>" . $row["delivered"] . "</td>";
                    echo "<td class='text-left'>" . $btitle . "</td>"; 
                    echo "<td class='text-left'>" . $row["autor"] . "</td>"; 
                      
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger" id="exampleModalLabel"><b>Title</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body bg-warning" id="modal_text">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
      </div>
    </div>
  </div>
</div>

<br><br>




</BODY>

</HTML>

