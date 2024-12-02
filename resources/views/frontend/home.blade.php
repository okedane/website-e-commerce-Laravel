@extends('frontend.layout')

@section('content')
    <div class="container mt-5">
        <div class="card card-hero-primary">
            <img src="{{ asset('frontend/assets/images/lol.png') }}" class="card-img-top" alt="...">
            <div class="card-body text-white card-hero position-absolute text-center">
                <h1 class="card-title card-title-hero">Laptop Hub</h1>
                <p class="card-text">Where Innovation Meets Affordability.</p>
                <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row mt-5">
            <h3 class="text-center mb-4">BERANDA PRODUK</h3>

            @foreach ($category as $item)
                <div class="col-lg-4 mb-5">
                    <div class="card" style="border: none">
                        <img src="{{ Storage::url('uploads/category/' . $item->image) }}"class="card-img-top"
                            style="height: 400px;object-fit: cover;" height="100" alt="...">
                        <div class="card-body">
                            <h4 class="card-title text-center">{{ $item->title }}</h4>
                        </div>
                        <div class="card-body d-block p-0 mx-auto w-75">
                            <a href="{{ route('feProduk', $item->id) }}"
                                class="d-block mb-3 card-link btn btn-primary">Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>

    </div>
@endsection
