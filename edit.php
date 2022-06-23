<?php
    require('config/config.php');

     // Update
     if(isset($_POST['submit'])){
        $fisrtName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $email = $_POST['email'];
        $street = $_POST['street'];
        $zipCode = $_POST['zip-code'];
        $city = $_POST['city'];

        $id = $_GET['id'];

        echo 'Your id is: '. $id;

        $update_sql = "UPDATE address SET first_name='$fisrtName',last_name='$lastName'
        ,email='$email',street='$street',zip_code='$zipCode',city='$city' WHERE id = $id";

        if(mysqli_query($db_connection, $update_sql)){
            header('Location: index.php');
        } else{
            echo 'Error: ' . mysqli_error($db_connection);
        }
        
    }

    if(isset($_GET['id'])){

        $id = mysqli_real_escape_string($db_connection, $_GET['id']);

        $query_sql = "SELECT * FROM address WHERE id = $id";

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
        <div class="form-container">
         <form action="" method="post">
            
            <label for="first_name">First Name</label>
            <input type="text" name='first_name' id='first_name' required  value='<?php echo $data['first_name']; ?>'>

            <label for="last_name">Last Name</label> 
            <input type="text" name='last_name' id='last_name' required  value='<?php echo $data['last_name']; ?>'>
            
            <label for="email">Email</label>
            <input type="email" id='email' name='email' required  value='<?php echo $data['email']; ?>'>

            <label for="street">Street</label> 
            <input type="text" name='street' id='street' required value='<?php echo $data['street']; ?>'>

            <label for="zip-code">Zip Code</label> 
            <input type="text" name='zip-code' id='zip-code' required value='<?php echo $data['zip_code']; ?>'>

            <label for="city">City</label> 
            <input type="text" name='city' id='city' required value='<?php echo $data['city']; ?>'>

            <input class="btn" type="submit" name="submit" value="Edit Address">
           
        </form>
       </div>

      <?php else : ?>
        <h5>No such address in our database</h5>
      <?php endif; ?>


     </div>
    <?php include('templates/footer.php') ?>

</html>