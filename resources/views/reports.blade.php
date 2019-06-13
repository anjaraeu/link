@extends('layouts.app')

@section('mainclass')
long
@endsection

@section('content')
    <div class="title">{{ __('admin.reports.title') }}</div>
    @foreach ($reports as $report)
        <admin-report initreport="{{ json_encode($report) }}"></admin-report>
    @endforeach
@endsection
