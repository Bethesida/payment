<!DOCTYPE html>
<html>

<head>
    <title>Payment Form</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
        crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 class="mt-5">Payment Form</h1>
        <form action="{{ route('payment.validate') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="card_number">Credit Card Number:</label>
                <input type="text" class="form-control" id="card_number" name="card_number">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="expiry_month">Expiry Month:</label>
                    <input type="number" class="form-control" id="expiry_month" name="expiry_month">
                </div>
                <div class="form-group col-md-6">
                    <label for="expiry_year">Expiry Year:</label>
                    <input type="number" class="form-control" id="expiry_year" name="expiry_year">
                </div>
            </div>
            <div class="form-group">
                <label for="cvv">CVV:</label>
                <input type="text" class="form-control" id="cvv" name="cvv">
            </div>
            <button type="submit" class="btn btn-primary">Pay</button>
        </form>
        <div id="result"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1CLKa//V9RHh4PaaLvJDVCveMfwGlwU"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $('form').submit(function(event) {
                event.preventDefault();
                $.post($(this).attr('action'), $(this).serialize(), function(response) {
                    if (response.status == 'success') {
                        $('#result').html('<span style="color:green">&#10004; Payment Successful</span>');
                    } else {
                        $('#result').html('<span style="color:red">&#10060; Payment Failed</span>');
                    }
                });
            });
        });
    </script>
</body>

</html>
