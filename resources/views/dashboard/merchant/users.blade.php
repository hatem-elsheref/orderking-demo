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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>

        let table = new DataTable('#ajax-table', {
            columnDefs: [ { orderable: false, targets: [3,4] }],
            ajax: '{{route('merchant.users.ajax')}}',
            processing: true,
            serverSide: true,
            'columns': [
                { data: 'id' },
                { data: 'name' },
                { data: 'email' },
                { data: 'status' },
                { data: 'action' }
            ]
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.7.4/socket.io.js" integrity="sha512-tE1z+95+lMCGwy+9PnKgUSIeHhvioC9lMlI7rLWU0Ps3XTdjRygLcy4mLuL0JAoK4TLdQEyP0yOl/9dMOqpH/Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        const socket = io(document.location.origin + ':5000');
        const $status = document.getElementById('customer-status');
        socket.on('connect', () => {});
        socket.on('new.customer', (data) => {
            table.ajax.reload( null, false );
        });
        function approve(event) {
           socket.emit('customer.approve', JSON.stringify({
               customer: event.getAttribute('data-id')
           }))
        }
    </script>

@endsection
