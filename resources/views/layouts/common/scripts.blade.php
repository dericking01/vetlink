<script src="{{ asset('/') }}vendors/jquery/jquery.min.js"></script>
<script src="{{ asset('/') }}vendors/popper/popper.min.js"></script>
<script src="{{ asset('/') }}vendors/bootstrap/bootstrap.min.js"></script>
<script src="{{ asset('/') }}vendors/anchorjs/anchor.min.js"></script>
<script src="{{ asset('/') }}vendors/is/is.min.js"></script>
<script src="{{ asset('/') }}vendors/chart/chart.min.js"></script>
<script src="{{ asset('/') }}vendors/echarts/echarts.min.js"></script>
<script src="{{ asset('/') }}vendors/countup/countUp.umd.js"></script>
<script src="{{ asset('/') }}assets/data/world.js"></script>
<script src="{{ asset('/') }}vendors/dayjs/dayjs.min.js"></script>
<script src="{{ asset('/') }}assets/js/flatpickr.js"></script>
<script src="{{ asset('/') }}vendors/choices/choices.min.js"></script>

<script src="{{ asset('/') }}vendors/prism/prism.js"></script>
<script src="{{ asset('/') }}vendors/select2/select2.min.js"> </script>
<script src="{{ asset('/') }}vendors/select2/select2.full.min.js"> </script>
<script src="{{ asset('/') }}vendors/datatables.net/jquery.dataTables.min.js"></script>
<script src="{{ asset('/') }}vendors/datatables.net-bs5/dataTables.bootstrap5.min.js"> </script>
<script src="{{ asset('/') }}vendors/datatables.net-fixedcolumns/dataTables.fixedColumns.min.js"> </script>

<script src="{{ asset('/') }}vendors/leaflet/leaflet.js"></script>
<script src="{{ asset('/') }}vendors/leaflet.markercluster/leaflet.markercluster.js"></script>
<script src="{{ asset('/') }}vendors/leaflet.tilelayer.colorfilter/leaflet-tilelayer-colorfilter.min.js"></script>
<script src="{{ asset('/') }}vendors/fontawesome/all.min.js"></script>
<script src="{{ asset('/') }}vendors/lodash/lodash.min.js"></script>
<script src="../../../polyfill.io/v3/polyfill.min58be.js?features=window.scroll"></script>
<script src="{{ asset('/') }}vendors/list.js/list.min.js"></script>
<script src="{{ asset('/') }}assets/js/theme.js"></script>
  <!-- toastr js -->
  <script src="{{ asset('toastr/toastr.min.js') }}"></script>

  <!-- summernote js -->
  <script src="{{ asset('summernote/summernote-bs4.min.js') }}"></script>
  <script>
      $(document).ready(function() {
          $('.summernote').summernote({
              height: 200 // Set the height to 300 pixels
          });
      });
  </script>

  {!! Toastr::message() !!}

  @if ($errors->any())
      <script>
          @foreach ($errors->all() as $error)
              toastr.error('{{ $error }}', Error, {
                  CloseButton: true,
                  ProgressBar: true
              });
          @endforeach
      </script>
  @endif



  <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('paymentType').addEventListener('change', function() {
            var issuerSelect = document.getElementById('issuer');
            issuerSelect.innerHTML = '';

            if (this.value == 'Bank') {
                var banks = ['CRDB', 'NMB', 'NBC', 'Equity'];
                banks.forEach(function(bank) {
                    var option = document.createElement('option');
                    option.value = bank;
                    option.text = bank;
                    issuerSelect.add(option);
                });
            } else if (this.value == 'Mobile') {
                var mobileIssuers = ['M-PESA', 'TigoPesa', 'AirtelMoney', 'HaloPesa'];
                mobileIssuers.forEach(function(issuer) {
                    var option = document.createElement('option');
                    option.value = issuer;
                    option.text = issuer;
                    issuerSelect.add(option);
                });
            }
        });
    });
</script>