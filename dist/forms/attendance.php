<!-- File: attendance.php -->
<?php include 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Attendance Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #0b2447; color: white;">

  <div class="container mt-5">
    <div class="card p-4 shadow-lg" style="border-radius: 20px;">
      <h2 class="text-center mb-4 text-dark">Attendance Form</h2>
      <form action="attendance_insert.php" method="POST">

        <div class="mb-3">
          <label class="form-label">Batch ID</label>
          <input type="number" name="batch_id" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Student ID</label>
          <input type="number" name="student_id" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Date</label>
          <input type="date" name="date" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Status</label>
          <select name="status" class="form-control" required>
            <option value="">Select Status</option>
            <option value="Present">Present</option>
            <option value="Absent">Absent</option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Remarks</label>
          <textarea name="remarks" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary w-100">Submit Attendance</button>
      </form>
    </div>
  </div>

</body>
</html>
