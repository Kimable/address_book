<?php
class Address
{
    public $firstName;
    public $lastName;
    public $email;
    public $street;
    public $zipCode;
    public $city;

    public function __construct($fn = '', $ln = '', $em = '', $st = '', $zp = '', $ct = '')
    {
        $this->firstName = $fn;
        $this->lastName = $ln;
        $this->email = $em;
        $this->street = $st;
        $this->zipCode = $zp;
        $this->city = $ct;
    }


    // Post data to the database
    public function insertDataToDB($db)
    {

        $insert_sql = "INSERT INTO address(first_name,last_name,email,street,zip_code,city) VALUES('$this->firstName', 
                '$this->lastName', '$this->email', '$this->street', '$this->zipCode', '$this->city')";

        if (mysqli_query($db, $insert_sql)) {
            header('Location: index.php');
        } else {
            echo 'Error: ' . mysqli_error($db);
        }
    }

    // Get data List from the database
    public function getDataFromDB($db)
    {
        $query_data = 'SELECT id, first_name, last_name, email, street, zip_code, city FROM address';

        $query_result = mysqli_query($db, $query_data);

        $data = mysqli_fetch_all($query_result, MYSQLI_ASSOC);

        mysqli_free_result($query_result);

        mysqli_close($db);

        $this->generateJSONandXML($data);

        return $data;
    }

    // Get Single Data based on id
    public function singleData($db)
    {
        if (isset($_GET['id'])) {

            $id = mysqli_real_escape_string($db, $_GET['id']);

            $query_sql = "SELECT * FROM address WHERE id=$id";

            $query_result = mysqli_query($db, $query_sql);

            $data = mysqli_fetch_assoc($query_result);

            mysqli_free_result($query_result);
            mysqli_close($db);
        } else {
            echo "You need to supply an ID";
        }
        return $data;
    }

    // Edit data in DB
    public function editData($db)
    {
        $id = $_GET['id'];

        $update_sql = "UPDATE address SET first_name='$this->firstName',last_name='$this->lastName'
            ,email='$this->email',street='$this->street',zip_code='$this->zipCode',city='$this->city' WHERE id = $id";

        if (mysqli_query($db, $update_sql)) {
            header('Location: index.php');
        } else {
            echo 'Error: ' . mysqli_error($db);
        }
    }

    // Delete Data from Database
    public function deleteData($db)
    {
        $id_delete = mysqli_real_escape_string($db, $_POST['id_delete']);

        $delete_query = "DELETE FROM address WHERE id = $id_delete";

        if (mysqli_query($db, $delete_query)) {

            header('Location: index.php');
        } else {
            echo "OOPs something went wrond. Error: " . mysqli_error($db);
        }
    }

    // Helper function to Generate JSON & XML
    public function generateJSONandXML($dataToGenerate)
    {
        // Generate Json File
        $json_file = 'address-list.json';
        $handle = fopen($json_file, 'r+');
        fwrite($handle, json_encode($dataToGenerate));

        // Generate XML File
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<address_list>';

        foreach ($dataToGenerate as $address) {
            $xml .= '<address>';
            $xml .= "<title>" . $address['last_name'] . "'s address" . "</title>";
            $xml .= '<firstName>' . $address['first_name'] . '</firstName>';
            $xml .= '<lastName>' . $address['last_name'] . '</lastName>';
            $xml .= '<email>' . $address['email'] . '</email>';
            $xml .= '<street>' . $address['street'] . '</street>';
            $xml .= '<zipCode>' . $address['zip_code'] . '</zipCode>';
            $xml .= '<city>' . $address['city'] . '</city>';
            $xml .= '</address>';
        }

        $xml .= '</address_list>';

        $xml_handle = fopen('address-list.xml', 'r+');
        fwrite($xml_handle, $xml);
    }
}
