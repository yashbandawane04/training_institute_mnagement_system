<!-- File: admin.php -->
<?php include 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Registration</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #0b2447; color: white;">

  <div class="container mt-5">
    <div class="card p-4 shadow-lg" style="border-radius: 20px;">
      <h2 class="text-center mb-4 text-dark">Admin Registration Form</h2>
      <form action="admin_insert.php" method="POST">

        <div class="mb-3">
          <label class="form-label">Username</label>
          <input type="text" name="username" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Role</label>
          <select name="role" class="form-control" required>
            <option value="">Select Role</option>
            <option value="Admin">Admin</option>
            <option value="Super Admin">Super Admin</option>
            <option value="Staff">Staff</option>
          </select>
        </div>

        <button type="submit" class="btn btn-primary w-100">Register Admin</button>
      </form>
    </div>
  </div>

</body>
</html>
