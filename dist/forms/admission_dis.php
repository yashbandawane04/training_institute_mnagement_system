<?php 
if (!defined('INCLUDE_MODE')) {
  include 'connection.php';
  $sql = "SELECT * FROM admission";
  $result = mysqli_query($conn, $sql);
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Admission Records</title>
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
  $sql = "SELECT * FROM admission";
  $result = mysqli_query($conn, $sql);
}
?>

<h4 class="mb-3">Admission Records</h4>
<table id="admissionTable" class="table table-bordered table-striped">
  <thead class="table-primary text-center">
    <tr>
      <th>Student Name</th>
      <th>Father Name</th>
      <th>Mobile</th>
      <th>Email</th>
      <th>Address</th>
      <th>Course</th>
      <th>Admission Date</th>
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
      <th></th>
    </tr>
  </tfoot>

  <tbody class="text-center">
    <?php while($row = mysqli_fetch_assoc($result)) { ?>
      <tr data-mobile="<?= $row['mobile']; ?>">
        <td><?= $row['student_name']; ?></td>
        <td><?= $row['father_name']; ?></td>
        <td><?= $row['mobile']; ?></td>
        <td><?= $row['email']; ?></td>
        <td><?= $row['address']; ?></td>
        <td><?= $row['course']; ?></td>
        <td><?= $row['admission_date']; ?></td>
        <td>
          <button class="btn btn-sm btn-primary editBtn">Edit</button>
          <button class="btn btn-sm btn-success saveBtn d-none">Save</button>
          <button class="btn btn-sm btn-danger deleteBtn">Delete</button>
          <a href="../forms/admission_pdf.php?mobile=<?= urlencode($row['mobile']) ?>" class="btn btn-sm btn-primary" target="_blank">Download PDF</a>
          <a href="admission_graph.php" class="btn btn-sm btn-primary">
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
    const table = $('#admissionTable').DataTable({
      language: {
        emptyTable: "Records not found"
      }
    });

    // Enable column filtering
    $('#admissionTable tfoot input').on('keyup change clear', function () {
      const colIndex = $(this).parent().index();
      table.column(colIndex).search(this.value).draw();
    });

    // Inline edit
    $('.editBtn').on('click', function () {
      const row = $(this).closest('tr');
      row.find('td').not(':last').attr('contenteditable', true).addClass('editable');
      row.find('.editBtn').addClass('d-none');
      row.find('.saveBtn').removeClass('d-none');
    });

    $('.saveBtn').on('click', function () {
      const row = $(this).closest('tr');
      const originalMobile = row.data('mobile');
      const student_name = row.find('td:eq(0)').text().trim();
      const father_name = row.find('td:eq(1)').text().trim();
      const mobile = row.find('td:eq(2)').text().trim();
      const email = row.find('td:eq(3)').text().trim();
      const address = row.find('td:eq(4)').text().trim();
      const course = row.find('td:eq(5)').text().trim();
      const admission_date = row.find('td:eq(6)').text().trim();

      $.post('update_admission.php', {
        originalMobile, student_name, father_name, mobile,
        email, address, course, admission_date
      }, function (response) {
        alert(response);
        row.attr('data-mobile', mobile);
        row.find('td').not(':last').attr('contenteditable', false).removeClass('editable');
        row.find('.editBtn').removeClass('d-none');
        row.find('.saveBtn').addClass('d-none');
      });
    });

    // Delete
    $('.deleteBtn').on('click', function () {
      if (!confirm("Delete this admission record?")) return;
      const row = $(this).closest('tr');
      const mobile = row.data('mobile');

      $.post('delete_admission.php', { mobile }, function (response) {
        alert(response);
        row.remove();
      });
    });
  });
</script>

<script>
$(document).ready(function() {
    $('#yourAdmissionTableID').DataTable({
        "columnDefs": [{
            "targets": -1,  // Last column mein button dalna hai
            "data": null,
            "defaultContent": "<a href='admission_graph.php' class='btn btn-sm btn-primary'><i class='fas fa-chart-bar'></i> Graph</a>"
        }]
    });
});
</script>


</body>
</html>
<?php } ?>
