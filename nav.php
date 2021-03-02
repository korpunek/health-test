
<?php 

    echo '<center>';
	echo '<nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">';
	echo '    <div class="container"><a class="navbar-brand logo" href="http://www.dim.pl" style="background-image:url(&quot;img/hti.png&quot;);background-size:contain;background-repeat:no-repeat;width:200px;height:40px;">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</a>';
	echo '        <button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>';
	echo '            <div class="collapse navbar-collapse" id="navcol-1">';
	echo '                <ul class="nav navbar-nav ml-auto">';
	echo '                    <li class="nav-item" role="presentation"><a class="nav-link ';
								if($pozycja == 1){echo 'active';}
	echo					 '" href="results_new.php">' . lang('menu_registration',$ilang,$dbObj) . '</a></li>';
	echo '                    <li class="nav-item" role="presentation"><a class="nav-link ';
								if($pozycja == 2){echo 'active';}
	echo					 '" href="results_list.php">' . lang('menu_list',$ilang,$dbObj) . '</a></li>';
	echo '                    <li class="nav-item" role="presentation"><a class="nav-link ';
								if($pozycja == 3){echo 'active';}
	echo					 '" href="results_chart.php">' . lang('menu_results',$ilang,$dbObj) . '</a></li>';
	echo '				<div class="dropdown">';
	echo '                <li class="nav-item ';
							if($pozycja == 4){echo 'active';}        
	echo                '" role="presentation" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><a class="nav-link dropdown-toggle" href="#">' . lang('menu_profile',$ilang,$dbObj) . '</a></li>';
	echo '						<div class="dropdown-menu" aria-labelledby="Profil">';
	echo '              <a class="dropdown-item" href="hti_view.php">Start</a>';
	echo '              <a class="dropdown-item" href="msg_list.php">Komunikaty</a>';
	echo '              <a class="dropdown-item" href="wyloguj.php">Wyloguj</a>';	
	echo '							<a class="dropdown-item text-danger" href="szyfrowanie.php">Szyfrowanie</a>';
	echo '							<a class="dropdown-item text-danger" href="info.php">Info</a>';
	echo '							<a class="dropdown-item text-danger" href="test.php">test</a>';
	echo '							<a class="dropdown-item text-danger" href="reszyfr.php">Reszyfruj</a>';
	echo '						</div>';
	echo '					</li>';
	echo '				</div>';
	echo '				</ul>';
	echo '            </div>';
	echo '    </div>';
	echo '</nav>';
	echo '</center>';

?>