<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;
use App\ShortLink;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $reports = Report::where('pending', true)->get()->all();
        // $ret = array();
        // foreach ($reports as $report) {
        //     $report->load('short_link');
        //     foreach ($ret as $secreport) {
        //         if ($secreport->short_link)
        //     }
        // }
        // dd($ret);
        $links = ShortLink::all()->all();
        $ret = array();
        foreach ($links as $link) {
            if ($link->reports->count() == 0) {
                continue;
            }
            $ret[$link->reports->count().'-'.$link->id] = $link;
        }
        foreach ($ret as $link) {
            $link->load('reports');
        }
        krsort($ret, SORT_NUMERIC);
        // dd($ret);
        return view('reports', ['reports' => $ret]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('report');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'link' => [
                'required',
                'url',
                'regex:/^'.str_replace('/', '\\/', url('/[A-Za-z0-9]{6}')).'$/'
            ],
            'reason' => 'required'
        ]);
        $link = ShortLink::where('slug', substr($data['link'], -6))->get()->first();
        if (empty($link)) {
            return response()->json(['errors' => ['link' => __('validation.present', ['attribute' => 'link'])], 'message' => __('The given data was invalid.')], 422);
        }
        Report::create([
            'short_link_id' => $link->id,
            'reason' => $data['reason']
        ]);
        return response()->json(['report' => 'created']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Report $report)
    {
        if ($request->input('delete_link')) {
            foreach (Report::where('short_link_id', $report->short_link_id)->get()->all() as $rep) {
                $rep->delete();
            }
            $report->short_link->delete();
        } else {
            foreach (Report::where('short_link_id', $report->short_link_id)->get()->all() as $rep) {
                $rep->delete();
            }
        }
        return response()->json(true);
    }
}
