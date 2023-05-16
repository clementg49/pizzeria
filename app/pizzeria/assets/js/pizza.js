$(function () {
  $('.ingredient-checkbox').on('change', function () {

    let count = 0;
    $('.ingredient-checkbox input:checked').each(function () {
      count = $(this).data('price') + count
    })
    $('#pizza-price').text(count);

  })


})
