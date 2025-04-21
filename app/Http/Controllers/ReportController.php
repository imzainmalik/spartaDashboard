<?php

namespace App\Http\Controllers;

use App\Models\ReportSetting;
use Illuminate\Http\Request;

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
            dd($filename);
        }
        ReportSetting::where('id', 1)->update(array(
            'report_title' => $request->report_title,
            'report_logo' => $filename,
            'report_phone' => $request->report_phone,
            'report_email' => $request->report_email,
            'report_address' => $request->report_address,
        ));

        return redirect()->back()->with('success','Report Successfuly Saved...');
    }

}
