<?php

function encrypt($string, $key)
{
	$output = false;
	$encrypt_method = "AES-256-CBC";
	$ivlen = openssl_cipher_iv_length($encrypt_method);
	$iv = substr(hash('sha256', openssl_random_pseudo_bytes($ivlen)), 0, $ivlen);
	$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
	$output = base64_encode($iv . $output);
	return $output;
}

function decrypt($string, $key)
{
	$output = false;
	$encrypt_method = "AES-256-CBC";
	$ivlen = openssl_cipher_iv_length($encrypt_method);	
	$buf = base64_decode($string);
	$iv = substr($buf,0,$ivlen);
	$string = substr($buf,$ivlen,strlen($buf)-$ivlen);
	$output = openssl_decrypt($string, $encrypt_method, $key, 0, $iv);
	return $output;
}

/*
function alert($msg)
{
	echo "<script type='text/javascript'>alert('$msg');</script>";
}
*/

?>
