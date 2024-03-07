<?php include 'view/header.php'; ?>
<main>
    <section class="main">
        <h1>Category List</h1>
        <table>
            <tr>
                <th>Name</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($categories as $category) : ?>
            <tr>
                <td><?php echo $category['categoryName']; ?></td>
                <td>
                    <form action="index.php" method="post">
                        <input type="hidden" name="action" value="delete_category" />
                        <input type="hidden" name="category_id"
                            value="<?php echo $category['categoryID']; ?>"/>
                        <button class="remove-button" type="submit" value="Delete">X</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </section>

    <section class="main">
        <h2>Add Category</h2>
        <form id="add_category_form"
            action="index.php" method="post">
            <input type="hidden" name="action" value="add_category" />

            <label>Name:</label>
            <input type="text" name="name" required/>
            <button class="button" type="submit" value="Add">Add</button>
        </form>
    </section>

    <p><a href="index.php?action=list_items">View List Items</a></p>

</main>
<?php include 'view/footer.php'; ?>