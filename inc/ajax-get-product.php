<?php
    session_start();
    include('./connect.php');

    $sql = 'Select * from monan';
    $run = mysqli_query($conn, $sql);

    $arr = [];

    while ($row = mysqli_fetch_assoc($run)) {
        array_push($arr, $row);
    }

    echo json_encode($arr);