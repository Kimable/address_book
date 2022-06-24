<?php

require('config/config.php'); // For Database Conection
require('classes/Address.php'); // Address class for CRUD functionalities

$address = new Address();
// Delete Data based on ID
if (isset($_POST['delete'])) {
    $address->deleteData($db_connection);
}
// Grab data from DB based on ID.
$data = $address->singleData($db_connection);

?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php') ?>

<div class="container center">

    <?php if ($data) : ?>

        <h4 style='text-decoration: underline;'><?php echo $data['last_name'] . "'s Address"; ?></h4>
        <p>Full Name: <strong><?php echo $data['first_name'] . ' ' . $data['last_name']; ?></strong></p>
        <p>Address: <strong><?php echo $data['street'] . ', ' . $data['zip_code'] . ', ' . $data['city']; ?></strong></p>
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