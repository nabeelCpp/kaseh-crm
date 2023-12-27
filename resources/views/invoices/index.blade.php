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
          <th>Product</th>
          <th>Care Type</th>
          <th width="280px">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key => $invoices)
         <tr>
           <td>{{ ++$key }}</td>
           <td>
                <div class="row">

                    <div class="col-sm-9">
                        {{ $invoices->product}}
                    </div>

                </div>
            </td>
            <td>
           {{ $invoices->care_type }}
            </td>
           <td>
                <a class="btn btn-info btn-sm" href="{{ route('invoices.show',$invoices->id) }}">Show</a>
                <a class="btn btn-primary btn-sm" href="{{ route('invoices.edit',$invoices->id) }}">Edit</a>
                {!! Form::open(['method' => 'DELETE','route' => ['invoices.destroy', $invoices->id],'style'=>'display:inline']) !!}
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
