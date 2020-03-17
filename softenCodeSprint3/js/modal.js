$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})
$(document).ready(function() {
  $("#myModal").modal();
});
