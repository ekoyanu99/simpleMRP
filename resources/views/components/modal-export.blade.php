<div class="modal fade" id="modalExport" tabindex="-1" aria-labelledby="modalExportLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #222149; color: white; border-bottom: 1px solid #dee2e6;">
                <h5 class="modal-title" id="modalExportLabel">Export Options</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body bg-light">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <button class="btn btn-block btn-warning btn-flat" id="exportBtn3" onclick="printPreview()"
                            disabled>
                            <i class="fas fa-print mr-2"></i> Print
                        </button>
                    </div>
                    <div class="col-md-4 mb-3">
                        <button class="btn btn-block btn-success btn-flat" id="exportBtn2" onclick="exportReport()">
                            <i class="fas fa-file-excel mr-2"></i> Excel
                        </button>
                    </div>
                    <div class="col-md-4 mb-3">
                        <button class="btn btn-block btn-danger btn-flat" id="exportBtn1" onclick="printPreview(1)"
                            disabled>
                            <i class="fas fa-file-pdf mr-2"></i> PDF
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
