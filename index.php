<?php
require('config/config.php'); // For Database Conection
require('classes/Address.php'); // Address class for CRUD functionalities

$get_data_from_DB = new Address();
$data = $get_data_from_DB->getDataFromDB($db_connection);


?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>

<div class="address-list-container container section">
  <div class="row">
    <table>
      <h3>Address List</h3>
      <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Street</th>
        <th>Zip Code</th>
        <th>City</th>
        <th></th>
      </tr>
      <?php foreach ($data as $item) { ?>

        <tr>
          <td><?php echo htmlspecialchars($item['first_name']); ?></td>
          <td><?php echo htmlspecialchars($item['last_name']); ?></td>
          <td><?php echo htmlspecialchars($item['email']); ?></td>
          <td><?php echo htmlspecialchars($item['street']); ?></td>
          <td><?php echo htmlspecialchars($item['zip_code']); ?></td>
          <td><?php echo htmlspecialchars($item['city']); ?></td>
          <td><a href="detail.php?id=<?php echo $item['id'] ?>">More Info</a></td>
        </tr>

      <?php } ?>
    </table>

    <div class="file section right">
      <a class='btn pink' href="address-list.json" download>Export as JSON</a>
      <a class='btn grey' href="address-list.xml" download>Export as XML</a>
    </div>
  </div>
</div>

<?php include('templates/footer.php') ?>

</html>