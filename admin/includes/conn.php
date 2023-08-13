<?php
$isSSL = function () {
	if (!empty($_SERVER['https']))
		return true;

	if (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_P
ROTO'] == 'https')
		return true;

	if (!isset($_SERVER['SERVER_PORT']))
		return false;

	if ($_SERVER['SERVER_PORT'] == 443)
		return true;

	return false;
};

$prot = $isSSL() ? 'https://' : 'http://';
// $config['base_url'] = $prot . $host . "/";
$base_url = $prot . $_SERVER['HTTP_HOST'] .
	str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
$conn = new mysqli('localhost', 'root', '', 'db_apsystem');

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}