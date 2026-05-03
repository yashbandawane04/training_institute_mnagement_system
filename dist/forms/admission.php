<!-- File: admission.php -->
<?php include 'connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admission Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #0b2447; color: white;">

<div class="container mt-5">
    <div class="card p-4 shadow-lg" style="border-radius: 20px;">
        <h2 class="text-center mb-4 text-dark">Admission Form</h2>
        <form action="admission_insert.php" method="POST">

            <div class="mb-3">
                <label class="form-label">Student ID</label>
                <input type="number" name="student_id" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Course ID</label>
                <input type="number" name="course_id" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Admission Date</label>
                <input type="date" name="admission_date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-control" required>
                    <option value="" disabled selected>Select Status</option>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100">Submit Admission</button>
        </form>
    </div>
</div>

</body>
</html>
