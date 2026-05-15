<?php
include '../db_connectivity/db.php';

try {
    $table_name = $_GET['table'];
    $result_column = mysqli_fetch_assoc(mysqli_query($con, "SHOW COLUMNS FROM $table_name"));
    if (!$result_column) {
        throw new Exception("Failed to fetch table columns");
    }    
    $first_col = $result_column['Field'];
    $id = base64_decode($_GET[$first_col]);
    $query = mysqli_query($con, "DELETE FROM $table_name WHERE $first_col = $id");
    if ($query) {
        header("Location: ./dashboard.php?admin=true&table=$table_name&result=true");
    } else {
        throw new Exception("Failed to execute delete query");
    }
    
} catch (Exception $e) {
    header("Location: ./dashboard.php?admin=true&table=$table_name&result=false");
}
?>