<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>SCP Foundation CRUD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .scp {
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
            margin: 20px;
        }

        .scp h2 {
            color: #333;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .scp h3 {
            color: #555;
            font-size: 18px;
            margin-top: 5px;
        }

        .scp img {
            max-width: 100%;
            border-radius: 8px;
            margin-top: 20px;
            margin-bottom: 15px;
        }

        .scp p {
            font-size: 16px;
            line-height: 1.6;
            color: #333;
        }

        strong {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header>
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
                        <a class="nav-link active" href="scp2.php?item=SCP-002">SCP-002</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="scp3.php?item=SCP-003">SCP-003</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="scp4.php?item=SCP-004">SCP-004</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="scp5.php?item=SCP-005">SCP-005</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="scp6.php?item=SCP-006">SCP-006</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- SCP-002 Content -->
    <div class="container-fluid mt-5">
        <div class="scp">
            <?php
            include '../includes/db.php';

            if (isset($_GET['item'])) {
                $item = $conn->real_escape_string($_GET['item']);
                $result = $conn->query("SELECT * FROM scp_entries WHERE item = '$item'");

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
            ?>
                    <h2><?php echo htmlspecialchars($row['item']); ?></h2>
                    <h3>Object Class: <?php echo htmlspecialchars($row['object_class']); ?></h3>
                    <?php if ($row['image']): ?>
                        <img src="<?php echo htmlspecialchars($row['image']); ?>" class="img-fluid" alt="<?php echo htmlspecialchars($row['item']); ?>">
                    <?php endif; ?>
                    <div class="p-3">
                        <p><strong>Special Containment Procedures:</strong><br><?php echo htmlspecialchars($row['procedures']); ?></p>
                        <p><strong>Description:</strong><br><?php echo htmlspecialchars($row['description']); ?></p>
                        <?php if ($row['reference']): ?>
                            <p><strong>Reference:</strong><br><?php echo htmlspecialchars($row['reference']); ?></p>
                        <?php endif; ?>
                    </div>
                    <!-- Edit and Delete Buttons -->
                    <div class="mt-4">
                        <a href="edit_scp.php?item=<?php echo urlencode($row['item']); ?>" class="btn btn-warning">Edit</a>
                        <form action="delete_scp.php" method="post" class="d-inline">
                            <input type="hidden" name="item" value="<?php echo htmlspecialchars($row['item']); ?>">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this SCP entry?')">Delete</button>
                        </form>
                    </div>
            <?php
                } else {
                    echo "<p>No SCP entry found!</p>";
                }

                $conn->close();
            } else {
                echo "<p>Invalid request!</p>";
            }
            ?>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
