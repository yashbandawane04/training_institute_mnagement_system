<?php
require 'connection.php'; // DB connection

// Add Expense
if (isset($_POST['add'])) {
    $name = $conn->real_escape_string($_POST['expense_name']);
    $category = $conn->real_escape_string($_POST['category']);
    $quantity = intval($_POST['quantity']);
    $price = floatval($_POST['price']);
    $date = $conn->real_escape_string($_POST['date_of_purchase']);

    $sql = "INSERT INTO expenses (`expenses name`, `category`, `quantity`, `price`, `date of purchase`) 
            VALUES ('$name', '$category', $quantity, $price, '$date')";
    $conn->query($sql);
    header('location: expense_tracker.php');
    exit();
}

// Delete Expense
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM expenses WHERE id=$id");
    header('location: expense_tracker.php');
    exit();
}

// Edit Expense
if (isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $name = $conn->real_escape_string($_POST['expense_name']);
    $category = $conn->real_escape_string($_POST['category']);
    $quantity = intval($_POST['quantity']);
    $price = floatval($_POST['price']);
    $date = $conn->real_escape_string($_POST['date_of_purchase']);

    $sql = "UPDATE expenses SET 
                `expenses name`='$name',
                `category`='$category',
                `quantity`=$quantity,
                `price`=$price,
                `date of purchase`='$date'
            WHERE id=$id";
    $conn->query($sql);
    header('location: expense_tracker.php');
    exit();
}

// Fetch all expenses ordered by date of purchase
$result = $conn->query("SELECT * FROM expenses ORDER BY `date of purchase` DESC");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Expense Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container my-4">
    <h1 class="mb-4">Expense Tracker</h1>

    <!-- Add Expense Form -->
    <form method="post" class="row g-3 mb-4">
        <div class="col-md-3">
            <input type="text" name="expense_name" class="form-control" placeholder="Expense Name" required />
        </div>
        <div class="col-md-3">
            <select name="category" class="form-select" required>
                <option value="">Category</option>
                <option>Trainer Salary</option>
                <option>Equipment</option>
                <option>Furniture</option>
                <option>Stationery & Course Materials</option>
                <option>Maintenance & Repairs</option>
                <option>Utilities</option>
                <option>Marketing & Advertising</option>
                <option>Rent / Lease</option>
                <option>Software Licenses / Subscriptions</option>
                <option>Bills</option>
                <option>Orders</option>
                <option>Shoppings</option>
                <option>Travel & Transport</option>
                <option>Miscellaneous</option>
            </select>
        </div>
        <div class="col-md-2">
            <input type="number" name="quantity" class="form-control" placeholder="Quantity" min="1" required />
        </div>
        <div class="col-md-2">
            <input type="number" step="0.01" min="0" name="price" class="form-control" placeholder="Price" required />
        </div>
        <div class="col-md-2">
            <input type="date" name="date_of_purchase" class="form-control" required />
        </div>
        <div class="col-md-12 d-grid">
            <button type="submit" name="add" class="btn btn-primary">Add</button>
        </div>
    </form>

    <!-- Expenses Table -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Expense Name</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Date of Purchase</th>
                <th>Added On</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['expenses name']) ?></td>
                <td><?= htmlspecialchars($row['category']) ?></td>
                <td><?= $row['quantity'] ?></td>
                <td><?= number_format($row['price'], 2) ?></td>
                <td><?= $row['date of purchase'] ?></td>
                <td><?= $row['added on'] ?></td>
                <td>
                    <a href="expense_tracker.php?edit=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="expense_tracker.php?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this expense?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

<?php
// Edit form display
if (isset($_GET['edit'])) {
    $edit_id = intval($_GET['edit']);
    $edit_result = $conn->query("SELECT * FROM expenses WHERE id=$edit_id LIMIT 1");
    if ($edit_result && $edit_result->num_rows > 0) {
        $edit_row = $edit_result->fetch_assoc();
        ?>
        <hr>
        <h3>Edit Expense ID #<?= $edit_row['id'] ?></h3>
        <form method="post" class="row g-3 mb-4">
            <input type="hidden" name="id" value="<?= $edit_row['id'] ?>" />
            <div class="col-md-3">
                <input type="text" name="expense_name" class="form-control" value="<?= htmlspecialchars($edit_row['expenses name']) ?>" required />
            </div>
            <div class="col-md-3">
                <select name="category" class="form-select" required>
                    <option value="">Category</option>
                    <?php
                    $categories = [
                        "Trainer Salary",
                        "Equipment",
                        "Furniture",
                        "Stationery & Course Materials",
                        "Maintenance & Repairs",
                        "Utilities",
                        "Marketing & Advertising",
                        "Rent / Lease",
                        "Software Licenses / Subscriptions",
                        "Bills",
                        "Orders",
                        "Shoppings",
                        "Travel & Transport",
                        "Miscellaneous"
                    ];
                    foreach ($categories as $cat) {
                        $selected = ($edit_row['category'] == $cat) ? 'selected' : '';
                        echo "<option value=\"$cat\" $selected>$cat</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-2">
                <input type="number" name="quantity" class="form-control" value="<?= htmlspecialchars($edit_row['quantity']) ?>" min="1" required />
            </div>
            <div class="col-md-2">
                <input type="number" step="0.01" min="0" name="price" class="form-control" value="<?= htmlspecialchars($edit_row['price']) ?>" required />
            </div>
            <div class="col-md-2">
                <input type="date" name="date_of_purchase" class="form-control" value="<?= htmlspecialchars($edit_row['date of purchase']) ?>" required />
            </div>
            <div class="col-md-12 d-grid">
                <button type="submit" name="update" class="btn btn-success">Update</button>
            </div>
        </form>
        <?php
    }
}
?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
