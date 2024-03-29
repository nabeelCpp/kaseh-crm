@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('customers.create') }}"> Create New Customer</a>
        </div>
    </div>
</div>

<hr>
<table class="table table-striped table-bordered dt-responsive nowrap" id="usersTable">
    <thead>
        <tr>
          <th>No</th>
          <th>First Name</th>
          <th>Last Name</th>
          <!-- <th>Email</th> -->
          <th width="280px">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key => $customer)
         <tr>
           <td>{{ ++$key }}</td>
           <td>
                <div class="row">

                    <div class="col-sm-9">
                        {{ $customer->first_name }}
                    </div>
                </div>
            </td>
            <td>
           {{ $customer->last_name }}
            </td>
           <td>
                <a class="btn btn-info btn-sm" href="{{ route('customers.show',$customer->id) }}">Show</a>
                @if(auth()->user()->id == $customer->user_id || auth()->user()->getRoleNames() == '["Admin"]')
                <a class="btn btn-primary btn-sm" href="{{ route('customers.edit',$customer->id) }}">Edit</a>
                {!! Form::open(['method' => 'DELETE','route' => ['customers.destroy', $customer->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                    @endif
                {!! Form::close() !!}
                
           </td>
         </tr>
        @endforeach
    </tbody>
</table>


@endsection

@section('js')
    <script src="{{ url('') }}/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script>
        $('#usersTable').DataTable()
    </script>
@endsection
