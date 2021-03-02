<?php
	session_start();

	$inumer = $_SESSION["numer"];
	$inazwa = $_SESSION["nazwa"];
	$ilang = $_SESSION["lang"];
	$tkey = $_SESSION["tshark"];	

	$dbObj->host = $_SESSION["dbhost"];
	$dbObj->baza = $_SESSION["dbbaza"];
	$dbObj->nazwa = $_SESSION["dbnazwa"];
	$dbObj->haslo = $_SESSION["dbhaslo"];
	
	if ($inazwa == "" or $inumer == "") {header("Location: blad.htm");}

	include('obj_crypt.php');
	include('obj_config.php');
	
	$db = mysqli_connect($dbObj->host, $dbObj->nazwa, $dbObj->haslo, $dbObj->baza);
	
		$sql = "SELECT * FROM users WHERE id = " . $inumer;
		$res = mysqli_query($db, $sql);
	
		if (! $res)
		{
				echo "ERROR " . mysqli_errno();
				echo mysqli_error();
				echo "<PRE>$sql</PRE>";
		}

		if( $row = mysqli_fetch_assoc($res))
		{
			$ifirstname = decrypt($row['firstname'], $tkey);
			$ilastname = decrypt($row['lastname'], $tkey);
			$inicname = decrypt($row['nickname'], $tkey);
			$icitizenship = $row['citizenship'];
			$ibirth_date = $row['date_of_birth'];
			$irank = decrypt($row['rank'], $tkey);
			$iid_number = decrypt($row['idnumber'], $tkey);
			$istatus = decrypt($row['status'], $tkey);
		
		}

		$sql = "SELECT * FROM messages WHERE (status > 0) AND ( (type = 0) OR (type = " . $inumer . "))";
		$res = mysqli_query($db, $sql);
		$imessage = '';
		if( $row = mysqli_fetch_assoc($res))
		{
			$imessage = "<h3>" . $row['title'] . "</h3><br><h4>" . $row['body'] . "<br><br>" . $row['autor'] . "</h4><br>";
			$msg_id = $row['id'];
		}
		mysqli_close($db);
		if($imessage == ''){$imessage = str_repeat("<br>", 13);}


	

	include('head.php');


	function alert($msg)
	{
		echo "<script type='text/javascript'>alert('$msg');</script>";
	}


?>

	<script>


		function przeczytane(str)
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
				xmlhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						document.getElementById("lista_rodzaj").innerHTML = this.responseText;
					}
				};
				xmlhttp.open("GET","msg_set.php?rekord="+str,true);
				xmlhttp.send();
		}


		function mover(obiekt)
		{
			obiekt.style.cursor = 'copy';
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
		$pozycja = 4;
		include('nav.php');
	?>

	<br><br><br>

	<div class="row">

		<div class="col-12 col-lg-6">

			<div class="card bg-info">
				<div class="card-header">
					<div class="row">
						<div class="col text-white">						
							<h4><?php echo lang('txt_messages',$ilang,$dbObj); ?></h4>
						</div>
						<div class="col text-right vtext">	
							<img src="img/check_white_18dp.png" OnMouseOver="mover(this)" OnClick="przeczytane(<?php echo $msg_id ?>)"/>
						</div>
					</div>	
				</div>
				<div class="card-body bg-white text-black">
					<div id="lista_rodzaj">
					<?php echo $imessage; ?>
					</div>	
				</div>
			</div>

			<br>

		</div>


		<div class="col-12 col-lg-6">

			<div class="card text-black bg-light">
				<div class="card-header">
					<div class="row">
						<div class="col">						
						<h4><?php echo lang('txt_patient',$ilang,$dbObj) . " [" . $inazwa . "]"; ?></h4>
						</div>
						<div class="col text-right vtext">	

						</div>
					</div>	
				</div>
				<div class="card-body bg-white">
					<div id="lista_rodzaj"></div>


						<div class="row">
							<div class="col"><?php echo lang('txt_photo',$ilang,$dbObj); ?></div>
							<div class="col"><img src="img/photo/<?php echo $inumer; ?>.png" width="100"></div>
						</div>


						<div class="row">
							<div class="col"><?php echo lang('txt_firstname',$ilang,$dbObj); ?></div>
							<div class="col"><?php echo $ifirstname; ?></div>
						</div>
						<div class="row">
							<div class="col"><?php echo lang('txt_lastname',$ilang,$dbObj); ?></div>
							<div class="col"><?php echo $ilastname; ?></div>
						</div>
						<div class="row">
							<div class="col"><?php echo lang('txt_nickname',$ilang,$dbObj); ?></div>
							<div class="col"><?php echo $inicname; ?></div>
						</div>
						<div class="row">
							<div class="col"><?php echo lang('txt_birth_date',$ilang,$dbObj); ?></div>
							<div class="col"><?php echo $ibirth_date; ?></div>
						</div>
						<div class="row">
							<div class="col"><?php echo lang('txt_citizenship',$ilang,$dbObj); ?></div>
							<div class="col"><?php echo $icitizenship; ?></div>
						</div>
						<div class="row">
							<div class="col"><?php echo lang('txt_rank',$ilang,$dbObj); ?></div>
							<div class="col"><?php echo $irank; ?></div>
						</div>
						<div class="row">
							<div class="col"><?php echo lang('txt_id_number',$ilang,$dbObj); ?></div>
							<div class="col"><?php echo $iid_number; ?></div>
						</div>
						<div class="row">
							<div class="col"><?php echo lang('txt_status',$ilang,$dbObj); ?></div>
							<div class="col"><?php echo $istatus; ?></div>
						</div>

				</div>

			</div>

			<br>

		</div>

	</div>

	<center>
	<div class="alert alert-secondary" role="alert">
		<a href="https://www.nato.int/nato-welcome/index.html" target="new">What is NATO</a>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="https://www.ncia.nato.int/Pages/homepage.aspx" target="new">NATO CI Agency</a>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="https://www.eurobrussels.com/jobs_at/nato_north_atlantic_treaty_organisation/52" target="new">Jobs at NATO</a>
		

	</div>
	</center>

</div>


<br><br>


</BODY>

</HTML>
