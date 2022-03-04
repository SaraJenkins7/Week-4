<?php 
function get_items_by_category($categoryID){
    global $db;
    if($categoryID){
        $query = 'SELECT T.ItemNum, T.Title, T.Description, C.categoryName FROM todoitems T
                    Left JOIN categories C ON T.categoryID = C.categoryID
                    WHERE T.categoryID =:categoryID ORDER BY ID';
    } else {
        $query = 'SELECT T.ItemNum, T.Title, T.Description, C.categoryName FROM todoitems T
                    Left JOIN categories C ON T.categoryID = C.categoryID
                    ORDER BY ID';
    }
    $statement = $db->prepare($query);
    if($categoryID){
        $statement->bindValue(':categoryID', $categoryID);
    }
    $statement->execute();
    $todoitems = $statement->fetchAll();
    $statement->closeCursor();
    return $todoitems;
}

function delete_item($categoryID){
    global $db;
    $query = 'DELETE FROM todoitems WHERE ID = :categoryID';
    $statement = $db->prepare($query);
    $statement->bindValue(':categoryID', $categoryID);
    $statement->execute();
    $statement->closeCursor();
}

function add_item($itemNum, $title, $description, $categoryID){
    global $db;
    $query = 'INSERT INTO todoitems (ItemNum, Title, Description, categoryID) VALUES (:itemNum, :title, :description, :categoryID)';
    $statement = $db->prepare($query);
    $statement->bindValue(':itemNum', $itemNum);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':description', $description);
    $statement->bindValue(':categoryID', $categoryID);
    $statement->execute();
    $statement->closeCursor();
}

?>