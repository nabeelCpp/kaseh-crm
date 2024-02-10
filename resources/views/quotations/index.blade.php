@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('quotations.create') }}"> Create Quotations</a>
        </div>
    </div>
</div>



<hr>
<table class="table table-striped table-bordered dt-responsive nowrap" id="usersTable">
    <thead>
        <tr>
          <th>No</th>
          <th>Customer</th>
          <th>Caregiver</th>
          <th width="280px">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key => $quotation)
         <tr>
           <td>{{ ++$key }}</td>
           <td>
                <div class="row">

                    <div class="col-sm-9">
                        {{ $quotation->customer->first_name}}
                    </div>

                </div>
            </td>
            <td>
           {{ $quotation->caregiver->first_name }}
            </td>
           <td>
                <a class="btn btn-info btn-sm" href="{{ route('quotations.show',$quotation->id) }}">Show</a>
                <a class="btn btn-primary btn-sm" href="{{ route('quotations.edit',$quotation->id) }}">Edit</a>
                {!! Form::open(['method' => 'DELETE','route' => ['quotations.destroy', $quotation->id],'style'=>'display:inline']) !!}
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
