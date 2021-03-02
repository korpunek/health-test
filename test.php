<?php
	session_start();

	$inumer = $_SESSION["numer"];
	$inazwa = $_SESSION["nazwa"];
	$ilang = $_SESSION["lang"];
		

	$dbObj->host = $_SESSION["dbhost"];
	$dbObj->baza = $_SESSION["dbbaza"];
	$dbObj->nazwa = $_SESSION["dbnazwa"];
	$dbObj->haslo = $_SESSION["dbhaslo"];
	
	if ($inazwa == "" or $inumer == "") {header("Location: blad.htm");}

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
		$pozycja = 4;
		include('nav.php');
	?>

	<br><br><br>

	<div class="row">

		<div class="col-12 col-lg-6">

			<div class="card bg-info">
				<div class="card-header">
					<div class="row">
						<div class="col col-3 text-white">						
							TEST
						</div>
						<div class="col text-right vtext"></div>
					</div>	
				</div>
				<div class="card-body bg-white text-black">
					<div id="lista_rodzaj">

<?php

	echo "* początek *<br><br>";

	$dbhost = 'localhost';
	$dbport = '27017';
	$dbname = 'admin';
	$dbcoll = 'test1';
	
	$conn = new MongoDB\Driver\Manager("mongodb://$dbhost:$dbport");
	
	// print_r($conn);

	// echo "<br><br>*******<br><br>";
	
	$filter = ['data' => array( '$gt' => '2019-01-11', '$lt' => '2019-02-22' )];
	$option = [];
	$read = new MongoDB\Driver\Query($filter, $option);
	$result = $conn->executeQuery("$dbname.$dbcoll", $read);
	
	//echo nl2br("nSingle user => rn");
	
	foreach ($result as $user) {
		echo $user->name . ' ' . $user->data . '<br><br>';
	//	foreach ($user->tags as $tag) {
	//		echo $tag . "<br>";
	//	}
	}

	echo "<br><br>******************<br><br>";

	$filter = ['data' => '2019-02-07'];
	$option = [];
	$read = new MongoDB\Driver\Query($filter, $option);
	$result = $conn->executeQuery("$dbname.$dbcoll", $read);
	
	//echo nl2br("nSingle user => rn");
	
	foreach ($result as $user) {
		echo $user->name . ' ' . $user->data . '<br><br>';
	//	foreach ($user->tags as $tag) {
	//		echo $tag . "<br>";
	//	}
	}

/*

	$m = new MongoClient();
    var_dump($m);



		$m = new MongoClient('mongodb://localhost', [
			'username' => 'abc',
			'password' => 'abc@123',
			'db'       => 'abc'
		]);



		try
		{
//			$m = new MongoClient("mongodb://127.0.0.1");
//			$users = $m->selectCollection("admin", "test1");

$m = new MongoClient;

		}
		catch(Exception $e)
		{
			echo 'Wystąpił wyjątek nr ' . $e->getCode() . ', jego komunikat to:' . $e->getMessage();
		}






		//alert($users);

		//$document = array( "data" => "2019-01-12" );
		//$users ->insert($document);
//		$usersRepository = $users->find();
		
//		foreach ($usersRepository as $u) {
//			echo $u["name"] . "\n";
//		}

*/

	echo "<br><br> *koniec *<br><br>";

?>



					</div>	
				</div>
			</div>

			<br>

		</div>


		<br>


	</div>


</div>


<br><br>


</BODY>

</HTML>
