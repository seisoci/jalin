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
                  <h4 class="card-title">Data {{ $config['title'] }} </h4>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="form-group row">
                <label class="control-label col-sm-3 align-self-center mb-0" for="configFile">Jenis File :</label>
                <div class="col-sm-9">
                  <select id="select2TypeFile">
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="control-label col-sm-3 align-self-center mb-0" for="configFile">Kode File :</label>
                <div class="col-sm-9">
                  <select id="select2ConfigFile" name="configFile">
                  </select>
                </div>
              </div>
            </div>
            <hr>
            <form id="formStore" action="{{ $config['form']->action }}" method="POST">
              @method($config['form']->method)
              @csrf
            <div id="dataConfig" class="row">
            </div>
              <div class="d-flex justify-content-end d-none">
                <button type="submit" class="btn btn-primary">Simpan <i
                    class="fa-solid fa-floppy-disk"></i></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  @push('scripts')
    <script>
      $(document).ready(async function () {
        $('#select2TypeFile').select2({
          dropdownParent: $('#select2TypeFile').parent(),
          placeholder: "Cari Jenis File",
          width: '100%',
          allowClear: true,
          ajax: {
            url: "{{ route('config-file.select2-type') }}",
            dataType: "json",
            cache: true,
            data: function (e) {
              return {
                q: e.term || '',
                page: e.page || 1,
              }
            },
          },
        }).on('select2:select', function (e) {
          console.log($('#select2TypeFile').find(":selected").val());
          $('#select2ConfigFile').val('').trigger('change');
          $("button[type='submit']").parent().addClass('d-none');
          $('#dataConfig').empty();
        }).on('select2:clear', function (){
          $('#select2ConfigFile').val('').trigger('change');
          $("button[type='submit']").parent().addClass('d-none');
          $('#dataConfig').empty();
        });

        $('#select2ConfigFile').select2({
          dropdownParent: $('#select2ConfigFile').parent(),
          placeholder: "Cari Dokumen",
          width: '100%',
          allowClear: true,
          ajax: {
            url: "{{ route('config-file.select2') }}",
            dataType: "json",
            cache: true,
            data: function (e) {
              return {
                q: e.term || '',
                page: e.page || 1,
                file_name: $('#select2TypeFile').find(":selected").val() || null,
              }
            },
          },
        }).on('select2:select', function (e) {
          let data = e.params.data;
          $("button[type='submit']").parent().removeClass('d-none');
          callData(data['id']);
        }).on('select2:clear', function (){
          $("button[type='submit']").parent().addClass('d-none');
          $('#dataConfig').empty();
        });

        function callData($id) {
          $.ajax({
            cache: false,
            processData: false,
            contentType: false,
            type: "GET",
            url: '{{ route('config-file.index') }}/' +$id + '/generate',
            success: function (response) {
              $('#dataConfig').empty();
              $('#dataConfig').append(response);
            },
            error: function (response) {
              toastr.error((response.message ? response.message : "Please complete your form"), 'Failed !');
            }
          });
        }

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

      });
    </script>
  @endpush
</x-app-layout>
