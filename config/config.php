<?php

    $db_connection = mysqli_connect('localhost', 'root', '','address_book');

    if(!$db_connection){
        echo 'Connection Error: ' . mysqli_connect_error();
    }