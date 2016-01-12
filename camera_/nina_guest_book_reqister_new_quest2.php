<?php

	$sLogin_new_guest   = $_POST['login_new_guest'];
	$sPass_new_guest    = MD5($_POST['pass_new_guest']);

	require_once("includes_gb/connect.php");

	$sql_insert_new_guest = "INSERT INTO guests (login, pass)
			VALUES (\"$sLogin_new_guest\", \"$sPass_new_guest\")"
			;
	$out_insert_new_guest= mysql_query($sql_insert_new_guest);

	if($out_insert_new_guest === false)
	{
		echo json_encode($out_insert_new_guest);
		exit;
	}

	$sql_select_id = "SELECT login AS guest_id
			FROM guests
			WHERE login = \"$sLogin_new_guest\"";
	$out_select_id= mysql_query($sql_select_id);
	while($aLine_select_id = mysql_fetch_assoc($out_select_id))
	{
		$iGuest_id = $aLine_select_id["guest_id"];
	}

	echo json_encode($iGuest_id);
	exit;

?>
