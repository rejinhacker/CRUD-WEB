<?php
include '../includes/db.php';

if (isset($_POST['item'])) {
    $item = $conn->real_escape_string($_POST['item']);
    $object = $conn->real_escape_string($_POST['object']);
    $image = $conn->real_escape_string($_POST['image']);
    $procedures = $conn->real_escape_string($_POST['procedures']);
    $description = $conn->real_escape_string($_POST['description']);
    $reference = $conn->real_escape_string($_POST['reference']);

    $sql = "UPDATE scp_entries SET 
            object = '$object', 
            image = '$image', 
            procedures = '$procedures', 
            description = '$description', 
            reference = '$reference' 
            WHERE item = '$item'";

    if ($conn->query($sql) === TRUE) {
        header("Location: scp2.php?item=$item");
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    echo "Invalid request!";
}

$conn->close();
?>
