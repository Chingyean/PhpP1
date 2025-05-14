<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <div class="container">
        <h1 class="title">Add New Product</h1>
        <form action="add.php" method="POST">
        <input type="text" name="product_name" required>
        <input type="text" name="product_description" required>
        <input type="number" name="product_price" required>
        <button type="submit" name="add_product">Add Product</button>
        </form>
        <a href="index.php" class="back-link">← Back to Dashboard</a>
    </div>
</body>
</html>
