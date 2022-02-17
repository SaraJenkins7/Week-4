<?php 
require_once('database.php');

$itemnum = filter_input(INPUT_POST, "itemnum", FILTER_SANITIZE_STRING);
$title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING);
$description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING);

$query = 'INSERT INTO todoitems
            (ItemNum, Title, Description)
            Values
                (:itemnum, :title, :description)';
$statement = $db->prepare($query);
$statement->bindValue(':itemnum', $itemnum);
$statement->bindValue(':title', $title);
$statement->bindValue(':description', $description);
$statement->execute();
$statement->closeCursor();

include('index.php');
?>