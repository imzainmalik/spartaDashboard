@extends('layouts.admin_app')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.user-management.index') }}" class="themeBtn">All User</a>
            </div>
        </div>
        <div class="card-body">
            <section class="assesSec">
                <div class="container-fluid p-0">
                    <form action="{{ route('admin.user-management.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            @if ($request->type != 'creating_client')
                                <div class="col-md-12">
                                    <label for="">User type</label>
                                    <select type="text" name="user_type" required class="form-control">
                                        <option value="" disabled selected>Select user type</option>
                                        <option value="0">Admin</option>
                                        <option value="1">Employee</option>
                                        <option value="2">Customer</option>
                                    </select>
                                </div>
                            @else
                                <input type="hidden" name="user_type" value="2">
                            @endif
                            <div id="main_form_div" class="col-md-12 row py-4">
                                <div class="col-md-6">
                                    <label for="">First Name</label>
                                    <input type="text" name="f_name" class="form-control" required
                                        placeholder="Enter Name">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Last Name</label>
                                    <input type="text" name="l_name" class="form-control" required
                                        placeholder="Enter Name">
                                </div>
                                <div class="col-md-6 py-4">
                                    <label for="">Email</label>
                                    <input type="email" name="email" class="form-control" required
                                        placeholder="Enter Email">
                                </div>
                                <div class="col-md-6 py-4">
                                    <label for="">Phone</label>
                                    <input type="text" name="phone" class="form-control" required
                                        placeholder="Enter Phone">
                                </div>
                                <div class="col-md-6  py-4">
                                    <label for="">Address</label>
                                    <input type="text" name="address" class="form-control" required
                                        placeholder="Enter Address">
                                </div>
                                <div class="col-md-6 py-4">
                                    <label for="">Address 1</label>
                                    <input type="text" name="address1" required class="form-control"
                                        placeholder="Enter Address 1">
                                </div>
                                <div class="col-md-6 py-4">
                                    <label for="">City</label>
                                    <input type="text" name="city" class="form-control" required
                                        placeholder="Enter City">
                                </div>
                                <div class="col-md-6 py-4">
                                    <label for="">State</label>
                                    <input type="text" name="state" class="form-control" required
                                        placeholder="Enter State">
                                </div>
                                <div class="col-md-6 py-4">
                                    <label for="">Zip</label>
                                    <input type="text" name="zip" class="form-control" required
                                        placeholder="Enter Zip">
                                </div>
                            </div>
                            @if ($request->type != 'creating_client')
                            <div id="employe_form" class="col-md-12 row py-4">
                                <div class="col-md-6">
                                    <label for="">First Name</label>
                                    <input type="text" name="employee_f_name" class="form-control" required
                                        placeholder="Enter Name">
                                </div>
                                <div class="col-md-6">
                                    <label for="">Last Name</label>
                                    <input type="text" name="employee_l_name" class="form-control" required
                                        placeholder="Enter Name">
                                </div>
                                <div class="col-md-6 py-4">
                                    <label for="">Email</label>
                                    <input type="email" name="employee_email" class="form-control" required
                                        placeholder="Enter Email">
                                </div>
                                <div class="col-md-6 py-4">
                                    <label for="">Password</label>
                                    <input type="password" name="password" class="form-control" required
                                        placeholder="Enter password">
                                </div>
                                <div class="col-md-6 py-4">
                                    <label for="">Profile Avatar</label>
                                    <input type="file" name="profile_avatar" class="form-control" required
                                        placeholder="Enter password">
                                </div>
                            </div>
                            @endif
                            <div class="col-md-6 py-4">
                                <button class="themeBtn">Create User</button>
                            </div>

                    </form>
                </div>
            </section>
        </div>
    </div>
@endsection
@push('custom_scripts')
    <script>
        $(document).ready(function() {
            @if ($request->type == 'creating_client')
                $('#main_form_div').show();
                $('#employe_form').hide();
            @else
                $('#main_form_div').hide();
                $('#employe_form').hide();
            @endif
            $('select[name="user_type"]').on('change', function() {
                var user_type = $(this).val();
                if (user_type == 2) {
                    $('#main_form_div input').attr('required', 'required');
                    $('#employe_form input').removeAttr('required');

                    $('#main_form_div').show();
                    $('#employe_form').hide();
                } else {
                    $('#main_form_div input').removeAttr('required');
                    $('#employe_form input').attr('required', 'required');
                    $('#main_form_div').hide();
                    $('#employe_form').show();

                }
            });
        });
    </script>
@endpush
