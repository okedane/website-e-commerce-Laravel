@extends('layouts.app')

@section('title', 'Wisata')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ $kategori->title }}</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item"><a href="{{ route('beCategory') }}">Category</a></div>
                    <div class="breadcrumb-item"><a>Produk</a></div>
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
                                    <form method="GET" action="{{ route('beProduk.index', $kategori->id) }}">
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
                                    <a href="{{ Route('beProduk.create', $kategori->id) }}" class=" btn btn-primary">Tambah
                                        Produk</a>
                                </div>
                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            <th>No</th>
                                            <th>name</th>
                                            <th>stock</th>
                                            <th>price</th>
                                            <th>Description</th>
                                            <th>Aksi</th>
                                        </tr>
                                        @foreach ($produk as $d)
                                            <tr>

                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $d->name }} </td>
                                                <td>{{ $d->stock }} </td>
                                                <td>{{ $d->price }} </td>
                                                <td>{{ $d->decription }} </td>
                                                <td>
                                                    <div class="d-flex justify-content">
                                                        <a href=""
                                                            class="btn btn-success btn-icon mr-2">
                                                            <i class="fas fa-eye"> Image </i>
                                                        </a>


                                                        <a href="{{ Route('beProduk.edit', $d->id) }}"
                                                            class="btn  btn-info btn-icon">
                                                            <i class="fas fa-edit"> Edit</i>
                                                        </a>

                                                        <form action="{{ Route('beProduk.destroy', $d->id) }}"
                                                            method="POST" class="ml-2"
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
