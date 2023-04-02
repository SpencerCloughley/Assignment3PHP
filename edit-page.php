<?php
require('includes/auth.php');

$title = 'Page Details';
require('includes/header.php');

$pageId = $_GET['pageId'];

if (empty($taskId) || !is_numeric($taskId)) {
    header('location:400.php');  // bad request http 400 error
    exit();
}

require('includes/db.php');


$sql = "DELETE FROM pages WHERE pageId = :pageId";
$cmd = $db->prepare($sql);
$cmd->bindParam(':pageId', $pageId, PDO::PARAM_INT);


$cmd->execute();


$db = null;
echo '<p>Page Deleted</p>
    <a href="page-tabel.php">See the Updated Page List</a>';

header('location:page-tabel.php');
?>