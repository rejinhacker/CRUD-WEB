<?php
include '../includes/db.php';

$message = '';

if (isset($_POST['item'])) {
    $item = $_POST['item'];

    $stmt = $conn->prepare("DELETE FROM scp_entries WHERE item = ?");
    $stmt->bind_param("s", $item);

    if ($stmt->execute()) {
        $message = '<div class="alert alert-success" role="alert">SCP entry deleted successfully</div>';
    } else {
        $message = '<div class="alert alert-danger" role="alert">Error deleting SCP entry: ' . $stmt->error . '</div>';
    }

    $stmt->close();
    $conn->close();
} else {
    $message = '<div class="alert alert-danger" role="alert">Invalid request</div>';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Delete SCP Entry</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container my-5">
        <h2 class="mb-4">Delete SCP Entry</h2>
        <?php echo $message; ?>
        <a href="index.php" class="btn btn-primary mb-3">Back to Home</a>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
