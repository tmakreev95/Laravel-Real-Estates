Stripe.setPublishableKey('pk_test_SPAO4fuy3mzWvnV00v3NFmhZ');

var $form = $('#checkout-form');

$form.submit(function(event){
  $('#charge-error').addClass('d-none');
  $form.find('button').prop('disabled', true);
  Stripe.card.createToken({
    number: $('#card-number').val(),
    cvc: $('#cvc').val(),
    exp_month: $('#card-expiry-month').val(),
    exp_year: $('#card-expiry-year').val(),
  }, stripeResponseHandler);
  return false;
});

function stripeResponseHandler(status, response) {
  if(response.error){
    $('#charge-error').removeClass('d-none');
    $('#charge-error').text(response.error.message);
    $form.find('button').prop('disabled', false);
  }
  else{
    var token = response.id;
    $form.append($('<input type="hidden" name="stripeToken" />').val(token));
    $form.get(0).submit();
  }
}
