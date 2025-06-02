@extends('layouts.app')

@section('title', 'Sales Order')

@section('content_header')
    {{-- Header halaman dengan desain responsif --}}
    <div class="d-flex justify-content-between align-items-center flex-column flex-md-row text-md-start text-center">
        <h1 class="m-0 mb-2 mb-md-0">
            <i class="fas fa-handshake"></i> Sales Order
        </h1>
        <div>
            {{-- Tombol aksi di header (opsional) --}}
            {{-- <a href="{{ route('SalesMstrs.export') }}" class="btn btn-info btn-sm">
                <i class="fas fa-file-export"></i> Export Data
            </a> --}}
        </div>
    </div>
@stop

{{-- Pastikan plugins yang dibutuhkan aktif di layouts/app.blade.php --}}
{{-- @section('plugins.Datatables', true) --}}
{{-- @section('plugins.TempusDominusBs4', true) --}} {{-- Untuk Datepicker --}}

@section('content')
    <div class="container-fluid">
        <div class="card card-outline card-info"> {{-- Menggunakan card-outline untuk tampilan lebih modern --}}
            <div class="card-header">
                {{-- Menggunakan flexbox untuk header card --}}
                <div
                    class="d-flex justify-content-between align-items-center flex-column flex-md-row text-md-start text-center w-100">
                    <h3 class="card-title m-0 mb-2 mb-md-0"><i class="fas fa-list-ul"></i> Daftar Sales Order</h3>
                    <div class="card-tools m-0">
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                            data-target="#modalAddSales">
                            <i class="fas fa-plus-circle mr-1"></i> Tambah Sales Order Baru
                        </button>
                        {{-- Tombol collapse/minimize jika diinginkan --}}
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="salesmstrlistTable">
                        <thead>
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th style="width: 15%;">Nomor Sales</th>
                                <th style="width: 15%;">Bill To</th>
                                <th style="width: 15%;">Ship To</th>
                                <th style="width: 10%;">Tgl. Order</th>
                                <th style="width: 10%;">Jatuh Tempo</th>
                                <th style="width: 10%;">Total</th>
                                <th style="width: 10%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Data akan diisi oleh DataTables AJAX --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Add New Sales --}}
    <form action="{{ route('SalesMstrs.store') }}" method="post" autocomplete="off" id="formAddSales">
        @csrf
        <div class="modal fade" id="modalAddSales" tabindex="-1" role="dialog" aria-labelledby="modalAddSalesTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="modalAddSalesTitle"><i class="fas fa-plus-circle mr-2"></i> Tambah Sales
                            Order Baru</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{-- Field Sales Number --}}
                        <div class="form-group">
                            <label for="sales_mstr_nbr"><i class="fas fa-hashtag text-info"></i> Nomor Sales</label>
                            <input type="text" name="sales_mstr_nbr" id="sales_mstr_nbr"
                                class="form-control form-control-sm @error('sales_mstr_nbr') is-invalid @enderror"
                                placeholder="Auto-generate atau masukkan nomor sales" required
                                value="{{ old('sales_mstr_nbr') }}">
                            @error('sales_mstr_nbr')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        {{-- Field Bill To --}}
                        <div class="form-group">
                            <label for="sales_mstr_bill"><i class="fas fa-user text-purple"></i> Bill To</label>
                            <input type="text" name="sales_mstr_bill" id="sales_mstr_bill"
                                class="form-control form-control-sm @error('sales_mstr_bill') is-invalid @enderror"
                                placeholder="Nama pelanggan penagih" required value="{{ old('sales_mstr_bill') }}">
                            @error('sales_mstr_bill')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        {{-- Field Ship To --}}
                        <div class="form-group">
                            <label for="sales_mstr_ship"><i class="fas fa-truck text-orange"></i> Ship To</label>
                            <input type="text" name="sales_mstr_ship" id="sales_mstr_ship"
                                class="form-control form-control-sm @error('sales_mstr_ship') is-invalid @enderror"
                                placeholder="Alamat pengiriman" required value="{{ old('sales_mstr_ship') }}">
                            @error('sales_mstr_ship')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        {{-- Field Order Date --}}
                        <div class="form-group">
                            <label for="sales_mstr_date"><i class="fas fa-calendar-alt text-primary"></i> Tanggal
                                Order</label>
                            <div class="input-group date" id="sales_mstr_date_add_picker" data-target-input="nearest">
                                <input type="text" name="sales_mstr_date" id="sales_mstr_date"
                                    class="form-control form-control-sm datetimepicker-input @error('sales_mstr_date') is-invalid @enderror"
                                    data-target="#sales_mstr_date_add_picker" required
                                    value="{{ old('sales_mstr_date', date('Y-m-d')) }}"> {{-- Default to current date --}}
                                <div class="input-group-append" data-target="#sales_mstr_date_add_picker"
                                    data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                @error('sales_mstr_date')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        {{-- Field Due Date --}}
                        <div class="form-group">
                            <label for="sales_mstr_due_date"><i class="fas fa-calendar-check text-success"></i> Tanggal
                                Jatuh Tempo</label>
                            <div class="input-group date" id="sales_mstr_due_date_add_picker"
                                data-target-input="nearest">
                                <input type="text" name="sales_mstr_due_date" id="sales_mstr_due_date"
                                    class="form-control form-control-sm datetimepicker-input @error('sales_mstr_due_date') is-invalid @enderror"
                                    data-target="#sales_mstr_due_date_add_picker" required
                                    value="{{ old('sales_mstr_due_date', date('Y-m-d', strtotime('+7 days'))) }}">
                                {{-- Default to 7 days from now --}}
                                <div class="input-group-append" data-target="#sales_mstr_due_date_add_picker"
                                    data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                @error('sales_mstr_due_date')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        {{-- Field Total (hidden karena dihitung di backend) --}}
                        <input type="hidden" name="sales_mstr_total" value="0">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                class="fas fa-times"></i> Batal</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Sales
                            Order</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{-- Modal Edit Sales Mastr --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="editForm" method="POST" autocomplete="off"> {{-- Action URL will be set by JS --}}
                    @csrf
                    @method('PUT')
                    {{-- Hidden input untuk menyimpan UUID Sales Mstr yang sedang diedit --}}
                    <input type="hidden" name="sales_mstr_uuid" id="sales_mstr_uuid_edit"
                        value="{{ old('sales_mstr_uuid') }}">

                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title" id="editModalLabel"><i class="fas fa-edit mr-2"></i> Edit Sales Order
                        </h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{-- Field Sales Number (Readonly) --}}
                        <div class="form-group">
                            <label for="sales_mstr_nbr_edit"><i class="fas fa-hashtag text-info"></i> Nomor Sales</label>
                            <input type="text" name="sales_mstr_nbr" id="sales_mstr_nbr_edit"
                                class="form-control form-control-sm @error('sales_mstr_nbr') is-invalid @enderror" readonly
                                value="{{ old('sales_mstr_nbr') }}">
                            @error('sales_mstr_nbr')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        {{-- Field Bill To --}}
                        <div class="form-group">
                            <label for="sales_mstr_bill_edit"><i class="fas fa-user text-purple"></i> Bill To</label>
                            <input type="text" name="sales_mstr_bill" id="sales_mstr_bill_edit"
                                class="form-control form-control-sm @error('sales_mstr_bill') is-invalid @enderror"
                                placeholder="Nama pelanggan penagih" required value="{{ old('sales_mstr_bill') }}">
                            @error('sales_mstr_bill')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        {{-- Field Ship To --}}
                        <div class="form-group">
                            <label for="sales_mstr_ship_edit"><i class="fas fa-truck text-orange"></i> Ship To</label>
                            <input type="text" name="sales_mstr_ship" id="sales_mstr_ship_edit"
                                class="form-control form-control-sm @error('sales_mstr_ship') is-invalid @enderror"
                                placeholder="Alamat pengiriman" required value="{{ old('sales_mstr_ship') }}">
                            @error('sales_mstr_ship')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                        {{-- Field Order Date --}}
                        <div class="form-group">
                            <label for="sales_mstr_date_edit"><i class="fas fa-calendar-alt text-primary"></i> Tanggal
                                Order</label>
                            <div class="input-group date" id="sales_mstr_date_edit_picker" data-target-input="nearest">
                                <input type="text" name="sales_mstr_date" id="sales_mstr_date_edit"
                                    class="form-control form-control-sm datetimepicker-input @error('sales_mstr_date') is-invalid @enderror"
                                    data-target="#sales_mstr_date_edit_picker" required
                                    value="{{ old('sales_mstr_date') }}">
                                <div class="input-group-append" data-target="#sales_mstr_date_edit_picker"
                                    data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                @error('sales_mstr_date')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        {{-- Field Due Date --}}
                        <div class="form-group">
                            <label for="sales_mstr_due_date_edit"><i class="fas fa-calendar-check text-success"></i>
                                Tanggal Jatuh Tempo</label>
                            <div class="input-group date" id="sales_mstr_due_date_edit_picker"
                                data-target-input="nearest">
                                <input type="text" name="sales_mstr_due_date" id="sales_mstr_due_date_edit"
                                    class="form-control form-control-sm datetimepicker-input @error('sales_mstr_due_date') is-invalid @enderror"
                                    data-target="#sales_mstr_due_date_edit_picker" required
                                    value="{{ old('sales_mstr_due_date') }}">
                                <div class="input-group-append" data-target="#sales_mstr_due_date_edit_picker"
                                    data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                                @error('sales_mstr_due_date')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        {{-- Field Total (Readonly) --}}
                        <div class="form-group">
                            <label for="sales_mstr_total_edit"><i class="fas fa-dollar-sign text-danger"></i>
                                Total</label>
                            <input type="number" step="0.01" name="sales_mstr_total" id="sales_mstr_total_edit"
                                class="form-control form-control-sm @error('sales_mstr_total') is-invalid @enderror"
                                placeholder="Total nilai Sales Order" readonly value="{{ old('sales_mstr_total') }}">
                            @error('sales_mstr_total')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                class="fas fa-times"></i> Batal</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan
                            Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@push('styles')
    <style>
        /* Gaya umum untuk form-group */
        .form-group {
            margin-bottom: 1rem;
            /* Sedikit lebih lega antar field */
        }

        /* Gaya untuk label dengan ikon */
        .form-group label {
            display: block;
            margin-bottom: .25rem;
            font-weight: 600;
        }

        .form-group label i {
            margin-right: .5rem;
        }

        /* Penyesuaian tinggi untuk Select2 agar sesuai dengan form-control-sm (jika ada select2 di modal ini) */
        .select2-container .select2-selection--single {
            height: calc(1.8125rem + 2px);
            /* Ketinggian form-control-sm */
            border-radius: .2rem;
            /* Border-radius form-control-sm */
            border: 1px solid #ced4da;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 28px;
            /* Teks di tengah */
            padding-left: .5rem;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 28px;
            right: 3px;
        }

        .select2-container--bootstrap4 .select2-selection--single {
            border-color: #ced4da;
            padding: 0.25rem 0.5rem;
        }

        .select2-container--bootstrap4.select2-container--focus .select2-selection--single {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .select2-container--bootstrap4 .select2-results__option--highlighted {
            background-color: #007bff !important;
            color: #fff !important;
        }

        /* Penyesuaian untuk input-group (datepicker) */
        .input-group-text {
            height: calc(1.8125rem + 2px);
            /* Match form-control-sm height */
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            /* Match form-control-sm font-size */
        }

        .form-control-sm+.input-group-append .input-group-text {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        /* Action buttons in table */
        #salesmstrlistTable .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.775rem;
            /* Slightly smaller for compactness */
        }

        #salesmstrlistTable .input-group-prepend {
            /* Fix for input-group-prepend making button round on one side */
            border-radius: .2rem;
            overflow: hidden;
            display: flex;
        }

        #salesmstrlistTable .input-group-prepend .btn {
            border-radius: 0;
            /* Remove default button radius */
        }

        #salesmstrlistTable .input-group-prepend .btn:first-child {
            border-top-left-radius: .2rem;
            border-bottom-left-radius: .2rem;
        }

        #salesmstrlistTable .input-group-prepend .btn:last-child {
            border-top-right-radius: .2rem;
            border-bottom-right-radius: .2rem;
        }
    </style>
@endpush

@push('js')
    <script>
        // salesmstrlist.js (dimasukkan langsung di sini untuk kemudahan)
        $(document).ready(function() {
            const allColumns = {
                id: {
                    data: "DT_RowIndex",
                    name: "sales_mstr_id",
                    orderable: false,
                    searchable: false
                },
                nbr: {
                    data: "sales_mstr_nbr",
                    name: "sales_mstr_nbr"
                },
                bill: {
                    data: "sales_mstr_bill",
                    name: "sales_mstr_bill"
                },
                ship: {
                    data: "sales_mstr_ship",
                    name: "sales_mstr_ship"
                },
                date: {
                    data: "sales_mstr_date",
                    name: "sales_mstr_date",
                    className: "text-right text-nowrap"
                },
                due_date: {
                    data: "sales_mstr_due_date",
                    name: "sales_mstr_due_date"
                },
                total: {
                    data: "sales_mstr_total",
                    name: "sales_mstr_total",
                    render: function(data, type, row) {
                        return new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR'
                        }).format(data);
                    }
                },
                action: {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false
                },
            };

            const salesColKey = ["id", "nbr", "bill", "ship", "date", "due_date", "total", "action"];
            const salesCol = salesColKey.map((key) => allColumns[key]);

            // Asumsi initDataTable adalah fungsi yang Anda definisikan di luar atau di file JS terpisah
            // Jika Anda ingin tetap mempertahankan file JS terpisah, biarkan ini.
            // Jika tidak, Anda bisa langsung menggunakan konfigurasi DataTables di sini.
            let table = $('#salesmstrlistTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('SalesMstr.data') }}', // URL DataTables AJAX
                columns: salesCol,
                paging: true,
                lengthChange: true,
                searching: true,
                ordering: true,
                info: true,
                autoWidth: false,
                responsive: true,
                order: [
                    [0, "asc"]
                ]
            });


            $('#f_Sfilter, #f_addFilterForm, #f_CFilter').on('click', function() {
                table.draw();
            });

            // Clear form filter - fungsi ini akan berada di file JS terpisah atau di sini
            window.clearForm = function() {
                $("#addFilterForm")[0].reset();
            };

            // Inisialisasi Datepicker untuk modal tambah dan edit
            $('.input-group.date').datetimepicker({
                format: 'YYYY-MM-DD',
                locale: 'id',
                icons: {
                    time: 'fa fa-clock',
                    date: 'fa fa-calendar',
                    up: 'fa fa-arrow-up',
                    down: 'fa fa-arrow-down',
                    previous: 'fa fa-chevron-left',
                    next: 'fa fa-chevron-right',
                    today: 'fa fa-calendar-check',
                    clear: 'fa fa-trash',
                    close: 'fa fa-times'
                }
            });

            // Logika untuk membuka modal kembali jika ada error validasi
            @if ($errors->any())
                $(document).ready(function() {
                    // Check if there are validation errors specific to the 'Add Sales' modal
                    // By checking for is-invalid class on fields within that modal
                    if ($('#formAddSales').find('.is-invalid').length > 0) {
                        $('#modalAddSales').modal('show');
                    }
                    // Check if there are validation errors specific to the 'Edit Sales Mastr' modal
                    else if ($('#editModal').find('.is-invalid').length > 0) {
                        // Get the UUID from the old input of the hidden field
                        const failedUuid = "{{ old('sales_mstr_uuid') }}";
                        // Construct the update URL dynamically
                        const updateUrl = "{{ route('SalesMstrs.update', '') }}" + '/' + failedUuid;

                        // Set the action URL on the edit modal form
                        $("#editForm").attr("action", updateUrl);

                        // Set the UUID to the hidden input in the edit form
                        $("#editForm #sales_mstr_uuid_edit").val(failedUuid);

                        // Call fillEditModalData to re-populate the form with old data
                        // This might be redundant if old() is already handled in Blade value attributes
                        // But good for consistency if some fields are not directly old() bound
                        // You need to pass the data that was previously present in the edit form.
                        // For simplicity, we'll just open the modal here,
                        // assuming old() in blade will handle the field values.
                        $('#editModal').modal('show');

                        // If you need to re-populate based on old input for fields not directly bound by old(),
                        // you might need a helper function here. For now, rely on Blade's old().
                    }

                    // Opsional: Tampilkan SweetAlert2 untuk validasi gagal (jika diaktifkan)
                    // Swal.fire({
                    //     icon: 'error',
                    //     title: 'Validasi Gagal!',
                    //     text: 'Terdapat kesalahan input pada form. Mohon periksa kembali field yang disorot.',
                    //     toast: true,
                    //     position: 'top-end',
                    //     showConfirmButton: false,
                    //     timer: 5000,
                    //     timerProgressBar: true
                    // });
                });
            @endif
        });

        // updateModal.js (dimasukkan langsung di sini untuk kemudahan)
        $(document).on("click", ".editButton", function() {
            // console.log("Button clicked"); // Debugging

            const id = $(this).data("id"); // Ini adalah sales_mstr_uuid dari Sales Mstr
            const date = $(this).data("date");
            const duedate = $(this).data("due_date");
            const nbr = $(this).data("nbr");
            const bill = $(this).data("bill");
            const ship = $(this).data("ship");
            const total = $(this).data("total");

            const url = $(this).data(
            "url"); // Ini adalah URL update: route('SalesMstrs.update', $salesMstr->sales_mstr_uuid)

            // Mengisi hidden input sales_mstr_uuid_edit
            $("#editForm #sales_mstr_uuid_edit").val(id);

            // Mengisi nilai input pada modal edit. Prioritaskan old() jika ada, jika tidak, pakai data-attribute.
            // Penting: pastikan nama field di Blade (misal: name="sales_mstr_nbr") sesuai dengan old()
            // dan tidak menggunakan efid_Date atau efid_Due di name atribut.
            // Jika Anda bersikeras pada efid_, maka old() perlu disesuaikan di Blade.
            // Untuk skrip ini, saya akan asumsikan nama field HTML sesuai dengan nama kolom DB yang digunakan old().
            $("#editForm #sales_mstr_nbr_edit").val("{{ old('sales_mstr_nbr', '') }}" || nbr || "");
            $("#editForm #sales_mstr_bill_edit").val("{{ old('sales_mstr_bill', '') }}" || bill || "");
            $("#editForm #sales_mstr_ship_edit").val("{{ old('sales_mstr_ship', '') }}" || ship || "");
            $("#editForm #sales_mstr_total_edit").val("{{ old('sales_mstr_total', '') }}" || total || "");

            // Mengisi nilai datepicker. Laravel's old() for date fields can be tricky with type="date".
            // It's better to pass it as string and then initialize datetimepicker.
            // Or use old() and then re-initialize picker.
            // For datetimepicker, set date like this:
            $('#sales_mstr_date_edit_picker').datetimepicker('date', ("{{ old('sales_mstr_date', '') }}" || date));
            $('#sales_mstr_due_date_edit_picker').datetimepicker('date', ("{{ old('sales_mstr_due_date', '') }}" ||
                duedate));


            // Set action URL pada form edit modal
            $("#editForm").attr("action", url);

            // Membuka modal edit
            $('#editModal').modal('show');
        });
    </script>
@endpush
