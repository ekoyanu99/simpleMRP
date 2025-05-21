<td class="text-center">
    <div class="btn-group" role="group">
        <!-- Permission Button -->
        <a href="{{ url('RoleMstr/' . $id . '/give-permission') }}" class="btn btn-xs btn-flat"
            style="background-color: #86BAC1; color: white;" title="Manage Permissions">
            <i class="fas fa-user-shield fa-sm"></i>
        </a>

        <!-- Edit Button -->
        <button type="button" data-id="{{ $id }}" data-name="{{ $name }}"
            data-url="{{ url('RoleMstrs/' . $id) }}" class="btn btn-xs btn-flat btn-info editButton" data-toggle="modal"
            data-target="#editModal" title="Edit Role">
            <i class="fas fa-edit fa-sm"></i>
        </button>

        <!-- Delete Button -->
        <a href="RoleMstr/{{ $id }}/delete" class="btn btn-xs btn-flat btn-danger"
            onclick="return confirm('Are you sure?')" title="Delete Role">
            <i class="fas fa-trash-alt fa-sm"></i>
        </a>
    </div>
</td>
