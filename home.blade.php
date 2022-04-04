@extends('layouts.app')

@section('content')
    <section class="home-section">
    <div class="container-fluid" style="min-height: calc(100vh - 60px);">
        <div class="row justify-content-between">
            <div class="col px-0">
            @if (Auth::user()->role == 'tamu')
            <div style="position: relative">
                <img src="https://www.hotelgrotta.gr/images/slides/naxos-hotel-grotta-3a.jpg" class="d-block w-100 opacity-50 float-start" alt="...">
                    <div class="content-header opacity-100" style="position: absolute">
                        <div class="container-fluid">
                        <div class="row pb-1 mb-1"style="position: relative">
                            <h2 class="title-mobile text-light mt-4"><b>LuuL Hotel</b></h2>
                            <hr class="mt-3 ms-2 mb-1 bg-light">
                        </div>
                        </div>
                    </div>
                    <div id="carouselExampleControlsNoTouching" class="carousel slide" data-bs-touch="false" data-bs-interval="false">
                        <div class="carousel-inner">
                          <div class="carousel-item active">
                          </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching" data-bs-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Next</span>
                        </button>
                    </div>
            </div>
            @endif
            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'resepsionis')
                <div class="container mt-5 pt-5">
                    <div class="row">
                        <div class="col text-center">
                            <h1 class="display-4"><b>Hai, {{ Auth::user()->username }}!</b></h1>
                            <p class="lead">Selamat datang di WEB <b>Hotel.LuuL</b></p>
                        </div>
                    </div>
                </div>
            @endif
            </div>
        </div>
    </div>
    @include('layouts.footer')
    </section>
@endsection