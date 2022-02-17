<?php
require_once('database.php');

$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);

// Delete the product from the database
if ($title != false) {
    $query = 'DELETE FROM todoitems
              WHERE $title = :title';
    $statement = $db->prepare($query);
    $statement->bindValue(':title', $title);
    $success = $statement->execute();
    $statement->closeCursor();    
}

// Display the Product List page
include('index.php');