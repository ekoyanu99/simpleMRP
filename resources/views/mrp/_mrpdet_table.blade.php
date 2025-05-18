<table class="table table-sm table-hover align-middle w-75">
    <thead class="table-light">
        <tr>
            <th>Tanggal</th>
            <th>Sales</th>
            <th class="text-end">Qty Req</th>
            {{-- <th class="text-end">Stock</th> --}}
            <th class="text-end">MR</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($details as $det)
            <tr>
                <td>{{ $det->mrp_det_date ? formatDateIndo($det->mrp_det_date) : $det->mrp_det_date }}</td>
                <td>{{ $det->mrp_det_sales }}</td>
                <td class="text-end">
                    {{ $det->mrp_det_qtyreq ? formatNumberV2($det->mrp_det_qtyreq) : $det->mrp_det_qtyreq }}
                </td>
                {{-- <td class="text-end">
                    {{ $det->mrp_det_stock ? formatNumberV2($det->mrp_det_stock) : $det->mrp_det_stock }}
                </td> --}}
                <td class="text-end">
                    {{ $det->mrp_det_mr ? formatNumberV2($det->mrp_det_mr) : $det->mrp_det_mr }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
