<?php 

require_once('model/database.php');
require_once('model/category_db.php');
require_once('model/item_db.php');

$categoryID = filter_input(INPUT_POST, 'categoryID', FILTER_VALIDATE_INT);
$itemnum = filter_input(INPUT_POST, 'itemnum', FILTER_SANITIZE_STRING);
$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
$description = filter_input(INPUT_POST, 'description', FILTER_UNSAFE_RAW);
$categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_UNSAFE_RAW);

$categoryID = filter_input(INPUT_POST, 'categoryID', FILTER_VALIDATE_INT);
if(!$categoryID){
    $categoryID = filter_input(INPUT_GET, 'categoryID', FILTER_VALIDATE_INT);
}

$action = filter_input(INPUT_POST, 'action', FILTER_UNSAFE_RAW);

if(!$action){
    $action = filter_input(INPUT_GET, 'action', FILTER_UNSAFE_RAW);
    if(!$action){
        $action = 'list_items';
    }
}

switch($action){
    case "list_categories":
        $categories = get_items();
        include('view/category_list.php');
        break;
    case "add_category":
        add_category($categoryName);
        header("Location: .?action=list_categories");
        break;
    case "add_item":
        if($categoryID && $description){
            add_item($categoryID, $description);
            header("Location: .?categoryID=$categoryID");
        } else {
            $error = "Invalid item data. Check all fields and try again.";
            include('view/error.php');
            exit();
        }
    case "delete_category":
        if($categoryID){
            try{
                delete_category($categoryID);
            } catch (PDOException $e){
                $error = "You cannot delete a category if items exist in the category.";
                include('view/error.php');
                exit();
            }
            header("Location: .?action=list_categories");
        }
        break;
    case "delete_item":
        if($ItemNum){
            delete_item($ItemNum);
            header("Location: .?categoryID=$categoryID");
        } else {
            $error = "Missing or incorrect item number.";
            include('view/error.php');
        }
    default:
       $categoryName = get_items_by_category($categoryID);
        $categories = get_items();
        $items = get_items_by_category($categoryID);
        include('view/item_list.php');
}

?>
