<?php
include 'connection.php';
$sql = "SELECT * FROM payments";
$result = mysqli_query($conn, $sql);

if (!defined('INCLUDE_MODE')) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Payment Records</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
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
<?php } ?>

<h2 class="text-center mb-4">Payment Records</h2>
<table id="paymentTable" class="table table-bordered table-striped">
  <thead class="table-primary text-center">
    <tr>
      <th>ID</th>
      <th>Amount Paid</th>
      <th>Total Fees</th>
      <th>Due Amount</th>
      <th>Payment Method</th>
      <th>Payment Date</th>
      <th>Transaction ID</th>
      <th>Student ID</th>
      <th>Amount</th>
      <th>Actions</th>
    </tr>
  </thead>

  <tfoot class="text-center">
    <tr>
      <th><input type="text" placeholder="Filter" style="width:100%;"></th>
      <th><input type="text" placeholder="Filter" style="width:100%;"></th>
      <th><input type="text" placeholder="Filter" style="width:100%;"></th>
      <th><input type="text" placeholder="Filter" style="width:100%;"></th>
      <th><input type="text" placeholder="Filter" style="width:100%;"></th>
      <th><input type="text" placeholder="Filter" style="width:100%;"></th>
      <th><input type="text" placeholder="Filter" style="width:100%;"></th>
      <th><input type="text" placeholder="Filter" style="width:100%;"></th>
      <th><input type="text" placeholder="Filter" style="width:100%;"></th>
      <th></th>
    </tr>
  </tfoot>

  <tbody class="text-center">
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr data-id="<?= $row['id'] ?>">
      <td><?= $row['id'] ?></td>
      <td contenteditable="false"><?= $row['amount_paid'] ?></td>
      <td contenteditable="false"><?= $row['total_fees'] ?></td>
      <td contenteditable="false"><?= $row['due_amount'] ?></td>
      <td contenteditable="false"><?= $row['payment_method'] ?></td>
      <td contenteditable="false"><?= $row['payment_date'] ?></td>
      <td contenteditable="false"><?= $row['transaction_id'] ?></td>
      <td contenteditable="false"><?= $row['student_id'] ?></td>
      <td contenteditable="false"><?= $row['amount'] ?></td>
      <td>
        <button class="btn btn-sm btn-primary editBtn">Edit</button>
        <button class="btn btn-sm btn-success saveBtn d-none">Save</button>
        <button class="btn btn-sm btn-danger deleteBtn">Delete</button>
        <a href="../forms/payments_pdf.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary" target="_blank">Download PDF</a>
        <a href="payment_graph.php" class="btn btn-sm btn-primary">
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
    const table = $('#paymentTable').DataTable({
      language: {
        emptyTable: "Records not found"
      }
    });

    $('#paymentTable tfoot input').on('keyup change clear', function () {
      const colIndex = $(this).parent().index();
      table.column(colIndex).search(this.value).draw();
    });

    $('.editBtn').on('click', function () {
      const row = $(this).closest('tr');
      row.find('td').not(':first, :last').attr('contenteditable', true).addClass('editable');
      row.find('.editBtn').addClass('d-none');
      row.find('.saveBtn').removeClass('d-none');
    });

    $('.saveBtn').on('click', function () {
      const row = $(this).closest('tr');
      const id = row.data('id');
      const amount_paid = row.find('td:eq(1)').text().trim();
      const total_fees = row.find('td:eq(2)').text().trim();
      const due_amount = row.find('td:eq(3)').text().trim();
      const payment_method = row.find('td:eq(4)').text().trim();
      const payment_date = row.find('td:eq(5)').text().trim();
      const transaction_id = row.find('td:eq(6)').text().trim();
      const student_id = row.find('td:eq(7)').text().trim();
      const amount = row.find('td:eq(8)').text().trim();

      $.post('update_payments.php', {
        id, amount_paid, total_fees, due_amount,
        payment_method, payment_date, transaction_id,
        student_id, amount
      }, function (response) {
        alert(response);
        row.find('td').not(':first, :last').attr('contenteditable', false).removeClass('editable');
        row.find('.editBtn').removeClass('d-none');
        row.find('.saveBtn').addClass('d-none');
      });
    });

    $('.deleteBtn').on('click', function () {
      if (!confirm("Delete this payment record?")) return;
      const row = $(this).closest('tr');
      const id = row.data('id');

      $.post('delete_payments.php', { id }, function (response) {
        alert(response);
        row.remove();
      });
    });
  });
</script>

</body>
</html>
<?php } ?>
