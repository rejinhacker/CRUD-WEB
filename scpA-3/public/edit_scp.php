<?php
include '../includes/db.php';

$message = '';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve POST data
    $item = $_POST['item'];
    $object_class = $_POST['object_class'];
    $image = $_POST['image'];
    $procedures = $_POST['procedures'];
    $description = $_POST['description'];
    $chronological = $_POST['chronological'];
    $additional = $_POST['additional'];

    // Prepare SQL statement to update SCP entry
    $stmt = $conn->prepare("UPDATE scp_entries SET object_class=?, image=?, procedures=?, description=?, chronological=?, additional=? WHERE item=?");

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters to the SQL statement
    $stmt->bind_param("sssssss", $object_class, $image, $procedures, $description, $chronological, $additional, $item);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        $message = '<div class="alert alert-success" role="alert">SCP entry updated successfully</div>';
    } else {
        $message = '<div class="alert alert-danger" role="alert">Error updating SCP entry: ' . $stmt->error . '</div>';
    }

    // Close the statement
    $stmt->close();
}

// Fetch SCP entry details from database
$item = '';
$object_class = '';
$image = '';
$procedures = '';
$description = '';
$chronological = '';
$additional = '';

$stmt = $conn->prepare("SELECT * FROM scp_entries WHERE item = ?");
$stmt->bind_param("s", $_GET['item']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $item = $row['item'];
    $object_class = $row['object_class'];
    $image = $row['image'];
    $procedures = $row['procedures'];
    $description = $row['description'];
    $chronological = $row['chronological'];
    $additional = $row['additional'];
} else {
    $message = '<div class="alert alert-danger" role="alert">SCP entry not found.</div>';
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit SCP Entry</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Additional Custom Styles */
        .container {
            max-width: 800px; /* Adjusted for better readability */
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">SCP Foundation</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="create.php">Create SCP Entry</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="view.php">Read SCP Entries</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container my-5">
    <h2 class="mb-4">Edit SCP Entry: <?php echo htmlspecialchars($item); ?></h2>

    <?php echo $message; ?> <!-- Display success or error message -->

    <form method="POST" action="">
        <input type="hidden" name="item" value="<?php echo htmlspecialchars($item); ?>">
        <div class="form-group">
            <label for="object_class">Object Class</label>
            <input type="text" class="form-control" name="object_class" id="object_class"
                   value="<?php echo htmlspecialchars($object_class); ?>" required>
        </div>
        <div class="form-group">
            <label for="image">Image URL</label>
            <input type="text" class="form-control" name="image" id="image"
                   value="<?php echo htmlspecialchars($image); ?>">
        </div>
        <div class="form-group">
            <label for="procedures">Special Containment Procedures</label>
            <textarea class="form-control" name="procedures" id="procedures" rows="5"
                      required><?php echo htmlspecialchars($procedures); ?></textarea>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" id="description" rows="5"
                      required><?php echo htmlspecialchars($description); ?></textarea>
        </div>
        <div class="form-group">
            <label for="chronological">Chronological History</label>
            <textarea class="form-control" name="chronological" id="chronological" rows="5"
                      ><?php echo htmlspecialchars($chronological); ?></textarea>
        </div>
        <div class="form-group">
            <label for="additional">Additional Notes</label>
            <textarea class="form-control" name="additional" id="additional" rows="5"
                      ><?php echo htmlspecialchars($additional); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
        <a href="delete_scp.php?item=<?php echo urlencode($item); ?>"  class="btn btn-danger"
           onclick="return confirm('Are you sure you want to delete this SCP entry?')">Delete</a>
    </form>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
