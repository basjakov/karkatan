<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Karkatan payment</title>
    <style>
        *,
        *::before,
        *::after {
        box-sizing: border-box;
        }

        html,
        body {
        min-height: 100%;
        font-family: "Open Sans", sans-serif;
        }

        body {
        background: linear-gradient(50deg, #f3c680, #a1e3e2);
        }

        /*--------------------
        Buttons
        --------------------*/
        .btn {
        display: block;
        background: #bded7d;
        color: white;
        text-decoration: none;
        margin: 20px 0;
        padding: 15px 15px;
        border-radius: 5px;
        position: relative;
        }
        .btn::after {
        content: "";
        position: absolute;
        z-index: 1;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        transition: all 0.2s ease-in-out;
        box-shadow: inset 0 3px 0 rgba(0, 0, 0, 0), 0 3px 3px rgba(0, 0, 0, 0.2);
        border-radius: 5px;
        }
        .btn:hover::after {
        background: rgba(0, 0, 0, 0.1);
        box-shadow: inset 0 3px 0 rgba(0, 0, 0, 0.2);
        }

        /*--------------------
        Form
        --------------------*/
        .form fieldset {
        border: none;
        padding: 0;
        padding: 10px 0;
        position: relative;
        clear: both;
        }
        .form fieldset.fieldset-expiration {
        float: left;
        width: 60%;
        }
        .form fieldset.fieldset-expiration .select {
        width: 84px;
        margin-right: 12px;
        float: left;
        }
        .form fieldset.fieldset-ccv {
        clear: none;
        float: right;
        width: 86px;
        }
        .form fieldset label {
        display: block;
        text-transform: uppercase;
        font-size: 11px;
        color: rgba(0, 0, 0, 0.6);
        margin-bottom: 5px;
        font-weight: bold;
        font-family: Inconsolata;
        }
        .form fieldset input,
        .form fieldset .select {
        width: 100%;
        height: 38px;
        color: #333333;
        padding: 10px;
        border-radius: 5px;
        font-size: 15px;
        outline: none !important;
        border: 1px solid rgba(0, 0, 0, 0.3);
        box-shadow: inset 0 1px 4px rgba(0, 0, 0, 0.2);
        }
        .form fieldset input.input-cart-number,
        .form fieldset .select.input-cart-number {
        width: 82px;
        display: inline-block;
        }
        .form fieldset input.input-cart-number:last-child,
        .form fieldset .select.input-cart-number:last-child {
        margin-right: 0;
        }
        .form fieldset .select {
        position: relative;
        }
        .form fieldset .select::after {
        content: "";
        border-top: 8px solid #222;
        border-left: 4px solid transparent;
        border-right: 4px solid transparent;
        position: absolute;
        z-index: 2;
        top: 14px;
        right: 10px;
        pointer-events: none;
        }
        .form fieldset .select select {
        -webkit-appearance: none;
            -moz-appearance: none;
                appearance: none;
        position: absolute;
        padding: 0;
        border: none;
        width: 100%;
        outline: none !important;
        top: 6px;
        left: 6px;
        background: none;
        }
        .form fieldset .select select :-moz-focusring {
        color: transparent;
        text-shadow: 0 0 0 #000;
        }
        .form button {
        width: 100%;
        outline: none !important;
        background: linear-gradient(180deg, #49a09b, #3d8291);
        text-transform: uppercase;
        font-weight: bold;
        border: none;
        box-shadow: none;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        margin-top: 90px;
        }
        .form button .fa {
        margin-right: 6px;
        }

        /*--------------------
        Checkout
        --------------------*/
        .checkout {
        margin: 150px auto 30px;
        position: relative;
        width: 460px;
        background: white;
        border-radius: 15px;
        padding: 160px 45px 30px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        /*--------------------
        Credit Card
        --------------------*/
        .credit-card-box {
        perspective: 1000;
        width: 400px;
        height: 280px;
        position: absolute;
        top: -112px;
        left: 50%;
        transform: translateX(-50%);
        }
        .credit-card-box:hover .flip, .credit-card-box.hover .flip {
        transform: rotateY(180deg);
        }
        .credit-card-box .front,
        .credit-card-box .back {
        width: 400px;
        height: 250px;
        border-radius: 15px;
        -webkit-backface-visibility: hidden;
                backface-visibility: hidden;
        background: linear-gradient(135deg, #bd6772, #53223f);
        position: absolute;
        color: #fff;
        font-family: Inconsolata;
        top: 0;
        left: 0;
        text-shadow: 0 1px 1px rgba(0, 0, 0, 0.3);
        box-shadow: 0 1px 6px rgba(0, 0, 0, 0.3);
        }
        .credit-card-box .front::before,
        .credit-card-box .back::before {
        content: "";
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        background: url("http://cdn.flaticon.com/svg/44/44386.svg") no-repeat center;
        background-size: cover;
        opacity: 0.05;
        }
        .credit-card-box .flip {
        transition: 0.6s;
        transform-style: preserve-3d;
        position: relative;
        }
        .credit-card-box .logo {
        position: absolute;
        top: 9px;
        right: 20px;
        width: 60px;
        }
        .credit-card-box .logo svg {
        width: 100%;
        height: auto;
        fill: #fff;
        }
        .credit-card-box .front {
        z-index: 2;
        transform: rotateY(0deg);
        }
        .credit-card-box .back {
        transform: rotateY(180deg);
        }
        .credit-card-box .back .logo {
        top: 185px;
        }
        .credit-card-box .chip {
        position: absolute;
        width: 60px;
        height: 45px;
        top: 20px;
        left: 20px;
        background: linear-gradient(135deg, #ddccf0 0%, #d1e9f5 44%, #f8ece7 100%);
        border-radius: 8px;
        }
        .credit-card-box .chip::before {
        content: "";
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
        border: 4px solid rgba(128, 128, 128, 0.1);
        width: 80%;
        height: 70%;
        border-radius: 5px;
        }
        .credit-card-box .strip {
        background: linear-gradient(135deg, #404040, #1a1a1a);
        position: absolute;
        width: 100%;
        height: 50px;
        top: 30px;
        left: 0;
        }
        .credit-card-box .number {
        position: absolute;
        margin: 0 auto;
        top: 103px;
        left: 19px;
        font-size: 38px;
        }
        .credit-card-box label {
        font-size: 10px;
        letter-spacing: 1px;
        text-shadow: none;
        text-transform: uppercase;
        font-weight: normal;
        opacity: 0.5;
        display: block;
        margin-bottom: 3px;
        }
        .credit-card-box .card-holder,
        .credit-card-box .card-expiration-date {
        position: absolute;
        margin: 0 auto;
        top: 180px;
        left: 19px;
        font-size: 22px;
        text-transform: capitalize;
        }
        .credit-card-box .card-expiration-date {
        text-align: right;
        left: auto;
        right: 20px;
        }
        .credit-card-box .ccv {
        height: 36px;
        background: #fff;
        width: 91%;
        border-radius: 5px;
        top: 110px;
        left: 0;
        right: 0;
        position: absolute;
        margin: 0 auto;
        color: #000;
        text-align: right;
        padding: 10px;
        }
        .credit-card-box .ccv label {
        margin: -25px 0 14px;
        color: #fff;
        }

        .the-most {
        position: fixed;
        z-index: 1;
        bottom: 0;
        left: 0;
        width: 50vw;
        max-width: 200px;
        padding: 10px;
        }
        .the-most img {
        max-width: 100%;
        }
    </style>
</head>
<body>
<div class="checkout">
  <div class="credit-card-box">
    <div class="flip">
      <div class="front">
        <div class="chip"></div>
        <div class="logo">
          <svg version="1.1" id="visa" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
               width="47.834px" height="47.834px" viewBox="0 0 47.834 47.834" style="enable-background:new 0 0 47.834 47.834;">
            <g>
              <g>
               
              </g>
            </g>
          </svg>
        </div>
        <div class="number"></div>
        <div class="card-holder">
          <label>Card holder</label>
          <div></div>
        </div>
        <div class="card-expiration-date">
          <label>Expires</label>
          <div></div>
        </div>
      </div>
      <div class="back">
        <div class="strip"></div>
        <div class="logo">
          <svg version="1.1" id="visa" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
               width="47.834px" height="47.834px" viewBox="0 0 47.834 47.834" style="enable-background:new 0 0 47.834 47.834;">
            <g>
              <g>
                <path d="M44.688,16.814h-3.004c-0.933,0-1.627,0.254-2.037,1.184l-5.773,13.074h4.083c0,0,0.666-1.758,0.817-2.143
                         c0.447,0,4.414,0.006,4.979,0.006c0.116,0.498,0.474,2.137,0.474,2.137h3.607L44.688,16.814z M39.893,26.01
                         c0.32-0.819,1.549-3.987,1.549-3.987c-0.021,0.039,0.317-0.825,0.518-1.362l0.262,1.23c0,0,0.745,3.406,0.901,4.119H39.893z
                         M34.146,26.404c-0.028,2.963-2.684,4.875-6.771,4.875c-1.743-0.018-3.422-0.361-4.332-0.76l0.547-3.193l0.501,0.228
                         c1.277,0.532,2.104,0.747,3.661,0.747c1.117,0,2.313-0.438,2.325-1.393c0.007-0.625-0.501-1.07-2.016-1.77
                         c-1.476-0.683-3.43-1.827-3.405-3.876c0.021-2.773,2.729-4.708,6.571-4.708c1.506,0,2.713,0.31,3.483,0.599l-0.526,3.092
                         l-0.351-0.165c-0.716-0.288-1.638-0.566-2.91-0.546c-1.522,0-2.228,0.634-2.228,1.227c-0.008,0.668,0.824,1.108,2.184,1.77
                         C33.126,23.546,34.163,24.783,34.146,26.404z M0,16.962l0.05-0.286h6.028c0.813,0.031,1.468,0.29,1.694,1.159l1.311,6.304
                         C7.795,20.842,4.691,18.099,0,16.962z M17.581,16.812l-6.123,14.239l-4.114,0.007L3.862,19.161
                         c2.503,1.602,4.635,4.144,5.386,5.914l0.406,1.469l3.808-9.729L17.581,16.812L17.581,16.812z M19.153,16.8h3.89L20.61,31.066
                         h-3.888L19.153,16.8z"/>
              </g>
            </g>
          </svg>

        </div>
        <div class="ccv">
          <label>CCV</label>
          <div></div>
        </div>
      </div>
    </div>
  </div>
  <form class="form" 
        role="form"
        action="{{ route('order.stripe.post',$order->id) }}"
        method="post"
        data-cc-on-file="false"
        data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
        autocomplete="off"
        novalidate 
        class="require-validation"
        id="payment-form">
    @csrf
    <fieldset>
        @if($errors->has('cardnumber'))
            <label class='control-label help-block text-danger'>{{ $errors->first('name') }}</label>
        @endif
      <label for="card-number">Card Number</label>
      <input type="num" id="card-number" class="input-cart-number" maxlength="4" />
      <input type="num" id="card-number-1" class="input-cart-number" maxlength="4" />
      <input type="num" id="card-number-2" class="input-cart-number" maxlength="4" />
      <input type="num" id="card-number-3" class="input-cart-number" maxlength="4" />
      <input type="hidden" class="card_number card-number" name="cardnumber" >
    </fieldset>
    <fieldset>
        @if($errors->has('name'))
            <label class='control-label help-block text-danger'>{{ $errors->first('name') }}</label>
        @endif
      <label for="card-holder">Card holder</label>
      <input type="text" id="card-holder" name="name"/>
    </fieldset>
    <fieldset class="fieldset-expiration">
        @if($errors->has('exp_month'))
            <label class='control-label help-block text-danger'>{{ $errors->first('exp_month') }}</label>
        @endif
      <label for="card-expiration-month">Expiration date</label>
      <div class="select">
        <select id="card-expiration-month" name="exp_month" class="card-expiry-month" >
          <option></option>
          <option>01</option>
          <option>02</option>
          <option>03</option>
          <option>04</option>
          <option>05</option>
          <option>06</option>
          <option>07</option>
          <option>08</option>
          <option>09</option>
          <option>10</option>
          <option>11</option>
          <option>12</option>
        </select>
      </div>
      @if($errors->has('exp_year'))
            <label class='control-label help-block text-danger'>{{ $errors->first('exp_year') }}</label>
        @endif
      <div class="select">
        <select id="card-expiration-year" name="exp_year" class="card-expiry-year">
          <option></option>
          <option>2022</option>
          <option>2023</option>
          <option>2024</option>
          <option>2025</option>
        </select>
      </div>
    </fieldset>
    <fieldset class="fieldset-ccv">
    @if($errors->has('cvc'))
            <label class='control-label help-block text-danger'>{{ $errors->first('cvc') }}</label>
        @endif
      <label for="card-ccv">CCV</label>
      <input type="text" class="card-cvc" id="card-ccv" maxlength="3" name="cvc"/>
    </fieldset>
    <button class="btn"><i class="fa fa-lock"></i> Pay Now</button>
  </form>
</div>
<a class="the-most" target="_blank" href="https://stripe.com/">
  <img src="http://ticemadox.com/wp-content/uploads/2019/03/power-by-stripe_03.png">
</a>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">

    $(".input-cart-number").on("keyup change", function () {
        $t = $(this);

        if ($t.val().length > 3) {
            $t.next().focus();
        }

        var card_number = "";
        $(".input-cart-number").each(function () {
            card_number += $(this).val() + " ";
            if ($(this).val().length == 4) {
            $(this).next().focus();
            }
        });
            
        $(".credit-card-box .number").html(card_number);
        card_number = Parseint(card_number);
       
        $("input[name='cardnumber']").val(card_number);
    });

$("#card-holder").on("keyup change", function () {
  $t = $(this);
  $(".credit-card-box .card-holder div").html($t.val());
});

$("#card-holder").on("keyup change", function () {
  $t = $(this);
  $(".credit-card-box .card-holder div").html($t.val());
});

$("#card-expiration-month, #card-expiration-year").change(function () {
  m = $("#card-expiration-month option").index(
    $("#card-expiration-month option:selected")
  );
  m = m < 10 ? "0" + m : m;
  y = $("#card-expiration-year").val().substr(2, 2);
  $(".card-expiration-date div").html(m + "/" + y);
});

$("#card-ccv")
  .on("focus", function () {
    $(".credit-card-box").addClass("hover");
  })
  .on("blur", function () {
    $(".credit-card-box").removeClass("hover");
  })
  .on("keyup change", function () {
    $(".ccv div").html($(this).val());
  });

/*--------------------
CodePen Tile Preview
--------------------*/
setTimeout(function () {
  $("#card-ccv")
    .focus()
    .delay(1000)
    .queue(function () {
      $(this).blur().dequeue();
    });
}, 500);


</script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
    $(function() {
        var $form = $(".require-validation");
        $('form.require-validation').bind('submit', function(e) {
            var $form = $(".require-validation"),
                inputSelector = ['input[type=email]', 'input[type=password]',
                    'input[type=text]', 'input[type=file]',
                    'textarea'
                ].join(', '),
                $inputs = $form.find('.required').find(inputSelector),
                $errorMessage = $form.find('div.error'),
                valid = true;
            $errorMessage.addClass('hide');
            $('.has-error').removeClass('has-error');
            $inputs.each(function(i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorMessage.removeClass('hide');
                    e.preventDefault();
                }
            });
            if (!$form.data('cc-on-file')) {
                e.preventDefault();
                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                Stripe.createToken({
                    number: $('.card-number').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeResponseHandler);
            }
        });
        function stripeResponseHandler(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('hide')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                /* token contains id, last4, and card type */
                var token = response['id'];
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }
    });
</script>
</body>
</html>
<!-- 
<!DOCTYPE html>
<html>
<head>
    <title>stripe payment gateway integration in php - phpcodingstuff.com</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style type="text/css">
        .panel-title {
            display: inline;
            font-weight: bold;
        }
        .display-table {
            display: table;
        }
        .display-tr {
            display: table-row;
        }
        .display-td {
            display: table-cell;
            vertical-align: middle;
            width: 61%;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>stripe payment gateway integration in php - phpcodingstuff.com</h1>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default credit-card-box">
                <div class="panel-heading display-table" >
                    <div class="row display-tr" >
                        <h3 class="panel-title display-td" >Payment Details</h3>
                        <div class="display-td" >
                            <img class="img-responsive pull-right" src="http://i76.imgup.net/accepted_c22e0.png">
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    @if (Session::has('success'))
                        <div class="alert alert-success text-center">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                            <p>{{ Session::get('success') }}</p>
                        </div>
                    @endif
                    <form
                        role="form"
                        action="{{ route('order.stripe.post',$order->id) }}"
                        method="post"
                        class="require-validation"
                        data-cc-on-file="false"
                        data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                        id="payment-form">
                        @csrf
                        <div class='form-row row'>

                            <div class='col-xs-12 form-group required'>
                                @if($errors->has('name'))
                                    <label class='control-label help-block text-danger'>{{ $errors->first('name') }}</label>
                                @endif
                                <label class='control-label'>Name on Card</label> <input
                                    class='form-control' name="name" size='4' type='text'>
                            </div>
                        </div>
                        <div class='form-row row'>
                            <div class='col-xs-12 form-group card required'>
                                @if($errors->has('cardnumber'))
                                    <label class='control-label help-block text-danger'>{{ $errors->first('cardnumber') }}</label>
                                @endif
                                <label class='control-label'>Card Number</label> <input
                                    autocomplete='off' name="cardnumber" class='form-control card-number' size='20'
                                    type='text'>
                            </div>
                        </div>
                        <div class='form-row row'>
                            <div class='col-xs-12 col-md-4 form-group cvc required'>
                                @if($errors->has('cvc'))
                                    <label class='control-label help-block text-danger'>{{ $errors->first('cvc') }}</label>
                                @endif
                                <label class='control-label'>CVC</label>
                                <input autocomplete='off'
                                       class='form-control card-cvc'
                                       placeholder='ex. 311'
                                       size='4'
                                       name="cvc"
                                       type='text'>
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                @if($errors->has('exp_month'))
                                    <label class='control-label help-block text-danger'>{{ $errors->first('exp_month') }}</label>
                                @endif
                                <label class='control-label'>Expiration Month</label> <input
                                    class='form-control card-expiry-month' placeholder='MM' size='2'
                                    type='text' name="exp_month">
                            </div>
                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                @if($errors->has('exp_year'))
                                    <label class='control-label help-block text-danger'>{{ $errors->first('exp_year') }}</label>
                                @endif
                                <label class='control-label'>Expiration Year</label> <input
                                    class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                    type='text' name="exp_year">
                            </div>
                        </div>
                        <div class='form-row row'>
                            <div class='col-md-12 error form-group hide'>
                                <div class='alert-danger alert'>Please correct the errors and try
                                    again.
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
    $(function() {
        var $form = $(".require-validation");
        $('form.require-validation').bind('submit', function(e) {
            var $form = $(".require-validation"),
                inputSelector = ['input[type=email]', 'input[type=password]',
                    'input[type=text]', 'input[type=file]',
                    'textarea'
                ].join(', '),
                $inputs = $form.find('.required').find(inputSelector),
                $errorMessage = $form.find('div.error'),
                valid = true;
            $errorMessage.addClass('hide');
            $('.has-error').removeClass('has-error');
            $inputs.each(function(i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorMessage.removeClass('hide');
                    e.preventDefault();
                }
            });
            if (!$form.data('cc-on-file')) {
                e.preventDefault();
                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                Stripe.createToken({
                    number: $('.card-number').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeResponseHandler);
            }
        });
        function stripeResponseHandler(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('hide')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                /* token contains id, last4, and card type */
                var token = response['id'];
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }
    });
</script>
</html> -->
