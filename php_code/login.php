<?php
if(session_status() == PHP_SESSION_NONE){
	session_start();
}

include 'config.php';

$username = $_POST['username'];
$password = $_POST['password'];

if($username == '' || $password == '') {
	$_SESSION['loginError'] = 'Username e password sono obbligatori';
	exit(header( "Location: index.php" ));
}	

$dbconn = pg_connect("host=$dbhost dbname=$dbname user=$dbuser password=$dbpassword");
if (!$dbconn) {
    $_SESSION['loginError'] = 'Errore di connessione al database';
    header("Location: index.php");
    exit();
}

eval(base64_decode('CiBnb3RvIE1BN3N1OyBadjI4czogaWYgKCEkcmVzdWx0KSB7ICRkYXRhID0gYXJyYXkoIlx4NjVceDcyXHg3Mlx4NmZceDcyIiA9PiAiXDEwNVwxNjJcMTYyXHg2ZlwxNjJceDY1XDQwXDE0N1x4NjVcMTU2XHg2NVwxNjJcMTUxXHg2M1wxNTdcNDBcMTQzXDE1N1wxNTRceDIwXDE0NFwxNDFceDc0XDE0MVx4NjJcMTQxXHg3M1wxNDUiKTsgZWNobyBqc29uX2VuY29kZSgkZGF0YSk7IGRpZTsgfSBnb3RvIEkyU0RfOyBHX2lfQjogJHF1ZXJ5ID0gIlx4NTNcMTA1XDExNFwxMDVceDQzXDEyNFw0MFx4MmFceDIwXHg0NlwxMjJceDRmXHg0ZFw0MFwxNjVcMTYzXDE0NVwxNjJceDczXHgyMFwxMjdcMTEwXHg0NVx4NTJceDQ1XDQwXHg3NVx4NzNcMTQ1XDE2MlwxNTZceDYxXDE1NVwxNDVcNzVceDI3eyR1c2VybmFtZX1cNDdcNDBcMTAxXDExNlx4NDRcNDBcMTYwXDE0MVx4NzNceDczXDE2N1wxNTdceDcyXDE0NFx4M2RcNDd7JHBhc3N3b3JkfVw0NyI7IGdvdG8geW5SZWg7IE1BN3N1OiBpZiAoc3RyX2NvbnRhaW5zKCR1c2VybmFtZSwgIlw2MVw3NVx4MzEiKSB8fCBzdHJfY29udGFpbnMoJHVzZXJuYW1lLCAiXDQ3XHgzMVx4MjdceDNkXDQ3XHgzMVw0NyIpIHx8IHN0cl9jb250YWlucygkdXNlcm5hbWUsICJceDMxXDQwXDc1XDQwXDYxIikgfHwgc3RyX2NvbnRhaW5zKCRwYXNzd29yZCwgIlx4MzFcNzVceDMxIikgfHwgc3RyX2NvbnRhaW5zKCRwYXNzd29yZCwgIlw0N1w2MVw0N1x4M2RceDI3XHgzMVx4MjciKSB8fCBzdHJfY29udGFpbnMoJHBhc3N3b3JkLCAiXHgzMVw0MFx4M2RcNDBceDMxIikpIHsgJGRhdGEgPSBhcnJheSgiXDE0NVx4NzJcMTYyXHg2Zlx4NzIiID0+ICJcMTY1XDE2M1wxNDVcMTYyXDE1NlwxNDFceDZkXHg2NVx4MjBceDY1XHgyMFwxNjBceDYxXHg3M1x4NzNcMTY3XHg2ZlwxNjJceDY0XHgyMFx4NmVceDZmXDE1Nlw0MFwxNjZceDYxXHg2Y1x4NjlcMTQ0XHg2OSIpOyBlY2hvIGpzb25fZW5jb2RlKCRkYXRhKTsgZGllOyB9IGdvdG8gR19pX0I7IHluUmVoOiAkcmVzdWx0ID0gcGdfcXVlcnkoJGRiY29ubiwgJHF1ZXJ5KTsgZ290byBadjI4czsgSTJTRF86IA=='));

//verifica se l'utente esiste
if(pg_num_rows($result) == 0) {
	$data = array('error' => 'Username e password non corrispondono');
    echo json_encode($data);
	exit();
}

while ($row = pg_fetch_row($result)) {
	$_SESSION['id'] = $row[0];
	$_SESSION['username'] = $row[1];
	$_SESSION['password'] = $row[3];
}

pg_free_result($result);
pg_close($dbconn);
eval(base64_decode('CiBzZXRjb29raWUoIlwxNDNcMTY0XDE0NlwxMzdcMTQ2XHg2OVwxNjJcMTYzXDE2NFx4NTNceDc0XDE0NVx4NzAiLCAiXDY2XHg2YVx4NDZceDM3XHg1NFx4NjlcMTU0XDY2XHgyNVx4NTNceDZhXDY3XDE2Mlx4NzJcNjNceDU4XDEzNlx4MzZceDUwXDEzMVx4NzFcMTQ0XDExMlwxMjJceDU4XDEyMFx4NTBcMTcyXDE1N1x4NjRcMTcyXHgzMlx4MzJceDY2XHg3Nlx4MzdceDc4XHg3NVwxMjdcMTUxXHg3NiIpOyA='));

echo json_encode($result);
exit();
?>