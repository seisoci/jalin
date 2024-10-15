<x-app-layout :config="$config ?? []" :isToastr="true" :isSweetalert="true" :assets="$assets ?? []"
              :isBanner="false" :isFlatpickr="true">
  <div>
    <div class="row">
      <div class="col-sm-12 col-lg-12">
        <div class="card">
          <div class="card-header justify-content-between">
            <div class="header-title">
              <div class="row">
                <div class="col-sm-6 col-lg-6">
                  <h4 class="card-title">{{ $config['title'] }} </h4>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-3">
                <div class="form-group">
                  <label>Tanggal <span class="text-danger">*</span></label>
                  <input id="dateUploadAwal" type="text" class="form-control datePicker" readonly/>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table id="Datatable" class="table table-bordered">
                <thead>
                <tr>
                  <th>Tgl Upload</th>
                  <th>Cabang</th>
                  <th>ACQ</th>
                  <th>ISS</th>
                  <th>Destination</th>
                  <th>Terminal</th>
                  <th>Produk</th>
                  <th>I/O</th>
                  <th>Msg</th>
                  <th>Proses</th>
                  <th>Tgl Trx</th>
                  <th>No Kartu</th>
                  <th>No Rek DB</th>
                  <th>No Rek CR</th>
                  <th>Nilai Transaksi</th>
                  <th>Nilai Transaksi Rev</th>
                  <th>Hist Post</th>
                  <th>Rec Num</th>
                </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @push('head')
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/datatables.min.css"/>
  @endpush
  @push('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
            src="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.12.1/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/b-print-2.2.3/datatables.min.js"></script>
    <script>
      $(document).ready(function () {
        let dataTable = $('#Datatable').DataTable({
          responsive: false,
          scrollX: true,
          serverSide: true,
          processing: true,
          order: [[0, 'asc']],
          lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
          pageLength: 10,
          lengthChange: false,
          ajax: {
            url: "{{ route('penampungan-bruto-core.index') }}",
            data: function (d) {
              d.transaksi = $('#select2Transaksi').find(':selected').val();
              d.tgl = $('#dateUploadAwal').val();
            }
          },
          buttons: ['pageLength', {
            extend: 'copy',
          }, {
            extend: 'csv',
          }, {
            extend: 'excel',
          }, {
            extend: 'pdf',
          },],
          columns: [
            {data: 'tgl', name: 'tgl'},
            {data: 'cabang', name: 'cabang'},
            {data: 'acq', name: 'acq'},
            {data: 'iss', name: 'iss'},
            {data: 'destination', name: 'destination'},
            {data: 'terminal', name: 'terminal'},
            {data: 'produk', name: 'produk'},
            {data: 'io', name: 'io'},
            {data: 'msg', name: 'msg'},
            {data: 'proses', name: 'proses'},
            {data: 'trx_tgl', name: 'trx_tgl'},
            {data: 'no_kartu', name: 'no_kartu'},
            {data: 'no_rek_db', name: 'no_rek_db'},
            {data: 'no_rek_cr', name: 'no_rek_cr'},
            {
              data: 'nilai_transaksi',
              name: 'nilai_transaksi',
              className: 'text-end',
              render: $.fn.dataTable.render.number(',', '.', 0, '')
            },
            {
              data: 'nilai_replace_rev',
              name: 'nilai_replace_rev',
              className: 'text-end',
              render: $.fn.dataTable.render.number(',', '.', 0, '')
            },
            {data: 'hist_post', name: 'hist_post'},
            {
              data: 'rec_num',
              name: 'rec_num',
              className: 'text-end',
              render: $.fn.dataTable.render.number(',', '.', 0, '')
            },
          ],
          initComplete: function (settings, json) {
            dataTable.buttons().container().appendTo('#Datatable_wrapper .col-md-6:eq(0)')
          }
        });

        $(".datePicker").flatpickr({
          disableMobile: true,
          dateFormat: 'Y-m-d',
          onChange: function (selectedDates, date_str, instance) {
            dataTable.draw();
          },
          onReady: function (dateObj, dateStr, instance) {
            const $clear = $('<button class="btn btn-danger btn-sm flatpickr-clear mb-2">Clear</button>')
              .on('click', () => {
                instance.clear();
                instance.close();
              })
              .appendTo($(instance.calendarContainer));
          }
        });

        $('#select2Transaksi').select2({
          placeholder: 'Cari Transaksi',
          dropdownParent: $('#select2Transaksi').parent(),
          allowClear: true,
          width: '100%',
        }).on('change', function () {
          dataTable.draw();
        });
      });
    </script>
  @endpush
</x-app-layout>
