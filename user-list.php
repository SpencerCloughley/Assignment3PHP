<?php 
    require('includes/auth.php');

    $title='Page List';
    require('includes/header.php');?>
    <main>
        <h1>Administrators</h1>

        <?php
        //connect to the database and run the validated sql command
        try{
        require('includes/db.php');
        $sql="SELECT * FROM users";
        $cmd = $db->prepare($sql);
        $cmd->execute();
        $users=$cmd->fetchAll();
        //start of the table to label all the columns
        echo '<table><thead><th>Email</th><th>Edit</th><th>Delete</th></thead>';
        
        //print each page out from the table then a delete and edit option
        foreach($users as $user){
            echo '<tr>
            <td>' . $user['username'] . '</td>
            <td>
            <a href="edit-user.php?userId=' . $user['userId'] .'" title="Edit">
                Edit</i>
            </a>
            <td>         
            <a href="delete-user.php?userId=' . $user['userId'] . '"
                title="Delete" onclick="return confirmDelete();">
                    Delete</i>
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