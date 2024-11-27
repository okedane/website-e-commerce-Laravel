@extends('frontend.layout')

@section('content')
    <div class="container mt-5">
        <div class="card card-hero-primary">
            <img src="{{ Storage::url('uploads/category/' . $kategori->image) }}"" class="card-img-top" alt="...">
            <div class="card-body text-white card-hero position-absolute text-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/" class="text-white">Home</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">{{ $kategori->name }}</li>
                    </ol>
                </nav>
                <h1 class="card-title card-title-hero">{{ $kategori->name }}</h1>
                <p class="card-text"></p>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row mt-5">
            <h3 class="text-center mb-4">{{ $kategori->descriotion }}</h3>

            @foreach ($produks as $item)
                <div class="col-lg-4 mb-5">
                    <div class="card" style="border: none">
                        @if ($item->image->isNotEmpty())
                            {{-- Display the first image --}}
                            <img src="{{ Storage::url('uploads/produk/' . $item->image->first()->image_path) }}"
                                style="height: 400px; object-fit: cover;" class="card-img-top" alt="{{ $item->name }}">
                        @else
                            <img src="{{ asset('frontend/assets/images/default.jpg') }}"
                                style="height: 400px; object-fit: cover;" class="card-img-top" alt="Default Image">
                        @endif
                        <div class="card-body">
                            <h4 class="card-title text-center">{{ $item->name }}</h4>
                        </div>
                        <div class="card-body d-block p-0 mx-auto w-75">
                            <a href="{{ route('feShow', $item->id) }}"
                                class="d-block mb-3 card-link btn btn-primary">Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
