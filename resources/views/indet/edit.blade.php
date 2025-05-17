@extends('layouts.app')

@section('title', 'Purchase Order Detail')

@section('content_header', 'Purchase Order Detail')

@section('content')

    <div class="row">
        <div class="col-md-4 col-sm-12">
            {{-- data header --}}
            <form class="" action="{{ route('PoMstrs.update', $poMstr->po_mstr_id) }}" method="post" autocomplete="off">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <div class="form-row mb-4">
                            <div class="form-group col-md-6">
                                <label for="po_mstr_nbr" class="form-label">
                                    PO Number
                                </label>
                                <input type="text" name="efid_nbr" id="po_mstr_nbr" class="form-control form-control-sm"
                                    placeholder="" required="" value="{{ $poMstr->po_mstr_nbr }}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="po_mstr_vendor" class="form-label">
                                    Vendor
                                </label>
                                <input type="text" name="efid_vendor" id="po_mstr_vendor"
                                    class="form-control form-control-sm" placeholder="" required=""
                                    value="{{ $poMstr->po_mstr_vendor }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="po_mstr_date" class="form-label">
                                    Date Order
                                </label>
                                <input type="date" name="efid_date" id="po_mstr_date"
                                    class="form-control form-control-sm" placeholder="" required=""
                                    value="{{ $poMstr->po_mstr_date }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="po_mstr_delivery_date" class="form-label">
                                    ETD
                                </label>
                                <input type="date" name="efid_delivery" id="po_mstr_delivery_date"
                                    class="form-control form-control-sm" placeholder="" required=""
                                    value="{{ $poMstr->po_mstr_delivery_date }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="po_mstr_arrival_date" class="form-label">
                                    ETA
                                </label>
                                <input type="date" name="efid_arrival" id="po_mstr_arrival_date"
                                    class="form-control form-control-sm" placeholder="" required=""
                                    value="{{ $poMstr->po_mstr_arrival_date }}">
                            </div>

                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary"> <i class="fas fa-save"></i> </button>
                    </div>
                </div>


            </form>
        </div>

        <div class="col-md-8 col-sm-12">
            {{-- data detail --}}
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-12 col-md-4 col-lg-auto mt-1 ">
                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                data-target="#modalAddPoDet">
                                Add New PO Detail
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
                                                        data-url="{{ url('PoDets/' . $poDet->po_det_id) }}"
                                                        data-toggle="modal" data-target="#editModal">
                                                        <i
                                                            class="fas fa-pen
                                                        "></i>
                                                    </button>

                                                    <a href="{{ url('PoDet/' . $poDet->po_det_id . '/delete') }}"
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

    <form action="{{ route('PoDets.store') }}" method="post" autocomplete="off">
        @csrf
        <div class="modal fade" id="modalAddPoDet" tabindex="-1" role="dialog" aria-labelledby="modalAddPoDetTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add New Purchase Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                    ETD
                                </label>
                                <input type="date" name="pod_det_delivery" id="pod_det_delivery"
                                    class="form-control form-control-sm" placeholder="" required=""
                                    value="{{ $poMstr->po_mstr_delivery_date }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="pod_det_arrival" class="form-label">
                                    ETA
                                </label>
                                <input type="date" name="pod_det_arrival" id="pod_det_arrival"
                                    class="form-control form-control-sm" placeholder="" required=""
                                    value="{{ $poMstr->po_mstr_delivery_date }}">
                            </div>


                            <div class="form-group col-md-6">
                                <label for="pod_detitem" class="form-label">
                                    Item
                                </label>

                                <select name="pod_det_item" id="pod_det_item" class="form-control form-control-sm"
                                    required onchange="getDesc()">
                                    <option value="">Select Item</option>
                                    @foreach ($items as $item)
                                        <option value="{{ $item->item_mstr_id }}">{{ $item->item_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="pod_det_desc" class="form-label">
                                    Description
                                </label>
                                <input type="text" name="pod_det_desc" id="pod_det_desc"
                                    class="form-control form-control-sm" readonly required=""
                                    value="{{ old('pod_det_desc') }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="pod_det_qty" class="form-label">
                                    Qty
                                </label>
                                <input type="number" name="pod_det_qty" id="pod_det_qty"
                                    class="form-control form-control-sm" required=""
                                    value="{{ old('pod_det_qty') }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="pod_det_price" class="form-label">
                                    Price
                                </label>
                                <input type="number" name="pod_det_price" id="pod_det_price"
                                    class="form-control form-control-sm" required=""
                                    value="{{ old('pod_det_price') }}">
                            </div>

                            <div class="form-group col-md-12">
                                <label for="pod_det_remarks" class="form-label">
                                    Remarks
                                </label>
                                <input type="text" name="pod_det_remarks" id="pod_det_remarks"
                                    class="form-control form-control-sm" required=""
                                    value="{{ old('pod_det_remarks') }}">
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
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
