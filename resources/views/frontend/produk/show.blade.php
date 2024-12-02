@extends('frontend.layout')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card card-blog-single p-3 border-0">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('feProduk', $produk->kategori_id) }}">Produk</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $produk->name }}</li>
                        </ol>
                    </nav>

                    <div class="row align-items-start">
                        <!-- Gambar -->
                        <div class="col-md-4">
                            <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($image as $key => $img)
                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                            <img src="{{ Storage::url('uploads/produk/' . $img->image_path) }}"
                                                 class="d-block w-100"
                                                 alt="{{ $produk->name }}"
                                                 style="height: 300px; object-fit: cover; border-radius: 8px;">
                                        </div>
                                    @endforeach
                                </div>
                                <!-- Kontrol Navigasi -->
                                <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>

                        <!-- Konten -->
                        <div class="col-md-8">
                            <h3>{{ $produk->name }}</h3>
                            <h4>Stok: {{ $produk->stock }}</h4>
                            <p>{!! nl2br(e($produk->decription)) !!}</p>

                            <form action="{{ route('produk.checkout', $produk->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="kategori_id" value="{{ $produk->kategori_id }}">
                                <button type="submit" class="btn btn-primary btn-block mt-4" style="width: 100%; font-size: 1.2rem;">
                                    Checkout <br> Rp.{{ number_format($produk->price, 0, ',', '.') }}
                                </button>
                            </form>

                            {{-- <form action="{{ route('produk.checkout', $produk->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-block mt-4" style="width: 100%; font-size: 1.2rem;">
                                    Checkout <br> Rp.{{ $produk->price }}
                                </button>
                            </form> --}}


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
