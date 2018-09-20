@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Page A</div>
                <div class="card-body">
                    <p><a href="#">Some file</a></p>
                </div>
                <div class="card-footer">
                    <form action="{{route('subscribe')}}" type="DELETE" class="form-inline">
                        <input type="hidden" name="token" value="{{$token}}">
                        <div class="form-group">
                            <input type="email" name="email" id="email" value="" autocomplete="off" class="form-control"
                            placeholder="Email">
                        </div>
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
