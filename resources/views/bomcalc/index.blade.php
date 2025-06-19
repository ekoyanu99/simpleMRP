@extends('layouts.app')

@section('title', 'Simulasi BOM')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center flex-column flex-md-row text-md-start text-center">
        <h1 class="m-0 mb-2 mb-md-0">
            Simulasi Bill of Material
        </h1>
        <div>
            <a href="{{ route('BomMstr.calculator') }}" class="btn btn-secondary">
                <i class="fas fa-undo"></i> Kembali ke Form
            </a>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-info-circle"></i> Ringkasan Simulasi</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p class="lead mb-0">
                            <i class="fas fa-box-open text-primary"></i>
                            <strong>Finished Good:</strong> {{ $fgItem->item_name }} ({{ $fgItem->item_desc }})
                        </p>
                    </div>
                    <div class="col-md-6 text-right">
                        <p class="lead mb-0">
                            <i class="fas fa-sort-numeric-up-alt text-success"></i>
                            <strong>Kuantitas:</strong> <span
                                class="badge badge-success px-3 py-2">{{ formatNumberV2($qtyReq) }}
                                {{ $fgItem->item_uom }}</span>
                        </p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-12">
                        <p class="mb-0">
                            <i class="fas fa-boxes text-info"></i>
                            <strong>Total Komponen Unik:</strong> <span
                                class="badge badge-info px-2">{{ $totalComponents }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-list-alt"></i> Detail Kebutuhan Komponen</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="componentBreakdownTable" class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Level</th>
                                <th>Parent</th>
                                <th>Component</th>
                                <th>UOM</th>
                                <th>Qty Per</th>
                                <th>Yield (%)</th>
                                <th>Required Qty</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($results as $item)
                                <tr>
                                    <td><span class="badge badge-secondary">LVL {{ $item['level'] }}</span></td>
                                    <td>{{ $item['parent_name'] }}
                                    </td>
                                    <td>
                                        <i class="fas fa-chevron-right text-sm text-muted"></i>
                                        <strong>{{ $item['component_name'] }}</strong> <small
                                            class="text-muted">({{ $item['component'] }})</small>
                                    </td>
                                    <td>{{ $item['uom'] }}</td>
                                    <td>{{ formatNumberV2($item['qty_per']) }}</td>
                                    <td>{{ formatNumberV2($item['yield'] * 100) }}</td>
                                    <td class="font-weight-bold text-primary">{{ formatNumberV2($item['required_qty']) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer text-right">
                <button class="btn btn-secondary"><i class="fas fa-print"></i> Cetak</button>
                <button class="btn btn-success"><i class="fas fa-file-excel"></i> Export Excel</button>
            </div>
        </div>

        <div class="card card-outline card-warning">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-sitemap"></i> Struktur BOM Visual</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div id="bom-tree-container">
                </div>
            </div>
        </div>

        <div class="row py-3">
            <div class="col-12 text-center">
                <a href="{{ url()->previous() }}" class="btn btn-default mr-2"><i class="fas fa-arrow-left"></i>
                    Kembali</a>
            </div>
        </div>

    </div>
@stop

@push('js')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        $(document).ready(function() {
            $('#componentBreakdownTable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "columnDefs": [{
                    "type": "num",
                    "targets": 6
                }]
            });

            google.charts.load('current', {
                packages: ["orgchart"]
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Name');
                data.addColumn('string', 'Manager');
                data.addColumn('string', 'ToolTip');


                var chartData = [];
                chartData.push([{
                        'v': '{{ $fgItem->item_id }}',
                        'f': '<div class="chart-node-title"><i class="fas fa-cube"></i> {{ $fgItem->item_name }}</div>' +
                            '<div class="chart-node-qty">Qty: {{ formatNumberV2($qtyReq) }} {{ $fgItem->item_uom }}</div>'
                    },
                    '',
                    'Finished Good: {{ $fgItem->item_name }}'
                ]);

                @foreach ($results as $item)
                    chartData.push([{
                            'v': '{{ $item['component'] }}',
                            'f': '<div class="chart-node-title"><i class="fas fa-sitemap"></i> {{ $item['component_name'] }}</div>' +
                                '<div class="chart-node-qty">Req: {{ formatNumberV2($item['required_qty']) }} {{ $item['uom'] }}</div>'
                        },
                        '{{ $item['parent'] }}',
                        'Komponen: {{ $item['component_name'] }}\nKuantitas Dibutuhkan: {{ formatNumberV2($item['required_qty']) }} {{ $item['uom'] }}'
                    ]);
                @endforeach

                data.addRows(chartData);

                var chart = new google.visualization.OrgChart(document.getElementById('bom-tree-container'));

                var options = {
                    'allowHtml': true,
                    'allowCollapse': true,
                    'size': 'large', // default, small, medium, large
                    'nodeClass': 'chart-node',
                    'selectedNodeClass': 'chart-node-selected',
                };

                chart.draw(data, options);
            }
        });
    </script>
@endpush

@push('styles')
    <style>
        #bom-tree-container {
            width: 100%;
            min-height: 500px;
            border: 1px solid var(--bs-border-color);
            border-radius: var(--bs-border-radius);
            overflow: auto;
            background-color: var(--bs-white);
            padding: 1rem;
            box-sizing: border-box;
            position: relative;
            margin-bottom: 20px;

        }

        .google-visualization-orgchart-node {
            border: none !important;
            border-radius: var(--bs-border-radius-sm);
            background-color: #f8f9fa;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
            padding: 8px 12px;
            margin: 5px;
        }

        .google-visualization-orgchart-node:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }

        .chart-node-title {
            font-weight: bold;
            color: #333;
            font-size: 0.95em;
        }

        .chart-node-subtitle {
            font-size: 0.8em;
            color: var(--bs-gray-600);
            margin-top: 2px;
            white-space: nowrap !important;
        }

        .chart-node-qty {
            font-size: 0.85em;
            color: var(--bs-primary-dark);
            margin-top: 4px;
            font-weight: 600;
        }

        .google-visualization-orgchart-node-toggle {
            background-color: var(--bs-primary) !important;
            color: var(--bs-white) !important;
            border-radius: 50% !important;
            border: 1px solid var(--bs-primary-dark) !important;
            box-shadow: var(--bs-box-shadow-sm);
            transition: background-color 0.2s ease, transform 0.2s ease;
            width: 24px !important;
            height: 24px !important;
            line-height: 24px !important;
            font-size: 1.1em !important;
            text-align: center;
        }

        .google-visualization-orgchart-node-toggle:hover {
            background-color: var(--bs-primary-dark) !important;
            transform: scale(1.1);
        }

        .google-visualization-orgchart-linehead,
        .google-visualization-orgchart-linenode {
            border-color: var(--bs-gray-600) !important;
            border-width: 1.5px !important;
        }

        .chart-node-selected {
            background-color: var(--bs-blue-200) !important;
            border: 2px solid var(--bs-blue-500) !important;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.25) !important;
        }
    </style>
@endpush
