<?php
require('includes/auth.php');

$title = 'Page Details';
require('includes/header.php');

$pageName=$_POST['pageName'];
$content=$_POST['content'];
$ok=true;
$pageId=$_POST['pageId'];

if(empty($pageId)){
    echo '<p>Page Id is required</p>';
    $ok=false;
}
if(empty($pageName)){
    echo '<p>Page Name is required</p>';
    $ok=false;
}
if(empty($content)){
    echo '<p>Page content is required</p>';
    $ok=false;
}

if($ok){
    require('includes/db.php');
    $sql="UPDATE pages SET pageName=:pageName,content=:content WHERE pageId= :pageId";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':pageName',$pageName,PDO::PARAM_STR,100);
    $cmd->bindParam(':content',$content,PDO::PARAM_STR,255);
    $cmd->bindParam(':pageId', $pageId, PDO::PARAM_INT);

    $cmd->execute();
    $db=null;
    echo "Page updated";
}
header('location:page-list.php');
?>

<?php require('includes/footer.php'); ?>