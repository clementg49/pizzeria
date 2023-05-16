$(function () {
  $(".btn-close").on("click", function () {
    $.ajax({
      url: `/supprimer-pizza/${$(this).data('id')}`,
      type: 'POST',
      success: function (data) {
        $('#list-pizza').replaceWith(data);
      },
      error: function () {
        alert('Ajax request failed.');
      }
    });
  });
});

