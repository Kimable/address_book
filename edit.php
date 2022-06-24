<?php
require('config/config.php'); // For Database Conection
require('classes/Address.php'); // Address class for CRUD functionalities

$firstName = $lastName = $email = $street = $zipCode = $city = $errMessage = '';

// Update
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
        $edit = new Address($firstName, $lastName, $email, $street, $zipCode, $city);
        $edit->editData($db_connection);
    }
}

// Grab data from DB based on ID to pre-fill the form to edit.
$getSingleData = new Address();
$data = $getSingleData->singleData($db_connection);



?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php') ?>

<div class="container center">

    <?php if ($data) : ?>
        <div class="form-container">
            <form action="" method="post">

                <label for="first_name">First Name</label>
                <input type="text" name='first_name' id='first_name' required value='<?php echo $data['first_name']; ?>'>

                <label for="last_name">Last Name</label>
                <input type="text" name='last_name' id='last_name' required value='<?php echo $data['last_name']; ?>'>

                <label for="email">Email</label>
                <input type="email" id='email' name='email' required value='<?php echo $data['email']; ?>'>
                <div class="error-message red-text"><?php echo $errMessage ?></div>

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