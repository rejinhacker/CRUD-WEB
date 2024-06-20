<?php
include '../includes/db.php';

// Initialize an empty message variable
$message = '';

// Handle deletion if 'item' is set in the URL
if (isset($_GET['delete_item'])) {
    $item_to_delete = $_GET['delete_item'];

    $stmt = $conn->prepare("DELETE FROM scp_entries WHERE item = ?");
    $stmt->bind_param("s", $item_to_delete);

    if ($stmt->execute()) {
        $message = '<div class="alert alert-success" role="alert">SCP entry deleted successfully.</div>';
    } else {
        $message = '<div class="alert alert-danger" role="alert">Error deleting SCP entry: ' . $stmt->error . '</div>';
    }

    $stmt->close();
}

// Fetch all SCP entries from the database
$stmt = $conn->prepare("SELECT item, object_class FROM scp_entries");
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

// Check if there are SCP entries
if ($result->num_rows > 0) {
    // Initialize an empty array to store SCP entries
    $scp_entries = [];

    // Fetch each SCP entry and store in the $scp_entries array
    while ($row = $result->fetch_assoc()) {
        $scp_entries[] = $row;
    }
} else {
    $message .= '<div class="alert alert-info" role="alert">No SCP entries found.</div>';
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All SCP Entries</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Additional Custom Styles */
        .container {
            margin-top: 50px;
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
                <a class="nav-link active" href="view.php">All SCP Records</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <h2 class="my-4">All SCP Entries</h2>

    <?php echo $message; ?> <!-- Display message if any -->

    <?php if (!empty($scp_entries)): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                <tr>
                    <th>Item</th>
                    <th>Object Class</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($scp_entries as $scp): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($scp['item']); ?></td>
                        <td><?php echo htmlspecialchars($scp['object_class']); ?></td>
                        <td>
                            <a href="edit_scp.php?item=<?php echo urlencode($scp['item']); ?>" class="btn btn-info btn-sm">View Details</a>
                            <a href="edit_scp.php?item=<?php echo urlencode($scp['item']); ?>" class="btn btn-primary btn-sm">Edit</a>
                            <a href="view.php?delete_item=<?php echo urlencode($scp['item']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this SCP entry?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
