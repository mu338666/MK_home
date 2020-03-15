<?php

	$num = $_GET["num"];
	$mode = $_GET["mode"];

	$con = mysqli_connect("localhost", "root", "123456", "mkhome");
	$sql = "delete from message where num=$num";

	mysqli_query($con, $sql);
	mysqli_close($con);

	if($mode == "send")
		$url = "mk_message_box.php?mode=send";
	else
		$url = "mk_message_box.php?mode=rv";
	echo "
	<script>
		location.href = '$url';
	</script>

	";
?>
