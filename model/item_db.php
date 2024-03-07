<?php
function get_items_by_category($category_id) {
    global $db;

    if(!$category_id){
        $query = 'SELECT * FROM todoitems';
    } else {
        $query = 'SELECT * FROM todoitems
                WHERE todoitems.categoryID = :category_id
                ORDER BY ItemNum';
    }

    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->execute();
    $items = $statement->fetchAll();
    $statement->closeCursor();
    return $items;
}

function get_items() {
    global $db;
    $query = 'SELECT * FROM todoitems';
    $statement = $db->prepare($query);
    $statement->execute();

    $items = $statement->fetchAll();
    $statement->closeCursor();
    return $items;
}

function delete_item($item_num) {
    global $db;
    $query = 'DELETE FROM todoitems
              WHERE ItemNum = :item_num';
    $statement = $db->prepare($query);
    $statement->bindValue(':item_num', $item_num);
    $statement->execute();
    $statement->closeCursor();
}

function add_item($category_id, $item_title, $item_description) {
    global $db;
    $query = 'INSERT INTO todoitems
                 (categoryID, Title, Description)
              VALUES
                 (:category_id, :item_title, :item_description)';
    $statement = $db->prepare($query);
    $statement->bindValue(':category_id', $category_id);
    $statement->bindValue(':item_title', $item_title);
    $statement->bindValue(':item_description', $item_description);
    $statement->execute();
    $statement->closeCursor();
}
?>