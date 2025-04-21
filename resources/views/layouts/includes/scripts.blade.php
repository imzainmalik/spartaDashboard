<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="{{ asset('assets/js/all.min.js') }}"></script>
<script src="{{ asset('assets/js/custom.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

<script>
    @if (session('error'))
        Swal.fire({
            title: 'Error!',
            text: '{{ session('error') }}',
            icon: 'error',
            confirmButtonText: 'Ok!'
        })
    @endif
    @if (session('success'))
        Swal.fire({
            title: 'Success!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'Ok!'
        })
    @endif
    @if (session('warning'))
        Swal.fire({
            title: 'Warning!',
            text: '{{ session('warning') }}',
            icon: 'warning',
            confirmButtonText: 'Ok!'
        })
    @endif
    @if (session('info'))
        Swal.fire({
            title: 'Info!',
            text: '{{ session('info') }}',
            icon: 'info',
            confirmButtonText: 'Ok!'
        })
    @endif
</script>
