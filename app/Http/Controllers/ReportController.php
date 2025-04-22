<?php

namespace App\Http\Controllers;

use App\Models\AssementFillup;
use App\Models\ReportSetting;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ReportController extends Controller
{
    //
    public function store_report_setting(Request $request)
    {
        // dd($request->all());
        if ($request->hasFile("report_logo")) {
            $file = $request->file("report_logo");
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = public_path("uploads/report_setting");
            $file->move($path, $filename);
        } else {
            $reportSetting = ReportSetting::find(1);
            $filename = $reportSetting->report_logo;
        }
        ReportSetting::where('id', 1)->update(array(
            'report_title' => $request->report_title,
            'report_logo' => $filename,
            'report_phone' => $request->report_phone,
            'report_email' => $request->report_email,
            'report_address' => $request->report_address,
        ));

        return redirect()->back()->with('success', 'Report Successfuly Saved...');
    }

    public function index(Request $request)
    {
        $page_title = 'Reports';
        $assessment = AssementFillup::select('assement_no', 'customer_id', 'created_at', 'employee_id')
            ->distinct('assement_no')->get();
        // dd($assessment);
        if ($request->ajax()) {
            return DataTables::of(source: $assessment)
                ->addIndexColumn()

                ->addColumn('cus_name', function ($row) {
                    return $row->customer->f_name . ' ' . $row->customer->l_name;
                })
                ->addColumn('date_created', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('email', function ($row) {
                    return $row->customer->email;
                })
                ->addColumn('assessment_by', function ($row) {
                    return $row->assessment_by->name . ' (' . $row->assessment_by->email . ')';
                })
                ->addColumn('risk_score', function ($row) {
                    return round($row->assessment_riskscore->avg('scoring'));
                })
                ->addColumn('report', function ($row) {
                    if ($row->assessment_report) {
                        return '<a href="' . asset($row->assessment_report->report_file) . '" _blank>Download report</a>';
                    } else {
                        return 'No report generated';
                    }
                })
                ->addColumn('action', function ($row) {
                    return '<a href="' . route('admin.assessment-management.edit', $row->assement_no) . '">Edit</a>';
                })

                ->rawColumns(['id', 'cus_name', 'date_created', 'email', 'assessment_by', 'risk_score', 'report', 'action'])
                ->make(true);
        }

        return view('Admin.report.index', get_defined_vars());
    }

}
