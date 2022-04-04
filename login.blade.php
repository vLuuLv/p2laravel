<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    {{-- Custom Css --}}
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="css/login.css" rel="stylesheet">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="{{ asset('js') }}/showPassword.js"></script>
    <link rel="icon" href="{{ url('favicon.png') }}">
    <title>{{ $title }}</title>
</head>

<body>
    <section class="home-section h-sb">
    @include('layouts.alert')
      <div class="container">
        <div class="row">
          <div class="col pt-5">

            <main class="form-signin mt-5">
                <form class="mt-3" action="/login" method="post">
                  @csrf
                  <h1 class="h3 mb-4 fw-normal text-center">Harap Login!</h1>
              
                  <div class="form-floating">
                    <input type="text" name="username" value="{{ old('username') }}" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="LuuL" autofocus required>
                    <label for="username">Username</label>
                    @error('username')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                    @enderror
                  </div>
                  <div class="form-floating">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                    <label for="password">Password</label>
                  </div>
                  <input type="checkbox" class="show-pass" onclick="myFunction()">
                  <span class="text-light">Show Password</span>
                  <button class="w-100 btn btn-lg button btn-light mb-2 mt-3" type="submit">Login</button>
                  <div class="mt-2">
                    <small>Belum pernah daftar? <a href="/register">Daftar Sekarang!</a></small>
                  </div>
                </form>
              </main>
          </div>
        </div>
      </div>
    </section>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="{{ asset('js/alert.js') }}"></script>
</body>

</html>