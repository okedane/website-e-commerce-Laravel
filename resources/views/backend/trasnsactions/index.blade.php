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
                <h1>Laporan Penjualan</h1>
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
                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama User</th>
                                            <th>Produk</th>
                                            <th>Jumlah</th>
                                            <th>Total Harga</th>
                                            <th>Waktu</th>
                                        </tr>
                                        @foreach ($transactions as $transaction)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $transaction->user->name }}</td>
                                            <td>{{ $transaction->produk->name }}</td>
                                            <td>{{ $transaction->quantity }}</td>
                                            <td>Rp.{{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                                            <td>{{ $transaction->created_at }}</td>
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
