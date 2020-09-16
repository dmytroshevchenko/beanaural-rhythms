<?php
	error_reporting( 0 );
	
	$mixURL = $_GET[ 'mix-url' ];
	$mixName = $_GET[ 'mix-name' ];
	$mixSize = $_GET[ 'mix-size' ];
	
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename="' . $mixName . '.mp3"');
	header('Expires: 0');
	header('Cache-Control: must-revalidate');
	header('Pragma: public');
	// header('Content-Length: ' . filesize($file));   
	header('Content-Length: ' . $mixSize);
	readfile( $mixURL );
	exit;	
?>