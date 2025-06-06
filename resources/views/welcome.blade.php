@extends('layouts.guest')

@section('title', 'Welcome to simpleMRP - Production & Inventory Planning')

@push('styles')
    <style>
        body {
            background-color: #f8f9fa;
        }

        .hero-section {
            background: #ffffff;
            border-radius: 0.5rem;
            padding: 4rem 2rem;
            margin-top: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            font-size: 3rem;
            color: #0d6efd;
        }

        .feature-card {
            transition: transform .2s, box-shadow .2s;
            border: none;
            border-radius: 0.5rem;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            font-weight: 700;
            color: #343a40;
        }

        .cta-section {
            border-radius: 0.5rem;
        }
    </style>
@endpush

@section('content')
    <div class="hero-section text-center">
        <img src="{{ asset('images/logo/simplemrp.png') }}" alt="simpleMRP Logo" class="mb-4" style="max-height: 80px;">
        <h1 class="display-5 fw-bold mb-3">Optimalkan Produksi & Inventaris Anda</h1>
        <p class="lead text-muted mb-4">
            simpleMRP adalah solusi terintegrasi untuk perencanaan kebutuhan material, membantu Anda mengelola inventaris,
            jadwal produksi, dan pesanan secara efisien.
        </p>
        <div>
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-4 me-2">
                <i class="fas fa-sign-in-alt me-2"></i> Login
            </a>
            <a href="{{ route('register') }}" class="btn btn-outline-secondary btn-lg px-4">
                Register
            </a>
        </div>
    </div>

    <div class="container px-4 py-5">
        <h2 class="section-title text-center pb-2 border-bottom mb-5">Fitur Unggulan</h2>

        <div class="row g-4 py-4 row-cols-1 row-cols-lg-3">
            <div class="col d-flex align-items-stretch">
                <div class="feature-card card p-4 text-center">
                    <div class="feature-icon mb-3 mx-auto">
                        <i class="fas fa-boxes-stacked"></i>
                    </div>
                    <h3 class="fs-4">Manajemen Inventaris</h3>
                    <p>Lacak stok bahan baku dan produk jadi secara real-time. Hindari kekurangan atau kelebihan stok dengan
                        data yang akurat.</p>
                </div>
            </div>
            <div class="col d-flex align-items-stretch">
                <div class="feature-card card p-4 text-center">
                    <div class="feature-icon mb-3 mx-auto">
                        <i class="fas fa-cogs"></i>
                    </div>
                    <h3 class="fs-4">Bill of Materials (BOM)</h3>
                    <p>Definisikan struktur produk Anda dengan mudah. Hitung kebutuhan material untuk setiap jadwal produksi
                        secara otomatis.</p>
                </div>
            </div>
            <div class="col d-flex align-items-stretch">
                <div class="feature-card card p-4 text-center">
                    <div class="feature-icon mb-3 mx-auto">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <h3 class="fs-4">Perencanaan Produksi</h3>
                    <p>Buat dan kelola jadwal produksi (Master Production Schedule) untuk memastikan permintaan pelanggan
                        terpenuhi tepat waktu.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white px-4 py-5 my-5 rounded shadow-sm">
        <div class="row align-items-center">
            <div class="col-md-5 text-center">
                <i class="fas fa-chart-line fa-5x text-success"></i>
            </div>
            <div class="col-md-7">
                <h2 class="section-title mb-3">Tingkatkan Efisiensi Bisnis Anda</h2>
                <p class="text-muted">Dengan simpleMRP, Anda mendapatkan alat yang Anda butuhkan untuk membuat keputusan
                    yang lebih baik dan lebih cepat.</p>
                <ul class="list-unstyled">
                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Kurangi biaya penyimpanan
                        inventaris.</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Optimalkan alur kerja produksi
                        Anda.</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Tingkatkan kepuasan pelanggan
                        dengan pengiriman tepat waktu.</li>
                    <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i>Dapatkan laporan akurat untuk
                        analisis mendalam.</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="cta-section text-center bg-primary text-white p-5 my-5">
        <h2 class="display-6 fw-bold mb-3">Siap untuk Memulai?</h2>
        <p class="lead mb-4">Daftar sekarang dan lihat bagaimana simpleMRP dapat mengubah cara Anda mengelola bisnis.</p>
        <a href="{{ route('register') }}" class="btn btn-light btn-lg px-5">
            <i class="fas fa-user-plus me-2"></i> Buat Akun Gratis
        </a>
    </div>

    <footer class="text-center py-4 text-muted">
        <p>&copy; {{ date('Y') }} simpleMRP. All rights reserved.</p>
    </footer>
@endsection
