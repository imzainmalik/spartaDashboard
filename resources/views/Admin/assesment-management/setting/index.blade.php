@extends('layouts.admin_app')
@section('content')

    <div class="card">
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                    <button class="btn accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        Report Settings
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <form action="{{ route('admin.report_setting') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="container">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="">Report title</label>
                                        <input type="text" name="report_title" value="{{ $reportsetting->report_title }}"
                                            required class="form-control" id="">
                                    </div>
                                    <div class="col-6">
                                        <label for="">Report logo</label>
                                        <input type="file" name="report_logo" class="form-control" id=""> <br>
                                        <small><strong>Preview</strong></small><br>
                                        <img src="{{ asset('uploads/report_setting/' . $reportsetting->report_logo . ' ') }}"
                                            alt="" class="img-thumb">
                                    </div>
                                    <br>
                                    <small><strong>Contact info</strong></small>
                                    <br>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="">Phone</label>
                                        <input type="text" name="report_phone" value="{{ $reportsetting->report_phone }}"
                                            required class="form-control" id="">
                                    </div>
                                    <div class="col-6">
                                        <label for="">Email</label>
                                        <input type="text" name="report_email" value="{{ $reportsetting->report_email }}"
                                            required class="form-control" id="">
                                    </div>
                                    <div class="col-6">
                                        <label for="">Address</label>
                                        <input type="text" name="report_address"
                                            value="{{ $reportsetting->report_address }}" required class="form-control"
                                            id="">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <button class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingTwo">
                    <button class="btn accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                        Questioniers
                    </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                    data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">

                        <div class="card-header">
                            {{-- <div class="d-flex justify-content-end"> --}}
                                <ul class="nav nav-tabs" id="myTab" role="tablist">

                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="Perimeter-tab" data-bs-toggle="tab"
                                            data-bs-target="#Perimeter" type="button" role="tab" aria-controls="Perimeter"
                                            aria-selected="true">
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
                                            data-bs-target="#Lighting" type="button" role="tab" aria-controls="Lighting"
                                            aria-selected="false">
                                            Lighting & Cameras
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="Interior-tab" data-bs-toggle="tab"
                                            data-bs-target="#Interior" type="button" role="tab" aria-controls="Interior"
                                            aria-selected="false">
                                            Interior Security
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="Emergency-tab" data-bs-toggle="tab"
                                            data-bs-target="#Emergency" type="button" role="tab" aria-controls="Emergency"
                                            aria-selected="false">
                                            Emergency Preparedness
                                        </button>
                                    </li>
                                </ul>
                                {{--
                            </div> --}}
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">

                                <div class="tab-pane fade show active" id="Perimeter" role="tabpanel"
                                    aria-labelledby="Perimeter-tab">
                                    <div class="row">
                                        <div class="qustion col-8">
                                            <ul>
                                                @php
                                                    $index = 1;
                                                @endphp
                                                @foreach ($questions1 as $question1)
                                                    @php
                                                        $answer = App\Models\AssementAnswer::where('question_id', $question1->id)
                                                        ->where('is_active', 0)->first(); 
                                                    @endphp

                                                    <li>Q{{ $index++ }}:
                                                        &nbsp;<strong>{{ $question1->question }}</strong></li>
                                                    @foreach ($question1->answerOption as $item)
                                                        <li style="margin-left: 19px;padding: 10px;">
                                                            {{ $item->ans_text }}
                                                        </li>
                                                    @endforeach
                                                    <a href="{{ route('admin.assessment-management.setting.delete_question', $question1->id) }}" 
                                                        class="btn btn-danger delete-btn" 
                                                        data-id="{{ $item->id }}"
                                                        data-url="{{ route('admin.assessment-management.setting.delete_question', $question1->id) }}">
                                                        <i class="fa fa-trash"></i>
                                                     </a>|
                                                    <a href="{{ route('admin.assessment-management.setting.edit_question', 1) }}"
                                                        data-toggle="modal" data-target="#PerimetereidtModal_{{ $question1->id }}"
                                                        class="btn btn-info">Edit {{ $question1->question }}</a> |
                                                         @if($answer->ans_input_type == 1) <div class="badge badge-warning">Dropdown</div>@else <div class="badge badge-danger">Radio checkbox</div>@endif
                                                         

                                                    <hr>    
                                                    
                                                    
                                                    <div class="modal fade" id="PerimetereidtModal_{{ $question1->id }}" tabindex="-1" role="dialog"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Edit
                                                                        Perimeter Q&A</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    @php
                                                                        $question_type = App\Models\AssementQuestionType::all();
                                                                    @endphp
                                                                    <form
                                                                        action="{{ route('admin.assessment-management.update_question',$question1->id) }}"
                                                                        id="question-form" method="post">
                                                                        @csrf
                                                                        <input type="hidden" name="type_id" value="1"> 
                                                                        <div class="row">
                                                                            <div class="col-md-12 py-4">
                                                                                <label for="">Select Question type</label>
                                                                                <select name="type_id" id=""
                                                                                    class="form-control">
                                                                                    @foreach ($question_type as $type) 
                                                                                        <option value="{{ $type->id }}"
                                                                                            @if($type->id == $question1->type_id) selected @endif>{{ $type->name }}</option> 
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <br>
                                                                            <div class="col-md-12">
                                                                                <label for="">Question</label>
                                                                                <input type="text" name="question" value="{{ $question1->question }}"
                                                                                    class="form-control" required
                                                                                    placeholder="Enter Question">
                                                                            </div>
                                                                            <br>
                                                                           
                                                                            <div class="col-md-12 py-4">
                                                                                <label for="">Select option input type</label>
                                                                                <select name="ans_input_type" id=""
                                                                                    class="form-control">
                                                                                    <option value="0">Radio checkbox</option>
                                                                                    <option value="1">Select Dropdown</option>
                                                                                </select>
                                                                            </div>
                                                                            <br> 
                                                                            {{-- <div class="row"> --}}
                                                                                @foreach ($question1->answerOption as $option)
                                                                                    <div class="col-md-10" id="ans_div_{{ $option->id }}">
                                                                                        <label for="">Answer Text</label>
                                                                                        <input type="text" name="ans_text[]"
                                                                                            class="form-control" required
                                                                                            placeholder="Enter Answer" value="{{ $option->ans_text }}">

                                                                                            <button class="btn" type="button" onclick="delete_option({{ $option->id }})"><i class="fa fa-trash"></i></button>
                                                                                    </div>
                                                                                    @push('custom_scripts')
                                                                                    <script>
                                                                                        function delete_option(ans_id){
                                                                                            $('#ans_div_'+ans_id+'').remove();
                                                                                        }
                                                                                    </script>
                                                                                    @endpush
                                                                                @endforeach
                                                                                <div id="ans_append_{{ $question1->id }}"></div>
                                                                                <div class="col-md-2" style="padding: 24px;">
                                                                                    <button
                                                                                        class="btn btn-primary add-ans-option"
                                                                                        type="button"><i
                                                                                            class="fa fa-plus"></i></button>
                                                                                </div> 
                                                                            {{-- </div> --}}
                                                                        </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Save changes</button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="container col-4">
                                            <a href="javascript:;" data-toggle="modal" data-target="#PerimeterModal"
                                                class="btn btn-primary">Create Perimeter Q&A</a>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="PerimeterModal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Create Perimeter Q&A</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.assessment-management.store_question') }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="type_id" value="1">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label for="">Question</label>
                                                                <input type="text" name="question" class="form-control"
                                                                    required placeholder="Enter Question">
                                                            </div>
                                                            <br>
                                                            <div class="col-md-12 py-4">
                                                                <label for="">Select option type</label>
                                                                <select name="ans_input_type" id="" class="form-control">
                                                                    <option value="0">Radio checkbox</option>
                                                                    <option value="1">Select Dropdown</option>
                                                                </select>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-md-10">
                                                                    <label for="">Answer Text</label>
                                                                    <input type="text" name="ans_text[]"
                                                                        class="form-control" required
                                                                        placeholder="Enter Answer">
                                                                </div>
                                                                <div id="ans_append"></div>
                                                                <div class="col-md-2">
                                                                    <button class="btn btn-primary add-ans-option"
                                                                        type="button"><i class="fa fa-plus"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Create</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="tab-pane fade" id="Entry" role="tabpanel" aria-labelledby="Entry-tab">
                                    <div class="row"> 
                                        <div class="qustion col-8">
                                            <ul>
                                                @php
                                                    $index = 1;
                                                @endphp
                                                @foreach ($questions2 as $question1)
                                                @php
                                                $answer2 = App\Models\AssementAnswer::where('question_id', $question1->id)
                                                ->where('is_active', 0)->first(); 
                                            @endphp
                                                    <li>Q{{ $index++ }}:
                                                        &nbsp;<strong>{{ $question1->question }}</strong></li>
                                                    @foreach ($question1->answerOption as $item)
                                                        <li style="margin-left: 19px;padding: 10px;">
                                                            {{ $item->ans_text }}
                                                        </li>
                                                    @endforeach
                                                    <a href="{{ route('admin.assessment-management.setting.delete_question', $question1->id) }}" 
                                                        class="btn btn-danger delete-btn" 
                                                        data-id="{{ $item->id }}"
                                                        data-url="{{ route('admin.assessment-management.setting.delete_question', $question1->id) }}">
                                                        <i class="fa fa-trash"></i>
                                                     </a>|
                                                    <a href="{{ route('admin.assessment-management.setting.edit_question', 2) }}"
                                                        data-toggle="modal" data-target="#EntryeidtModal_{{ $question1->id }}"
                                                        class="btn btn-info">Edit {{ $question1->question }}</a> |

                                                         @if($answer2->ans_input_type == 1) <div class="badge badge-warning">Dropdown</div>@else <div class="badge badge-danger">Radio checkbox</div>@endif
                                                    <hr>
                                                    <div class="modal fade" id="EntryeidtModal_{{ $question1->id }}" tabindex="-1" role="dialog"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Edit
                                                                        Perimeter Q&A</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    @php
                                                                        $question_type = App\Models\AssementQuestionType::all();
                                                                    @endphp
                                                                    <form
                                                                        action="{{ route('admin.assessment-management.update_question',$question1->id) }}"
                                                                        id="question-form" method="post">
                                                                        @csrf
                                                                        <input type="hidden" name="type_id" value="1"> 
                                                                        <div class="row">
                                                                            <div class="col-md-12 py-4">
                                                                                <label for="">Select Question type</label>
                                                                                <select name="type_id" id=""
                                                                                    class="form-control">
                                                                                    @foreach ($question_type as $type) 
                                                                                        <option value="{{ $type->id }}"
                                                                                            @if($type->id == $question1->type_id) selected @endif>{{ $type->name }}</option> 
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <br>
                                                                            <div class="col-md-12">
                                                                                <label for="">Question</label>
                                                                                <input type="text" name="question" value="{{ $question1->question }}"
                                                                                    class="form-control" required
                                                                                    placeholder="Enter Question">
                                                                            </div>
                                                                            <br>
                                                                           
                                                                            <div class="col-md-12 py-4">
                                                                                <label for="">Select option input type</label>
                                                                                <select name="ans_input_type" id=""
                                                                                    class="form-control">
                                                                                    <option value="0">Radio checkbox</option>
                                                                                    <option value="1">Select Dropdown</option>
                                                                                </select>
                                                                            </div>
                                                                            <br> 
                                                                            {{-- <div class="row"> --}}
                                                                                @foreach ($question1->answerOption as $option)
                                                                                    <div class="col-md-10" id="ans_div_{{ $option->id }}">
                                                                                        <label for="">Answer Text</label>
                                                                                        <input type="text" name="ans_text[]"
                                                                                            class="form-control" required
                                                                                            placeholder="Enter Answer" value="{{ $option->ans_text }}">

                                                                                            <button class="btn" type="button" onclick="delete_option({{ $option->id }})"><i class="fa fa-trash"></i></button>
                                                                                    </div>
                                                                                    @push('custom_scripts')
                                                                                    <script>
                                                                                        function delete_option(ans_id){
                                                                                            $('#ans_div_'+ans_id+'').remove();
                                                                                        }
                                                                                    </script>
                                                                                    @endpush
                                                                                @endforeach
                                                                                <div id="ans_append_{{ $question1->id }}"></div>
                                                                                
                                                                                <div class="col-md-2" style="padding: 24px;">
                                                                                    <button
                                                                                        class="btn btn-primary add-ans-option"
                                                                                        type="button"><i
                                                                                            class="fa fa-plus"></i></button>
                                                                                </div> 
                                                                            {{-- </div> --}}
                                                                        </div> 
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Save changes</button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="col-4">
                                            <div class="container col-4">
                                                <a href="javascript:;" data-toggle="modal" data-target="#entryModal"
                                                    class="btn btn-primary">Create Entry Points Q&A</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="entryModal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Create Entry Points Q&A</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.assessment-management.store_question') }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="type_id" value="2">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label for="">Question</label>
                                                                <input type="text" name="question" class="form-control"
                                                                    required placeholder="Enter Question">
                                                            </div>
                                                            <br>
                                                            <div class="col-md-12 py-4">
                                                                <label for="">Select option type</label>
                                                                <select name="ans_input_type" id="" class="form-control">
                                                                    <option value="0">Radio checkbox</option>
                                                                    <option value="1">Select Dropdown</option>
                                                                </select>
                                                            </div>
                                                            <br>
                                                            <div class="container col-md-10">
                                                                <label for="">Answer Text</label>
                                                                <input type="text" name="ans_text[]"
                                                                    class="form-control" required
                                                                    placeholder="Enter Answer">
                                                            </div>
                                                            <div id="text_ans_append_2"></div>
                                                            <div class="container col-md-2">
                                                                <button class="btn btn-primary add-ans-option2" id="add-ans-option2"
                                                                    type="button"><i class="fa fa-plus"></i></button>
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Create</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @push('custom_scripts')
                                    <script>
                                        $('#add-ans-option2').click(function(){
                                            var random_id = Math.random().toString().substring(2);                                            ;
                                            var html = `
                                            <div class="row mt-2" id="appended_option_${random_id}">
                                                <div class="col-md-10">
                                                    <label for="">Answer Text</label>
                                                    <input type="text" name="ans_text[]" class="form-control" required placeholder="Enter Answer">
                                                </div>
                                                <div class="col-md-2 d-flex align-items-end">
                                                    <button class="btn btn-danger remove-ans-option" onclick="delete_appended_option('appended_option_${random_id}')" id="delete_option_append_{{ $question1->id }}"  type="button"><i class="fa fa-minus"></i></button>
                                                </div>
                                            </div>`; 
                                            
                                            $('#text_ans_append_2').append(html);
                                        }); 

                                        function delete_appended_option(appended_div_id){
                                            $('#' + appended_div_id).remove();
                                        }
                                    </script>
                                @endpush
                                <div class="tab-pane fade" id="Lighting" role="tabpanel" aria-labelledby="Lighting-tab">
                                    <div class="row"> 
                                        <div class="qustion col-8">
                                            <ul>
                                                @php
                                                    $index = 1;
                                                @endphp
                                                @foreach ($questions3 as $question1)
                                                @php
                                                $answer2 = App\Models\AssementAnswer::where('question_id', $question1->id)
                                                ->where('is_active', 0)->first(); 
                                            @endphp
                                                    <li>Q{{ $index++ }}:
                                                        &nbsp;<strong>{{ $question1->question }}</strong></li>
                                                    @foreach ($question1->answerOption as $item)
                                                        <li style="margin-left: 19px;padding: 10px;">
                                                            {{ $item->ans_text }}
                                                        </li>
                                                    @endforeach
                                                    <a href="{{ route('admin.assessment-management.setting.delete_question', $question1->id) }}" 
                                                        class="btn btn-danger delete-btn" 
                                                        data-id="{{ $item->id }}"
                                                        data-url="{{ route('admin.assessment-management.setting.delete_question', $question1->id) }}">
                                                        <i class="fa fa-trash"></i>
                                                     </a>|
                                                    <a href="{{ route('admin.assessment-management.setting.edit_question', 3) }}"
                                                        data-toggle="modal" data-target="#EntryeidtModal_{{ $question1->id }}"
                                                        class="btn btn-info">Edit {{ $question1->question }}</a> |

                                                         @if($answer2->ans_input_type == 1) <div class="badge badge-warning">Dropdown</div>@else <div class="badge badge-danger">Radio checkbox</div>@endif
                                                    <hr>
                                                    <div class="modal fade" id="EntryeidtModal_{{ $question1->id }}" tabindex="-1" role="dialog"
                                                        aria-labelledby="LightingModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="LightingModalLabel">Edit
                                                                        Perimeter Q&A</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    @php
                                                                        $question_type = App\Models\AssementQuestionType::all();
                                                                    @endphp
                                                                    <form
                                                                        action="{{ route('admin.assessment-management.update_question',$question1->id) }}"
                                                                        id="question-form" method="post">
                                                                        @csrf
                                                                        <input type="hidden" name="type_id" value="3"> 
                                                                        <div class="row">
                                                                            <div class="col-md-12 py-4">
                                                                                <label for="">Select Question type</label>
                                                                                <select name="type_id" id=""
                                                                                    class="form-control">
                                                                                    @foreach ($question_type as $type) 
                                                                                        <option value="{{ $type->id }}"
                                                                                            @if($type->id == $question1->type_id) selected @endif>{{ $type->name }}</option> 
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <br>
                                                                            <div class="col-md-12">
                                                                                <label for="">Question</label>
                                                                                <input type="text" name="question" value="{{ $question1->question }}"
                                                                                    class="form-control" required
                                                                                    placeholder="Enter Question">
                                                                            </div>
                                                                            <br>
                                                                           
                                                                            <div class="col-md-12 py-4">
                                                                                <label for="">Select option input type</label>
                                                                                <select name="ans_input_type" id=""
                                                                                    class="form-control">
                                                                                    <option value="0">Radio checkbox</option>
                                                                                    <option value="1">Select Dropdown</option>
                                                                                </select>
                                                                            </div>
                                                                            <br> 
                                                                            {{-- <div class="row"> --}}
                                                                                @foreach ($question1->answerOption as $option)
                                                                                    <div class="col-md-10" id="ans_div_{{ $option->id }}">
                                                                                        <label for="">Answer Text</label>
                                                                                        <input type="text" name="ans_text[]"
                                                                                            class="form-control" required
                                                                                            placeholder="Enter Answer" value="{{ $option->ans_text }}">

                                                                                            <button class="btn" type="button" onclick="delete_option({{ $option->id }})"><i class="fa fa-trash"></i></button>
                                                                                    </div>
                                                                                    @push('custom_scripts')
                                                                                    <script>
                                                                                        function delete_option(ans_id){
                                                                                            $('#ans_div_'+ans_id+'').remove();
                                                                                        }
                                                                                    </script>
                                                                                    @endpush
                                                                                @endforeach
                                                                                <div id="ans_append_{{ $question1->id }}"></div>
                                                                                
                                                                                <div class="col-md-2" style="padding: 24px;">
                                                                                    <button
                                                                                        class="btn btn-primary add-ans-option"
                                                                                        type="button"><i
                                                                                            class="fa fa-plus"></i></button>
                                                                                </div> 
                                                                            {{-- </div> --}}
                                                                        </div> 
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Save changes</button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="col-4">
                                            <div class="container col-4">
                                                <a href="javascript:;" data-toggle="modal" data-target="#LightingModal"
                                                    class="btn btn-primary">Create Lighting & Cameras Q&A</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="LightingModal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Create Lighting & Cameras Q&A</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.assessment-management.store_question') }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="type_id" value="3">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label for="">Question</label>
                                                                <input type="text" name="question" class="form-control"
                                                                    required placeholder="Enter Question">
                                                            </div>
                                                            <br>
                                                            <div class="col-md-12 py-4">
                                                                <label for="">Select option type</label>
                                                                <select name="ans_input_type" id="" class="form-control">
                                                                    <option value="0">Radio checkbox</option>
                                                                    <option value="1">Select Dropdown</option>
                                                                </select>
                                                            </div>
                                                            <br>
                                                            <div class="container col-md-10">
                                                                <label for="">Answer Text</label>
                                                                <input type="text" name="ans_text[]"
                                                                    class="form-control" required
                                                                    placeholder="Enter Answer">
                                                            </div>
                                                            <div id="text_ans_append_3"></div>
                                                            <div class="container col-md-2">
                                                                <button class="btn btn-primary add-ans-option3" id="add-ans-option3"
                                                                    type="button"><i class="fa fa-plus"></i></button>
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Create</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @push('custom_scripts')
                                        <script>
                                            $('#add-ans-option3').click(function(){ 
                                                var random_id = Math.random().toString().substring(2);                                            ;
                                                var htmla = `
                                                <div class="row mt-2" id="appended_option_${random_id}">
                                                    <div class="col-md-10">
                                                        <label for="">Answer Text</label>
                                                        <input type="text" name="ans_text[]" class="form-control" required placeholder="Enter Answer">
                                                    </div>
                                                    <div class="col-md-2 d-flex align-items-end">
                                                        <button class="btn btn-danger remove-ans-option" onclick="delete_appended_option('appended_option_${random_id}')" id="delete_option_append_{{ $question1->id }}"  type="button"><i class="fa fa-minus"></i></button>
                                                    </div>
                                                </div>`; 
                                                
                                                $('#text_ans_append_3').append(htmla);
                                            }); 

                                            function delete_appended_option(appended_div_id){
                                                $('#' + appended_div_id).remove();
                                            }
                                        </script>
                                    @endpush
                                </div>
                                <div class="tab-pane fade" id="Interior" role="tabpanel" aria-labelledby="Interior-tab">
                                    <div class="row"> 
                                        <div class="qustion col-8">
                                            <ul>
                                                @php
                                                    $index = 1;
                                                @endphp
                                                @foreach ($questions4 as $question1)
                                                @php
                                                $answer2 = App\Models\AssementAnswer::where('question_id', $question1->id)
                                                ->where('is_active', 0)->first(); 
                                            @endphp
                                                    <li>Q{{ $index++ }}:
                                                        &nbsp;<strong>{{ $question1->question }}</strong></li>
                                                    @foreach ($question1->answerOption as $item)
                                                        <li style="margin-left: 19px;padding: 10px;">
                                                            {{ $item->ans_text }}
                                                        </li>
                                                    @endforeach
                                                    <a href="{{ route('admin.assessment-management.setting.delete_question', $question1->id) }}" 
                                                        class="btn btn-danger delete-btn" 
                                                        data-id="{{ $item->id }}"
                                                        data-url="{{ route('admin.assessment-management.setting.delete_question', $question1->id) }}">
                                                        <i class="fa fa-trash"></i>
                                                     </a>|
                                                    <a href="{{ route('admin.assessment-management.setting.edit_question', 4) }}"
                                                        data-toggle="modal" data-target="#InterioreidtModal_{{ $question1->id }}"
                                                        class="btn btn-info">Edit {{ $question1->question }}</a> |

                                                         @if($answer2->ans_input_type == 1) <div class="badge badge-warning">Dropdown</div>@else <div class="badge badge-danger">Radio checkbox</div>@endif
                                                    <hr>
                                                    <div class="modal fade" id="InterioreidtModal_{{ $question1->id }}" tabindex="-1" role="dialog"
                                                        aria-labelledby="InteriorModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="InteriorModalLabel">Edit
                                                                        Interior Security Q&A</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    @php
                                                                        $question_type = App\Models\AssementQuestionType::all();
                                                                    @endphp
                                                                    <form
                                                                        action="{{ route('admin.assessment-management.update_question',$question1->id) }}"
                                                                        id="question-form" method="post">
                                                                        @csrf
                                                                        <input type="hidden" name="interior_type_id" value="4"> 
                                                                        <div class="row">
                                                                            <div class="col-md-12 py-4">
                                                                                <label for="">Select Question type</label>
                                                                                <select name="type_id" id=""
                                                                                    class="form-control">
                                                                                    @foreach ($question_type as $type) 
                                                                                        <option value="{{ $type->id }}"
                                                                                            @if($type->id == $question1->type_id) selected @endif>{{ $type->name }}</option> 
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <br>
                                                                            <div class="col-md-12">
                                                                                <label for="">Question</label>
                                                                                <input type="text" name="question" value="{{ $question1->question }}"
                                                                                    class="form-control" required
                                                                                    placeholder="Enter Question">
                                                                            </div>
                                                                            <br>
                                                                           
                                                                            <div class="col-md-12 py-4">
                                                                                <label for="">Select option input type</label>
                                                                                <select name="ans_input_type" id=""
                                                                                    class="form-control">
                                                                                    <option value="0">Radio checkbox</option>
                                                                                    <option value="1">Select Dropdown</option>
                                                                                </select>
                                                                            </div>
                                                                            <br> 
                                                                            {{-- <div class="row"> --}}
                                                                                @foreach ($question1->answerOption as $option)
                                                                                    <div class="col-md-10" id="ans_div_{{ $option->id }}">
                                                                                        <label for="">Answer Text</label>
                                                                                        <input type="text" name="ans_text[]"
                                                                                            class="form-control" required
                                                                                            placeholder="Enter Answer" value="{{ $option->ans_text }}">

                                                                                            <button class="btn" type="button" onclick="delete_option({{ $option->id }})"><i class="fa fa-trash"></i></button>
                                                                                    </div>
                                                                                    @push('custom_scripts')
                                                                                    <script>
                                                                                        function delete_option(ans_id){
                                                                                            $('#ans_div_'+ans_id+'').remove();
                                                                                        }
                                                                                    </script>
                                                                                    @endpush
                                                                                @endforeach
                                                                                <div id="ans_append_{{ $question1->id }}"></div>
                                                                                
                                                                                <div class="col-md-2" style="padding: 24px;">
                                                                                    <button
                                                                                        class="btn btn-primary add-ans-option"
                                                                                        type="button"><i
                                                                                            class="fa fa-plus"></i></button>
                                                                                </div> 
                                                                            {{-- </div> --}}
                                                                        </div> 
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Save changes</button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="col-4">
                                            <div class="container col-4">
                                                <a href="javascript:;" data-toggle="modal" data-target="#InteriorModal"
                                                    class="btn btn-primary">Create Interior Security Q&A</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="InteriorModal" tabindex="-1" role="dialog"
                                        aria-labelledby="InteriorModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="InteriorModalLabel">Create Interior Security Q&A</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.assessment-management.store_question') }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="type_id" value="4">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label for="">Question</label>
                                                                <input type="text" name="question" class="form-control"
                                                                    required placeholder="Enter Question">
                                                            </div>
                                                            <br>
                                                            <div class="col-md-12 py-4">
                                                                <label for="">Select option type</label>
                                                                <select name="ans_input_type" id="" class="form-control">
                                                                    <option value="0">Radio checkbox</option>
                                                                    <option value="1">Select Dropdown</option>
                                                                </select>
                                                            </div>
                                                            <br>
                                                            <div class="container col-md-10">
                                                                <label for="">Answer Text</label>
                                                                <input type="text" name="ans_text[]"
                                                                    class="form-control" required
                                                                    placeholder="Enter Answer">
                                                            </div>
                                                            <div id="text_ans_append_4"></div>
                                                            <div class="container col-md-2">
                                                                <button class="btn btn-primary add-ans-option4" id="add-ans-option4"
                                                                    type="button"><i class="fa fa-plus"></i></button>
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Create</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @push('custom_scripts')
                                        <script>
                                            $('#add-ans-option4').click(function(){ 
                                                var random_id = Math.random().toString().substring(2);                                            ;
                                                var htmla = `
                                                <div class="row mt-2" id="appended_option_${random_id}">
                                                    <div class="col-md-10">
                                                        <label for="">Answer Text</label>
                                                        <input type="text" name="ans_text[]" class="form-control" required placeholder="Enter Answer">
                                                    </div>
                                                    <div class="col-md-2 d-flex align-items-end">
                                                        <button class="btn btn-danger remove-ans-option" onclick="delete_appended_option('appended_option_${random_id}')" id="delete_option_append_{{ $question1->id }}"  type="button"><i class="fa fa-minus"></i></button>
                                                    </div>
                                                </div>`; 
                                                
                                                $('#text_ans_append_4').append(htmla);
                                            }); 

                                            function delete_appended_option(appended_div_id){
                                                $('#' + appended_div_id).remove();
                                            }
                                        </script>
                                    @endpush
                                </div>
                                <div class="tab-pane fade" id="Emergency" role="tabpanel" aria-labelledby="Emergency-tab">
                                    <div class="row"> 
                                        <div class="qustion col-8">
                                            <ul>
                                                @php
                                                    $index = 1;
                                                @endphp
                                                @foreach ($questions5 as $question1)
                                                @php
                                                $answer2 = App\Models\AssementAnswer::where('question_id', $question1->id)
                                                ->where('is_active', 0)->first(); 
                                            @endphp
                                                    <li>Q{{ $index++ }}:
                                                        &nbsp;<strong>{{ $question1->question }}</strong></li>
                                                    @foreach ($question1->answerOption as $item)
                                                        <li style="margin-left: 19px;padding: 10px;">
                                                            {{ $item->ans_text }}
                                                        </li>
                                                    @endforeach
                                                    <a href="{{ route('admin.assessment-management.setting.delete_question', $question1->id) }}" 
                                                        class="btn btn-danger delete-btn" 
                                                        data-id="{{ $item->id }}"
                                                        data-url="{{ route('admin.assessment-management.setting.delete_question', $question1->id) }}">
                                                        <i class="fa fa-trash"></i>
                                                     </a>|
                                                    <a href="{{ route('admin.assessment-management.setting.edit_question', 5) }}"
                                                        data-toggle="modal" data-target="#EmergencyeidtModal_{{ $question1->id }}"
                                                        class="btn btn-info">Edit {{ $question1->question }}</a> |

                                                         @if($answer2->ans_input_type == 1) <div class="badge badge-warning">Dropdown</div>@else <div class="badge badge-danger">Radio checkbox</div>@endif
                                                    <hr>
                                                    <div class="modal fade" id="EmergencyeidtModal_{{ $question1->id }}" tabindex="-1" role="dialog"
                                                        aria-labelledby="EmergencyModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="EmergencyModalLabel">Edit Emergency Preparedness Q&A</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    @php
                                                                        $question_type = App\Models\AssementQuestionType::all();
                                                                    @endphp
                                                                    <form
                                                                        action="{{ route('admin.assessment-management.update_question',$question1->id) }}"
                                                                        id="question-form" method="post">
                                                                        @csrf
                                                                        <input type="hidden" name="interior_type_id" value="5"> 
                                                                        <div class="row">
                                                                            <div class="col-md-12 py-4">
                                                                                <label for="">Select Question type</label>
                                                                                <select name="type_id" id=""
                                                                                    class="form-control">
                                                                                    @foreach ($question_type as $type) 
                                                                                        <option value="{{ $type->id }}"
                                                                                            @if($type->id == $question1->type_id) selected @endif>{{ $type->name }}</option> 
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <br>
                                                                            <div class="col-md-12">
                                                                                <label for="">Question</label>
                                                                                <input type="text" name="question" value="{{ $question1->question }}"
                                                                                    class="form-control" required
                                                                                    placeholder="Enter Question">
                                                                            </div>
                                                                            <br>
                                                                           
                                                                            <div class="col-md-12 py-4">
                                                                                <label for="">Select option input type</label>
                                                                                <select name="ans_input_type" id=""
                                                                                    class="form-control">
                                                                                    <option value="0">Radio checkbox</option>
                                                                                    <option value="1">Select Dropdown</option>
                                                                                </select>
                                                                            </div>
                                                                            <br> 
                                                                            {{-- <div class="row"> --}}
                                                                                @foreach ($question1->answerOption as $option)
                                                                                    <div class="col-md-10" id="ans_div_{{ $option->id }}">
                                                                                        <label for="">Answer Text</label>
                                                                                        <input type="text" name="ans_text[]"
                                                                                            class="form-control" required
                                                                                            placeholder="Enter Answer" value="{{ $option->ans_text }}">

                                                                                            <button class="btn" type="button" onclick="delete_option({{ $option->id }})"><i class="fa fa-trash"></i></button>
                                                                                    </div>
                                                                                    @push('custom_scripts')
                                                                                    <script>
                                                                                        function delete_option(ans_id){
                                                                                            $('#ans_div_'+ans_id+'').remove();
                                                                                        }
                                                                                    </script>
                                                                                    @endpush
                                                                                @endforeach
                                                                                <div id="ans_append_{{ $question1->id }}"></div>
                                                                                
                                                                                <div class="col-md-2" style="padding: 24px;">
                                                                                    <button
                                                                                        class="btn btn-primary add-ans-option"
                                                                                        type="button"><i
                                                                                            class="fa fa-plus"></i></button>
                                                                                </div> 
                                                                            {{-- </div> --}}
                                                                        </div> 
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Save changes</button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="col-4">
                                            <div class="container col-4">
                                                <a href="javascript:;" data-toggle="modal" data-target="#EmergencyModal"
                                                    class="btn btn-primary">Create Emergency Preparedness Q&A</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="EmergencyModal" tabindex="-1" role="dialog"
                                        aria-labelledby="EmergencyModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="Emergency ModalLabel">Create Emergency Preparedness Q&A</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('admin.assessment-management.store_question') }}"
                                                        method="post">
                                                        @csrf
                                                        <input type="hidden" name="type_id" value="5">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label for="">Question</label>
                                                                <input type="text" name="question" class="form-control"
                                                                    required placeholder="Enter Question">
                                                            </div>
                                                            <br>
                                                            <div class="col-md-12 py-4">
                                                                <label for="">Select option type</label>
                                                                <select name="ans_input_type" id="" class="form-control">
                                                                    <option value="0">Radio checkbox</option>
                                                                    <option value="1">Select Dropdown</option>
                                                                </select>
                                                            </div>
                                                            <br>
                                                            <div class="container col-md-10">
                                                                <label for="">Answer Text</label>
                                                                <input type="text" name="ans_text[]"
                                                                    class="form-control" required
                                                                    placeholder="Enter Answer">
                                                            </div>
                                                            <div id="text_ans_append_5"></div>
                                                            <div class="container col-md-2">
                                                                <button class="btn btn-primary add-ans-option5" id="add-ans-option5"
                                                                    type="button"><i class="fa fa-plus"></i></button>
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Create</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @push('custom_scripts')
                                        <script>
                                            $('#add-ans-option5').click(function(){ 
                                                var random_id = Math.random().toString().substring(2);
                                                var htmla = `
                                                <div class="row mt-2" id="appended_option_${random_id}">
                                                    <div class="col-md-10">
                                                        <label for="">Answer Text</label>
                                                        <input type="text" name="ans_text[]" class="form-control" required placeholder="Enter Answer">
                                                    </div>
                                                    <div class="col-md-2 d-flex align-items-end">
                                                        <button class="btn btn-danger remove-ans-option" onclick="delete_appended_option('appended_option_${random_id}')" id="delete_option_append_{{ $question1->id }}"  type="button"><i class="fa fa-minus"></i></button>
                                                    </div>
                                                </div>`; 
                                                
                                                $('#text_ans_append_5').append(htmla);
                                            }); 

                                            function delete_appended_option(appended_div_id){
                                                $('#' + appended_div_id).remove();
                                            }
                                        </script>
                                    @endpush
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
@push('custom_scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>
    <script>
        $('.add-ans-option').click(function () { 
            var html =
                '<div class="row"><div class="col-md-10"><label for="">Answer Text</label><input type="text" name="ans_text[]" class="form-control" required placeholder="Enter Answer"></div><div class="col-md-2"><button class="btn btn-danger remove-ans-option" type="button"><i class="fa fa-minus"></i></button></div></div>';
            $('#ans_append').append(html);
        });
        
    </script>
 

@endpush