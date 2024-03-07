<?php
require('model/database.php');
require('model/item_db.php');
require('model/category_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_items';
    }
}

if ($action == 'list_items') {
    $category_id = filter_input(INPUT_GET, 'category', FILTER_VALIDATE_INT);

    if ($category_id === false || $category_id === null || $category_id == "all") {
        $category_id = null;
    }

    if ($category_id !== null) {
        $category_name = get_category_name($category_id);
    } else {
        $category_name = null;
    }

    $categories = get_categories();

    if ($category_id !== null) {
        $items = get_items_by_category($category_id);
    } else {
        $items = get_items();
    }

    include('view/item_list.php');
} else if ($action == 'delete_item') {
    $item_num = filter_input(INPUT_POST, 'item_num', 
            FILTER_VALIDATE_INT);
    $category_id = filter_input(INPUT_POST, 'category_id', 
            FILTER_VALIDATE_INT);
    if ($category_id == NULL || $category_id == FALSE ||
            $item_num == NULL || $item_num == FALSE) {
        $error = "Missing or incorrect product id or category id.";
        include('view/error.php');
    } else { 
        delete_item($item_num);
        header("Location: .?category_id=$category_id");
    }
} else if ($action == 'show_add_form') {
    $categories = get_categories();
    include('view/item_add.php');    
} else if ($action == 'add_item') {
    $category_id = filter_input(INPUT_POST, 'category_id', 
            FILTER_VALIDATE_INT);
    $item_title = filter_input(INPUT_POST, 'item_title');
    $item_description = filter_input(INPUT_POST, 'item_description');

    if ($category_id == NULL || $category_id == FALSE || 
            $item_title == NULL || $item_description == NULL) {
        $error = "Invalid item data. Check all fields and try again.";
        include('view/error.php');
    } else { 
        add_item($category_id, $item_title, $item_description);
        header("Location: .?category_id=$category_id");
    }
} else if ($action == 'list_categories') {
    $categories = get_categories();
    include('view/category_list.php');
} else if ($action == 'add_category') {
    $name = filter_input(INPUT_POST, 'name');

    // Validate inputs
    if ($name == NULL) {
        $error = "Invalid category name. Check name and try again.";
        include('view/error.php');
    } else {
        add_category($name);
        header('Location: .?action=list_categories');  // display the Category List page
    }
} else if ($action == 'delete_category') {
    $category_id = filter_input(INPUT_POST, 'category_id', 
            FILTER_VALIDATE_INT);
    delete_category($category_id);
    header('Location: .?action=list_categories');      // display the Category List page
}
?>