<?php

   require('config/config.php');

   $fisrtName = $lastName = $email = $street = $zipCode = $city = '';
   $errors = array('first_name' => '', 'last_name'=> '', 'email'=>'');

   if(isset($_POST['submit'])){
        $fisrtName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $email = $_POST['email'];
        $street = $_POST['street'];
        $zipCode = $_POST['zip-code'];
        $city = $_POST['city'];

        // Check If Fields are empty
        if(empty($fisrtName)){
            $errors['first_name'] = 'This field is required';
        };
        if(empty($lastName)){
            $errors['last_name'] = 'This field is required';
        };
        if(empty($email)){
            $errors['email'] = 'This field is required';
        } else{
            // Sanitize Email
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors['email'] = 'Email must be valid. (eg: it must contain @ character and .com extension)';
        };
        }  
        
        if(!array_filter($errors)){
            $insert_sql = "INSERT INTO address(first_name,last_name,email,street,zip_code,city) VALUES('$fisrtName', 
            '$lastName', '$email', '$street', '$zipCode', '$city')";

            if(mysqli_query($db_connection, $insert_sql)){
                header('Location: index.php');
            } else{
                echo 'Error: ' . mysqli_error($db_connection);
            }
        }
   }
   
?>

<!DOCTYPE html>
<html lang="en">

  <?php include('templates/header.php'); ?>

  <div class="form-container container section">
    <h3>ADD AN ADDRESS</h3>
    <form action="" method='post'>

      <label for="first_name">First Name</label>
      <input type="text" name='first_name' id='first_name'  value='<?php echo htmlspecialchars($fisrtName); ?>'>
      <div class="error-message red-text"><?php echo $errors['first_name']?></div>

      <label for="last_name">Last Name</label> 
      <input type="text" name='last_name' id='last_name'  value='<?php echo htmlspecialchars($lastName); ?>'>
      <div class="error-message red-text"><?php echo $errors['last_name']?></div>
      
      <label for="email">Email</label>
      <input type="email" id='email' name='email'  value='<?php echo htmlspecialchars($email); ?>'>
      <div class="error-message red-text"><?php echo $errors['email']?></div>

      <label for="street">Street</label> 
      <input type="text" name='street' id='street' required value='<?php echo htmlspecialchars($street); ?>'>

      <label for="zip-code">Zip Code</label> 
      <input type="text" name='zip-code' id='zip-code' required value='<?php echo htmlspecialchars($zipCode); ?>'>

      <label for="city">City</label> 
      <input type="text" name='city' id='city' required value='<?php echo htmlspecialchars($city); ?>'>

      <input class="btn" type="submit" name="submit" value="Add Address">
    </form>
  </div>

  <?php include('templates/footer.php') ?>
</html>