<td class="text-center">
    <div class="btn-group" role="group">

        <a href="UserMstrs/{{ $id }}/edit" class="btn btn-sm btn-info" title="Edit">
            <i class="fas fa-edit fa-xs"></i>
        </a>

        @role('superadmin')
            <a href="UserMstr/{{ $id }}/delete" class="btn btn-sm btn-danger" title="Delete">
                <i class="fas fa-trash-alt fa-xs"></i>
            </a>
        @endrole
    </div>
</td>
