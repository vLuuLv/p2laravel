@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show ms-2 position-absolute top-0 start-50 translate-middle-x" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if(session()->has('error'))
<div class="alert alert-danger alert-dismissible fade show ms-2 position-absolute top-0 start-50 translate-middle-x" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show ms-2 position-absolute top-0 start-50 translate-middle-x" role="alert">
        {{ $errors->first() }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if(session()->has('loginError'))
  <div class="alert alert-danger alert-dismissible fade show ms-2 position-absolute top-0 start-50 translate-middle-x" role="alert">
    {{ session('loginError') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif
