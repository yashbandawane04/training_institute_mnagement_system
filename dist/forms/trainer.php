<!-- File: trainer.php -->
<?php include 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Trainer Registration</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #0b2447; color: white;">

  <div class="container mt-5">
    <div class="card p-4 shadow-lg" style="border-radius: 20px;">
      <h2 class="text-center mb-4 text-dark">Trainer Registration Form</h2>
      <form action="trainer_insert.php" method="POST">

        <div class="mb-3">
          <label class="form-label">Full Name</label>
          <input type="text" name="full_name" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Phone</label>
          <input type="text" name="phone" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Qualification</label>
          <input type="text" name="qualification" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Specialization</label>
          <input type="text" name="specialization" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Joining Date</label>
          <input type="date" name="joining_date" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Status</label>
          <select name="status" class="form-control" required>
            <option value="">Select Status</option>
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
          </select>
        </div>

        <button type="submit" class="btn btn-primary w-100">Register Trainer</button>
      </form>
    </div>
  </div>

</body>
</html>
