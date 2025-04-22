@extends('layouts.admin_app')
@section('content')
<section class="assesSec">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-md-12 text-right">
                <a href="new-threat-assessment.php" class="themeBtn">Start New Assessment</a>
            </div>
            <div class="col">
                <div class="numberBox">
                    <div class="iconBox">
                        <img src="{{ asset('assets/images/mix/icons/1.png') }}"
                            class="img-fluid" alt="">
                    </div>
                    <h6>{{ $total_assessment }}</h6>
                    <p>TOTAL ASSESSMENTS</p>
                    <div class="tag">
                        <i class="fal fa-arrow-up"></i> +1.23%
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="numberBox">
                    <div class="iconBox">
                        <img src="{{ asset('assets/images/mix/icons/1.png') }}"
                            class="img-fluid" alt="">
                    </div>
                    <h6>{{ $ReportGenrated }}</h6>
                    <p>REPORTS GENERATED</p>
                    <div class="tag">
                        <i class="fal fa-arrow-up"></i> +1.23%
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="numberBox">
                    <div class="iconBox">
                        <img src="{{ asset('assets/images/mix/icons/1.png') }}"
                            class="img-fluid" alt="">
                    </div>
                    <h6>{{ $new_customer }}</h6>
                    <p>NEW CUSTOMER</p>
                    <div class="tag">
                        <i class="fal fa-arrow-up"></i> +1.23%
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pt-0">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-md-12">
                <div class="tableBox">
                    <div class="table-container">
                        <div class="table-header">
                            <h2>Latest assessments</h2>
                            <button class="themeBtn">
                                <i class="far fa-file-download"></i> Generate Report
                            </button>
                        </div>
                        <div class="tableScroll">
                            <table>
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Customer Name</th>
                                        <th>Date</th>
                                        <th>Email</th>
                                        <th>Assessment By</th>
                                        <th>Risk score</th>
                                        <th>Report</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($latest_assessment->count() > 0)
                                        @php
                                            $index = 1;
                                        @endphp
                                        @foreach($latest_assessment as $assessment)
                                            {{-- @dd($assessment->assessment_riskscore->avg('scoring')); --}}
                                            <tr>
                                                <td>{{ $index ++ }}</td>
                                                <td>{{ $assessment->customer->f_name .' '.$assessment->customer->l_name }}
                                                </td>
                                                <td>{{ $assessment->created_at->diffForHumans() }}</td>
                                                <td>{{ $assessment->customer->email }}</td>
                                                <td>{{ $assessment->assessment_by->name .' ('. $assessment->assessment_by->email .')' }}
                                                </td>
                                                <td>{{ round($assessment->assessment_riskscore->avg('scoring')) }}
                                                </td>
                                                @if($assessment->assessment_report)
                                                    <td><a href="{{ asset($assessment->assessment_report->report_file ?? '') }}"
                                                            _blank>Download report</a></td>
                                                @else
                                                    <td>No report generated</td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>No result found.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection
