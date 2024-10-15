<x-app-layout :config="$config ?? []" :isToastr="true" :isSweetalert="true" :assets="$assets ?? []"
              :isBanner="false" :isFlatpickr="true" :isAutoNumeric="true">
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
              <div class="col-md-12">
                <div class="alert alert-primary" role="alert">
                  <h5>Pilih Tanggal</h5>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <input id="dateUploadAwal" type="text" class="form-control datePicker" readonly/>
                      </div>
                    </div>
                    <div class="col-md-8">
                      <div class="d-flex flex-row">
                        <div class="bd-example">
                          <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="{{ route('rekap-bruto.index') }}" method="GET"
                               class="btn btn-warning me-2 btnSubmit">
                              <i class="fa-solid fa-eye"></i> Lihat
                            </a>
                            <a href="#" class="btn btn-success me-2 btnCompare">
                              <i class="fa-solid fa-files"></i> Bandingkan
                            </a>
                            <a href="#" id="btnExport"
                               class="btn btn-primary me-2">
                              <i class="fa-solid fa-file-excel"></i> Excel
                            </a>
                            <a href="#" class="btn btn-danger me-2 btnDelete">
                              <i class="fa-solid fa-trash"></i> Hapus
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="table-responsive">
                  <table id="tableCore" class="table table-sm table-bordered w-100">
                    <thead>
                    <tr>
                      <th colspan="6" class="text-center">Core</th>
                    </tr>
                    <tr>
                      <th style="width: 50px">No.</th>
                      <th>Tgl Trx</th>
                      <th>ACQ</th>
                      <th>No Kartu</th>
                      <th>Terminal</th>
                      <th class="text-end">Nominal</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot></tfoot>
                  </table>
                </div>
              </div>
              <div class="col-md-6">
                <div class="table-responsive">
                  <table id="tableJalin" class="table table-sm table-bordered w-100">
                    <thead>
                    <tr>
                      <th colspan="5" class="text-center">Jalin 56</th>
                    </tr>
                    <tr>
                      <th>Tgl Trx</th>
                      <th>ACQ</th>
                      <th>No Kartu</th>
                      <th>Terminal</th>
                      <th class="text-end">Nominal</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot></tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @push('scripts')
    <script>
      $(document).ready(function () {
        $('.btnSubmit').on('click', function (e) {
          e.preventDefault();
          let url = $(this).attr('href');
          let method = $(this).attr('method');
          let data = {
            _token: '{{ csrf_token() }}',
            tgl: $('.datePicker').val(),
          };
          $.ajax({
            type: method,
            url: url,
            data: data,
            success: function (response) {
              if (response.status == 'success') {
                toastr.success('Data Berhasil Ditampilkan', 'Success !');
                let data = response.data;
                $('#tableJalin tbody, #tableCore tbody, #tableJalin tfoot, #tableCore tfoot').empty();
                $('#tableJalin tbody').append(data.jalin);
                $('#tableCore tbody').append(data.core);
                $('#tableCore tfoot').append(data.core_footer);
                $('#tableJalin tfoot').append(data.jalin_footer);
                document.querySelectorAll(".autoNumeric").forEach(function (el) {
                  if (AutoNumeric.getAutoNumericElement(el) === null) {
                    new AutoNumeric(el, {
                      caretPositionOnFocus: "start",
                      decimalPlaces: '0',
                      unformatOnSubmit: true,
                      modifyValueOnWheel: false,
                    });
                  }
                });
              }else{
                toastr.error((response.message ? response.message : "Please complete your form"), 'Failed !');
              }
            },
            error: function (response) {
              toastr.error((response.message ? response.message : "Please complete your form"), 'Failed !');
            }
          });
        });

        $('.btnCompare').on('click', function (e) {
          e.preventDefault();
          let url = `{{ route("rekap-bruto.store") }}`;
          Swal.fire({
            title: "Anda Yakin Ingin Bandingkan Data ?",
            text: "Membandingkan Data membutuhkan waktu proses",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#1cb24c",
            confirmButtonText: "Ya, Bandingkan!",
            cancelButtonText: "Tidak, Batalkan",
          }).then((result) => {
            if (result.value) {
              $.ajax({
                url: url,
                type: "POST",
                data: {
                  _token: '{{ csrf_token() }}',
                  tgl: $('.datePicker').val(),
                },
                error: function (response) {
                  toastr.error(response, 'Failed !');
                },
                success: function (response) {
                  if (response.status === "success") {
                    toastr.success('Data Berhasil Dibandingkan', 'Success !');
                    let data = response.data;
                    $('#tableJalin tbody, #tableCore tbody, #tableJalin tfoot, #tableCore tfoot').empty();
                    $('#tableJalin tbody').append(data.jalin);
                    $('#tableCore tbody').append(data.core);
                    $('#tableCore tfoot').append(data.core_footer);
                    $('#tableJalin tfoot').append(data.jalin_footer);

                    document.querySelectorAll(".autoNumeric").forEach(function (el) {
                      if (AutoNumeric.getAutoNumericElement(el) === null) {
                        new AutoNumeric(el, {
                          caretPositionOnFocus: "start",
                          decimalPlaces: '0',
                          unformatOnSubmit: true,
                          modifyValueOnWheel: false,
                        });
                      }
                    });
                  } else {
                    toastr.error((response.message ? response.message : "Please complete your form"), 'Failed !');
                  }
                }
              });
            }
          });
        });

        $('.btnDelete').on('click', function (e) {
          e.preventDefault();
          let pk = $('.datePicker').val(),
            url = `{{ route("rekap-bruto.index") }}/` + pk;
          Swal.fire({
            title: "Anda Yakin ?",
            text: "Data tidak dapat dikembalikan setelah di hapus!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Tidak, Batalkan",
          }).then((result) => {
            if (result.value) {
              $.ajax({
                url: url,
                type: "DELETE",
                data: {
                  _token: '{{ csrf_token() }}',
                  _method: 'DELETE'
                },
                error: function (response) {
                  toastr.error(response, 'Failed !');
                },
                success: function (response) {
                  if (response.status === "success") {
                    toastr.success(response.message, 'Success !');
                    $('#tableJalin tbody, #tableCore tbody').empty();
                  } else {
                    toastr.error((response.message ? response.message : "Please complete your form"), 'Failed !');
                  }
                }
              });
            }
          });
        });

        $(".datePicker").flatpickr({
          disableMobile: true,
          dateFormat: 'Y-m-d',
          onReady: function (dateObj, dateStr, instance) {
            const $clear = $('<button class="btn btn-danger btn-sm flatpickr-clear mb-2">Clear</button>')
              .on('click', () => {
                instance.clear();
                instance.close();
              })
              .appendTo($(instance.calendarContainer));
          }
        });

        $('#btnExport').on('click', function (e) {
          e.preventDefault();
          let params = {
            tgl: $('.datePicker').val(),
          };
          let query = $.param(params);
          location.href = `{{ route('rekap-bruto.export') }}?${query}`;
        });

      });
    </script>
  @endpush
</x-app-layout>
