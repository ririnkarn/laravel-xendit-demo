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
            <legend>CREATE ORDER</legend>
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('order.index') }}" class="btn btn-primary">BACK</a>
                    <hr>
                    
                    <div class="text-center my-3">
                        <p>
                            IDR {{ number_format($price, '0', ',', '.') }}
                        </p>
                    </div>
                    <form action="{{ route('order.store') }}" method="post" id="checkout">
                        @csrf
                    </form>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="name">First Name</label>
                                <input type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
                                    aria-describedby="helpId" placeholder="First name" form="checkout" required>
                                @error('name') <small id="helpId" class="form-text text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
                                    aria-describedby="helpId" placeholder="Email Address" form="checkout" required>
                                @error('email') <small id="helpId" class="form-text text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="phone_number">WhatsApp Number</label>
                                <input type="text" value="{{ old('phone_number') }}" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" id="phone_number"
                                    aria-describedby="helpId" placeholder="WhatsApp Number" form="checkout" required>
                                @error('phone_number') <small id="helpId" class="form-text text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="country">Provinsi</label>
                                <input type="text" value="{{ old('country') }}" class="form-control @error('country') is-invalid @enderror" name="country" id="country"
                                    aria-describedby="helpId" placeholder="Provinsi" form="checkout" required>
                                @error('country') <small id="helpId" class="form-text text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="state">Kabupaten</label>
                                <input type="text" value="{{ old('state') }}" class="form-control @error('state') is-invalid @enderror" name="state" id="state"
                                    aria-describedby="helpId" placeholder="Kabupaten" form="checkout" required>
                                @error('state') <small id="helpId" class="form-text text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="city">Kelurahan</label>
                                <input type="text" value="{{ old('city') }}" class="form-control @error('city') is-invalid @enderror" name="city" id="city"
                                    aria-describedby="helpId" placeholder="Kelurahan" form="checkout" required>
                                @error('city') <small id="helpId" class="form-text text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="postal_code">Postal Code</label>
                                <input type="text" value="{{ old('postal_code') }}" class="form-control @error('postal_code') is-invalid @enderror" name="postal_code" id="postal_code"
                                    aria-describedby="helpId" placeholder="Postal Code" form="checkout" required>
                                @error('postal_code') <small id="helpId" class="form-text text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label for="street_line1">Home Address</label>
                                <input type="text" value="{{ old('street_line1') }}" class="form-control @error('street_line1') is-invalid @enderror" name="street_line1" id="street_line1"
                                    aria-describedby="helpId" placeholder="Home Address" form="checkout" required>
                                @error('street_line1') <small id="helpId" class="form-text text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-block" form="checkout">Checkout</button>
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