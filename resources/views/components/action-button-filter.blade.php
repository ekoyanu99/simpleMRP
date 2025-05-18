<div
    class="d-flex flex-wrap align-items-center w-100 {{ $showExport ?? false ? 'justify-content-between' : 'justify-content-end' }}">
    @if ($showExport ?? false)
        <div class="d-flex gap-2 flex-wrap">
            <!-- Print Button -->
            <button class="btn btn-sm bg-gray" id="f_cetakData" onclick="cetakData()" type="button">
                <i class="fas fa-print me-1"></i>
                <span class="d-none d-md-inline">Cetak Data</span>
            </button>

            <!-- Excel Export -->
            <button type="button" class="btn btn-sm bg-success" data-bs-dismiss="modal">
                <i class="fas fa-file-excel me-1"></i>
                <span class="d-none d-md-inline">Export Excel</span>
            </button>

            <!-- PDF Export -->
            <button type="button" class="btn btn-sm bg-danger" data-bs-dismiss="modal">
                <i class="fas fa-file-pdf me-1"></i>
                <span class="d-none d-md-inline">Export PDF</span>
            </button>
        </div>
    @endif

    <div class="d-flex gap-2 flex-wrap justify-content-end">
        <!-- Reset Button -->
        <button class="btn btn-sm bg-maroon" id="f_addFilterForm" onclick="clearForm()" type="button">
            <i class="fas fa-undo me-1"></i>
            <span class="d-none d-md-inline">Reset</span>
        </button>

        <!-- Discard Button -->
        <button type="button" class="btn btn-sm btn-dark" data-bs-dismiss="modal">
            <i class="fas fa-times me-1"></i>
            <span class="d-none d-md-inline">Discard</span>
        </button>

        <!-- Filter Button -->
        <button type="button" class="btn btn-sm bg-indigo" id="f_Sfilter" data-bs-dismiss="modal">
            <i class="fas fa-filter me-1"></i>
            <span class="d-none d-md-inline">Filter</span>
        </button>
    </div>
</div>
