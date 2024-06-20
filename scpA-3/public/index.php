<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>SCP Foundation CRUD</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/css/style.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: Arial, sans-serif;
    }
    .jumbotron {
      background-color: #343a40;
      color: #fff;
      padding: 100px 0;
    }
    .section {
      background-color: #fff;
      padding: 60px 0;
    }
    .section h2 {
      font-size: 36px;
      font-weight: bold;
    }
    .section p {
      font-size: 18px;
      line-height: 1.6;
    }
    .section a {
      color: #007bff;
      text-decoration: none;
      font-style: italic;
    }
    .section a:hover {
      text-decoration: underline;
    }
    .crud-section {
      background-color: #e9ecef;
      padding: 40px 20px;
      border-radius: 8px;
      margin-top: 40px;
    }
    .crud-section h1 {
      font-size: 28px;
      font-weight: bold;
      margin-bottom: 20px;
    }
    .footer {
      background-color: #343a40;
      color: #fff;
      padding: 20px 0;
      position: fixed;
      width: 100%;
      bottom: 0;
      text-align: center;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="#">SCP Foundation</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link active" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="scp2.php?item=SCP-002">SCP-002</a>
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
      <li class="nav-item">
        <a class="nav-link" href="create.php">Create SCP Entry</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="view.php">Read SCP Entries</a>
      </li>
    </ul>
  </div>
</nav>

<!-- Landing Page -->
<div class="container-fluid">
  <div class="jumbotron jumbotron-fluid text-center">
    <div class="container">
      <h1 class="display-4">Welcome to SCP Foundation</h1>
      <p class="lead">Special Containment Procedures</p>
    </div>
  </div>

  <!-- Main Content for CRUD Operations -->
  <div class="container my-5">
    <div class="crud-section">
      <h1 class="text-center mb-4">SCP Foundation CRUD Operations</h1>
      <div class="row justify-content-center">
        <div class="col-md-6">
          <ul class="list-group">
            <li class="list-group-item"><a href="create.php">Create SCP Entry</a></li>
            <li class="list-group-item"><a href="view.php">Read SCP Entries</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- SCP Sections -->
  <section id="scp2" class="section">
    <div class="container">
      <h2>SCP-002</h2>
      <p>Description of SCP-002 goes here.... <a href="scp2.php?item=SCP-002">Read more</a></p>
    </div>
  </section>

  <section id="scp3" class="section">
    <div class="container">
      <h2>SCP-003</h2>
      <p>Description of SCP-003 goes here.... <a href="scp3.php?item=SCP-003">Read more</a></p>
    </div>
  </section>

  <section id="scp4" class="section">
    <div class="container">
      <h2>SCP-004</h2>
      <p>Description of SCP-004 goes here.... <a href="scp4.php?item=SCP-004">Read more</a></p>
    </div>
  </section>

  <section id="scp5" class="section">
    <div class="container">
      <h2>SCP-005</h2>
      <p>Description of SCP-005 goes here.... <a href="scp5.php?item=SCP-005">Read more</a></p>
    </div>
  </section>

  <section id="scp6" class="section">
    <div class="container">
      <h2>SCP-006</h2>
      <p>Description of SCP-006 goes here.... <a href="scp6.php?item=SCP-006">Read more</a></p>
    </div>
  </section>
</div>

<!-- Footer -->
<footer class="footer">
  <div class="container">
    <p>&copy; 2024 SCP Foundation. All Rights Reserved.</p>
  </div>
</footer>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Custom Scripts -->
<script src="../assets/js/scripts.js"></script>
</body>
</html>
