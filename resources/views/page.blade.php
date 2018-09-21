@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Page A</div>
                <div class="card-body">
                    @foreach($subscription->files()->get() as $file)
                        <p><a href="{{route('file', ['token' => $file->token])}}">{{$file->name}}</a></p>
                    @endforeach
                </div>
                <div class="card-footer">
                    <form action="{{route('subscribe.delete')}}" class="form-inline" method="POST">
                        @method("DELETE")
                        @csrf
                        <input type="hidden" name="token" value="{{$subscription->token}}">
                        <div class="form-group">
                            <input type="submit" class="btn btn-danger" value="Unsubscribe">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
