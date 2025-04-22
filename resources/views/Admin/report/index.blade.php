@extends('layouts.admin_app')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.user-management.create') }}" class="themeBtn">Start new Assessment</a>
            </div>
        </div>
        <div class="card-body">
            <section class="assesSec">
                <div class="container-fluid p-0">
                    <table id="myTable" class="display myTable" style="width: 100% !important;">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Customer Name</th>
                                <th>Date</th>
                                <th>Email</th> 
                                <th>Assessment By</th>
                                <th>Risk score</th>
                                <th>Report</th>
                                <th>Edit Assessment</th>
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
                ajax: "{{ route('admin.report.all_report') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },

                    {
                        data: 'cus_name',
                        name: 'cus_name'
                    },
                    {
                        data: 'date_created',
                        name: 'date_created'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'assessment_by',
                        name: 'assessment_by'
                    },
                    {
                        data: 'risk_score',
                        name: 'risk_score'
                    },
                    {
                        data: 'report',
                        name: 'report'
                    }, 
                    {
                        data: 'action',
                        name: 'action'
                    }, 
                    
                ]
            });

        });
    </script>
@endpush
