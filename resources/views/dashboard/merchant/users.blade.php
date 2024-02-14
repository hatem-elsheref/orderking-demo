@extends('dashboard.merchant.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Users') }}</div>
                    <div class="card-body">
                        <table class="table table-borders" id="ajax-table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        @if($user->status)
                                            <span class="badge bg-success">Approved</span>
                                        @else
                                            <span class="badge bg-danger">Not Approved</span>

                                        @endif
                                    </td>
                                    <td>

                                    @if(!$user->status)
                                        <form action="" method="post">
                                            @csrf
                                            <input type="hidden" name="customer_id" value="{{$user->id}}">
                                            <button class="btn btn-sm btn-primary">Approve</button>
                                        </form>
                                    @endif
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        {!! $users->render('vendor.pagination.bootstrap-4') !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        new DataTable('#ajax-table', {
            ajax: 'data/arrays.txt'
        });
    </script>
@endsection