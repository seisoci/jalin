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
                <div class="col-sm-6 col-lg-6">
                  <a href="#" class="btn btn-primary float-end" data-bs-toggle="modal"
                     data-bs-target="#modalCreate">
                    <i class="fa-solid fa-plus"></i> Tambah
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="Datatable" class="table table-bordered w-100">
                <thead>
                <tr>
                  <th>Nama File</th>
                  <th>Tgl</th>
                  <th class="text-center">Aksi</th>
                </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  {{-- Modal --}}
  <div class="modal fade" id="modalCreate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah</h5>
          <button aria-label="Close" class="btn-close" data-bs-dismiss="modal"><span aria-hidden="true">×</span>
          </button>
        </div>
        <form id="formStore" method="POST" action="{{ $config['form']->action }}">
          @csrf
          <div class="modal-body">
            <div id="errorCreate" style="display:none;">
              <div class="alert alert-danger" role="alert">
                <div class="alert-text">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Upload File <span class="text-danger">*</span></label>
              <input type="file" name="file_raw" class="form-control">
            </div>
            <div class="form-group">
              <label>Tgl <span class="text-danger">*</span></label>
              <input type="text" name="tgl" class="form-control datePicker"/>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  @push('scripts')
    <script>
      $(document).ready(function () {
        let modalCreate = document.getElementById('modalCreate');
        const bsCreate = new bootstrap.Modal(modalCreate);

        let dataTable = $('#Datatable').DataTable({
          responsive: true,
          serverSide: true,
          processing: true,
          order: [[1, 'desc']],
          lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
          pageLength: 10,
          ajax: {
            url: `{{ route('upload-core.index') }}`
          },
          columns: [
            {data: 'name', name: 'name'},
            {data: 'tgl_dokumen', name: 'tgl_dokumen'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
          ],
          rowCallback: function (row, data) {
            let api = this.api();
            $(row).find('.btn-delete').click(function () {
              let pk = $(this).data('id'),
                url = `{{ route("upload-core.index") }}/` + pk;
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
                        api.draw();
                      } else {
                        toastr.error((response.message ? response.message : "Please complete your form"), 'Failed !');
                      }
                    }
                  });
                }
              });
            });
          }
        });

        modalCreate.addEventListener('show.bs.modal', function (event) {
        });

        modalCreate.addEventListener('hidden.bs.modal', function (event) {
          this.querySelector('input[name=file_raw]').value = '';
          this.querySelector('input[name=tgl]').value = '';
        });

        $("#formStore").submit(function (e) {
          e.preventDefault();
          let form = $(this);
          let btnSubmit = form.find("[type='submit']");
          let btnSubmitHtml = btnSubmit.html();
          let url = form.attr("action");
          let data = new FormData(this);
          $.ajax({
            cache: false,
            processData: false,
            contentType: false,
            type: "POST",
            url: url,
            data: data,
            beforeSend: function () {
              btnSubmit.addClass("disabled").html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...').prop("disabled", "disabled");
            },
            success: function (response) {
              let errorCreate = $('#errorCreate');
              errorCreate.css('display', 'none');
              errorCreate.find('.alert-text').html('');
              btnSubmit.removeClass("disabled").html(btnSubmitHtml).removeAttr("disabled");
              if (response.status === "success") {
                toastr.success(response.message, 'Success !');
                bsCreate.hide();
                dataTable.draw();
              } else {
                toastr.error((response.message ? response.message : "Please complete your form"), 'Failed !');
                if (response.error !== undefined) {
                  errorCreate.removeAttr('style');
                  $.each(response.error, function (key, value) {
                    errorCreate.find('.alert-text').append('<span style="display: block">' + value + '</span>');
                  });
                }
              }
            },
            error: function (response) {
              btnSubmit.removeClass("disabled").html(btnSubmitHtml).removeAttr("disabled");
              toastr.error(response.responseJSON.message, 'Failed !');
            }
          });
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


      });
    </script>
  @endpush
</x-app-layout>