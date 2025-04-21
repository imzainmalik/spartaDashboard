<?php

namespace App\Http\Controllers;

use App\Models\AssementFillup;
use App\Models\AssementNotes;
use App\Models\AssementQuestion;
use App\Models\AssementQuestionType;
use App\Models\Customer;
use App\Models\ReportSetting;
use Illuminate\Http\Request;
use App\Mail\AssessmentReport;
use App\Models\AssementAnswer;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;

class AssementManagementController extends Controller
{
    //
    public function create()
    {
        $page_title = 'Start Assesment';
        $customers = Customer::where('is_active', 0)->get();
        $questions = AssementQuestion::where('is_active', 0)->where('type_id', 1)->get();
        $questions2 = AssementQuestion::where('is_active', 0)->where('type_id', 2)->get();
        $questions3 = AssementQuestion::where('is_active', 0)->where('type_id', 3)->get();
        $questions4 = AssementQuestion::where('is_active', 0)->where('type_id', 4)->get();
        $questions5 = AssementQuestion::where('is_active', 0)->where('type_id', 5)->get();

        return view('Admin.assesment-management.create', get_defined_vars());
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $assement_no = rand(0, 1000000);
        foreach ($request->answer as $key => $value) {
            $assement_fillups = new AssementFillup();
            $assement_fillups->assement_no = $assement_no;
            $assement_fillups->employee_id = auth()->user()->id;
            $assement_fillups->customer_id = $request->cutomer;
            $assement_fillups->question_id = $key;
            $assement_fillups->answer_id = $value;
            $assement_fillups->save();
        }

        if ($request->scoring) {
            foreach ($request->scoring as $key => $value) {

                $filename = null;

                // Check if file exists for this specific key
                if ($request->hasFile("file.$key")) {
                    $file = $request->file("file.$key");

                    if ($file) {
                        $filename = time() . '.' . $file->getClientOriginalExtension();
                        $path = public_path("uploads/assesment/$assement_no/$key");

                        if (!file_exists($path)) {
                            mkdir($path, 0777, true);
                        }

                        $file->move($path, $filename);
                    }
                }

                $assement_notes = new AssementNotes();
                $assement_notes->assement_no = $assement_no;
                $assement_notes->question_type_id = $key;
                $assement_notes->file = $filename ? $filename : null;
                $assement_notes->scoring = $value;
                $assement_notes->security_notes = $request->notes[$key];
                $assement_notes->save();
            }
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Assessment submitted successfully.',
            'assement_no' => $assement_no,
        ]);
    }



    public function assessment_preview($assement_no)
    {
        $page_title = 'Assessment Preview';
        $assessment_fillup = AssementFillup::where('assement_no', $assement_no)->first();
        $customers = Customer::where('id', $assessment_fillup->customer_id)->first();

        $types = AssementQuestionType::with([
            'questions.fillups' => function ($q) use ($assement_no) {
                $q->where('assement_no', $assement_no);
            }
        ])->get();


        $assement_notes = AssementNotes::where('assement_no', $assement_no)->get();
        // dd();
        if (!$types) {
            abort(404);
        }

        return view('Admin.assesment-management.preview', get_defined_vars());
    }

    public function donwload_pdf_report($assement_no)
    {

        $types = AssementQuestionType::with([
            'questions.fillups' => function ($q) use ($assement_no) {
                $q->where('assement_no', $assement_no);
            }
        ])->get();

        $assement_notes = AssementNotes::where('assement_no', (int) $assement_no)->get();

        $pdf = Pdf::loadView('email.report_email', [
            'assement_no' => $assement_no,
            'types' => $types,
            'assement_notes' => $assement_notes,
        ]);

        $fileName = "assessment_{$assement_no}.pdf";
        $filePath = public_path('pdfs/assessments'); // Absolute path to public folder

        // Make directory if it doesn't exist
        if (!File::exists($filePath)) {
            File::makeDirectory($filePath, 0777, true);
        }

        // Save the PDF in the public folder
        $pdf->save($filePath . '/' . $fileName);

        // Optional: return the PDF to download
        return response()->download($filePath . '/' . $fileName);
    }


    public function send_report(Request $request, $assement_no)
    {

        $types = AssementQuestionType::with([
            'questions.fillups' => function ($q) use ($assement_no) {
                $q->where('assement_no', $assement_no);
            }
        ])->get();

        $assement_notes = AssementNotes::where('assement_no', (int) $assement_no)->get();
        // dd($assement_notes);
        if (!$types) {
            abort(404);
        }


        $pdf = Pdf::loadView('email.report_email', [
            'assement_no' => $assement_no,
            'types' => $types,
            'assement_notes' => $assement_notes,
        ]);

        $fileName = "assessment_{$assement_no}.pdf";
        $filePath = public_path('pdfs/assessments'); // Absolute path to public folder

        // Make directory if it doesn't exist
        if (!File::exists($filePath)) {
            File::makeDirectory($filePath, 0777, true);
        }

        // Save the PDF in the public folder
        $pdf->save($filePath . '/' . $fileName);

        // return $pdf->download("assessment_{$assement_no}.pdf");

        // return view('email.report_email', get_defined_vars());
        Mail::to($request->client_email)->send(new AssessmentReport($types, $assement_notes, asset('pdfs/assessments/' . $fileName)));
        // dd($types, $assement_notes, $directory);
        return redirect()->route('admin.assessment-management.create')->with('success', 'Report sent successfully!');
    }

    public function setting_index(Request $request)
    {
        $page_title = 'Assessment Setting';
        $questions1 = AssementQuestion::where('is_active', 0)->where('type_id', 1)->get();
        $questions2 = AssementQuestion::where('is_active', 0)->where('type_id', 2)->get();
        $questions3 = AssementQuestion::where('is_active', 0)->where('type_id', 3)->get();
        $questions4 = AssementQuestion::where('is_active', 0)->where('type_id', 4)->get();
        $questions5 = AssementQuestion::where('is_active', 0)->where('type_id', 5)->get();
        // $questions = AssementQuestion::where('is_active', 0)->get();
        // $question_types = AssementQuestionType::where('is_active', 0)->get();
        // dd($questions5);
        $reportsetting = ReportSetting::where("id", 1)->first();

        return view('Admin.assesment-management.setting.index', get_defined_vars());
    }

    public function store_question(Request $request)
    {
        // dd($request->all());
        $question = new AssementQuestion();
        $question->question = $request->question;
        $question->type_id = $request->type_id;
        $question->is_active = 0;
        $question->save();

        foreach ($request->ans_text as $ans_text) {
            $ans = new AssementAnswer();
            $ans->question_id = $question->id;
            $ans->ans_text = $ans_text;
            $ans->ans_input_type = $request->ans_input_type;
            $ans->save();
        }

        return redirect()->back()->with('success', 'Question created successfully');

    }

    public function edit_question(Request $request, $type_id)
    {
        $page_title = 'Edit Questioniers';
        $questions = AssementQuestion::where('is_active', 0)->where('type_id', $type_id)->get();

        return view('Admin.assesment-management.setting.edit_questioniers', get_defined_vars());

    }

    public function update_question(Request $request, $question_id)
    { 
        // dd($request->all());

        AssementQuestion::where('id', $question_id)->update(array(
            'question' => $request->question,
            'type_id' => $request->type_id,
        ));

        $AssementAnswers = AssementAnswer::where('question_id', $question_id)->get();

        foreach ($AssementAnswers as $AssementAnswer) { 
            AssementAnswer::where('question_id', $question_id)->update(array(
                'is_active' => 1
            )); 
        }

        foreach($request->ans_text as $ans_text) {
            $create_new_ans = new AssementAnswer;
            $create_new_ans->question_id = $question_id;
            $create_new_ans->ans_text = $ans_text;
            $create_new_ans->ans_input_type = $request->ans_input_type;
            $create_new_ans->is_active = 0;
            
            $create_new_ans->save();
        }
        return redirect()->back()->with('success','Question updated successfuly'); 
    }

    public function delete_question(Request $request, $question_id){
        AssementQuestion::where('id', $question_id)->update(array(
            'is_active' => 1, 
        ));
        return redirect()->back()->with('success', 'Question deleted successfully');

    }
}
