<!-- File: enquiry.php -->
<?php include 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Enquiry Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #0b2447; color: white;">

  <div class="container mt-5">
    <div class="card p-4 shadow-lg" style="border-radius: 20px;">
      <h2 class="text-center mb-4 text-dark">Enquiry Form</h2>
      <form action="enquiry_insert.php" method="POST" enctype="multipart/form-data">

        <div class="mb-3">
          <label class="form-label">Name</label>
          <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Mobile Number</label>
          <input type="text" name="mob" class="form-control" required>
        </div>

       
        <div class="mb-3">
          <label class="form-label">Address</label>
          <textarea name="address" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label">Email ID</label>
          <input type="email" name="email" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Submit Enquiry</button>
      </form>
    </div>
  </div>

</body>
</html>
