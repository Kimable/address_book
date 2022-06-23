<?php

    require('config/config.php');

    // Delete Record
    if(isset($_POST['delete'])){
       
        $id_delete = mysqli_real_escape_string($db_connection, $_POST['id_delete']);

        $delete_query = "DELETE FROM address WHERE id = $id_delete";

        if(mysqli_query($db_connection, $delete_query)){

            header('Location: index.php');

        } else{
            echo "OOPs something went wrond. Error: ".mysqli_error($db_connection);
        }

    }


    if(isset($_GET['id'])){

        $id = mysqli_real_escape_string($db_connection, $_GET['id']);

        $query_sql = "SELECT * FROM address WHERE id=$id";

        $query_result = mysqli_query($db_connection, $query_sql);

        $data = mysqli_fetch_assoc($query_result);

        mysqli_free_result($query_result);
        mysqli_close($db_connection);

    }

?>

<!DOCTYPE html>
<html lang="en">

    <?php include('templates/header.php') ?>

     <div class="container center">

      <?php if($data) : ?>
          
        <h4 style='text-decoration: underline;'><?php echo $data['last_name'] . "'s Address"; ?></h4>
        <p>Full Name: <strong><?php echo $data['first_name']. ' '. $data['last_name']; ?></strong></p>
        <p>Address: <strong><?php echo $data['street']. ', '. $data['zip_code']. ', '. $data['city']; ?></strong></p>
        <p>Created on: <strong><?php echo $data['created_at'] ?></strong></p>
        <a class='btn' href="edit.php?id=<?php echo $data['id'] ?>">Edit Info</a>

        <div class="form-container">
         <form class='center' action="detail.php" method="post">
            <input type="hidden" name='id_delete' value="<?php echo $data['id']; ?>">
            <div class="center">
             <input type="submit" class='btn red btn-small' name='delete' value="Delete">
           </div>
        </form>
       </div>

      <?php else : ?>
        <h5>No such address in our database</h5>
      <?php endif; ?>


     </div>
    <?php include('templates/footer.php') ?>

</html>