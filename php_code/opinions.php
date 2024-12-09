<?php

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
  case 'POST':
    post_new_opinion();  
    break;
  case 'GET':
    load_opinions();  
    break;
  default:
    break;
}

function load_opinions(){

include 'config.php';
$dbconn = pg_connect("host=$dbhost dbname=$dbname user=$dbuser password=$dbpassword");
if (!$dbconn) {
    $_SESSION['loginError'] = 'Errore di connessione al database';
    header("Location: index.php");
    exit();
}
    $query = "SELECT opinion FROM opinions";
    $result = pg_query($dbconn, $query);
    if (!$result) {
        $data = array('error' => 'Errore generico col database');
        echo json_encode($data);
        exit();
    }

    $data = [];
    while ($row = pg_fetch_row($result)) {
        $rowResult = [];
        $rowResult['username'] = "ctf_doggy"; 
        $rowResult['opinion'] = $row[0];

        $data[] = $rowResult;
    }

    pg_free_result($result);
    pg_close($dbconn);

    echo json_encode($data);
    exit();
}

function post_new_opinion(){

include 'config.php';

$dbconn = pg_connect("host=$dbhost dbname=$dbname user=$dbuser password=$dbpassword");
if (!$dbconn) {
    $_SESSION['loginError'] = 'Errore di connessione al database';
    header("Location: index.php");
    exit();
}
    $opinion = $_POST['opinion'];
    $array = array("opinion" => $opinion);  
    $result = pg_insert($dbconn, "opinions", $array);    
    if (!$result) {
        $data = array('error' => 'Errore generico col database');
        echo json_encode($data);
        exit();
    }

    pg_free_result($result);
    pg_close($dbconn);

    echo json_encode($result);
    exit();
}
?>