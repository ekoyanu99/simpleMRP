<div class="d-flex gap-2">
    @if ($showExport ?? false)
        <button type="button" class="btn btn-sm btn-default" data-bs-toggle="modal" data-bs-target="#modalExport">
            <i class="fas fa-file-export mr-1"></i>
            <span class="d-none d-md-inline">Export To</span>
        </button>
    @endif

    <button type="button" class="btn btn-sm bg-dark" data-bs-toggle="modal" data-bs-target="#modalFilter">
        <i class="fas fa-filter mr-1"></i>
        <span class="d-none d-md-inline">Filter</span>
    </button>

    <button type="button" class="btn btn-sm bg-maroon" onclick="clearForm()" id="f_CFilter">
        <i class="fas fa-undo mr-1"></i>
        <span class="d-none d-md-inline">Reset</span>
    </button>

    @if ($showMigrate ?? false)
        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalMigrate">
            <i class="fas fa-random mr-1"></i>
            <span class="d-none d-md-inline">Migrate</span>
        </button>
    @endif
</div>
