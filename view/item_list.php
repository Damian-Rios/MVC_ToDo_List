<?php include 'view/header.php'; ?>
<main>
    <section class="main">
        <h1>Item List</h1>

        <form action="index.php" method="get">
            <label for="category">Select a category:</label>
            <select name="category" id="category">
                <option value="all">All Categories</option>
                <?php foreach ($categories as $category) : ?>
                    <option value="<?php echo $category['categoryID']; ?>"><?php echo $category['categoryName']; ?></option>
                <?php endforeach; ?>
            </select>
            <button class="button" type="submit" value="Filter">Filter</button>
        </form>
    </section>

    <section id="list" class="main">
        <!-- display a table of products -->
        <h2><?php echo $category_name; ?></h2>
        <table>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Category</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($items as $item) : ?>
            <tr>
                <td><?php echo $item['Title']; ?></td>
                <td><?php echo $item['Description']; ?></td>
                <td><?php echo get_category_name($item['categoryID']); ?></td>
                <td><form action="." method="post">
                    <input type="hidden" name="action"
                           value="delete_item">
                    <input type="hidden" name="item_num"
                           value="<?php echo $item['ItemNum']; ?>">
                    <input type="hidden" name="category_id"
                           value="<?php echo $item['categoryID']; ?>">
                    <button class="remove-button" type="submit" value="Delete">X</button>
                </form></td>
            </tr>
            <?php endforeach; ?>
        </table>     
    </section>

    <p><a href="?action=show_add_form">Add Item</a></p>
    <p><a href="?action=list_categories">View/Edit Categories</a></p>   

</main>
<?php include 'view/footer.php'; ?>