<?php 
require_once 'database.php';
$itemnum = filter_input(INPUT_POST, "itemnum", FILTER_SANITIZE_STRING);
$title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_STRING);
$description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING);

$todoitems = filter_input(INPUT_GET, "todoitems", FILTER_SANITIZE_STRING);

if(isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];

    /*$query = 'INSERT INTO todoitems
                (ItemNum, Title, Description)
                VALUES
                    (:itemnum, :title, :description)';
    $statement = $db->prepare($query);
    $statement->bindValue(':itemnum', $itemnum);
    $statement->bindValue(':title', $title);
    $statement->bindValue(':description', $description);
    $statement->execute();
    $statement->closeCursor(); */

} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <main>
        <header>
            <h1>To Do List</h1>
        </header>
        <section>
        <?php   if($title){
                    $query = 'SELECT * FROM todoitems
                                WHERE title = :title';
                    $statement = $db->prepare($query);
                    $statement->bindValue(':title', $title);
                    $statement->execute();
                    $statement->fetchAll();
                    $statement->closeCursor(); 
                } else {
                    echo "No to do list items exist yet.";
                } ?>
        </section>
        <section>
            <div action="<?php echo $_SERVER['PHP_SELF']?>" method="POST"><?php echo $title; ?><button type="reset" action="delete_item.php" method="POST" class="delete">X</button></div>
        </section>
        <?php
        if(!$todoitems){ ?>
            <section>
                <h2>Add Items</h2>
                <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                    <input type="text" id="title" name="title" placeholder="Title" required>
                    <input type="text" id="description" name="description" placeholder="Description" required>
                    <button type="submit" class="add">Add Item</button>
                </form>
            </section>
        
        <?php } else { ?>
            <?php
    /*       if(!empty($results)) { ?>
            <section>
                <p>No to do list items exist yet.</p>
            </section> */
        //    <?php } ?>
            <a href="<?php echo $_SERVER['PHP_SELF']?>">Go to list</a>
        <?php } ?>  
        <form action="add_item.php" method="POST">
            <?php
            if($title){
                $query = 'INSERT INTO todoitems
                            (ItemNum, Title, Description)
                            VALUES
                                (:itemnum, :title, :description)';
                $statement = $db->prepare($query);
                $statement->bindValue(':itemnum', $itemnum);
                $statement->bindValue(':title', $title);
                $statement->bindValue(':description', $description);
                $statement->execute();
                $statement->closeCursor();
            } 
            ?> 
        </form> 

    </main>
</body>
</html>