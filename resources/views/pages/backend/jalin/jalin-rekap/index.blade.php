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
            </div>
            <div class="table-responsive">
              <table id="Datatable" class="table table-sm table-bordered">
                <thead>
                <tr>
                  <th rowspan="5" class="text-center">Tgl Upload</th>
                  <th rowspan="5" class="text-center">No.</th>
                  <th rowspan="5" class="text-center">BANK</th>
                </tr>
                <tr>
                  <th colspan="11" class="text-center">ACQUIRER</th>
                  <th colspan="6" class="text-center">ISSUER</th>
                  <th colspan="2" class="text-center">SUB TOTAL GROSS</th>
                  <th rowspan="2" colspan="2" class="text-center">ACQUIRER</th>
                  <th rowspan="2" colspan="2" class="text-center">ISSUER</th>
                  <th rowspan="2" colspan="2" class="text-center">SUB TOTAL GROSS</th>
                  <th rowspan="2" colspan="2" class="text-center">TOTAL GROSS</th>
                  <th rowspan="2" colspan="2" class="text-center">TOTAL NETTO</th>
                </tr>
                <tr>
                  <th colspan="8" class="text-center">PURCHASE</th>
                  <th colspan="3" class="text-center">REFUND</th>
                  <th colspan="3" class="text-center">PURCHASE</th>
                  <th colspan="3" class="text-center">REFUND</th>
                  <th rowspan="3" class="text-center">HAK</th>
                  <th rowspan="3" class="text-center">KEWAJIBAN</th>
                </tr>
                <tr>
                  <th rowspan="2">JML TRX</th>
                  <th colspan="6" class="text-center">Fee Transaksi</th>
                  <th rowspan="2" class="text-center">TOTAL NOMINAL TRANSAKSI</th>
                  <th rowspan="2">JML TRX</th>
                  <th rowspan="2">FEE ISSUER</th>
                  <th rowspan="2">TOTAL NOMINAL TRANSAKSI</th>
                  <th rowspan="2">JML TRX</th>
                  <th rowspan="2">FEE ISSUER</th>
                  <th rowspan="2">TOTAL NOMINAL TRANSAKSI</th>
                  <th rowspan="2">JML TRX</th>
                  <th rowspan="2">FEE ISSUER</th>
                  <th rowspan="2">TOTAL NOMINAL TRANSAKSI</th>
                  <th rowspan="2" class="text-center">KEWAJIBAN DISPUTE</th>
                  <th rowspan="2" class="text-center">HAK DISPUTE</th>
                  <th rowspan="2" class="text-center">KEWAJIBAN DISPUTE</th>
                  <th rowspan="2" class="text-center">HAK DISPUTE</th>
                  <th rowspan="2" class="text-center">KEWAJIBAN</th>
                  <th rowspan="2" class="text-center">HAK</th>
                  <th rowspan="2" class="text-center">KEWAJIBAN</th>
                  <th rowspan="2" class="text-center">HAK</th>
                  <th rowspan="2" class="text-center">KEWAJIBAN</th>
                  <th rowspan="2" class="text-center">HAK</th>
                </tr>
                <tr>
                  <th>ACQUIRER SWITCH</th>
                  <th>ISSUER SWITCH</th>
                  <th>ISSUER</th>
                  <th>LBG STANDARD</th>
                  <th>LBG SERVICES</th>
                  <th>TOTAL FEE</th>
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
          lengthMenu: [[-1], ["All"]],
          pageLength: -1,
          ajax: {
            url: "{{ route('jalin-rekap.index') }}",
            data: function (d) {
              d.kode_report = $('#select2KodeReport').find(':selected').val();
              d.tgl = $('#dateUploadAwal').val();
            }
          },
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
            pageSize: 'A3'
          },],
          columns: [
            {data: 'tgl', name: 'tgl'},
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'bank_name', name: 'bank_name'},
            {
              data: 'acq_jml_trx_purchase',
              name: 'acq_jml_trx_purchase',
              className: 'text-center',
              render: $.fn.dataTable.render.number(',', '.', 0, '')
            },
            {
              data: 'acq_acq_switch_purchase',
              name: 'acq_acq_switch_purchase',
              className: 'text-end',
              render: $.fn.dataTable.render.number(',', '.', 2, '')
            },
            {
              data: 'acq_iss_switch_purchase',
              name: 'acq_iss_switch_purchase',
              className: 'text-end',
              render: $.fn.dataTable.render.number(',', '.', 2, '')
            },
            {
              data: 'acq_iss_purchase',
              name: 'acq_iss_purchase',
              className: 'text-end',
              render: $.fn.dataTable.render.number(',', '.', 2, '')
            },
            {
              data: 'acq_lbg_standard_purchase',
              name: 'acq_lbg_standard_purchase',
              className: 'text-end',
              render: $.fn.dataTable.render.number(',', '.', 2, '')
            },
            {
              data: 'acq_lbg_service_purchase',
              name: 'acq_lbg_service_purchase',
              className: 'text-end',
              render: $.fn.dataTable.render.number(',', '.', 2, '')
            },
            {
              data: 'acq_total_fee_purchase',
              name: 'acq_total_fee_purchase',
              className: 'text-end',
              render: $.fn.dataTable.render.number(',', '.', 2, '')
            },
            {
              data: 'acq_total_nominal_transaksi_purchase',
              name: 'acq_total_nominal_transaksi_purchase',
              className: 'text-end',
              render: $.fn.dataTable.render.number(',', '.', 2, '')
            },
            {
              data: 'acq_jml_trx_refund',
              name: 'acq_jml_trx_refund',
              className: 'text-center',
              render: $.fn.dataTable.render.number(',', '.', 0, '')
            },
            {
              data: 'acq_fee_iss_refund',
              name: 'acq_fee_iss_refund',
              className: 'text-end',
              render: $.fn.dataTable.render.number(',', '.', 2, '')
            },
            {
              data: 'acq_total_nominal_transaksi_refund',
              name: 'acq_total_nominal_transaksi_refund',
              className: 'text-end',
              render: $.fn.dataTable.render.number(',', '.', 2, '')
            },
            {
              data: 'iss_jml_trx_purchase',
              name: 'iss_jml_trx_purchase',
              className: 'text-center',
              render: $.fn.dataTable.render.number(',', '.', 0, '')
            },
            {
              data: 'iss_fee_iss_purchase',
              name: 'iss_fee_iss_purchase',
              className: 'text-end',
              render: $.fn.dataTable.render.number(',', '.', 2, '')
            },
            {
              data: 'iss_total_nominal_transaksi_purchase',
              name: 'iss_total_nominal_transaksi_purchase',
              className: 'text-end',
              render: $.fn.dataTable.render.number(',', '.', 2, '')
            },
            {
              data: 'iss_jml_trx_refund',
              name: 'iss_jml_trx_refund',
              className: 'text-center',
              render: $.fn.dataTable.render.number(',', '.', 0, '')
            },
            {
              data: 'iss_fee_iss_refund',
              name: 'iss_fee_iss_refund',
              className: 'text-end',
              render: $.fn.dataTable.render.number(',', '.', 2, '')
            },
            {
              data: 'iss_total_nominal_transaksi_refund',
              name: 'iss_total_nominal_transaksi_refund',
              className: 'text-end',
              render: $.fn.dataTable.render.number(',', '.', 2, '')
            },
            {
              data: 'subtotal_gross_kewajiban',
              name: 'subtotal_gross_kewajiban',
              className: 'text-end',
              render: $.fn.dataTable.render.number(',', '.', 2, '')
            },
            {
              data: 'subtotal_gross_hak',
              name: 'subtotal_gross_hak',
              className: 'text-end',
              render: $.fn.dataTable.render.number(',', '.', 2, '')
            },
            {
              data: 'acq_kewajiban_dispute',
              name: 'acq_kewajiban_dispute',
              className: 'text-end',
              render: $.fn.dataTable.render.number(',', '.', 2, '')
            },
            {
              data: 'acq_hak_dispute',
              name: 'acq_hak_dispute',
              className: 'text-end',
              render: $.fn.dataTable.render.number(',', '.', 2, '')
            },
            {
              data: 'iss_kewajiban_dispute',
              name: 'iss_kewajiban_dispute',
              className: 'text-end',
              render: $.fn.dataTable.render.number(',', '.', 2, '')
            },
            {
              data: 'iss_hak_dispute',
              name: 'iss_hak_dispute',
              className: 'text-end',
              render: $.fn.dataTable.render.number(',', '.', 2, '')
            },
            {
              data: 'subtotal_gross_kewajiban_t',
              name: 'subtotal_gross_kewajiban_t',
              className: 'text-end',
              render: $.fn.dataTable.render.number(',', '.', 2, '')
            },
            {
              data: 'subtotal_gross_hak_u',
              name: 'subtotal_gross_hak_u',
              className: 'text-end',
              render: $.fn.dataTable.render.number(',', '.', 2, '')
            },
            {
              data: 'total_gross_kewajiban_v',
              name: 'total_gross_kewajiban_v',
              className: 'text-end',
              render: $.fn.dataTable.render.number(',', '.', 2, '')
            },
            {
              data: 'total_gross_hak_w',
              name: 'total_gross_hak_w',
              className: 'text-end',
              render: $.fn.dataTable.render.number(',', '.', 2, '')
            },
            {
              data: 'total_net_kewajiban',
              name: 'total_net_kewajiban',
              className: 'text-end',
              render: $.fn.dataTable.render.number(',', '.', 2, '')
            },
            {
              data: 'total_net_hak',
              name: 'total_net_hak',
              className: 'text-end',
              render: $.fn.dataTable.render.number(',', '.', 2, '')
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
