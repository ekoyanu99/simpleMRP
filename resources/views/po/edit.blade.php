@extends('layouts.app')

@section('title', 'Purchase Order Detail')

@section('content_header', 'Purchase Order Detail')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-sm-12">
                {{-- data header --}}
                <form class="" action="{{ route('PoMstrs.update', $poMstr->po_mstr_id) }}" method="post"
                    autocomplete="off">
                    @csrf
                    @method('PUT')
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-receipt"></i> Data Purchase Order</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="po_mstr_nbr" class="form-label">
                                    <i class="fas fa-hashtag text-info"></i>
                                    PO Number
                                </label>
                                <input type="text" name="efid_nbr" id="po_mstr_nbr" class="form-control form-control-sm"
                                    placeholder="" required="" value="{{ $poMstr->po_mstr_nbr }}">
                            </div>
                            <div class="form-group">
                                <label for="po_mstr_vendor" class="form-label">
                                    <i class="fas fa-user text-purple"></i> Vendor
                                </label>
                                <input type="text" name="efid_vendor" id="po_mstr_vendor"
                                    class="form-control form-control-sm" placeholder="" required=""
                                    value="{{ $poMstr->po_mstr_vendor == '1' ? 'Toko Bahan Kue "Berkah Jaya"' : 'Toko Bahan Kue "Sinar Jaya"' }}">
                            </div>

                            <div class="form-group">
                                <label for="po_mstr_date" class="form-label">
                                    <i class="fas fa-calendar-alt text-primary"></i> Date Order
                                </label>
                                <input type="date" name="efid_date" id="po_mstr_date"
                                    class="form-control form-control-sm" placeholder="" required=""
                                    value="{{ $poMstr->po_mstr_date }}">
                            </div>

                            <div class="form-group">
                                <label for="po_mstr_delivery_date" class="form-label">
                                    <i class="fas fa-calendar-check text-success"></i> ETD
                                </label>
                                <input type="date" name="efid_delivery" id="po_mstr_delivery_date"
                                    class="form-control form-control-sm" placeholder="" required=""
                                    value="{{ $poMstr->po_mstr_delivery_date }}">
                            </div>

                            <div class="form-group">
                                <label for="po_mstr_arrival_date" class="form-label">
                                    <i class="fas fa-calendar-check text-success"></i> ETA
                                </label>
                                <input type="date" name="efid_arrival" id="po_mstr_arrival_date"
                                    class="form-control form-control-sm" placeholder="" required=""
                                    value="{{ $poMstr->po_mstr_arrival_date }}">
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-save"></i> Save
                                Changes</button>
                            <a href="{{ route('PoMstrs.index') }}" class="btn btn-secondary"><i
                                    class="fas fa-times-circle"></i> Cancel</a>
                        </div>
                    </div>

                </form>
            </div>

            <div class="col-md-8 col-sm-12">
                {{-- data detail --}}
                <div class="card card-outline card-secondary">
                    <div class="card-header">
                        <div
                            class="d-flex justify-content-between align-items-center flex-column flex-md-row text-md-start text-center w-100">
                            <h3 class="card-title m-0 mb-2 mb-md-0"><i class="fas fa-list-alt"></i> PO Detail
                            </h3>
                            <div class="card-tools m-0">
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#modalAddPoDet">
                                    <i class="fas fa-plus-circle mr-1"></i> Add New PO Detail
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">

                            <table class="table table-bordered table-striped table-hover" id="poDetTable">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">No</th>
                                        <th style="width: 30%;">Purchase Number</th>
                                        <th style="width: 15%;">Item</th>
                                        <th>Desc</th>
                                        <th style="width: 5%;">Qty</th>
                                        <th style="width: 5%;">Price</th>
                                        <th style="width: 10%;">Total</th>
                                        <th style="width: 6%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($poMstr->poDet as $poDet)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $poMstr->po_mstr_nbr }}</td>
                                            <td>{{ $poDet->itemMstr->item_name }}</td>
                                            <td>{{ $poDet->pod_det_desc }}</td>
                                            <td>{{ $poDet->pod_det_qty ? formatNumberV2($poDet->pod_det_qty) : $poDet->pod_det_qty }}
                                            </td>
                                            <td>{{ $poDet->pod_det_price ? formatCurrency($poDet->pod_det_price) : $poDet->pod_det_price }}
                                            </td>
                                            <td>{{ $poDet->pod_det_qty * $poDet->pod_det_price ? formatCurrency($poDet->pod_det_qty * $poDet->pod_det_price) : $poDet->pod_det_qty * $poDet->pod_det_price }}
                                            </td>
                                            <td>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-sm btn-info editButton"
                                                            data-id="{{ $poDet->pod_det_id }}" {{-- data-etd="{{ $poDet->pod_det_delivery }}"
                                                        data-eta="{{ $poDet->pod_det_arrival }}" --}}
                                                            data-item="{{ $poDet->pod_det_item }}"
                                                            data-desc="{{ $poDet->pod_det_desc }}"
                                                            data-qty="{{ $poDet->pod_det_qty }}"
                                                            data-price="{{ $poDet->pod_det_price }}"
                                                            data-url="{{ url('PoDets/' . $poDet->pod_det_uuid) }}"
                                                            data-uuid="{{ $poDet->pod_det_uuid }}" data-toggle="modal"
                                                            data-target="#editModal">
                                                            <i
                                                                class="fas fa-pen
                                                        "></i>
                                                        </button>

                                                        <a href="{{ url('PoDet/' . $poDet->pod_det_uuid . '/delete') }}"
                                                            class="btn btn-sm btn-danger rounded"><i class="fas fa-trash"
                                                                aria-hidden="true"></i></a>
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
            </div>

        </div>
    </div>

    <form action="{{ route('PoDets.store') }}" method="post" autocomplete="off">
        @csrf
        <div class="modal fade" id="modalAddPoDet" tabindex="-1" role="dialog" aria-labelledby="modalAddPoDetTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="modalAddPoDetTitle"><i class="fas fa-plus-circle mr-2"></i> Add
                            PO Detail</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row mb-4">

                            <div class="form-group col-md-6 d-none">
                                <label for="pod_det_mstr" class="form-label">
                                    pod_det_mstr
                                </label>
                                <input type="text" name="pod_det_mstr" id="pod_det_mstr"
                                    class="form-control form-control-sm" readonly required=""
                                    value="{{ $poMstr->po_mstr_id }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="pod_det_delivery" class="form-label">
                                    <i class="fas fa-calendar-check text-success"></i> ETD
                                </label>
                                <input type="date" name="pod_det_delivery" id="pod_det_delivery"
                                    class="form-control form-control-sm" placeholder="" required=""
                                    value="{{ $poMstr->po_mstr_delivery_date }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="pod_det_arrival" class="form-label">
                                    <i class="fas fa-calendar-check text-success"></i> ETA
                                </label>
                                <input type="date" name="pod_det_arrival" id="pod_det_arrival"
                                    class="form-control form-control-sm" placeholder="" required=""
                                    value="{{ $poMstr->po_mstr_delivery_date }}">
                            </div>


                            <div class="form-group col-md-6">
                                <label for="pod_detitem" class="form-label">
                                    <i class="fas fa-box text-purple"></i> Item
                                </label>

                                <x-adminlte-select2 name="pod_det_item" id="pod_det_item" onchange="getDesc()"
                                    data-dropdown-parent="#modalAddPoDet">
                                    <option value="">Select an item</option>
                                    @foreach ($items as $item)
                                        <option value="{{ $item->item_id }}">{{ $item->item_name }}</option>
                                    @endforeach
                                </x-adminlte-select2>

                            </div>

                            <div class="form-group col-md-6">
                                <label for="pod_det_desc" class="form-label">
                                    <i class="fas fa-file-alt text-secondary"></i> Description
                                </label>
                                <input type="text" name="pod_det_desc" id="pod_det_desc"
                                    class="form-control form-control-sm" readonly required=""
                                    value="{{ old('pod_det_desc') }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="pod_det_qty" class="form-label">
                                    <i class="fas fa-sort-numeric-up-alt text-info"></i>
                                    Qty
                                </label>
                                <input type="number" name="pod_det_qty" id="pod_det_qty"
                                    class="form-control form-control-sm" required=""
                                    value="{{ old('pod_det_qty') }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="pod_det_price" class="form-label">
                                    <i class="fas fa-dollar-sign text-danger"></i>
                                    Price
                                </label>
                                <input type="number" name="pod_det_price" id="pod_det_price"
                                    class="form-control form-control-sm" required=""
                                    value="{{ old('pod_det_price') }}">
                            </div>

                            <div class="form-group col-md-12">
                                <label for="pod_det_remarks" class="form-label">
                                    <i class="fas fa-comment-dots text-muted"></i> Remarks
                                </label>
                                <input type="text" name="pod_det_remarks" id="pod_det_remarks"
                                    class="form-control form-control-sm" required=""
                                    value="{{ old('pod_det_remarks') }}">
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                class="fas fa-times"></i> Cancel</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Detail</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit PO Detail</h5>
                        <button type="button" class="btn btn-sm btn-close" data-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">

                            <div class="form-group col-md-12">
                                <label for="efid_Qty" class="form-label">Qty</label>
                                <input type="number" name="pod_det_qty" id="efid_Qty"
                                    class="form-control form-control-sm w-100" required>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="efid_Price" class="form-label">Price</label>
                                <input type="number" name="pod_det_price" id="efid_Price"
                                    class="form-control form-control-sm w-100" required>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@push('styles')
@endpush

@push('scripts')
    <script>
        getDesc = () => {
            let item_id = document.getElementById('pod_det_item').value;
            console.log(item_id);
            let url = "{{ url('GetDesc') }}/" + item_id;
            console.log(url);
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('pod_det_desc').value = data.item_desc;
                });
        }
    </script>
    {{-- <script>
        getDesc = () => {
            let item_id = document.getElementById('pod_det_item').value;
            console.log(item_id);
            let url = "{{ url('GetDesc') }}/" + encodeURIComponent(item_id);
            console.log(url);

            // Get CSRF token from meta tag
            let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch(url, {
                    headers: {
                        'X-CSRF-TOKEN': token
                    }
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('pod_det_desc').value = data.item_desc;
                })
                .catch(error => console.error('Error:', error));
        }
    </script> --}}
    <script src="{{ asset('js/poDet/poDet.js') }}"></script>
    <script src="{{ asset('js/poDet/updateModal.js') }}"></script>
@endpush
