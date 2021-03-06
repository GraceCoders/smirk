<script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('dist/js/jquery.ui.touch-punch-improved.js') }}"></script>
<script src="{{ asset('dist/js/jquery-ui.min.js') }}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{ asset('assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{ asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('assets/extra-libs/sparkline/sparkline.js') }}"></script>
<!--Wave Effects -->
<script src="{{ asset('dist/js/waves.js') }}"></script>
<!--Menu sidebar -->
<script src="{{ asset('dist/js/sidebarmenu.js') }}"></script>
<!--Custom JavaScript -->
<script src="{{ asset('dist/js/custom.min.js') }}"></script>
<!-- this page js -->
<script src="{{ asset('assets/libs/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('assets/libs/fullcalendar/dist/fullcalendar.min .js') }}"></script>
<script src="{{ asset('dist/js/pages/calendar/cal-init.js') }}"></script>
<script src="{{ asset('assets/extra-libs/multicheck/datatable-checkbox-init.js') }}"></script>
<script src="{{ asset('assets/extra-libs/multicheck/jquery.multicheck.js') }}"></script>
<script src="{{ asset('assets/extra-libs/DataTables/datatables.min.js') }}"></script>
<script>
    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    // ==============================================================
    // Login and Recover Password
    // ==============================================================
    $('#to-recover').on("click", function() {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });
    $('#to-login').click(function() {

        $("#recoverform").hide();
        $("#loginform").fadeIn();
    });
    var table = jQuery('#ethnicity-table').DataTable({
        "pagingType": "numbers",
        "responsive": true,
        "processing": true,
        "serverSide": true,
        "orderable": false,
        "ajax": {
            "url": "{{ route('ethnicities.list') }}",
            "dataType": "json",
            "type": "POST",
            "data": function(data) {
                var searchData = $('input[type=search]').value;
                var statusData = $('input[type=radio]:checked').val();
                data.searchText = searchData;
                data.statusData = statusData;
                data._token = '{{ csrf_token() }}';
            }
        },
        columns: [{
                "data": "title"
            },
            {
                data: "status",
                "render": function(data, type, row) {
                    if (row.status == '1') {
                        return 'Active';
                    } else {
                        return 'Deactive';
                    }
                }
            }
        ],
    });
</script>
<script>
    function activateOrDeactivate(type, id, action) {
        alert(id);
    }
</script>
