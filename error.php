<html>
<head>
  
  <meta http-equiv="content-type" content="text/html; charset=utf-8">

  <script language="JavaScript">

  function back()
  {
	 history.back();
  }

  </script>

</head>

<body>

<br><br>
<center>

<TABLE ID="tab3" cellSpacing=0 cellPadding=0 border=0 width="90%">
<tr><td>
<br><br>
<center>

<table cellSpacing=0 cellPadding=1 border=0 width="500">
<tr><td colspan="2" bgcolor="#404040"><center><font face="Arial" size="2" color="white">ERROR</td></tr>
<tr><td bgcolor="#E0E0CC">

        <table width="100%" bgcolor="white">

        <tr>
	<td>

<center>

		<br>
		<!--img src="img/error.gif" hspace="10"-->

		<font face="Arial" size="2" color="red">
		
		<?php
      $imessage = $_REQUEST['error'];
			echo $imessage;	
		?>

</center>

		<br><br>
	</td>
          </tr>

        <tr><td align="left"><center><img src="img/ok1.gif" onClick=back();><br><br></td></tr>

        </table>

        </td></tr>

</font>
</table>

<td></tr>
</table>


</body>
</html>
