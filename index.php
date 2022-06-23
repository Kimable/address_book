<?php
   require('config/config.php');

   $query_data = 'SELECT id, first_name, last_name, email, street, zip_code, city FROM address';

   $query_result = mysqli_query($db_connection, $query_data);
  
    //  Converting data into associative array
    $data = mysqli_fetch_all($query_result, MYSQLI_ASSOC);

    // Free result from memory
    mysqli_free_result($query_result);

    // Close db connection
    mysqli_close($db_connection);

    //echo json_encode($data)

    // Export Json File
    $json_file = 'address-list.json';
    $handle = fopen($json_file, 'r+'); 
    fwrite($handle, json_encode($data));

    // Export XML
    $xml ='<?xml version="1.0" encoding="UTF-8"?>';
    $xml .= '<address_list>';

    foreach($data as $address){
      $xml .= '<address>';
      $xml .= "<title>".$address['last_name']."'s address". "</title>";
      $xml .= '<firstName>' .$address['first_name']. '</firstName>';
      $xml .= '<lastName>' .$address['last_name']. '</lastName>';
      $xml .= '<email>' .$address['email']. '</email>';
      $xml .= '<street>' .$address['street']. '</street>';
      $xml .= '<zipCode>' .$address['zip_code']. '</zipCode>';
      $xml .= '<city>' .$address['city']. '</city>';
      $xml .= '</address>';
    }

    $xml .= '</address_list>';

    $xml_handle = fopen('address-list.xml', 'r+');
    fwrite($xml_handle, $xml);
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
        <?php foreach($data as $item) { ?>

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