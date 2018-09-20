@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Subscribers</div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created At</th>
                            <th>Expire At</th>
                            <th></th>
                        </tr>

                        @foreach($subscriptions->get() as $subscription)
                            <tr>
                                <td>{{$subscription->name}}</td>
                                <td>{{$subscription->email}}</td>
                                <td>{{$subscription->created_at}}</td>
                                <td>{{$subscription->expired_at}}</td>
                                <td>
                                    <a href="{{route('admin.subscription.edit', ['id' => $subscription->id])}}">Edit</a> <br>
                                    <a href="{{route('admin.subscription.delete', ['id' => $subscription->id])}}" class="delete-subscription">Remove</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="card-footer">
                    <form action="{{route('admin.subscription.store')}}" class="form-inline" method="POST">
                        @csrf
                        <div class="form-group">
                            <input class="form-control" name="name" id="name" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="email" id="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Add Subscriber">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $(document).on('click', '.delete-subscription', function(e){
                e.preventDefault();
                if (confirm('Are you sure you want to remove this subscription?')) {
                    deleteSubscription($(this).attr('href'));
                }
            });
        });

        function deleteSubscription(url){
            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    "_token": "{{ csrf_token() }}"
                }
            }).done(function(){
                window.location.reload();
            });
        }
    </script>
@endsection