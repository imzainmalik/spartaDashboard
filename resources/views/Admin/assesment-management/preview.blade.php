@extends('layouts.admin_app')
@section('content')
    @push('custom_styles')
        <style>
            .risk-meter {
                font-family: Arial, sans-serif;
                padding: 30px;
                text-align: center;
                position: relative;
                width: 400px;
                height: 40px;
                background: linear-gradient(to right, #90ee90, #ffff00, #ffa500, #ff0000);
                border-radius: 5px;
                margin: 30px auto 10px auto;
            }

            .risk-arrow {
                position: absolute;
                top: -9px;
                width: 0;
                height: 0;
                border-left: 10px solid transparent;
                border-right: 10px solid transparent;
                border-bottom: 20px solid black;
                transition: left 0.3s ease;
                transform: rotate(180deg);
            }

            .risk-labels {
                display: flex;
                justify-content: space-between;
                width: 400px;
                margin: 10px auto;
                font-size: 14px;
            }

            select {
                padding: 6px 12px;
                font-size: 16px;
                margin-bottom: 20px;
            }
        </style>
    @endpush
    <div class="scrollSec">
        <section class="reportGeneration">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <h3>Report Preview</h3>
                        <div class="card">
                            <div class="card header">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="Customer-tab" data-bs-toggle="tab"
                                            data-bs-target="#Customer" type="button" role="tab"
                                            aria-controls="Customer" aria-selected="true">
                                            Customer Details
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="Perimeter-tab" data-bs-toggle="tab"
                                            data-bs-target="#Perimeter" type="button" role="tab"
                                            aria-controls="Perimeter" aria-selected="true">
                                            Perimeter Security
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="Entry-tab" data-bs-toggle="tab" data-bs-target="#Entry"
                                            type="button" role="tab" aria-controls="Entry" aria-selected="false">
                                            Entry Points
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="Lighting-tab" data-bs-toggle="tab"
                                            data-bs-target="#Lighting" type="button" role="tab"
                                            aria-controls="Lighting" aria-selected="false">
                                            Lighting & Cameras
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="Interior-tab" data-bs-toggle="tab"
                                            data-bs-target="#Interior" type="button" role="tab"
                                            aria-controls="Interior" aria-selected="false">
                                            Interior Security
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="Emergency-tab" data-bs-toggle="tab"
                                            data-bs-target="#Emergency" type="button" role="tab"
                                            aria-controls="Emergency" aria-selected="false">
                                            Emergency Preparedness
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="score-tab" data-bs-toggle="tab" data-bs-target="#score"
                                            type="button" role="tab" aria-controls="score" aria-selected="false">
                                            Scoring
                                        </button>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="myTabContent">

                                    <div class="tab-pane fade show active" id="Customer" role="tabpanel"
                                        aria-labelledby="Customer-tab">

                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h4>Customer Details</h4>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row py-4">
                                                <div class="col-md-6">
                                                    <h5>Customer Name</h5>
                                                </div>
                                                <div class="col-md-6 text-end">
                                                    <h5>{{ $customers->f_name . $customers->l_name }}</h5>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h5>Customer Email</h5>
                                                </div>
                                                <div class="col-md-6 text-end">
                                                    <h5>{{ $customers->email }}</h5>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h5>Customer Phone</h5>
                                                </div>
                                                <div class="col-md-6 text-end">
                                                    <h5>{{ $customers->phone }}</h5>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h5>Customer Address</h5>
                                                </div>
                                                <div class="col-md-6 text-end">
                                                    <h5>{{ $customers->address }}</h5>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h5>Customer City</h5>
                                                </div>
                                                <div class="col-md-6 text-end">
                                                    <h5>{{ $customers->city }}</h5>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h5>Customer State</h5>
                                                </div>
                                                <div class="col-md-6 text-end">
                                                    <h5>{{ $customers->state }}</h5>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h5>Customer Zip</h5>
                                                </div>
                                                <div class="col-md-6 text-end">
                                                    <h5>{{ $customers->zip }}</h5>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="Perimeter" role="tabpanel"
                                        aria-labelledby="Perimeter-tab">
                                        <div class="qustion">
                                            <ul>
                                                @php
                                                    $index = 1;
                                                @endphp
                                                @foreach ($types as $type)
                                                    @if ($type->id == 1)
                                                        @foreach ($type->questions as $question)
                                                            <li>Q{{ $index++ }}:
                                                                &nbsp;<strong>{{ $question->question }}</strong></li>
                                                            @foreach ($question->fillups as $item)
                                                                <li style="margin-left: 19px;padding: 10px;">
                                                                    {{ $item->answer->ans_text }}
                                                                </li>
                                                            @endforeach
                                                            <hr>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </ul>

                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="Entry" role="tabpanel"
                                        aria-labelledby="Entry-tab">
                                        @php
                                            $index = 1;
                                        @endphp
                                        @foreach ($types as $type)
                                            @if ($type->id == 2)
                                                @foreach ($type->questions as $question)
                                                    <li>Q{{ $index++ }}:
                                                        &nbsp;<strong>{{ $question->question }}</strong></li>
                                                    @foreach ($question->fillups as $item)
                                                        <li style="margin-left: 19px;padding: 10px;">
                                                            {{ $item->answer->ans_text }}
                                                        </li>
                                                    @endforeach
                                                    <hr>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="tab-pane fade" id="Lighting" role="tabpanel"
                                        aria-labelledby="Lighting-tab">
                                        @php
                                            $index = 1;
                                        @endphp
                                        @foreach ($types as $type)
                                            @if ($type->id == 3)
                                                @foreach ($type->questions as $question)
                                                    <li>Q{{ $index++ }}:
                                                        &nbsp;<strong>{{ $question->question }}</strong></li>
                                                    @foreach ($question->fillups as $item)
                                                        <li style="margin-left: 19px;padding: 10px;">
                                                            {{ $item->answer->ans_text }}
                                                        </li>
                                                    @endforeach
                                                    <hr>
                                                @endforeach
                                            @endif
                                        @endforeach

                                    </div>
                                    <div class="tab-pane fade" id="Interior" role="tabpanel"
                                        aria-labelledby="Interior-tab">
                                        @php
                                            $index = 1;
                                        @endphp
                                        @foreach ($types as $type)
                                            @if ($type->id == 4)
                                                @foreach ($type->questions as $question)
                                                    <li>Q{{ $index++ }}:
                                                        &nbsp;<strong>{{ $question->question }}</strong></li>
                                                    @foreach ($question->fillups as $item)
                                                        <li style="margin-left: 19px;padding: 10px;">
                                                            {{ $item->answer->ans_text }}
                                                        </li>
                                                    @endforeach
                                                    <hr>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="tab-pane fade" id="Emergency" role="tabpanel"
                                        aria-labelledby="Emergency-tab">
                                        @php
                                            $index = 1;
                                        @endphp
                                        @foreach ($types as $type)
                                            @if ($type->id == 5)
                                                @foreach ($type->questions as $question)
                                                    <li>Q{{ $index++ }}:
                                                        &nbsp;<strong>{{ $question->question }}</strong></li>
                                                    @foreach ($question->fillups as $item)
                                                        <li style="margin-left: 19px;padding: 10px;">
                                                            {{ $item->answer->ans_text }}
                                                        </li>
                                                    @endforeach
                                                    <hr>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="tab-pane fade" id="score" role="tabpanel"
                                        aria-labelledby="score-tab">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h4>Scoring</h4>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row py-4">
                                                <div class="col-md-6">
                                                    <h5>Perimeter Security</h5>
                                                </div>
                                                <div class="col-md-6 text-end">
                                                    <h5>Score: {{ $assement_notes[0]->scoring }}</h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h5>Entry Points</h5>
                                                </div>
                                                <div class="col-md-6 text-end">
                                                    <h5>Score: {{ $assement_notes[1]->scoring }}</h5>
                                                </div>
                                            </div>
                                            <div class="row py-4">
                                                <div class="col-md-6">
                                                    <h5>Lighting &amp; Cameras</h5>
                                                </div>
                                                <div class="col-md-6 text-end">
                                                    <h5>Score: {{ $assement_notes[2]->scoring }} </h5>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h5>Interior Security</h5>
                                                </div>
                                                <div class="col-md-6 text-end">
                                                    <h5>Score: {{ $assement_notes[3]->scoring }}</h5>
                                                </div>
                                            </div>
                                            <div class="row py-4">
                                                <div class="col-md-6">
                                                    <h5>Emergency Preparedness</h5>
                                                </div>
                                                <div class="col-md-6 text-end">
                                                    <h5>Score: {{ $assement_notes[4]->scoring }}</h5>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row py-4">
                                                <div class="col-md-6">
                                                    <h5><strong>Overall Scoring</strong></h5>
                                                </div>
                                                <div class="col-md-6 text-end">
                                                    <h5>Score: {{ $assement_notes->avg('scoring') }}</h5>
                                                </div>
                                            </div>
                                            @php
                                                $riskPercentage = (1 - $assement_notes->avg('scoring') / 5.0) * 100;
                                            @endphp

                                            <div class="container">
                                                <div class="risk-meter">
                                                    <div class="risk-arrow" id="arrow"
                                                        style="left: {{ $riskPercentage }}%;"></div>
                                                </div>

                                                <div class="risk-labels">
                                                    <span>No risk</span>
                                                    <span>Low risk</span>
                                                    <span>Medium risk</span>
                                                    <span>High risk</span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="andwerBoxs reportBox">
                            <div class="container">
                                <h4>Perimeter Security:</h4>
                                <p>{{ $assement_notes[0]->security_notes }} </p>
                                <br>
                                <h6>Perimeter Security File:</h6>
                                <p>
                                    <a href="{{ asset($assement_notes[0]->file) }}"
                                        target="_blank">{{ basename($assement_notes[0]->file) }}</a>

                                </p>
                            </div>


                            <div class="container">
                                <h4>Entry Points</h4>
                                <p>{{ $assement_notes[1]->security_notes }}</p>
                                <br>
                                <h6>Entry Points File</h6>
                                <p>
                                    <a href="{{ asset($assement_notes[1]->file) }}"
                                        target="_blank">{{ basename($assement_notes[1]->file) }}</a>

                                </p>
                            </div>

                            <div class="container">
                                <h4>Lighting &amp; Cameras</h4>
                                <p>{{ $assement_notes[2]->security_notes }}</p>
                                <br>
                                <h6>Entry Points File</h6>
                                <p>
                                    <a href="{{ asset($assement_notes[2]->file) }}"
                                        target="_blank">{{ basename($assement_notes[2]->file) }}
                                    </a>
                                </p>
                            </div>

                            <div class="container">
                                <h4>Interior Security</h4>
                                <p>{{ $assement_notes[3]->security_notes }}</p>
                                <br>
                                <h6>Entry Points File</h6>
                                <p>
                                    <a href="{{ asset($assement_notes[3]->file) }}"
                                        target="_blank">{{ basename($assement_notes[3]->file) }}</a>
                                </p>

                            </div>
                            <div class="container">
                                <h4>Emergency Preparedness</h4>
                                <p>{{ $assement_notes[4]->security_notes }}</p>
                                <br>
                                <h6>Entry Points File</h6>
                                <p>
                                    <a href="{{ asset($assement_notes[4]->file) }}"
                                        target="_blank">{{ basename($assement_notes[4]->file) }}</a>

                                </p>
                            </div>
                            <br>
                        </div>
                        <div class="reportBtns">
                            <a href="{{ route('admin.assessment-management.donwload_pdf_report', $assement_no) }}"
                                class="themeBtn"><i class="fal fa-file-download"></i>Download PDF</a>
                            <form method="post" action="{{ route('send.report', $assement_no) }}">
                                @csrf
                                <label>Send to Client</label>
                                <input type="text" name="client_email" required placeholder="Email">
                                <button class="themeBtn" type="submit">Send</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('custom_scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
@endpush
