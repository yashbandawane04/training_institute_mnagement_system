<?php
if (!defined('INCLUDE_MODE')) {
  include 'connection.php';
  $sql = "SELECT * FROM trainers";
  $result = mysqli_query($conn, $sql);
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Trainer Records</title>
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
  $sql = "SELECT * FROM trainers";
  $result = mysqli_query($conn, $sql);
}
?>

<h4 class="mb-3">Trainer Records</h4>
<table id="trainerTable" class="table table-bordered table-striped">
  <thead class="table-primary text-center">
    <tr>
      <th>ID</th>
      <th>Full Name</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Qualification</th>
      <th>Specialization</th>
      <th>Joining Date</th>
      <th>Status</th>
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
      <th><input type="text" placeholder="Filter" style="width:100%;" /></th>
      <th><input type="text" placeholder="Filter" style="width:100%;" /></th>
      <th><input type="text" placeholder="Filter" style="width:100%;" /></th>
      <th></th>
    </tr>
  </tfoot>

  <tbody class="text-center">
    <?php while($row = mysqli_fetch_assoc($result)) { ?>
      <tr data-id="<?= $row['id'] ?>">
        <td><?= $row['id'] ?></td>
        <td contenteditable="false"><?= $row['full_name'] ?></td>
        <td contenteditable="false"><?= $row['email'] ?></td>
        <td contenteditable="false"><?= $row['phone'] ?></td>
        <td contenteditable="false"><?= $row['qualification'] ?></td>
        <td contenteditable="false"><?= $row['specialization'] ?></td>
        <td contenteditable="false"><?= $row['joining_date'] ?></td>
        <td contenteditable="false"><?= $row['status'] ?></td>
        <td>
          <button class="btn btn-sm btn-primary editBtn">Edit</button>
          <button class="btn btn-sm btn-success saveBtn d-none">Save</button>
          <button class="btn btn-sm btn-danger deleteBtn">Delete</button>

          <a href="../forms/trainers_pdf.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary" target="_blank">
    Download PDF
</a>
          <a href="trainers_graph.php" class="btn btn-primary btn-sm">
    <i class="fas fa-chart-bar"></i> View Graph
</a>




        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>

<?php if (!defined('INCLUDE_MODE')) { ?>
  </div> <!-- container -->

  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

  <script>
    $(document).ready(function () {
      const table = $('#trainerTable').DataTable();

      // Enable column filtering
      $('#trainerTable tfoot input').on('keyup change clear', function () {
        const colIndex = $(this).parent().index();
        table.column(colIndex).search(this.value).draw();
      });

      // Inline edit
      $('.editBtn').on('click', function () {
        const row = $(this).closest('tr');
        row.find('td').not(':first, :last').attr('contenteditable', true).addClass('editable');
        row.find('.editBtn').addClass('d-none');
        row.find('.saveBtn').removeClass('d-none');
      });

      $('.saveBtn').on('click', function () {
        const row = $(this).closest('tr');
        const id = row.data('id');
        const full_name = row.find('td:eq(1)').text().trim();
        const email = row.find('td:eq(2)').text().trim();
        const phone = row.find('td:eq(3)').text().trim();
        const qualification = row.find('td:eq(4)').text().trim();
        const specialization = row.find('td:eq(5)').text().trim();
        const joining_date = row.find('td:eq(6)').text().trim();
        const status = row.find('td:eq(7)').text().trim();

        $.post('update_trainers.php', {
          id,
          full_name,
          email,
          phone,
          qualification,
          specialization,
          joining_date,
          status
        }, function (response) {
          alert(response);
          row.find('td').not(':first, :last').attr('contenteditable', false).removeClass('editable');
          row.find('.editBtn').removeClass('d-none');
          row.find('.saveBtn').addClass('d-none');
        });
      });

      // Delete
      $('.deleteBtn').on('click', function () {
        if (!confirm("Delete this trainer?")) return;
        const row = $(this).closest('tr');
        const id = row.data('id');

        $.post('delete_trainers.php', { id }, function (response) {
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
            "defaultContent": "<a href='trainers_graph.php' class='btn btn-sm btn-primary'><i class='fas fa-chart-bar'></i> Graph</a>"
        }]
    });
});
</script>

  </body>
  </html>
<?php } ?>
