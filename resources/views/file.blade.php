@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Downloading...</div>
                <div class="card-body">
                    <p>File: {{$file->name}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
