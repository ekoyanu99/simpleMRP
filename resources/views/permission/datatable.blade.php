<td class="text-center">
    <div class="btn-group" role="group">

        <!-- Edit Button -->
        <button type="button" data-id="{{ $id }}" data-name="{{ $name }}"
            data-url="{{ url('PermissionMstrs/' . $id) }}" class="btn btn-xs btn-flat btn-info editButton"
            data-toggle="modal" data-target="#editModal" title="Edit Permission">
            <i class="fas fa-edit fa-sm"></i>
        </button>

        <!-- Delete Button -->
        <a href="PermissionMstr/{{ $id }}/delete" class="btn btn-xs btn-flat btn-danger"
            onclick="return confirm('Are you sure?')" title="Delete Role">
            <i class="fas fa-trash-alt fa-sm"></i>
        </a>
    </div>
</td>
