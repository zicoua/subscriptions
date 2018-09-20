@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <form action="{{route('admin.subscription.update', ['id' => $subscription->id])}}" method="POST">
                    <div class="card-header">
                        Subscribe for: <strong>{{$subscription->email}}</strong>
                    </div>
                    <div class="card-body">
                        @csrf
                        @method("PUT")
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input class="form-control" name="name" id="name" placeholder="Name" value="{{$subscription->name}}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" name="email" id="email" placeholder="Email" value="{{$subscription->email}}">
                        </div>
                        <div class="form-group">
                            <label for="expire_at">Expire At</label>
                            <input class="form-control" name="expired_at" id="expired_at" placeholder="Expire At" value="{{$subscription->expired_at}}">
                        </div>
                        <div class="form-group">
                            <label for="is_active">
                                <input type="checkbox" name="is_active" id="is_active" value="1" {{$subscription->is_active ? 'checked' : ''}}>
                                Is Active
                            </label>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Update">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
