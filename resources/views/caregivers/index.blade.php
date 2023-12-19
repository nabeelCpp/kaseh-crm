@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('caregivers.create') }}"> Create New Caregiver</a>
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
        @foreach ($data as $key => $caregivers)
         <tr>
           <td>{{ ++$key }}</td>
           <td>
                <div class="row">

                    <div class="col-sm-9">
                        {{ $caregivers->first_name }}
                    </div>

                </div>
            </td>
            <td>
           {{ $caregivers->last_name }}
            </td>
           <td>
                <a class="btn btn-info btn-sm" href="{{ route('caregivers.show',$caregivers->id) }}">Show</a>
                <a class="btn btn-primary btn-sm" href="{{ route('caregivers.edit',$caregivers->id) }}">Edit</a>
                {!! Form::open(['method' => 'DELETE','route' => ['caregivers.destroy', $caregivers->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                {!! Form::close() !!}
           </td>
         </tr>
        @endforeach
    </tbody>
    <!-- <tbody>
        <tr>
            <th>1</th>
            <td>Customer 1</td>
            <td>091001901</td>
            <td>customer@1.com</td>
            <td>
                <a class="btn btn-info btn-sm" href="#">Show</a>
                <a class="btn btn-primary btn-sm" href="#">Edit</a>
                {{-- {!! Form::open(['method' => 'DELETE','route' => ['customers.destroy', $pt->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                {!! Form::close() !!} --}}
                {{-- uncomment the upper line for delete functionality and remove this a href line. --}}
                <a class="btn btn-danger btn-sm" href="#">Delete</a>
             </td>
        </tr>
    </tbody> -->
</table>


@endsection

@section('js')
    <script src="{{ url('') }}/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script>
        $('#usersTable').DataTable()
    </script>
@endsection
