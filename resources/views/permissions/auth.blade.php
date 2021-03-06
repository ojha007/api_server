<div class="box-header">
    <h3 class="box-title">Permissions</h3>
</div>
<!-- /.box-header -->
<div class="box-body">
    <table class="table table-bordered table-condensed">
        <tbody>
        <tr>
            <th class="col-md-2"></th>
            <th class="col-md-2 text-center">Full Access</th>
            <th class="col-md-2 text-center">View</th>
            <th class="col-md-2 text-center">Create</th>
            <th class="col-md-2 text-center">Edit</th>
            <th class="col-md-2 text-center">Delete</th>
        </tr>
        @include('permissions.permission_template',['permission_name'=>'user'])
        @include('permissions.permission_template',['permission_name'=>'role'])
        </tbody>
    </table>
</div>


@push('scripts')
    <script>
        $(document).ready(function () {
            $('.full-access').on('ifChanged', function (event) {
                $(this).closest('tr').find('input.view-access').prop('checked', this.checked).iCheck('update');
                $(this).closest('tr').find('input.create-access').prop('checked', this.checked).iCheck('update');
                $(this).closest('tr').find('input.edit-access').prop('checked', this.checked).iCheck('update');
                $(this).closest('tr').find('input.delete-access').prop('checked', this.checked).iCheck('update');
                $(this).closest('tr').find('input.approve-access').prop('checked', this.checked).iCheck('update');
            });
            $('.view-access').on('ifChanged', function (event) {
                if (!this.checked) {
                    $(this).closest('tr').find('input.create-access').prop('checked', this.checked).iCheck('update');
                    $(this).closest('tr').find('input.edit-access').prop('checked', this.checked).iCheck('update');
                    $(this).closest('tr').find('input.delete-access').prop('checked', this.checked).iCheck('update');
                    $(this).closest('tr').find('input.approve-access').prop('checked', this.checked).iCheck('update');
                    $(this).closest('tr').find('input.full-access').prop('checked', this.checked).iCheck('update');
                }
            });
            $('.create-access').on('ifChanged', function (event) {
                if (this.checked) {
                    $(this).closest('tr').find('input.view-access').prop('checked', this.checked).iCheck('update');
                } else {
                    $(this).closest('tr').find('input.edit-access').prop('checked', this.checked).iCheck('update');
                    $(this).closest('tr').find('input.delete-access').prop('checked', this.checked).iCheck('update');
                    $(this).closest('tr').find('input.full-access').prop('checked', this.checked).iCheck('update');
                }
            });
            $('.edit-access').on('ifChanged', function (event) {
                if (this.checked) {
                    $(this).closest('tr').find('input.view-access').prop('checked', this.checked).iCheck('update');
                    $(this).closest('tr').find('input.create-access').prop('checked', this.checked).iCheck('update');
                } else {
                    $(this).closest('tr').find('input.delete-access').prop('checked', this.checked).iCheck('update');
                    $(this).closest('tr').find('input.full-access').prop('checked', this.checked).iCheck('update');
                }
            });
            $('.delete-access').on('ifChanged', function (event) {
                if (this.checked) {
                    $(this).closest('tr').find('input.view-access').prop('checked', this.checked).iCheck('update');
                    $(this).closest('tr').find('input.create-access').prop('checked', this.checked).iCheck('update');
                    $(this).closest('tr').find('input.edit-access').prop('checked', this.checked).iCheck('update');
                    $(this).closest('tr').find('input.full-access').prop('checked', this.checked).iCheck('update');
                } else {
                    $(this).closest('tr').find('input.full-access').prop('checked', this.checked).iCheck('update');
                }
            });

            $('.approve-access').on('ifChanged', function (event) {
                if (this.checked) {
                    $(this).closest('tr').find('input.view-access').prop('checked', this.checked).iCheck('update');
                    fullAccess()
                } else {
                    $(this).closest('tr').find('input.full-access').prop('checked', this.checked).iCheck('update');
                }
            });

            $('.full-access').each(function () {
                if ($(this).closest('tr').find('input.access-permission:checked').length == $(this).closest('tr').find('input.access-permission').length) {
                    $(this).prop('checked', true).iCheck('update');
                }
            });

        });

    </script>
@endpush
