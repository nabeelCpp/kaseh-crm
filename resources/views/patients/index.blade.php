@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('patients.create') }}"> Create New Patient</a>
        </div>
    </div>
</div>



<hr>
<table class="table table-striped table-bordered dt-responsive nowrap" id="usersTable">
    <thead>
        <tr>
          <th>No</th>
          <th>Patient Name</th>
          <th>Blood Group</th>
          <th>Diseas</th>
          <th>Customer</th>
          <th width="280px">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($patients as $key => $pt)
         <tr>
           <td>{{ ++$key }}</td>
           <td>
                {{ $pt->name }}
                @if($pt->age) <br><small class="text-muted">Age: {{ $pt->age }}</small> @endif
            </td>
           <td>{{ $pt->blood_group }}</td>
           <td>{{ $pt->disease }}</td>
           <td>
             {{ $pt->user->name }}
           </td>
           <td>
              <a class="btn btn-info btn-sm" href="{{ route('patients.show',$pt->id) }}">Show</a>
              <a class="btn btn-primary btn-sm" href="{{ route('patients.edit',$pt->id) }}">Edit</a>
                {!! Form::open(['method' => 'DELETE','route' => ['patients.destroy', $pt->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
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
