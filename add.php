<?php

require('config/config.php'); // For Database Conection
require('classes/Address.php'); // Address class for CRUD functionalities

$firstName = $lastName = $email = $street = $zipCode = $city = $errMessage = '';

if (isset($_POST['submit'])) {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $street = $_POST['street'];
    $zipCode = $_POST['zip-code'];
    $city = $_POST['city'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errMessage = 'Email must be valid. (eg: it must contain @ character and .com extension)';
    } else {
        $insert = new Address($firstName, $lastName, $email, $street, $zipCode, $city);
        $insert->insertDataToDB($db_connection);
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
        <input type="text" name='first_name' id='first_name' required value='<?php echo htmlspecialchars($firstName); ?>'>


        <label for="last_name">Last Name</label>
        <input type="text" name='last_name' id='last_name' required value='<?php echo htmlspecialchars($lastName); ?>'>


        <label for="email">Email</label>
        <input type="email" id='email' name='email' required value='<?php echo htmlspecialchars($email); ?>'>
        <div class="error-message red-text"><?php echo $errMessage ?></div>


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