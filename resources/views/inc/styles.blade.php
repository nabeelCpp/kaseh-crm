<!-- Bootstrap -->
<link href="{{ url('') }}/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link href="{{ url('') }}/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<!-- NProgress -->
<link href="{{ url('') }}/vendors/nprogress/nprogress.css" rel="stylesheet">

<!-- Custom Theme Style -->
@if (isset($dataTable) && $dataTable)
<link href="{{ url('') }}/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="{{ url('') }}/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="{{ url('') }}/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="{{ url('') }}/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="{{ url('') }}/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
@endif
<link href="{{ url('') }}/vendors/build/css/custom.min.css" rel="stylesheet">
<style>

    .required::after{
        color: red;
        font-weight: bold;
        content: ' *'
    }
</style>

