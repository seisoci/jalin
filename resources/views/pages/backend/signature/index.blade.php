<x-app-layout :config="$config ?? []" :isToastr="true" :isSweetalert="true" :assets="$assets ?? []"
              :isBanner="false">
  <div>
    <div class="row">
      <div class="col-sm-12 col-lg-12">
        <div class="card">
          <div class="card-header justify-content-between">
            <div class="header-title">
              <div class="row">
                <div class="col-sm-6 col-lg-6">
                  <h4 class="card-title">Data {{ $config['title'] ?? '' }} </h4>
                </div>
                <div class="col-sm-6 col-lg-6">
                  <div class="d-flex justify-content-end">
                    <a href="{{ route('signature.create') }}" class="btn btn-primary"><i class="fa-solid fa-plus"></i>Tambah</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="dataTable" class="table table-bordered w-100">
                <thead>
                <tr>
                  <th>Nama Lengkap</th>
                  <th>Jabatan</th>
                  <th>Title Tanda Tangan</th>
                  <th>Tgl Buat</th>
                  <th class="text-center" data-priority="1">Aksi</th>
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
  @push('scripts')
    <script>
      $(document).ready(function () {
        let DataTable = $('#dataTable').DataTable({
          responsive: true,
          serverSide: true,
          processing: true,
          ajax: {
            url: `{{ route('signature.index') }}`,
          },
          order: [[3, 'desc']],
          lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
          pageLength: 10,
          columns: [
            {data: 'name', name: 'name'},
            {data: 'position', name: 'position'},
            {data: 'signature_title', name: 'signature_title.nama'},
            {data: 'created_at', name: 'created_at', searchable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false},
          ],
          rowCallback: function (row, data) {
            let api = this.api();
            $(row).find('.btn-delete').click(function () {
              let pk = $(this).data('id'),
                url = `{{ route("signature.index") }}/` + pk;
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

      });
    </script>
  @endpush
</x-app-layout>
