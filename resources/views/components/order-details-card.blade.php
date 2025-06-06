<div>
    {{-- CARD & TABLE DETAIL --}}
    <div class="card card-outline card-secondary">
        <div class="card-header">
            <div
                class="d-flex justify-content-between align-items-center flex-column flex-md-row text-md-start text-center w-100">
                <h3 class="card-title m-0 mb-2 mb-md-0"><i class="fas fa-list-alt"></i> {{ $title }}</h3>
                <div class="card-tools m-0">
                    <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modalAddDetail">
                        <i class="fas fa-plus-circle mr-1"></i> Add Detail
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover" id="detailsTable">
                    <thead>
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th style="width: 30%;">Order Number</th>
                            <th style="width: 15%;">Item</th>
                            <th style="width: 30%">Desc</th>
                            <th style="width: 5%;">Qty</th>
                            <th style="width: 5%;">Price</th>
                            <th style="width: 10%;">Total</th>
                            <th style="width: 10%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($details as $detail)
                            @php
                                // Generalisasi properti untuk Sales dan Purchase Order
                                $det_uuid = $detail->sales_det_uuid ?? $detail->po_det_uuid;
                                $det_id = $detail->sales_det_id ?? $detail->po_det_id;
                                $det_date = $detail->sales_det_date ?? $detail->po_det_date;
                                $det_duedate = $detail->sales_det_duedate ?? $detail->po_det_duedate;
                                $det_item_id = $detail->sales_det_item ?? $detail->po_det_item;
                                $det_desc = $detail->sales_det_desc ?? $detail->po_det_desc;
                                $det_qty = $detail->sales_det_qty ?? $detail->po_det_qty;
                                $det_price = $detail->sales_det_price ?? $detail->po_det_price;
                                $order_nbr = $orderMstr->sales_mstr_nbr ?? $orderMstr->po_mstr_nbr;
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order_nbr }}</td>
                                <td>{{ $detail->itemMstr->item_name }}</td>
                                <td>{{ $det_desc }}</td>
                                <td>{{ formatNumberV2($det_qty) }}</td>
                                <td>{{ formatCurrency($det_price) }}</td>
                                <td>{{ formatCurrency($det_qty * $det_price) }}</td>
                                <td>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            {{-- Tombol Edit dengan data attributes yang digeneralisasi --}}
                                            <button class="btn btn-sm btn-info editButton" data-id="{{ $det_id }}"
                                                data-uuid="{{ $det_uuid }}" data-date="{{ $det_date }}"
                                                data-due_date="{{ $det_duedate }}" data-item_id="{{ $det_item_id }}"
                                                data-desc="{{ $det_desc }}" data-qty="{{ $det_qty }}"
                                                data-price="{{ $det_price }}"
                                                data-update_url="{{ route($updateRoute, $det_uuid) }}"
                                                data-toggle="modal" data-target="#editDetailModal">
                                                <i class="fas fa-pen"></i>
                                            </button>

                                            {{-- Form Hapus dengan route dinamis --}}
                                            <form action="{{ route($destroyRoute, $det_uuid) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus detail ini?')"
                                                    title="Hapus Detail">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- MODAL TAMBAH DETAIL --}}
    <form action="{{ route($addRoute) }}" method="post" autocomplete="off">
        @csrf
        <div class="modal fade" id="modalAddDetail" tabindex="-1" role="dialog" aria-labelledby="modalAddDetailTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="modalAddDetailTitle"><i class="fas fa-plus-circle mr-2"></i> Add
                            Detail</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row mb-4">
                            {{-- Hidden input untuk master ID, digeneralisasi --}}
                            <input type="hidden" name="det_mstr_id"
                                value="{{ $orderMstr->sales_mstr_id ?? $orderMstr->po_mstr_id }}">

                            <div class="form-group col-md-6">
                                <label for="det_date"><i class="fas fa-calendar-alt text-primary"></i> Order
                                    Date</label>
                                <input type="date" name="det_date"
                                    class="form-control form-control-sm @error('det_date') is-invalid @enderror"
                                    required
                                    value="{{ old('det_date', $orderMstr->sales_mstr_date ?? $orderMstr->po_mstr_date) }}">
                                @error('det_date')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="det_duedate"><i class="fas fa-calendar-check text-success"></i> Due
                                    Date</label>
                                <input type="date" name="det_duedate"
                                    class="form-control form-control-sm @error('det_duedate') is-invalid @enderror"
                                    required
                                    value="{{ old('det_duedate', $orderMstr->sales_mstr_due_date ?? $orderMstr->po_mstr_due_date) }}">
                                @error('det_duedate')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="det_item"><i class="fas fa-box text-purple"></i> Item</label>
                                <x-adminlte-select2 name="det_item" id="addItemSelect" onchange="getDesc()"
                                    data-dropdown-parent="#modalAddDetail">
                                    <option value="">Select an item</option>
                                    @foreach ($items as $item)
                                        <option value="{{ $item->item_id }}"
                                            {{ old('det_item') == $item->item_id ? 'selected' : '' }}>
                                            {{ $item->item_name }}
                                        </option>
                                    @endforeach
                                </x-adminlte-select2>
                                @error('det_item')
                                    <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="det_desc"><i class="fas fa-file-alt text-secondary"></i>
                                    Description</label>
                                <input type="text" name="det_desc" id="addDesc"
                                    class="form-control form-control-sm" readonly required
                                    value="{{ old('det_desc') }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="det_qty"><i class="fas fa-sort-numeric-up-alt text-info"></i> Qty</label>
                                <input type="number" step="any" name="det_qty"
                                    class="form-control form-control-sm @error('det_qty') is-invalid @enderror"
                                    required value="{{ old('det_qty') }}">
                                @error('det_qty')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="det_price"><i class="fas fa-dollar-sign text-danger"></i> Price</label>
                                <input type="number" step="any" name="det_price"
                                    class="form-control form-control-sm @error('det_price') is-invalid @enderror"
                                    required value="{{ old('det_price') }}">
                                @error('det_price')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                class="fas fa-times"></i> Cancel</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save
                            Detail</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{-- MODAL EDIT DETAIL --}}
    <div class="modal fade" id="editDetailModal" tabindex="-1" aria-labelledby="editDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editDetailForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="det_uuid" id="edit_det_uuid" value="{{ old('det_uuid') }}">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title" id="editDetailModalLabel"><i class="fas fa-edit mr-2"></i> Edit
                            Detail</h5>
                        <button type="button" class="close text-white" data-dismiss="modal"
                            aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            {{-- Menggunakan nama field yang konsisten --}}
                            <div class="form-group col-md-12">
                                <label for="edit_det_date"><i class="fas fa-calendar-alt text-primary"></i> Order
                                    Date</label>
                                <input type="date" name="det_date" id="edit_det_date"
                                    class="form-control form-control-sm @error('det_date', 'update') is-invalid @enderror"
                                    required value="{{ old('det_date') }}">
                                @error('det_date', 'update')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label for="edit_det_duedate"><i class="fas fa-calendar-check text-success"></i> Due
                                    Date</label>
                                <input type="date" name="det_duedate" id="edit_det_duedate"
                                    class="form-control form-control-sm @error('det_duedate', 'update') is-invalid @enderror"
                                    required value="{{ old('det_duedate') }}">
                                @error('det_duedate', 'update')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label for="edit_det_desc"><i class="fas fa-file-alt text-secondary"></i>
                                    Description</label>
                                <input type="text" id="edit_det_desc" name="det_desc"
                                    class="form-control form-control-sm" readonly value="{{ old('det_desc') }}">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="edit_det_qty"><i class="fas fa-sort-numeric-up-alt text-info"></i>
                                    Qty</label>
                                <input type="number" step="any" name="det_qty" id="edit_det_qty"
                                    class="form-control form-control-sm @error('det_qty', 'update') is-invalid @enderror"
                                    required value="{{ old('det_qty') }}">
                                @error('det_qty', 'update')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12">
                                <label for="edit_det_price"><i class="fas fa-dollar-sign text-danger"></i>
                                    Price</label>
                                <input type="number" step="any" name="det_price" id="edit_det_price"
                                    class="form-control form-control-sm @error('det_price', 'update') is-invalid @enderror"
                                    required value="{{ old('det_price') }}">
                                @error('det_price', 'update')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                class="fas fa-times"></i> Cancel</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save
                            Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            // $("#salesDetTable").DataTable({
            //     lengthMenu: [25, 50, 100],
            //     order: [
            //         [1, "asc"]
            //     ],
            //     scrollY: 300,
            //     scroller: true,
            //     // dom: "lrtip",
            // });

            $('#detailsTable').DataTable({
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                "order": [
                    [1, "asc"]
                ],
                "deferRender": true,
                "scrollX": true,
                "scrollY": 375,
            });

        });
        // Fungsi untuk mengambil deskripsi item (untuk modal tambah)
        const GET_DESC_URL = "{{ $getDescUrl }}";

        function getDesc() {
            let itemId = document.getElementById('addItemSelect').value;
            if (!itemId) return;

            let url = GET_DESC_URL + "/" + itemId;
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('addDesc').value = data.item_desc || '';
                });
        }

        // Event listener untuk tombol edit untuk mengisi modal
        document.addEventListener('DOMContentLoaded', function() {
            $('.editButton').on('click', function(event) {
                event.preventDefault();

                let button = $(this);
                let updateUrl = button.data('update_url');

                // Mengisi data ke dalam form edit
                $('#edit_det_uuid').val(button.data('uuid'));
                $('#edit_det_date').val(button.data('date'));
                $('#edit_det_duedate').val(button.data('due_date'));
                $('#edit_det_desc').val(button.data('desc'));
                $('#edit_det_qty').val(button.data('qty'));
                $('#edit_det_price').val(button.data('price'));

                // Set action form secara dinamis
                $('#editDetailForm').attr('action', updateUrl);
            });

            // Script untuk membuka kembali modal jika ada error validasi
            @if ($errors->any())
                @if ($errors->hasBag('default')) // Error dari form 'Add'
                    $('#modalAddDetail').modal('show');
                @elseif ($errors->hasBag('update')) // Error dari form 'Edit'
                    $('#editDetailModal').modal('show');
                @endif
            @endif
        });
    </script>
@endpush
