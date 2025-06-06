@extends('layouts.app')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-3 col-6">
            <x-adminlte-info-box title="Sales Order Baru" text="{{ $newSOCount }}" icon="fas fa-lg fa-handshake"
                theme="gradient-primary" url="{{ route('SalesMstrs.index') }}" url-text="Lihat Detail"
                text-class="h2 font-weight-bold" />
        </div>
        <div class="col-lg-3 col-6">
            <x-adminlte-info-box title="Rekomendasi Pembelian" text="{{ $newMRCount }}"
                icon="fas fa-lg fa-file-invoice-dollar" theme="gradient-success" url="{{ route('MrpMstrs.index') }}"
                url-text="Proses MRP" text-class="h2 font-weight-bold" />
        </div>
        <div class="col-lg-3 col-6">
            <x-adminlte-info-box title="Stok Kritis" text="{{ $lowStockCount }}" icon="fas fa-lg fa-exclamation-triangle"
                theme="gradient-warning" url="{{ route('InDets.index') }}" url-text="Lihat Laporan Stok"
                text-class="h2 font-weight-bold" />
        </div>
        <div class="col-lg-3 col-6">
            <x-adminlte-info-box title="PO Outstanding" text="{{ $outstandingPOCount }}" icon="fas fa-lg fa-truck"
                theme="gradient-danger" url="{{ route('PoMstrs.index') }}" url-text="Lihat Detail PO"
                text-class="h2 font-weight-bold" />
        </div>
    </div>

    <div class="row">
        <div class="col-md-7">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-chart-line"></i> Tren Sales Order (7 Hari Terakhir)</h3>
                </div>
                <div class="card-body">
                    <div style="height: 300px;">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-chart-pie"></i> Komposisi Inventaris</h3>
                </div>
                <div class="card-body">
                    <div style="height: 300px;">
                        <canvas id="inventoryChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-danger">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-tasks"></i> Tugas & Notifikasi Penting</h3>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ route('MrpMstrs.index') }}">Rekomendasi Pembelian (MR) baru</a>
                            <span class="badge bg-danger rounded-pill">{{ $newMRCount }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ route('SalesMstrs.index') }}">Sales Order perlu diproses</a>
                            <span class="badge bg-primary rounded-pill">{{ $unprocessedSOCount }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ route('ItemMstrs.index') }}">Item di bawah stok minimum</a>
                            <span class="badge bg-warning rounded-pill">{{ $lowStockCount }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-rocket"></i> Akses Cepat</h3>
                </div>
                <div class="card-body text-center">

                    @can('sales.salesmstr.read')
                        <a href="{{ route('SalesMstrs.index') }}" class="btn btn-app bg-primary"><i
                                class="fas fa-handshake"></i> Buat SO</a>
                    @endcan
                    @can('purchase.purchasemstr.read')
                        <a href="{{ route('PoMstrs.index') }}" class="btn btn-app bg-danger"><i
                                class="fas fa-shopping-cart"></i> Buat PO</a>
                    @endcan
                    @can('ppic.mrmstr.read')
                        <a href="{{ route('MrpMstrs.index') }}" class="btn btn-app bg-success"><i class="fas fa-cogs"></i>
                            Jalankan MRP</a>
                    @endcan
                    @can('engineeering.itemmstr.read')
                        <a href="{{ route('ItemMstrs.index') }}" class="btn btn-app bg-info"><i class="fas fa-box"></i> Master
                            Item</a>
                    @endcan
                    @can('engineeering.bommstr.read')
                        <a href="{{ route('BomMstrs.index') }}" class="btn btn-app bg-secondary"><i
                                class="fas fa-list-alt"></i> Buat BOM</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data untuk grafik ini harus di-pass dari Controller
        // Contoh data dummy
        const salesData = {
            labels: {!! json_encode($salesChartData['labels']) !!},
            datasets: [{
                label: 'Jumlah Sales Order',
                data: {!! json_encode($salesChartData['data']) !!},
                backgroundColor: 'rgba(0, 123, 255, 0.5)',
                borderColor: 'rgba(0, 123, 255, 1)',
                borderWidth: 1
            }]
        };

        const inventoryData = {
            labels: {!! json_encode($inventoryChartData['labels']) !!}, // Contoh: ['Finished Goods', 'WIP', 'Supporting']
            datasets: [{
                data: {!! json_encode($inventoryChartData['data']) !!}, // Contoh: [40, 25, 35]
                backgroundColor: ['#17a2b8', '#ffc107', '#28a745']
            }]
        };

        // Render Sales Chart
        new Chart(document.getElementById('salesChart'), {
            type: 'bar',
            data: salesData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Render Inventory Chart
        new Chart(document.getElementById('inventoryChart'), {
            type: 'doughnut',
            data: inventoryData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });
    </script>
@endpush
