<?php include 'view/header.php'; ?>
<main>
    <section class="add__form">
        <h1>Add Item</h1>
        <form action="index.php" method="post" id="add_item_form">
            <input type="hidden" name="action" value="add_item">

            <label>Category:</label>
            <select name="category_id">
            <?php foreach ( $categories as $category ) : ?>
                <option value="<?php echo $category['categoryID']; ?>">
                    <?php echo $category['categoryName']; ?>
                </option>
            <?php endforeach; ?>
            </select>
            <br>

            <label>Title:</label>
            <input type="text" name="item_title" required/>
            <br>

            <label class=>Description:</label>
            <input type="text" name="item_description" required/>
            <br>

            <label>&nbsp;</label>
            <button class="button" type="submit" name="action" value="add_item">Add Item</button>
            <br>
        </form>
    </section>

    <p><a href="index.php?action=list_items">View Item List</a></p>

</main>
<?php include 'view/footer.php'; ?>