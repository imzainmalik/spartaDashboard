@extends('layouts.admin_app')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.user-management.create',['type'=>'creating_client']) }}" class="themeBtn">Create Clients</a>
            </div>
        </div>
        <div class="card-body">
            <section class="assesSec">
                <div class="container-fluid p-0">
                    <table id="myTable" class="display myTable">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Address 1</th>
                                <th>City</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
@endsection

@push('custom_scripts')
    <script>
        $(function() {

            var table = $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.assessment-management.customers') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'role',
                        name: 'role'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone',
                        name: 'phone'
                    },
                    {
                        data: 'address',
                        name: 'address'
                    },
                    {
                        data: 'address1',
                        name: 'address1'
                    },
                    {
                        data: 'city',
                        name: 'city'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

        });
    </script>
@endpush
