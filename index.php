<?php
require 'db.php';

// Handle Add Product
if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST['action'] === 'add') {
    $name = htmlspecialchars($_POST['name']);
    $price = $_POST['price'];
    $description = htmlspecialchars($_POST['description']);
    
    // Check for errors
    if (empty($name) || empty($price)) {
        $error = "Name and price are required.";
    } else {
        $stmt = $conn->prepare("INSERT INTO products (name, price, description) VALUES (?, ?, ?)");
        $stmt->bind_param("sds", $name, $price, $description);
        $stmt->execute();
        header("Location: index.php");
        exit();
    }
}

// Handle Edit Product
if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST['action'] === 'edit') {
    $id = $_POST['id'];
    $name = htmlspecialchars($_POST['name']);
    $price = $_POST['price'];
    $description = htmlspecialchars($_POST['description']);
    
    // Check for errors
    if (empty($name) || empty($price)) {
        $error = "Name and price are required.";
    } else {
        $stmt = $conn->prepare("UPDATE products SET name=?, price=?, description=? WHERE id=?");
        $stmt->bind_param("sdsi", $name, $price, $description, $id);
        $stmt->execute();
        header("Location: index.php");
        exit();
    }
}

// Handle Delete Product
if ($_SERVER["REQUEST_METHOD"] === "POST" && $_POST['action'] === 'delete') {
    $id = $_POST['id'];
    $conn->query("DELETE FROM products WHERE id=$id");
    header("Location: index.php");
    exit();
}

$result = $conn->query("SELECT * FROM products ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Dashboard & About</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap + jQuery -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<!-- Header Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">PHP Product App</a>
        <div class="ml-auto">
            <a href="#dashboard" class="nav-link text-white d-inline-block">Dashboard</a>
            <a href="#about" class="nav-link text-white d-inline-block">About</a>
        </div>
    </div>
</nav>

<!-- Dashboard -->
<section id="dashboard" class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="section-title">Product Dashboard</h2>
        <button class="btn btn-success" data-toggle="modal" data-target="#addModal">+ Add Product</button>
    </div>


<!-- Add -->
<div class="modal fade" id="addModal">
  <div class="modal-dialog">
    <form method="post">
      <div class="modal-content">
        <div class="modal-header"><h5>Add Product</h5></div>
        <div class="modal-body">
          <input type="hidden" name="action" value="add">
          <input name="name" class="form-control mb-2" placeholder="Name" required>
          <input name="price" type="number" step="0.01" class="form-control mb-2" placeholder="Price" required>
          <textarea name="description" class="form-control mb-2" placeholder="Description"></textarea>
        </div>
        <div class="modal-footer">
          <button class="btn btn-success" type="submit">Add</button>
          <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Edit -->
<div class="modal fade" id="editModal">
  <div class="modal-dialog">
    <form method="post">
      <div class="modal-content">
        <div class="modal-header"><h5>Edit Product</h5></div>
        <div class="modal-body">
          <input type="hidden" name="action" value="edit">
          <input type="hidden" name="id" id="edit-id">
          <input name="name" id="edit-name" class="form-control mb-2" required>
          <input name="price" id="edit-price" type="number" step="0.01" class="form-control mb-2" required>
          <textarea name="description" id="edit-description" class="form-control mb-2"></textarea>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary" type="submit">Update</button>
          <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Delete-->
<div class="modal fade" id="deleteModal">
  <div class="modal-dialog">
    <form method="post">
      <div class="modal-content">
        <div class="modal-header"><h5>Delete Product</h5></div>
        <div class="modal-body">
          Are you sure you want to delete this product?
          <input type="hidden" name="action" value="delete">
          <input type="hidden" name="id" id="delete-id">
        </div>
        <div class="modal-footer">
          <button class="btn btn-danger" type="submit">Delete</button>
          <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- About-->
<section id="about" class="container mt-5">
    <div class="about-container shadow-sm bg-white p-4 rounded">
        <h2 class="section-title">About This Project</h2>
        <p>This is a PHP CRUD project to manage product data using MySQL. It demonstrates basic Create, Read, Update, and Delete operations along with modal-based UI using Bootstrap.</p>
        <p>Developed by <strong>Thri Ching Yean – A4</strong>.</p>
    </div>
</section>

<script>
$('#editModal').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget)
    $('#edit-id').val(button.data('id'))
    $('#edit-name').val(button.data('name'))
    $('#edit-price').val(button.data('price'))
    $('#edit-description').val(button.data('description'))
})

$('#deleteModal').on('show.bs.modal', function (event) {
    const button = $(event.relatedTarget)
    $('#delete-id').val(button.data('id'))
})
</script>

</body>
</html>
