@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('orders.create') }}"> Create Sales Order</a>
            </div>
        </div>
    </div>



    <hr>
    <table class="table table-striped table-bordered dt-responsive nowrap" id="usersTable">
        <thead>
            <tr>
                <th>Sn#</th>
                <th>Sales Order No.</th>
                <th>Customer</th>
                <th>Care manager</th>
                <th>Total Invoiced</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Stage</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $key => $value)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>
                        <a type="button" class="btn btn-link" onclick="fillModalDetails('{{ route('download.order', ['order_no' => $value->order_no ]) }}', '{{$value->order_no}}')" data-toggle="modal" data-target="#salesOrderModal">{{ $value->order_no }}</a>
                    </td>
                    <td>
                        {{ $value->customer->first_name }} {{ $value->customer->last_name ?? '' }}
                    </td>
                    <td>
                        {{ $value->caregiver->first_name }} {{ $value->caregiver->last_name ?? '' }}
                    </td>
                    <td>
                        {{ env('currency') }} {{ $value->total_invoiced }}
                    </td>
                    <td>
                        {{ date('d-m-Y', strtotime($value->start_date)) }}
                    </td>
                    <td>
                        {{ date('d-m-Y', strtotime($value->end_date)) }}
                    </td>
                    <td>
                        {{ $value->stage }}
                    </td>
                    <td>
                        {{ $value->status == 0 ? 'Unpaid' : 'Paid' }}
                    </td>
                    <td>
                        <a class="btn btn-info btn-sm" href="{{ route('orders.show', $value->id) }}">Show</a>
                        <a class="btn btn-primary btn-sm" href="{{ route('orders.edit', $value->id) }}">Edit</a>
                        {!! Form::open(['method' => 'DELETE', 'route' => ['orders.destroy', $value->id], 'style' => 'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <!-- Modal -->
    <div class="modal fade" id="salesOrderModal" tabindex="-1" role="dialog" aria-labelledby="salesOrderModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Sales Order #<span id="sales_order_no"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <a href="#" class="btn btn-primary" id="download_quotation_url">Download Quotation</a>
                    <a href="#" class="btn btn-success" data-dismiss="modal">Confirm Sales Order</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ url('') }}/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script>
        $('#usersTable').DataTable()
        function fillModalDetails(downloadQuotationUrl, order_no) {
            $('#download_quotation_url').attr('href', downloadQuotationUrl)
            $('#sales_order_no').text(order_no)
        }
    </script>
@endsection
