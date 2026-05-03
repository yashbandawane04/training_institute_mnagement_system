<?php 
if (!defined('INCLUDE_MODE')) {
  include 'connection.php';
  $sql = "SELECT * FROM admins";
  $result = mysqli_query($conn, $sql);
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Admin Records</title>
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
  $sql = "SELECT * FROM admins";
  $result = mysqli_query($conn, $sql);
}
?>

<h4 class="mb-3">Admin Records</h4>
<table id="adminTable" class="table table-bordered table-striped">
  <thead class="table-primary text-center">
    <tr>
      <th>ID</th>
      <th>Email</th>
      <th>Password Hash</th>
      <th>Role</th>
      <th>Created At</th>
      <th>Username</th>
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
      <th></th>
    </tr>
  </tfoot>

  <tbody class="text-center">
    <?php while($row = mysqli_fetch_assoc($result)) { ?>
      <tr data-id="<?= $row['id'] ?>">
        <td><?= $row['id'] ?></td>
        <td contenteditable="false"><?= $row['email'] ?></td>
        <td contenteditable="false"><?= $row['password_hash'] ?></td>
        <td contenteditable="false"><?= $row['role'] ?></td>
        <td contenteditable="false"><?= $row['created_at'] ?></td>
        <td contenteditable="false"><?= $row['username'] ?></td>
        <td>
          <button class="btn btn-sm btn-primary editBtn">Edit</button>
          <button class="btn btn-sm btn-success saveBtn d-none">Save</button>
          <button class="btn btn-sm btn-danger deleteBtn">Delete</button>

          <a href="../forms/admin_pdf.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary" target="_blank">
    Download PDF
</a>
          <a href="admin_graph.php" target="_blank" class="btn btn-primary btn-sm">
    <i class="fas fa-chart-bar"></i> View Admin Graph
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
      const table = $('#adminTable').DataTable({
        language: {
          emptyTable: "Records not found"
        }
      });

      // Column filters
      $('#adminTable tfoot input').on('keyup change clear', function () {
        const colIndex = $(this).parent().index();
        table.column(colIndex).search(this.value).draw();
      });

      // Inline Edit
      $('.editBtn').on('click', function () {
        const row = $(this).closest('tr');
        row.find('td').not(':first, :last').attr('contenteditable', true).addClass('editable');
        row.find('.editBtn').addClass('d-none');
        row.find('.saveBtn').removeClass('d-none');
      });

      $('.saveBtn').on('click', function () {
        const row = $(this).closest('tr');
        const id = row.data('id');
        const email = row.find('td:eq(1)').text().trim();
        const password_hash = row.find('td:eq(2)').text().trim();
        const role = row.find('td:eq(3)').text().trim();
        const created_at = row.find('td:eq(4)').text().trim();
        const username = row.find('td:eq(5)').text().trim();

        $.post('update_admin.php', {
          id,
          email,
          password_hash,
          role,
          created_at,
          username
        }, function (response) {
          alert(response);
          row.find('td').not(':first, :last').attr('contenteditable', false).removeClass('editable');
          row.find('.editBtn').removeClass('d-none');
          row.find('.saveBtn').addClass('d-none');
        });
      });

      // Delete
      $('.deleteBtn').on('click', function () {
        if (!confirm("Delete this admin?")) return;
        const row = $(this).closest('tr');
        const id = row.data('id');

        $.post('delete_admin.php', { id }, function (response) {
          alert(response);
          row.remove();
        });
      });
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
document.getElementById('showGraph').addEventListener('click', function() {
    fetch('forms/admins_graph.php') // forms folder me graph.php ka path
        .then(response => response.json())
        .then(data => {
            var options = {
                chart: {
                    type: 'bar',
                    height: 350
                },
                series: [{
                    name: 'Total Admins',
                    data: data.totals
                }],
                xaxis: {
                    categories: data.roles
                },
                title: {
                    text: 'Admins by Role',
                    align: 'center'
                },
                colors: ['#008FFB']
            };

            document.getElementById('adminsChart').innerHTML = ""; // clear old chart
            var chart = new ApexCharts(document.querySelector("#adminsChart"), options);
            chart.render();
        });
});
</script>

<script>
$(document).ready(function() {
    $('#yourTableID').DataTable({
        "columnDefs": [{
            "targets": -1, // Last column for action buttons
            "data": null,
            "defaultContent": "<a href='admin_graph.php' class='btn btn-sm btn-primary'><i class='fas fa-chart-bar'></i> Graph</a>"
        }]
    });
});
</script>


  </body>
  </html>
<?php } ?>
