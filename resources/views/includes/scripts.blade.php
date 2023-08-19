<script src="{{ asset('/') }}assets/vendor/libs/jquery/jquery.js"></script>
<script src="{{ asset('/') }}assets/vendor/libs/popper/popper.js"></script>
<script src="{{ asset('/') }}assets/vendor/js/bootstrap.js"></script>

<script src="{{ asset('/') }}assets/vendor/libs/hammer/hammer.js"></script>

<script src="{{ asset('/') }}assets/vendor/libs/i18n/i18n.js"></script>
<script src="{{ asset('/') }}assets/vendor/libs/typeahead-js/typeahead.js"></script>

<script src="{{ asset('/') }}assets/vendor/js/menu.js"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{ asset('/') }}assets/vendor/libs/apex-charts/apexcharts.js"></script>

<!-- Main JS -->
<script src="{{ asset('/') }}assets/js/main.js"></script>

<!-- Page JS -->
<script src="{{ asset('/') }}assets/js/dashboards-analytics.js"></script>
<!-- Vendors JS -->
<script src="{{ asset('/') }}assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
<script src="{{ asset('/') }}assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
{{-- Waitme --}}
<script src="{{ asset('assets/waitMe/waitMe.js') }}"></script>


<!-- Flat Picker -->
<script src="{{ asset('/') }}assets/vendor/libs/moment/moment.js"></script>
<script src="{{ asset('/') }}assets/vendor/libs/flatpickr/flatpickr.js"></script>
<script src="{{ asset('/') }}assets/vendor/libs/jquery-timepicker/jquery-timepicker.js"></script>

<script src="{{ asset('/') }}assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js"></script>
<script src="{{ asset('/') }}assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js"></script>


<script src="{{ asset('/') }}assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
<script src="{{ asset('/') }}assets/vendor/libs/toastr/toastr.js"></script>

<script src="{{ asset('/') }}assets/vendor/libs/select2/select2.js"></script>

<script src="{{ asset('/') }}assets/js/ui-popover.js"></script>

<script>

    $(document).ready(function() {
        $('.select').select2({
            placeholder: "Pilih data",
            allowClear:true
        });
        
        $(".tanggal").flatpickr({
        monthSelectorType: 'static',
        locale: {
            weekdays: {
            shorthand: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
            longhand: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']
            }
            }
        });
     
    });
      //flash message
       @if(session()->has('success'))
        Swal.fire({
            type: "success",
            icon: "success",
            title: "BERHASIL!",
            text: "{{ session('success') }}",
            timer: 3000,
            showConfirmButton: false,
            showCancelButton: false,
            buttons: false,
        });
        @elseif(session()->has('error'))
        Swal.fire({
            type: "error",
            icon: "error",
            title: "GAGAL!",
            text: "{{ session('error') }}",
            timer: 3000,
            showConfirmButton: false,
            showCancelButton: false,
            buttons: false,
        });
        @elseif(session()->has('info'))
        Swal.fire({
            type: "info",
            icon: "info",
            title: "Info!",
            text: "{{ session('info') }}",
            timer: 3000,
            showConfirmButton: false,
            showCancelButton: false,
            buttons: false,
        });
    @endif
</script>