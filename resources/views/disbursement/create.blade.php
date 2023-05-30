<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <fieldset>
            <legend>CREATE DISBURSEMENT</legend>
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('disbursement.index') }}" class="btn btn-primary">BACK</a>
                    <hr>
                    <form action="{{ route('disbursement.store') }}" method="post" id="checkout">
                        @csrf
                    </form>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="name">Account Name</label>
                                <input type="text" value="{{ old('account_name') }}" class="form-control @error('account_name') is-invalid @enderror" name="account_name" id="account_name"
                                    aria-describedby="helpId" placeholder="Account Name" form="checkout" required>
                                @error('account_name') <small id="helpId" class="form-text text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="name">Account Number</label>
                                <input type="text" value="{{ old('account_number') }}" class="form-control @error('account_number') is-invalid @enderror" name="account_number" id="account_number"
                                    aria-describedby="helpId" placeholder="Account Number" form="checkout" required>
                                @error('account_number') <small id="helpId" class="form-text text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="phone_number">Bank Code</label>
                                <select class="form-control @error('bank_code') is-invalid @enderror" name="bank_code" id="bank_code"
                                    aria-describedby="helpId" placeholder="Bank Code" form="checkout" required>
                                    @foreach ($bank_codes as $bank_code)
                                        <option value="{{ $bank_code['code'] }}">{{ $bank_code['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('bank_code') <small id="helpId" class="form-text text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="country">Amount</label>
                                <input type="text" value="{{ old('amount') }}" class="form-control @error('amount') is-invalid @enderror" name="amount" id="amount"
                                    aria-describedby="helpId" placeholder="Amount" form="checkout" required>
                                @error('amount') <small id="helpId" class="form-text text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="street_line1">Description</label>
                                <input type="text" value="{{ old('description') }}" class="form-control @error('description') is-invalid @enderror" name="description" id="description"
                                    aria-describedby="helpId" placeholder="Description" form="checkout" required>
                                @error('description') <small id="helpId" class="form-text text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                                    aria-describedby="helpId" placeholder="Email" form="checkout" required>
                                @error('email') <small id="helpId" class="form-text text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-block" form="checkout">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>