<?php 
if (!defined('INCLUDE_MODE')) {
  include 'connection.php';
  $query = "SELECT * FROM attendance";
  $result = mysqli_query($conn, $query);
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Attendance Records</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"/>
    <style>
      .editable {
        border: 1px solid #ccc;
        background-color: #fff8e1;
      }
    </style>
  </head>
  <body>
  <div class="container mt-5">
<?php
} else {
  include 'connection.php';
  $query = "SELECT * FROM attendance";
  $result = mysqli_query($conn, $query);
}
?>

<h4 class="mb-3">Attendance Records</h4>
<table id="attendanceTable" class="table table-bordered table-striped">
  <thead class="table-primary text-center">
    <tr>
      <th>Batch ID</th>
      <th>Student ID</th>
      <th>Date</th>
      <th>Status</th>
      <th>Remarks</th>
      <th>Actions</th>
    </tr>
  </thead>

  <tfoot class="text-center">
    <tr>
      <th><input type="text" placeholder="Filter" style="width:100%;" /></th>
      <th><input type="text" placeholder="Filter" style="width:100%;" /></th>
      <th><input type="text" placeholder="Filter" style="width:100%;" /></th>
      <th><input type="text" placeholder="Filter" style="width:100%;" /></th>
      <th><input type="text" placeholder="Filter" style="width:100%;" /></th>
      <th></th>
    </tr>
  </tfoot>

  <tbody class="text-center">
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
      <tr>
        <td><?= htmlspecialchars($row['batch_id']) ?></td>
        <td><?= htmlspecialchars($row['student_id']) ?></td>
        <td><?= htmlspecialchars($row['date']) ?></td>
        <td><?= htmlspecialchars($row['status']) ?></td>
        <td><?= htmlspecialchars($row['remarks']) ?></td>
        <td>
          <button class="btn btn-sm btn-primary editBtn">Edit</button>
          <button class="btn btn-sm btn-success saveBtn d-none">Save</button>
          <button class="btn btn-sm btn-danger deleteBtn">Delete</button>
          <a href="../forms/attendance_pdf.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary" target="_blank">Download PDF</a>
          <a href="attendance_graph.php" class="btn btn-sm btn-primary">
          <i class="fas fa-chart-bar"></i> View Graph
          </a>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>

<?php if (!defined('INCLUDE_MODE')) { ?>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
  $(document).ready(function () {
    const table = $('#attendanceTable').DataTable({
      language: {
        emptyTable: "Records not found"
      }
    });

    $('#attendanceTable tfoot input').on('keyup change clear', function () {
      const colIndex = $(this).parent().index();
      table.column(colIndex).search(this.value).draw();
    });

    $('.editBtn').on('click', function () {
      const row = $(this).closest('tr');
      row.find('td').not(':last').attr('contenteditable', true).addClass('editable');
      row.find('.editBtn').addClass('d-none');
      row.find('.saveBtn').removeClass('d-none');
    });

    $('.saveBtn').on('click', function () {
      const row = $(this).closest('tr');
      row.find('td').not(':last').attr('contenteditable', false).removeClass('editable');
      row.find('.saveBtn').addClass('d-none');
      row.find('.editBtn').removeClass('d-none');
      alert("Changes saved (functionality pending backend)");
      // NOTE: Add AJAX call to update backend here if needed
    });

    $('.deleteBtn').on('click', function () {
      if (!confirm("Are you sure you want to delete this row?")) return;
      const row = $(this).closest('tr');
      row.remove();
      // NOTE: Add AJAX call to delete from backend if needed
    });
  });
</script>

<script>
$(document).ready(function() {
    $('#yourAttendanceTableID').DataTable({
        "columnDefs": [{
            "targets": -1,  // Last column mein button dalega
            "data": null,
            "defaultContent": "<a href='attendance_graph.php' class='btn btn-sm btn-primary'><i class='fas fa-chart-bar'></i> Graph</a>"
        }]
    });
});
</script>


</body>
</html>
<?php } ?>
