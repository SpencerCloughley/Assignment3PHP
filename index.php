<?php 
    
    $title='Assignment 2';
    require('includes/header.php');

    $pageId=$_GET['pageId'];
    require('includes/db.php');
    $sql="SELECT * FROM pages WHERE pageId=:pageId";
    $cmd = $db->prepare($sql);
    $cmd->bindParam(':pageId', $pageId, PDO::PARAM_INT);
    $cmd->execute();
    $page=$cmd->fetch();

    if (empty($page)) {
        $pageName="";
        $content="";
    }
    else{
        $pageName=$page['pageName'];
        $content=$page['content'];
    }
    ?>
    <main>
        <h1><?php echo $pageName; ?></h1>
        <p><?php echo $content; ?></p>
    </main>

<?php require('includes/footer.php'); ?>