@extends('layouts.app')

@section('content')
    <div class="title">{{ config('app.name') }}</div>
    <admin-panel initlogin="{{ session('admin', false) }}"></admin-panel>
@endsection
