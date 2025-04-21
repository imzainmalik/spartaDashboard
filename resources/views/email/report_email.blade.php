<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Security Assessment Report</title>

</head>

<body>
    <h3>Security Assessment Report</h3>

    <div class="container">
        <h4>Perimeter Security</h4>
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
        <hr>
        <h4>Entry Points</h4>
        <ul>
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
        </ul>

        <h4>Lighting & Cameras</h4>
        <ul>
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
        </ul>

        <h4>Interior Security</h4>
        <ul>
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
        </ul>


        <h4>Emergency Preparedness</h4>
        <ul>
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
        </ul>


    </div>
    <div class="container">
        <h4>Scoring</h4>
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
            <h5>Score: {{ $assement_notes[2]->scoring }}</h5>
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
        <div
            style="font-family: Arial, sans-serif; padding: 30px; text-align: center; position: relative; width: 400px; height: 40px; background: linear-gradient(to right, #90ee90, #ffff00, #ffa500, #ff0000); border-radius: 5px; margin: 30px auto 10px auto;">
            <div id="arrow"
                style="position: absolute; top: -9px; width: 0; height: 0; border-left: 10px solid transparent; border-right: 10px solid transparent; border-bottom: 20px solid black; transition: left 0.3s ease; transform: rotate(180deg); left: {{ $riskPercentage }}%;">
            </div>
        </div>

        <div style="display: flex; justify-content: space-between; width: 400px; margin: 10px auto; font-size: 14px;">
            <span>No risk</span>
            <span>Low risk</span>
            <span>Medium risk</span>
            <span>High risk</span>
        </div>

    </div>
    <div class="container">
        <h4>Perimeter Security:</h4>
        <p>{{ $assement_notes[0]->security_notes }}</p>
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
                target="_blank">{{ basename($assement_notes[2]->file) }}</a>
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

    <div class="container">
        <p>Please find attached the detailed security assessment report for your reference.</p>
        <p>If you have any questions or need further clarification, feel free to contact us.</p>
        <p>Best regards,<br>Security Assessment Team</p>
    </div>
</body>

</html>
