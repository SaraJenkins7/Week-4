<?php include('view/header.php') ?>
<?php if($categories) { ?>
    <section id="list" class="list">
        <header class="list_row list_header">
            <h1>Category List</h1>
        </header>
        <?php foreach ($categories as $category) : ?>
            <div class="list_row">
                <div class="list_item">
                    <p class="bold"><?=$category['categoryName'] ?></p>
                </div>
                <div class="list_removeItem">
                    <form action="." method="post">
                        <input type="hidden" name="action" value="delete_category">
                        <input type="hidden" name="catgoryID" value=<?=$category['categoryID'] ?>">
                        <button class="remove-button">❌</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
<?php } else { ?>
    <p>No categories exist yet</p>
<?php } ?>
<section id="add" class="add">
    <h2>Add Category</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" id="add_form" class="add_form">
        <input type="hidden" name="action" value="add_category">
        <div class="add_inputs">
            <label>Category Name:</label>
            <input type="text" name="categoryName" maxlength="20" placeholder="Category Name" autofocus required>
        </div>
        <div class="add_addItem">
            <button class="add-button bold">Add</button>
        </div>
    </form>
</section>

<br>
<p><a href=".">Back to To Do List</a></p>
<?php include('view/footer.php') ?>