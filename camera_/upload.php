<?php
define('UPLOAD_DIR', 'uploads/');
$img = $_POST['base64image'];
$img = str_replace('data:image/jpeg;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
$file = UPLOAD_DIR . uniqid() . '.png';
echo "jjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj" . UPLOAD_DIR . "jjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj";
$success = file_put_contents($file, $data);
print $success ? $file : 'Unable to save the file.';
?>
<script type="text/javascript" src="../js/jquery-2.1.4.min.js" ></script>
<script type="text/javascript">
var data = "<?php echo $data; ?>";
var file = "<?php echo $file; ?>";

$.ajax(
 {
 	type: "POST",
 	dataType: "json",
 	url: "https://changeyourlife/fff/demos/hh3.php",
 	data: {
 		sData: data,
 		sFile: file
 	}
 })

</script>