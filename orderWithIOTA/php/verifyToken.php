<?php

include 'src/JWToken.php';

//驗證token是否存在
function verifyToken($token){
	$public_key =  file_get_contents('http://140.127.74.191/wtlab108/php/keys/public_key.pem');
	try {
		$data = JWToken::decode($token,$public_key,'RS256');
	}catch(Exception $e){
		setcookie("AuthOver","true",time()+(60),"/wtlab108","140.127.74.191");
		unset($_COOKIE["token"]);
		return false;
	}
	return true;
}

//回傳token的cookie內部的值(user,time)
function getToken($token){
	$public_key =  file_get_contents('http://140.127.74.191/wtlab108/php/keys/public_key.pem');
	try {
		$data = JWToken::decode($token,$public_key,'RS256');
		//var_dump($data);
	}catch(Exception $e){
		setcookie("AuthOver","true",time()+(60),"/wtlab108","140.127.74.191");
		unset($_COOKIE["token"]);
		return "";
	}
	return $data;
}
?>
