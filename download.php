<?php
session_start();

$type = $_GET['type'];
switch ($type) {
	case 'all':
		if(empty($_SESSION['files'])) {
			return 0;
			die();
		}
		foreach($_SESSION['files'] as $index => $mp3Single) {
			header("Cache-Control: public");
			header("Content-Description: File Transfer");
			header("Content-Transfer-Encoding: binary/octet-stream");
			header("Content-Type: application/x-download");
			header("Content-Disposition: attachment; filename=" . $mp3Single);
			readfile($mp3Single);
			header("Location: download.php?type=all");
		}
		session_destroy();
		break;
	case 'single':
		if(!empty($_GET['filename'])) {
			$filename = $_GET['filename'];
			header("Cache-Control: public");
			header("Content-Description: File Transfer");
			header("Content-Transfer-Encoding: binary/octet-stream");
			header("Content-Type: application/x-download");
			header("Content-Disposition: attachment; filename=" . $filename);
			readfile($filename);
		}
		break;
	default:
		# code...
		break;
}
