@extends('layouts.admin_app')
@section('content')
    @push('custom_styles')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link href="{{ asset('assets/rating/star-rating.css') }}" rel="stylesheet" />
        <style>
            .is-invalid {
                border-color: #dc3545;
            }
        </style>
    @endpush
    <div class="card">
        <div class="card-body">
            <div class="alert alert-danger" id="error" style="display: none;">Please fill out form.</div>
            <form action="" method="post" id="main-form" class="needs-validation" novalidate
                enctype="multipart/form-data">
                {{-- <input type="hidden" id="token" value="{{ csrf_token() }}"> --}}
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <label for="name">Select Customer</label>
                        <select class="customjs-select2 form-control" name="cutomer" required disabled>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}" @if($fillups->customer_id == $customer->id) selected @endif>
                                    {{ $customer->f_name . ' ' . $customer->l_name . ' (' . $customer->email . ')' }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <section class="bodrBox silverBox">
                    <div class="container">
                        <div class="step-container d-flex">
                            <div class="step active" data-step="1">
                                <div class="circle">1</div>
                                <p>Perimeter Security</p>
                            </div>
                            <div class="step" data-step="2">
                                <div class="circle">2</div>
                                <p>Entry Points</p>
                            </div>
                            <div class="step" data-step="3">
                                <div class="circle">3</div>
                                <p>Lighting &amp; Cameras</p>
                            </div>
                            <div class="step" data-step="4">
                                <div class="circle">4</div>
                                <p>Interior Security</p>
                            </div>
                            <div class="step" data-step="5">
                                <div class="circle">5</div>
                                <p>Emergency Preparedness</p>
                            </div>
                        </div>
                        <div class="step-content active" data-step="1">
                            <div class="leadForm">

                                <div class="row">
                                    <div class="col-md-3">

                                        @if ($questions->count() > 0)
                                            @foreach ($questions as $question)
                                                <div class="radioSec">
                                                    <p>{{ $question->question }}</p>
                                                    @if ($question->answerOption != null)
                                                        @php
                                                            $index = 0;
                                                        @endphp

                                                        @foreach ($question->answerOption as $option)
                                                            @php 
                                                                $index++;
                                                                $fillup_answers = App\Models\AssementFillup::where('assement_no',$assessment_no)
                                                                ->where('answer_id', $option->id)->first();
                                                            @endphp
                                                            @if ($option->ans_input_type == 0)
                                                                @if ($option->ans_text != null)
                                                                    <input type="radio" required
                                                                        id="option_{{ $option->id . '_' . $index }}"
                                                                        name="answer[{{ $question->id }}]"
                                                                        value="{{ $option->id }}"
                                                                        class="form form-check-input"
                                                                        @if($fillup_answers->answer_id ?? '' == $option->id) checked @endif>
                                                                    <label
                                                                        for="option_{{ $option->id . '_' . $index }}">{{ $option->ans_text }}</label>
                                                                    &nbsp; &nbsp;
                                                                    <div class="invalid-feedback">Please select an option.
                                                                    </div>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                        @if ($option->ans_input_type == 1) 
                                                            <select class="form-control" name="answer[{{ $question->id }}]"
                                                                required>
                                                                <option value="" disabled selected>Select</option>
                                                                @foreach ($question->answerOption as $option)
                                                                @php  
                                                                $fillup_answers = App\Models\AssementFillup::where('assement_no',$assessment_no)
                                                                ->where('answer_id', $option->id)->first();
                                                            @endphp
                                                                    <option value="{{ $option->id }}" @if($fillup_answers->answer_id ?? '' == $option->id) selected @endif>
                                                                        {{ $option->ans_text }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <div class="invalid-feedback">Please select an option.</div>
                                                        @endif
                                                    @endif
                                                </div>
                                            @endforeach
                                        @endif

                                        <select class="star-rating py-4" name="scoring[{{ $question->type_id }}]"
                                            id="scoring" required>
                                            <option value="">Rate High to Low</option>
                                            <option value="5" @if($assement_notes[0]->scoring == 5) selected @endif>High</option>
                                            <option value="4" @if($assement_notes[0]->scoring == 4) selected @endif>Medium</option>
                                            <option value="3" @if($assement_notes[0]->scoring == 3) selected @endif>Medium</option>
                                            <option value="2" @if($assement_notes[0]->scoring == 2) selected @endif>Low</option>
                                            <option value="1" @if($assement_notes[0]->scoring == 1) selected @endif>Low</option>
                                        </select>
                                        <div class="invalid-feedback">Please select an option.</div>

                                        <label for="">Please select a file to upload:</label>
                                        <div class="chooseFiles">
                                            <input type="file"name="file[{{ $question->type_id }}]"/>
                                            @if($assement_notes[0]->file != null)
                                                <br>
                                                <p>Preview</p><br>
                                                <a href="{{asset($assement_notes[0]->file)}}">Download file</a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group textArea">
                                            <label for="">Notes</label>
                                            <textarea name="notes[{{ $question->type_id }}]" id="">{{$assement_notes[0]->security_notes}}</textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="step-content" data-step="2">
                            <div class="leadForm">
                                <div class="row">
                                    <div class="col-md-3">
                                        @if ($questions2->count() > 0)
                                            @foreach ($questions2 as $question)
                                                <div class="radioSec">
                                                    <p>{{ $question->question }}</p>
                                                    @if ($question->answerOption != null)
                                                        @php
                                                            $index = 0;
                                                        @endphp
                                                        @foreach ($question->answerOption as $option)
                                                            @php
                                                                $index++; 
                                                                $fillup_answers = App\Models\AssementFillup::where('assement_no',$assessment_no)
                                                                ->where('answer_id', $option->id)->first();
                                                            @endphp
                                                        @if ($option->ans_input_type == 0)
                                                            @if ($option->ans_text != null)
                                                                <input type="radio" required
                                                                    id="option_{{ $option->id . '_' . $index }}"
                                                                    name="answer[{{ $question->id }}]"
                                                                    value="{{ $option->id }}"
                                                                    class="form form-check-input"
                                                                    @if($fillup_answers->answer_id ?? '' == $option->id) checked @endif>
                                                                <label
                                                                    for="option_{{ $option->id . '_' . $index }}">{{ $option->ans_text }}</label>
                                                                &nbsp; &nbsp;
                                                                <div class="invalid-feedback">Please select an option.
                                                                </div>
                                                            @endif
                                                        @endif
                                                        @endforeach
                                                        @if ($option->ans_input_type == 1)  
                                                            <select class="form-control" name="answer[{{ $question->id }}]"
                                                                required>
                                                                <option value="" disabled selected>Select</option>
                                                                @foreach ($question->answerOption as $option)
                                                                    @php  
                                                                    $fillup_answers = App\Models\AssementFillup::where('assement_no',$assessment_no)
                                                                    ->where('answer_id', $option->id)->first();
                                                                    @endphp
                                                                    <option value="{{ $option->id }}" @if($fillup_answers->answer_id ?? '' == $option->id) selected @endif>
                                                                        {{ $option->ans_text }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <div class="invalid-feedback">Please select an option.</div>
                                                        @endif
                                                    @endif
                                                </div>
                                            @endforeach
                                        @endif

                                        <select class="star-rating py-4" name="scoring[{{ $question->type_id }}]"
                                            id="scoring" required>
                                            <option value="">Rate High to Low</option>
                                            <option value="5" @if($assement_notes[1]->scoring == 5) selected @endif>High</option>
                                            <option value="4" @if($assement_notes[1]->scoring == 4) selected @endif>Medium</option>
                                            <option value="3" @if($assement_notes[1]->scoring == 3) selected @endif>Medium</option>
                                            <option value="2" @if($assement_notes[1]->scoring == 2) selected @endif>Low</option>
                                            <option value="1" @if($assement_notes[1]->scoring == 1) selected @endif>Low</option>
                                        </select>
                                        <div class="invalid-feedback">Please select an option.</div>

                                        <label for="">Please select a file to upload:</label>
                                        <div class="chooseFiles">
                                            <input type="file"name="file[{{ $question->type_id }}]"/>
                                            @if($assement_notes[0]->file != null)
                                                <br>
                                                <p>Preview</p><br>
                                                <a href="{{asset($assement_notes[1]->file)}}">Download file</a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group textArea">
                                            <label for="">Notes</label>
                                            <textarea name="notes[{{ $question->type_id }}]" id="">{{$assement_notes[1]->security_notes}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="step-content" data-step="3">
                            <div class="leadForm">
                                <div class="row">
                                    <div class="col-md-3">
                                        @if ($questions3->count() > 0)
                                            @foreach ($questions3 as $question)
                                                <div class="radioSec">
                                                    <p>{{ $question->question }}</p>
                                                    @if ($question->answerOption != null)
                                                        @php
                                                            $index = 0;
                                                        @endphp
                                                        @foreach ($question->answerOption as $option)
                                                            @php
                                                                $index++; 
                                                                $fillup_answers = App\Models\AssementFillup::where('assement_no',$assessment_no)
                                                                ->where('answer_id', $option->id)->first();
                                                            @endphp
                                                            @if ($option->ans_input_type == 0)
                                                             @if ($option->ans_text != null)
                                                                 <input type="radio" required
                                                                     id="option_{{ $option->id . '_' . $index }}"
                                                                     name="answer[{{ $question->id }}]"
                                                                     value="{{ $option->id }}"
                                                                     class="form form-check-input"
                                                                     @if($fillup_answers->answer_id ?? '' == $option->id) checked @endif>
                                                                 <label
                                                                     for="option_{{ $option->id . '_' . $index }}">{{ $option->ans_text }}</label>
                                                                 &nbsp; &nbsp;
                                                                 <div class="invalid-feedback">Please select an option.
                                                                 </div>
                                                             @endif
                                                         @endif
                                                        @endforeach
                                                        @if ($option->ans_input_type == 1)  
                                                            <select class="form-control" name="answer[{{ $question->id }}]"
                                                                required>
                                                                <option value="" disabled selected>Select</option>
                                                                @foreach ($question->answerOption as $option)
                                                                    @php  
                                                                    $fillup_answers = App\Models\AssementFillup::where('assement_no',$assessment_no)
                                                                    ->where('answer_id', $option->id)->first();
                                                                    @endphp
                                                                    <option value="{{ $option->id }}" @if($fillup_answers->answer_id ?? '' == $option->id) selected @endif>
                                                                        {{ $option->ans_text }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <div class="invalid-feedback">Please select an option.</div>
                                                        @endif
                                                    @endif
                                                </div>
                                            @endforeach
                                        @endif
                                        <select class="star-rating py-4" name="scoring[{{ $question->type_id }}]"
                                            id="scoring" required>
                                            <option value="">Rate High to Low</option>
                                            <option value="5" @if($assement_notes[2]->scoring == 5) selected @endif>High</option>
                                            <option value="4" @if($assement_notes[2]->scoring == 4) selected @endif>Medium</option>
                                            <option value="3" @if($assement_notes[2]->scoring == 3) selected @endif>Medium</option>
                                            <option value="2" @if($assement_notes[2]->scoring == 2) selected @endif>Low</option>
                                            <option value="1" @if($assement_notes[2]->scoring == 1) selected @endif>Low</option>
                                        </select>
                                        <div class="invalid-feedback">Please select an option.</div>

                                        <label for="">Please select a file to upload:</label>
                                        <div class="chooseFiles">
                                            <input type="file"name="file[{{ $question->type_id }}]"/>
                                            @if($assement_notes[0]->file != null)
                                                <br>
                                                <p>Preview</p><br>
                                                <a href="{{asset($assement_notes[2]->file)}}">Download file</a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group textArea">
                                            <label for="">Notes</label>
                                            <textarea name="notes[{{ $question->type_id }}]" id="">{{$assement_notes[2]->security_notes}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="step-content" data-step="4">
                            <div class="leadForm">
                                <div class="row">
                                    <div class="col-md-3">
                                        @if ($questions4->count() > 0)
                                            @foreach ($questions4 as $question)
                                                <div class="radioSec">
                                                    <p>{{ $question->question }}</p>
                                                    @if ($question->answerOption != null)
                                                        @php
                                                            $index = 0;
                                                        @endphp
                                                        @foreach ($question->answerOption as $option)
                                                        @php
                                                            $index++; 
                                                            $fillup_answers = App\Models\AssementFillup::where('assement_no',$assessment_no)
                                                            ->where('answer_id', $option->id)->first();
                                                        @endphp
                                                        @if ($option->ans_input_type == 0)
                                                            @if ($option->ans_text != null)
                                                                <input type="radio" required
                                                                    id="option_{{ $option->id . '_' . $index }}"
                                                                    name="answer[{{ $question->id }}]"
                                                                    value="{{ $option->id }}"
                                                                    class="form form-check-input"
                                                                    @if($fillup_answers->answer_id ?? '' == $option->id) checked @endif>
                                                                <label
                                                                    for="option_{{ $option->id . '_' . $index }}">{{ $option->ans_text }}</label>
                                                                &nbsp; &nbsp;
                                                                <div class="invalid-feedback">Please select an option.
                                                                </div>
                                                            @endif
                                                        @endif
                                                        @endforeach
                                                        @if ($option->ans_input_type == 1)  
                                                            <select class="form-control" name="answer[{{ $question->id }}]"
                                                                required>
                                                                <option value="" disabled selected>Select</option>
                                                                @foreach ($question->answerOption as $option)
                                                                    @php  
                                                                    $fillup_answers = App\Models\AssementFillup::where('assement_no',$assessment_no)
                                                                    ->where('answer_id', $option->id)->first();
                                                                    @endphp
                                                                    <option value="{{ $option->id }}" @if($fillup_answers->answer_id ?? '' == $option->id) selected @endif>
                                                                        {{ $option->ans_text }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <div class="invalid-feedback">Please select an option.</div>
                                                        @endif
                                                    @endif
                                                </div>
                                            @endforeach
                                        @endif
                                        <select class="star-rating py-4" name="scoring[{{ $question->type_id }}]"
                                            id="scoring" required>
                                            <option value="">Rate High to Low</option>
                                            <option value="5" @if($assement_notes[3]->scoring == 5) selected @endif>High</option>
                                            <option value="4" @if($assement_notes[3]->scoring == 4) selected @endif>Medium</option>
                                            <option value="3" @if($assement_notes[3]->scoring == 3) selected @endif>Medium</option>
                                            <option value="2" @if($assement_notes[3]->scoring == 2) selected @endif>Low</option>
                                            <option value="1" @if($assement_notes[3]->scoring == 1) selected @endif>Low</option>
                                        </select>
                                        <div class="invalid-feedback">Please select an option.</div>

                                        <label for="">Please select a file to upload:</label>
                                        <div class="chooseFiles">
                                            <input type="file"name="file[{{ $question->type_id }}]"/>
                                            @if($assement_notes[3]->file != null)
                                                <br>
                                                <p>Preview</p><br>
                                                <a href="{{asset($assement_notes[3]->file)}}">Download file</a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group textArea">
                                            <label for="">Notes</label>
                                            <textarea name="notes[{{ $question->type_id }}]" id="">{{$assement_notes[3]->security_notes}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="step-content" data-step="5">
                            <div class="leadForm">
                                <div class="row">
                                    <div class="col-md-3">
                                        @if ($questions5->count() > 0)
                                            @foreach ($questions5 as $question)
                                                <div class="radioSec">
                                                    <p>{{ $question->question }}</p>
                                                    @if ($question->answerOption != null)
                                                        @php
                                                            $index = 0;
                                                        @endphp
                                                        @foreach ($question->answerOption as $option)
                                                            @php
                                                                $index++;
                                                                $fillup_answers = App\Models\AssementFillup::where('assement_no',$assessment_no)
                                                                ->where('answer_id', $option->id)->first();
                                                            @endphp
                                                            @if ($option->ans_input_type == 0)
                                                                @if ($option->ans_text != null)
                                                                    <input type="radio" required
                                                                        id="option_{{ $option->id . '_' . $index }}"
                                                                        name="answer[{{ $question->id }}]"
                                                                        value="{{ $option->id }}"
                                                                        class="form form-check-input"
                                                                        @if($fillup_answers->answer_id ?? '' == $option->id) checked @endif>
                                                                    <label
                                                                        for="option_{{ $option->id . '_' . $index }}">{{ $option->ans_text }}</label>
                                                                    &nbsp; &nbsp;
                                                                    <div class="invalid-feedback">Please select an option.
                                                                    </div>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                        @if ($option->ans_input_type == 1)  
                                                            <select class="form-control" name="answer[{{ $question->id }}]"
                                                                required>
                                                                <option value="" disabled selected>Select</option>
                                                                @foreach ($question->answerOption as $option)
                                                                    @php  
                                                                    $fillup_answers = App\Models\AssementFillup::where('assement_no',$assessment_no)
                                                                    ->where('answer_id', $option->id)->first();
                                                                    @endphp
                                                                    <option value="{{ $option->id }}" @if($fillup_answers->answer_id ?? '' == $option->id) selected @endif>
                                                                        {{ $option->ans_text }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <div class="invalid-feedback">Please select an option.</div>
                                                        @endif
                                                    @endif
                                                </div>
                                            @endforeach
                                        @endif
                                        <select class="star-rating py-4" name="scoring[{{ $question->type_id }}]"
                                            id="scoring" required>
                                            <option value="">Rate High to Low</option>
                                            <option value="5" @if($assement_notes[4]->scoring == 5) selected @endif>High</option>
                                            <option value="4" @if($assement_notes[4]->scoring == 4) selected @endif>Medium</option>
                                            <option value="3" @if($assement_notes[4]->scoring == 3) selected @endif>Medium</option>
                                            <option value="2" @if($assement_notes[4]->scoring == 2) selected @endif>Low</option>
                                            <option value="1" @if($assement_notes[4]->scoring == 1) selected @endif>Low</option>
                                        </select>
                                        <label for="">Please select a file to upload:</label>
                                        <div class="chooseFiles">
                                            <input type="file"name="file[{{ $question->type_id }}]"/>
                                            @if($assement_notes[4]->file != null)
                                                <br>
                                                <p>Preview</p><br>
                                                <a href="{{asset($assement_notes[4]->file)}}">Download file</a>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group textArea">
                                            <label for="">Notes</label>
                                            <textarea name="notes[{{ $question->type_id }}]" id="">{{$assement_notes[4]->security_notes}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="themeBtn" id="prevBtn" style="display: none;">Previous</button>
                        <button type="button" class="themeBtn" id="nextBtn">Next</button>

                    </div>
                </section>
            </form>
        </div>
    </div>
@endsection

@push('custom_scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets/rating/star-rating.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            var starRatingControl = new StarRating('.star-rating');

            $('.customjs-select2').select2();
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const steps = document.querySelectorAll('.step-content');
            const stepIndicators = document.querySelectorAll('.step');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const form = document.getElementById('main-form');
            let currentStepIndex = 0;

            function updateStepUI() {
                steps.forEach((step, index) => {
                    step.classList.toggle('active', index === currentStepIndex);
                });

                stepIndicators.forEach((indicator, index) => {
                    indicator.classList.remove('active', 'completed');
                    if (index < currentStepIndex) {
                        indicator.classList.add('completed');
                        indicator.querySelector('.circle').style.backgroundColor = 'red';
                    }
                    if (index === currentStepIndex) {
                        indicator.classList.add('active');
                        indicator.querySelector('.circle').style.backgroundColor =
                        'red'; // Bootstrap primary
                    }
                });

                prevBtn.style.display = currentStepIndex === 0 ? 'none' : 'inline-block';
                nextBtn.textContent = currentStepIndex === steps.length - 1 ? 'Regenerate report' : 'Next';
            }

            function validateCurrentStepOnly() {
                const currentStep = steps[currentStepIndex];
                const inputs = currentStep.querySelectorAll('input, select, textarea');
                let isValid = true;

                inputs.forEach(input => {
                    // clear existing feedback
                    input.classList.remove('is-invalid', 'is-valid');

                    if (!input.checkValidity()) {
                        input.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        input.classList.add('is-valid');
                    }
                });

                return isValid;
            }

            nextBtn.addEventListener('click', function(e) {
                e.preventDefault();

                const isValid = validateCurrentStepOnly();

                if (!isValid) {
                    return; // Stay on current step
                }

                if (currentStepIndex === steps.length - 1) {

                    const formData = new FormData(form);
                    console.log($('input[name="_token"]').val());
                    nextBtn.disabled = true;
                    $.ajax({
                        'url': '{{ route('admin.assessment-management.update',$assessment_no) }}',
                        'type': 'POST',
                        'data': formData,
                        'contentType': false, // Important for file upload
                        'processData': false, // Prevent jQuery from processing the data
                        'success': function(response) {
                            // Handle success response
                            Swal.fire({
                                title: 'Success!',
                                text: 'Assessment report created successfully... Redirecting to the Report Preview.',
                                icon: 'success',
                                confirmButtonText: 'Ok!'
                            })
                            window.location.href = '/admin/assessment-management/preview/'+response.assement_no+'';
                        },
                    });
                } else {
                    currentStepIndex++;
                    updateStepUI();
                }
            });

            prevBtn.addEventListener('click', function() {
                if (currentStepIndex > 0) {
                    currentStepIndex--;
                    updateStepUI();
                }
            });

            updateStepUI();
        });
    </script>


    {{-- <script>
        // Step Form JS
        let currentStep = 1;
        const totalSteps = 5;

        $("#nextBtn").click(function() {
            if (currentStep < totalSteps) {
                currentStep++;
            } else {
                alert("Form submitted!");
                return;
            }
            updateSteps();
        });

        $("#prevBtn").click(function() {
            if (currentStep > 1) {
                $(`.step[data-step='${currentStep}']`).removeClass("active");
                currentStep--;
            }
            updateSteps();
        });

        function updateSteps() {
            $('#error').hide();
            $(".step").each(function() {

                let stepNum = $(this).data("step");
                if (stepNum < currentStep) {
                    $(this).addClass("completed");
                } else {
                    $(this).removeClass("completed");
                }
                if (stepNum === currentStep) {
                    $(this).addClass("active");
                } else {
                    $(this).removeClass("active");
                }

            });

            $(".step-content").removeClass("active");
            $(`.step-content[data-step='${currentStep}']`).addClass("active");

            if (currentStep === totalSteps) {
                $("#nextBtn").text("Submit");
            } else {
                $("#nextBtn").text("Next");
            }

            if (currentStep === 1) {
                $("#prevBtn").hide();
            } else {
                $("#prevBtn").show();
            }
        }
    </script> --}}
@endpush
