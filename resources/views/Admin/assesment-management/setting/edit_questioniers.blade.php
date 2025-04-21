@extends('layouts.admin_app')
@section('content')

    <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body">
            <div class="container">
                <form action="{{ route('admin.assessment-management.update_question', $type_id) }}" id="question-form"
                    method="post">
                    @csrf
                    <input type="hidden" name="type_id" value="{{ $type_id }}">
                    @php
                        $index = 1;
                    @endphp
                    @foreach ($questions as $key => $item)
                                    @php
                                        $answers = App\Models\AssementAnswer::where('question_id', $item->id)->get();
                                    @endphp
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for=""><strong>Question#{{$index++}}</strong></label>
                                            <input type="text" name="question" value="{{ $item->question }}" class="form-control" required
                                                placeholder="Enter Question">
                                        </div>
                                        <br>
                                        <div class="col-md-12 py-4">
                                            <label for="">Select option type</label>
                                            <select name="ans_input_type[{{ $item->id }}]" id="" class="form-control">
                                                <option value="0">Radio checkbox</option>
                                                <option value="1">Select Dropdown</option>
                                            </select>
                                        </div>
                                        <br>
                                        <div class="row">
                                            @foreach($answers as $ans_key => $answer)
                                                <div class="col-md-10">
                                                    <label for="">Answer Text</label>
                                                    <input type="text" name="ans_text[]" value="{{ $answer->ans_text }}" class="form-control"
                                                        required placeholder="Enter Answer">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <hr>
                    @endforeach
                    <button class="btn btn-primary">Save Chnages</button>

                </form>
            </div>
        </div>
    </div>


@endsection

{{-- @push('custom_scripts')
<script>
    let autoSaveInterval = 10000; // 10 seconds
    let autoSaveTimer;
    let lastSavedData = null;
    let isFormDirty = false;

    function getFormData() {
        return $('#question-form').serialize();
    }

    function saveFormData() {
        const formData = getFormData();

        if (formData === lastSavedData) return; // No changes

        $.ajax({
            url: '{{ route('admin.assessment - management.store_question') }}',
            type: 'POST',
            data: formData,
            success: function (response) {
                console.log("Auto-saved at " + new Date().toLocaleTimeString());
                lastSavedData = formData;
                isFormDirty = false;
            },
            error: function (xhr) {
                console.error("Auto-save failed", xhr);
            }
        });
    }

    $(document).ready(function () {
        lastSavedData = getFormData();

        // Set up interval to auto-save
        autoSaveTimer = setInterval(saveFormData(), autoSaveInterval);

        // Track form changes
        $('#question-form :input').on('change input', function () {
            isFormDirty = true;
        });

        // Warn before leaving if unsaved
        window.onbeforeunload = function () {
            if (isFormDirty) {
                return "You have unsaved changes. Are you sure you want to leave?";
            }
        };

        // Optional: Save manually disables the warning
        $('#question-form').on('submit', function () {
            window.onbeforeunload = null;
        });
    });
</script>

@endpush --}}