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
                        <a class="btn btn-info btn-sm" href="{{ route('caregivers.show', $caregivers->id) }}">Show</a>
                        <a class="btn btn-primary btn-sm" href="{{ route('caregivers.edit', $caregivers->id) }}">Edit</a>
                        {!! Form::open([
                            'method' => 'DELETE',
                            'route' => ['caregivers.destroy', $caregivers->id],
                            'style' => 'display:inline',
                        ]) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                        <button class="btn btn-warning btn-sm" onclick="copyUrl(this, {{ $caregivers->id }})">Copy</button>
                        <input type="text" id="caregiverUrl_{{ $caregivers->id }}" class="d-none"
                            value="{{ route('caregiver', $caregivers->id) }}">
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

        function copyUrl(element, id) {

            var linkInput = document.getElementById('caregiverUrl_' + id);

            var textToCopy = linkInput.value;

            navigator.clipboard.writeText(textToCopy)
                .then(function() {
                    console.log('Text copied to clipboard:', textToCopy);
                })
                .catch(function(error) {
                    console.error('Unable to copy text to clipboard:', error);
                });

            $(element).text('Copied')
            setTimeout(() => {
                $(element).text('Copy')
            }, 5000);
        }
    </script>
@endsection
