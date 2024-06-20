<?php
include '../includes/db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item = $_POST['item'];
    $object_class = $_POST['object_class'];
    $image = $_POST['image'];
    $procedures = $_POST['procedures'];
    $description = $_POST['description'];
    $additional = $_POST['additional'];
    $chronological = $_POST['chronological'];
    $reference = $_POST['reference']; // New field for references

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO scp_entries (item, object_class, image, procedures, description, chronological, additional, reference) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameters to the SQL statement
    $stmt->bind_param("ssssssss", $item, $object_class, $image, $procedures, $description, $chronological, $additional, $reference);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        $message = '<div class="alert alert-success" role="alert">New record created successfully</div>';
        
        // Update navigation JSON file
        $nav_items_file = '../includes/nav_items.json';
        if (file_exists($nav_items_file)) {
            $nav_items = json_decode(file_get_contents($nav_items_file), true);
            $nav_items[] = ["name" => $item, "link" => "scp2.php?item=" . urlencode($item)]; // Assuming scp2.php is the detail page
            file_put_contents($nav_items_file, json_encode($nav_items, JSON_PRETTY_PRINT));
        }
    } else {
        $message = '<div class="alert alert-danger" role="alert">Error: ' . $stmt->error . '</div>';
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Create SCP Entry</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Additional Custom Styles */
    .container {
      max-width: 600px;
    }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="#">SCP Foundation</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <?php
      $nav_items_file = '../includes/nav_items.json';
      if (file_exists($nav_items_file)) {
          $nav_items = json_decode(file_get_contents($nav_items_file), true);
          foreach ($nav_items as $nav_item) {
              echo '<li class="nav-item">';
              echo '<a class="nav-link" href="' . htmlspecialchars($nav_item['link']) . '">' . htmlspecialchars($nav_item['name']) . '</a>';
              echo '</li>';
          }
      }
      ?>
      <li class="nav-item">
        <a class="nav-link active" href="index.php">Home</a>
      </li>
    </ul>
  </div>
</nav>

<div class="container my-5">
  <h2 class="mb-4">Create a New SCP Entry</h2>
  
  <?php echo $message; ?> <!-- Display success or error message -->

  <form method="POST" action="">
    <div class="form-group">
      <label for="item">Item</label>
      <input type="text" class="form-control" name="item" id="item" required>
    </div>
    <div class="form-group">
      <label for="object_class">Object Class</label>
      <input type="text" class="form-control" name="object_class" id="object_class" required>
    </div>
    <div class="form-group">
      <label for="image">Image URL</label>
      <input type="text" class="form-control" name="image" id="image">
    </div>
    <div class="form-group">
      <label for="procedures">Special Containment Procedures</label>
      <textarea class="form-control" name="procedures" id="procedures" rows="5" required></textarea>
    </div>
    <div class="form-group">
      <label for="description">Description</label>
      <textarea class="form-control" name="description" id="description" rows="5" required></textarea>
    </div>
    <div class="form-group">
      <label for="chronological">Chronological History</label>
      <textarea class="form-control" name="chronological" id="chronological" rows="5"></textarea>
    </div>
    <div class="form-group">
      <label for="additional">Additional Notes</label>
      <textarea class="form-control" name="additional" id="additional" rows="5"></textarea>
    </div>
    <div class="form-group">
      <label for="reference">References</label>
      <textarea class="form-control" name="reference" id="reference" rows="5"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
  </form>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
