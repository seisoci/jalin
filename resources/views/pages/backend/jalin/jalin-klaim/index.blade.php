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
                  <h4 class="card-title">Data {{ $config['title'] }} </h4>
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
              <div class="col-4">
                <div class="form-group">
                  <label>Jenis <span class="text-danger">*</span></label>
                  <select id="select2KodeReport" class="form-select">
                    <option value=""></option>
                    <option value="DSPT01"> DSPT01 - LMP AS ACQUIRER</option>
                    <option value="DSPT02">DSPT02 - LMP AS ISSUER</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table id="Datatable" class="table table-bordered">
                <thead>
                <tr>
                  <th>Tgl Upload</th>
                  <th>Kode Report</th>
                  <th>Trx Code</th>
                  <th>Tgl Trans</th>
                  <th>Wktu Trans</th>
                  <th>No. Ref</th>
                  <th>Trace No.</th>
                  <th>Term ID.</th>
                  <th>No. Kartu</th>
                  <th>Kode ISS</th>
                  <th>Kode ACQ</th>
                  <th>MerchantID</th>
                  <th>Merchant Location</th>
                  <th>Merchant Name</th>
                  <th>Nom. Transaksi</th>
                  <th>Merchant Code</th>
                  <th>Dispute Trans Code</th>
                  <th>Registration Num</th>
                  <th>Dispute Amount</th>
                  <th>Chargeback Fee</th>
                  <th>Fee Return</th>
                  <th>Dispute Net Amount</th>
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
          buttons: ['pageLength', {
            extend: 'copy',
          }, {
            extend: 'csv',
          }, {
            extend: 'excel',
          }, {
            extend: 'pdf',
            orientation: 'landscape',
            pageSize: 'LEGAL'
          },],
          ajax: {
            url: "{{ route('jalin-klaim.index') }}",
            data: function (d) {
              d.no_report = $('#select2KodeReport').find(':selected').val();
              d.tgl = $('#dateUploadAwal').val();
            }
          },
          columns: [
            {data: 'tgl', name: 'tgl'},
            {data: 'no_report', name: 'no_report'},
            {data: 'trx_code', name: 'trx_code'},
            {data: 'trx_tgl', name: 'trx_tgl'},
            {data: 'trx_time', name: 'trx_time'},
            {data: 'ref_no', name: 'ref_no'},
            {data: 'trace_no', name: 'trace_no'},
            {data: 'term_id', name: 'term_id'},
            {data: 'no_kartu', name: 'no_kartu'},
            {data: 'kode_iss', name: 'kode_iss'},
            {data: 'kode_acq', name: 'kode_acq'},
            {data: 'marchant_id', name: 'marchant_id'},
            {data: 'marchant_location', name: 'marchant_location'},
            {data: 'marchant_name', name: 'marchant_name'},
            {
              data: 'nominal',
              name: 'nominal',
              className: 'text-end',
              render: $.fn.dataTable.render.number(',', '.', 0, '')
            },
            {data: 'marchant_code', name: 'marchant_code'},
            {data: 'dispute_trans_code', name: 'dispute_trans_code'},
            {data: 'registration_num', name: 'registration_num'},
            {
              data: 'dispute_amount',
              name: 'dispute_amount',
              className: 'text-end',
              render: $.fn.dataTable.render.number(',', '.', 0, '')
            },
            {
              data: 'charge_back_fee',
              name: 'charge_back_fee',
              className: 'text-end',
              render: $.fn.dataTable.render.number(',', '.', 0, '')
            },
            {
              data: 'fee_return',
              name: 'fee_return',
              className: 'text-end',
              render: $.fn.dataTable.render.number(',', '.', 0, '')
            },
            {
              data: 'dispute_net_amount',
              name: 'dispute_net_amount',
              className: 'text-end',
              render: $.fn.dataTable.render.number(',', '.', 0, '')
            },
          ],
          initComplete: function (settings, json) {
            dataTable.buttons().container().appendTo('#Datatable_wrapper .col-md-6:eq(0)');
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

        $('#select2KodeReport').select2({
          placeholder: 'Cari Kode Report',
          dropdownParent: $('#select2KodeReport').parent(),
          allowClear: true,
          width: '100%',
        }).on('change', function () {
          dataTable.draw();
        });
      });
    </script>
  @endpush
</x-app-layout>
