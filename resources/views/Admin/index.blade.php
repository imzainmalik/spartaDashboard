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
                            <img src="{{ asset('assets/images/mix/icons/1.png') }}" class="img-fluid" alt="">
                        </div>
                        <h6>243,352</h6>
                        <p>TOTAL ASSESSMENTS</p>
                        <div class="tag">
                            <i class="fal fa-arrow-up"></i> +1.23%
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="numberBox">
                        <div class="iconBox">
                            <img src="{{ asset('assets/images/mix/icons/1.png') }}" class="img-fluid" alt="">
                        </div>
                        <h6>243,352</h6>
                        <p>REPORTS GENERATED</p>
                        <div class="tag">
                            <i class="fal fa-arrow-up"></i> +1.23%
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="numberBox">
                        <div class="iconBox">
                            <img src="{{ asset('assets/images/mix/icons/1.png') }}" class="img-fluid" alt="">
                        </div>
                        <h6>243,352</h6>
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
                                            <th>Invoice No.</th>
                                            <th>Customer Name</th>
                                            <th>Date</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>#214314</td>
                                            <td>Jonathan Downing</td>
                                            <td>11/10/2020</td>
                                            <td>email434@domain.com</td>
                                            <td><span class="paid-badge">PAID</span></td>
                                            <td>
                                                <select name="" id="" class="details-btn">
                                                    <option value="">Details</option>
                                                </select>
                                            </td>
                                        </tr>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
