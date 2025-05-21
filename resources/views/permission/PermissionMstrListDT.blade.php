    <td style="text-align: center">
        <div class="input-group justify-content-center">
            <div class="input-group-prepend">
                <button type="button" data-id="{{ $id }}" data-name = "{{ $name }}"
                    data-desc="{{ $permission_mstr_desc }}" data-url="{{ url('PermissionMstrs/' . $id) }}"
                    data-bs-toggle="modal" data-bs-target="#editModal"
                    class="btn btn-small rounded btn-info editButton"><i class="fa-solid fa-pen-to-square"
                        style="font-size: 12px"></i></button>
                <a href="PermissionMstr/{{ $id }}/delete" class="btn btn-small rounded btn-danger"><i
                        class="fa fa-trash" style="font-size: 12px"></i></a>
            </div>
        </div>
    </td>
