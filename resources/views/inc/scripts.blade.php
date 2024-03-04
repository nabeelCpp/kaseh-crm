<!-- jQuery -->
<script src="{{ url('') }}/vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{ url('') }}/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- FastClick -->
<script src="{{ url('') }}/vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="{{ url('') }}/vendors/nprogress/nprogress.js"></script>

@if (isset($dataTable) && $dataTable)
    <script src="{{ url('') }}/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ url('') }}/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="{{ url('') }}/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="{{ url('') }}/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="{{ url('') }}/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ url('') }}/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="{{ url('') }}/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
@endif
<!-- Custom Theme Scripts -->
<script src="{{ url('') }}/vendors/build/js/custom.min.js"></script>
<script>
    $(document).ready(function() {
        $('[type="submit"]').click(function(e) {
            let requiredFields = $("[required]");
            requiredFields.each(function() {
                if(!$(this).val()){
                    e.preventDefault();
                    $(this).parents('.form-group').addClass('bad');
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                }else{
                    if($(this).parents('.form-group').hasClass('bad')){
                        $(this).parents('.form-group').removeClass('bad');
                    }
                }
            })
        })
    })
</script>
