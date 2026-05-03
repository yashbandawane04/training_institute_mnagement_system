<?php
include 'connection.php';
$sql = "SELECT * FROM enquiry";
$result = mysqli_query($conn, $sql);
?>

<?php if (!defined('INCLUDE_MODE')): ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Enquiry Records</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"/>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"/>
  <style>
    .editable {
      background-color: #ffffcc;
    }
  </style>
</head>
<body>
<div class="container mt-5">
  <h2 class="text-center mb-4">Enquiry Records</h2>
<?php endif; ?>

  <table id="enquiryTable" class="table table-bordered table-striped">
    <thead class="table-primary text-center">
      <tr>
        <th>Name</th>
        <th>Mobile No</th>
        <th>Address</th>
        <th>Email</th>
        <th>Actions</th>
      </tr>
    </thead>

    <tfoot class="text-center">
      <tr>
        <th><input type="text" placeholder="Filter" style="width:100%;" /></th>
        <th><input type="text" placeholder="Filter" style="width:100%;" /></th>
        <th><input type="text" placeholder="Filter" style="width:100%;" /></th>
        <th><input type="text" placeholder="Filter" style="width:100%;" /></th>
        <th></th>
      </tr>
    </tfoot>

    <tbody class="text-center">
      <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr data-mobno="<?= $row['mobno']; ?>">
          <td><?= $row['name']; ?></td>
          <td><?= $row['mobno']; ?></td>
          <td><?= $row['address']; ?></td>
          <td><?= $row['email']; ?></td>
          <td>
            <a href="#" class="btn btn-primary btn-sm editBtn">Edit</a>
            <a href="#" class="btn btn-success btn-sm saveBtn d-none">Save</a>
            <a href="#" class="btn btn-danger btn-sm deleteBtn">Delete</a>
            <a href="../forms/enquiry_pdf.php?mobno=<?= $row['mobno']; ?>" class="btn btn-sm btn-secondary">Download PDF</a>
            <a href="enquiry_graph.php" class="btn btn-primary btn-sm">
            <i class="fas fa-chart-bar"></i> View Enquiry Graph
            </a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

<?php if (!defined('INCLUDE_MODE')): ?>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<?php endif; ?>

<script>
  $(document).ready(function () {
    const table = $('#enquiryTable').DataTable();

    // Column filter
    $('#enquiryTable tfoot input').on('keyup change clear', function () {
      const colIndex = $(this).parent().index();
      table.column(colIndex).search(this.value).draw();
    });

    // Edit
    $('.editBtn').on('click', function () {
      const row = $(this).closest('tr');
      row.find('td').not(':last').attr('contenteditable', true).addClass('editable');
      row.find('.editBtn').addClass('d-none');
      row.find('.saveBtn').removeClass('d-none');
    });

    // Save
    $('.saveBtn').on('click', function () {
      const row = $(this).closest('tr');
      const originalMob = row.data('mobno');
      const name = row.find('td:eq(0)').text().trim();
      const mobno = row.find('td:eq(1)').text().trim();
      const address = row.find('td:eq(2)').text().trim();
      const email = row.find('td:eq(3)').text().trim();

      $.post('update_enquiry.php', {
        originalMob, name, mobno, address, email
      }, function (response) {
        alert(response);
        row.attr('data-mobno', mobno);
        row.find('td').not(':last').attr('contenteditable', false).removeClass('editable');
        row.find('.editBtn').removeClass('d-none');
        row.find('.saveBtn').addClass('d-none');
      });
    });

    // Delete
    $('.deleteBtn').on('click', function () {
      if (!confirm("Are you sure you want to delete this enquiry?")) return;
      const row = $(this).closest('tr');
      const mobno = row.data('mobno');

      $.post('delete_enquiry.php', { mobno }, function (response) {
        alert(response);
        row.remove();
      });
    });
  });
</script>

<script>
$(document).ready(function() {
    $('#yourTableID').DataTable({
        "columnDefs": [{
            "targets": -1, // Last column for action buttons
            "data": null,
            "defaultContent": "<a href='enquiry_graph.php' class='btn btn-sm btn-primary'><i class='fas fa-chart-bar'></i> Graph</a>"
        }]
    });
});
</script>



<?php if (!defined('INCLUDE_MODE')): ?>
</body>
</html>
<?php endif; ?>
