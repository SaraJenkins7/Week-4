<?php include('view/header.php') ?>

<section id="list" class="list">
    <header class="list_row list_header">
        <h1>To Do Items</h1>
        <form action="." method="GET" id="list_header_select" class="list_header_select">
            <input type="hidden" name="action" value="list_items">
            <select name="categoryID" required>
                <option value="0">View All</option>
                <?php foreach($categories as $category) : ?>
                    <?php if($categoryID == $category['categoryID']){ ?>
                        <option value="<?= $category['categoryID'] ?>" selected></option>
                        <?php } else { ?>
                        <option value="<?= $category['categoryID'] ?>"></option>
                        <?php } ?>
                        <option value="<?= $category['categoryName'] ?>"></option>
                    <?php endforeach; ?>
            </select>
            <button class="add-button bold">Add</button>
        </form>
    </header>
    <?php if($items) { ?>
        <?php foreach($todoitems as $todoitem) : ?>
            <div class="list_row">
                <div class="list_items">
                    <p class="bold"><?= $todoitem['categoryName'] ?></p>
                    <p><?= $todoitem['Description']?></p>
                </div>
                <div class="list_removeItem">
                    <form action="." method="post">
                        <input type="hidden" name="action" value="delete_item">
                        <input type="hidden" name="categoryID" value="<?=$todoitem['ID'] ?>">
                        <button class="remove-button">❌</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
        <?php ?>
    <?php } else { ?>
        <br>
        <?php if($categoryID) { ?>
            <p>No to do list items exist in this category yet</p>
        <?php } else { ?>
            <p>No to do list items exist yet</p>
        <?php } ?>
            <br>
    <?php } ?>
</section>

<section id="add" class="add">
<h2>Add Item</h2>
<form action="." method="post" id="add_form" class="add_form">
    <input type="hidden" name="action" value="add_item">
    <div class="add_inputs">
        <label>Category:</label>
        <select name="categoryID">
            <option value="">Please Select</option>
            <?php foreach ($categories as $category) : ?>
                <option value="<?= $category['categoryID'];?>">
                <?= $category['categoryName'];?>
            </option>
            <?php endforeach; ?>
        </select>
        <br>
        <label>Title:</label>
        <input type="text" name="Title" maxlength="20" placeholder="Title" required>
        <label>Description:</label>
        <input type="text" name="Description" maxlength="50" placeholder="Description" required>
    </div>
    <div class="add_addItem">
        <button class="add-button bold">Add</button>
    </div>
</form>
</section>
<p><a href=".?action=list_categories">Edit Categories</a></p>
<?php include('view/footer.php') ?>