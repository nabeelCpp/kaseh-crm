@extends('layouts.app')
@section('content')
    <table class="table table-striped table-bordered dt-responsive nowrap" id="usersTable">
        <thead>
            <tr>
                <th>Sn#</th>
                <th>Invoice No#</th>
                <th>Care manager</th>
                <th>Created Date</th>
                <th>Paid Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $value)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>
                       {{ $value->invoice_no }}
                    </td>
                    <td>
                        {{ $value->caregiver->first_name }} {{ $value->caregiver->last_name ?? '' }}
                    </td>
                    <td>
                        {{ date('D d M Y h:i a', strtotime($value->created_at)) }}
                    </td>
                    <td>
                        {{ $value->paid_at ? date('D d M Y h:i a', strtotime($value->paid_at)) : '-' }}
                    </td>
                    <td>
                        <span class="badge @if($value->status === 'paid') badge-success @else badge-danger @endif">
                            {{ ucfirst($value->status) }}
                        </span>
                    </td>
                    <td class=" last"><a href="{{ route('payslips.show', $value->id) }}">View</a></td>
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
