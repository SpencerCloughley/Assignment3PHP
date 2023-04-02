    <?php 
    require('includes/auth.php');

    $title='Page List';
    require('includes/header.php');?>
    <main>
        <h1>Page List</h1>
        <a href="add-page.php">Add a new Page</a>

        <?php
        //connect to the database and run the validated sql command
        try{
        require('includes/db.php');
        $sql="SELECT * FROM pages";
        $cmd = $db->prepare($sql);
        $cmd->execute();
        $pages=$cmd->fetchAll();
        //start of the table to label all the columns
        echo '<table><thead><th>Page Name</th><th>Edit</th><th>Delete</th></thead>';
        
        //print each page out from the table then a delete and edit option
        foreach($pages as $page){
            echo '<tr>
            <td>' . $page['pageName'] . '</td>
            <td>
            <a href="edit-page.php?pageId=' . $page['pageId'] .'" title="Edit">
                <i class="fa-solid fa-pen-to-square"></i>
            </a>
            <td>         
            <a href="delete-page.php?pageId=' . $page['pageId'] . '"
                title="Delete" onclick="return confirmDelete();">
                    <i class="fa-solid fa-trash-can"></i>
            </a>
            </td>
            </tr>';
        }
        //closing out table
        echo '</table>';
        $db=null;
        }
        catch(Exception $e){
            header('location:error.php');
            exit();
        }
        ?>
        <?php require('includes/footer.php'); ?>