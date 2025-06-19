<div class="d-flex gap-2">
    @if ($showExport ?? false)
        <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#modalExport">
            <i class="fas fa-file-export "></i>
            <span class="d-none d-md-inline">Export To</span>
        </button>
    @endif

    <button type="button" class="btn btn-sm bg-indigo" data-toggle="modal" data-target="#modalFilter">
        <i class="fas fa-filter "></i>
        <span class="d-none d-md-inline">Filter</span>
    </button>

    <button type="button" class="btn btn-sm bg-maroon" onclick="clearForm()" id="f_CFilter">
        <i class="fas fa-undo "></i>
        <span class="d-none d-md-inline">Reset</span>
    </button>

    @if ($showMigrate ?? false)
        <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalMigrate">
            <i class="fas fa-random "></i>
            <span class="d-none d-md-inline">Migrate</span>
        </button>
    @endif
</div>
