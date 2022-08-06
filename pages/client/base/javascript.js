$('#calculate').click(function () {
  calculate()
})

function calculate() {
  if ($('[name="loan_term"]').val() == '' || $('[name="amount"]').val() == '') {
    Swal.fire({
      icon: 'error',
      title: 'Oops ...',
      text: 'Enter amount and loan term to calculate the value.'
    })
    return false;
  }
  $.ajax({
    url: "base/calculation_table.php",
    method: "POST",
    data: {
      amount: $('[name="amount"]').val(),
      months: $('[name="loan_term"]').val(),
      membership: $('[name="membership"]').val()
    },
    success: function (resp) {
      $('#calculation_table').html(resp)
    }
  })
}

$(document).ready(function () {
  $(".viewloan").click(function () {
    $('#borrower_name').val($(this).data('borrower_name'));
    $('#ref_no').val($(this).data('ref_no'));
    $('#loan_amount').val($(this).data('loan_amount'));
    $('#loan_terms').val($(this).data('loan_terms'));
    $('#loan_type').val($(this).data('loan_type'));
    $('#loan_date').val($(this).data('loan_date'));
    $('#purpose').val($(this).data('purpose'));
    $('#comaker_name').val($(this).data('comaker_name'));
    $('#status_comaker').val($(this).data('status_comaker'));
    $('#status_processor').val($(this).data('status_processor'));
    $('#status_manager').val($(this).data('status_manager'));
    $('#status_cashier').val($(this).data('status_cashier'));
    $('#comaker_date').val($(this).data('comaker_date'));
    $('#processor_date').val($(this).data('processor_date'));
    $('#manager_date').val($(this).data('manager_date'));
    $('#cashier_date').val($(this).data('cashier_date'));

    $('#viewloan').modal('show');
  });
});

$(document).ready(function () {
  $("#close_modal").click(function () {
    $('#view_loan_amount').val('');
    $('#view_loan_months').val('');
    $('#view_loan_type').val('');
    $('#view_loan_purpose').val('');
    $('#view_loan_comaker').prop('selectedIndex', 0);
    $('#addloan').modal('hide');
  });
});


function approve() {
  Swal.fire({
    title: 'Confirm Approve?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Approve'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = "../../config/update-status.php?approveref_no=<?php echo $row['status_ref']; ?>"
    }
  })
}

function disapprove() {
  Swal.fire({
    title: 'Confirm Disapprove?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Disapprove'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location.href = "../../config/update-status.php?denyref_no=<?php echo $row['status_ref']; ?>"
    }
  })
}
