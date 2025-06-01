@extends('layouts.app')

@section('title', 'Kalkulator BOM')

@section('content_header')

    <div class="d-flex justify-content-between align-items-center flex-column flex-md-row text-md-start text-center">
        <h1 class="m-0 mb-2 mb-md-0"><i class="fas fa-calculator"></i> Kalkulator Bill of Material</h1>
        <div>
            <a href="{{ route('BomMstrs.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar BOM
            </a>
        </div>
    </div>
@stop


@section('content')
    <div class="container-fluid">
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-cogs"></i> Masukkan Detail Simulasi</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('BomMstr.calculate') }}" id="bomCalculatorForm">
                    @csrf

                    <div class="form-group">
                        <label for="item_id"><i class="fas fa-box-open text-primary"></i> Finished Good Item</label>
                        <select class="form-control select2 @error('item_id') is-invalid @enderror" id="item_id"
                            name="item_id" required data-placeholder="Pilih Finished Good Item..."> {{-- Placeholder untuk Select2 --}}
                            <option value="">Pilih Item</option>
                            @foreach ($items as $item)
                                <option value="{{ $item->item_id }}"
                                    {{ old('item_id') == $item->item_id ? 'selected' : '' }}>
                                    {{ $item->item_name }} ({{ $item->item_desc }})
                                </option>
                            @endforeach
                        </select>
                        @error('item_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <small class="form-text text-muted">Pilih item produk jadi atau setengah jadi yang ingin
                            disimulasikan.</small>
                    </div>

                    <div class="form-group">
                        <label for="quantity"><i class="fas fa-sort-numeric-up-alt text-success"></i> Kuantitas</label>
                        <input type="number" step="0.01" min="0.01"
                            class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity"
                            placeholder="Masukkan kuantitas yang dibutuhkan (misal: 10.50)" required
                            value="{{ old('quantity') }}">
                        @error('quantity')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <small class="form-text text-muted">Masukkan jumlah kuantitas Finished Good yang akan
                            diproduksi.</small>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-end">
                        <button type="reset" class="btn btn-secondary mr-2"><i class="fas fa-eraser"></i> Reset</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-play-circle"></i> Hitung
                            BOM</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@push('js')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap4',
                allowClear: true,
            });
        });
    </script>
@endpush
