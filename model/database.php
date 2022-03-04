<?php 
$dsn ='mysql:host=localhost; dbname=todolist';
$username = 'root';
$password = 'Sj_7509696!';

try{
    $db = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $error_message = 'Database Error';
    $error_message .= $e->getMessage();
    include('view/error.php');
    exit();
}

?>