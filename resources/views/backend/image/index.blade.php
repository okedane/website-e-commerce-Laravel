@extends('layouts.app')

@section('title', 'Wisata-gambar')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ $produk->title }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item"><a href="{{ route('beProduk.index', $produk->kategori_id) }}">Produk</a>
                    </div>
                    <div class="breadcrumb-item"><a>Gambar</a></div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                <div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="float-right">
                                    <form method="GET" action="{{ route('beImage.index', $produk->id) }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search" name="search"
                                                value="">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="section-header-button ">
                                    <a href="{{ Route('beImage.create', $produk->id) }}" class=" btn btn-primary">Tambah
                                        Gambar</a>
                                </div>
                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            <th>No</th>
                                            <th>Image</th>
                                            <th>Aksi</th>
                                        </tr>
                                        @foreach ($image as $i)
                                            <tr>

                                                <td>{{ $loop->iteration }}</td>
                                                <td> <img src="{{ Storage::url('uploads/produk/' . $i->image_path) }}"
                                                        alt="{{ $i->title }}" style="width: 100px; height: auto;">
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content">
                                                        <a href="{{ Route('beImage.edit', $i->id) }}"
                                                            class="btn  btn-info btn-icon">
                                                            <i class="fas fa-edit"> Edit</i>
                                                        </a>

                                                        <form action="{{ Route('beImage.destroy', $i->id) }}" method="POST"
                                                            class="ml-2"
                                                            onsubmit="return confirm ('Apakah anda yakin ?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn  btn-danger btn-icon confirm-delete">
                                                                <i class="fas fa-trash"> Hapus</i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                {{-- <div class="float-right">
                                    {{ $desa->withQueryString()->links() }}
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
