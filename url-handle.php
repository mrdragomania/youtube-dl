<?php
session_start();

define('PATH', './converted-files/');

$url = '';

$json = [
	'header' => [
		'status_code' => 500
	],
	'payload' => [
		'stream' => []
	],
	'error' => [
		'stream' => null,
	]
];

error_reporting(-1);

if(isset($_POST['url']) && $_POST['url'] !== null && $_POST['url'] !== '') {
	$url = $_POST['url'];
} else {
	$json['header']['status_code'] = 404;
	$json['error']['stream'] = 'URL not set.';
	echo json_encode($json);
	// print_r($json);
	die();
}

try {
	exec('youtube-dl.exe -i -c -o "%(title)s.%(ext)s" --restrict-filenames --geo-bypass --extract-audio --audio-format mp3 --audio-quality 0 ' . $url);
} catch(Exception $e) {
	print_r($e);
	die();
}

$mp3Array = glob("*.mp3");

foreach($mp3Array as $mp3SingleRow) {
	rename($mp3SingleRow, './converted-files/' . $mp3SingleRow);
	array_push($_SESSION['files'], $mp3SingleRow);
}

if(isset($mp3Array[0]) && $mp3Array[0] !== null && $mp3Array[0] !== '') {
	$json['header']['status_code'] = 200;
	$json['payload']['stream'] = [
		'path' => PATH,
		'filename' => $mp3Array[0]
	];
	// print_r($json);
	echo json_encode($json);
} else {
	$json['header']['status_code'] = 500;
	$json['error']['stream'] = 'Something went wrong.';
	// print_r($json);
	echo json_encode($json);
}