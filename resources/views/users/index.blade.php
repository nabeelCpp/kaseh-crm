@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <p class="text-muted">Roles</p>
            <button class="btn btn-outline-dark btn-sm @if(!request()->has('role')) active @endif" onclick="window.location.href='{{ route('users.index') }}'">All</button>
            @foreach ($roles as $role)
                <button class="btn btn-outline-dark btn-sm @if(request('role') == $role->name) active @endif" onclick="window.location.href='{{ route('users.index') }}?role={{ $role->name }}'">{{ $role->name }}</button>
            @endforeach
        </div>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
        </div>
    </div>
</div>



<hr>
<table class="table table-striped table-bordered dt-responsive nowrap" id="usersTable">
    <thead>
        <tr>
          <th>No</th>
          <th>Name</th>
          <th>Email</th>
          <th>Roles</th>
          <th width="280px">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key => $user)
         <tr>
           <td>{{ ++$key }}</td>
           <td>
                <div class="row">
                    <div class="col-sm-3">
                        <img src="@if (!$user->image) {{ asset("storage/uploads/users/user.png") }} @else {{ asset("storage/{$user->image}") }} @endif" alt="{{ $user->name }}" class="img img-thumbnail rounded mr-2" >

                    </div>
                    <div class="col-sm-9">
                        {{ $user->name }}
                        @if($user->phone) <br><small class="text-muted">Phone: {{ $user->phone }}</small> @endif
                        @if($user->dob) <br><small class="text-muted">DOB: {{ $user->dob ? date('d-M-Y', strtotime($user->dob)) : '-' }}</small> @endif
                    </div>

                </div>
            </td>
           <td>{{ $user->email }}</td>
           <td>
             @if(!empty($user->getRoleNames()))
               @foreach($user->getRoleNames() as $v)
                  <label class="badge bg-secondary text-light">{{ $v }}</label>
               @endforeach
             @endif
           </td>
           <td>
              <a class="btn btn-info btn-sm" href="{{ route('users.show',$user->id) }}">Show</a>
              <a class="btn btn-primary btn-sm" href="{{ route('users.edit',$user->id) }}">Edit</a>
              @if ($user->id != 1)
                   {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                       {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                   {!! Form::close() !!}
              @endif
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
