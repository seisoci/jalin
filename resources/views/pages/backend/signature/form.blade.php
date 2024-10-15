<x-app-layout :config="$config ?? []" :assets="$assets ?? []" :isBanner="false" :isToastr="true"
              :isSelect2="true">
  <div>
    <form id="formStore" action="{{ $config['form']->action }}" method="POST">
      @method($config['form']->method)
      @csrf
      <div class="row">
        <div class="col-sm-12 col-lg-8">
          <div class="card">
            <div class="card-header justify-content-between">
              <div class="header-title">
                <div class="row">
                  <div class="col-sm-6 col-lg-6">
                    <h4 class="card-title">{{ $config['title'] }}</h4>
                  </div>
                  <div class="col-sm-6 col-lg-6">
                    <div class="btn-group float-end" role="group" aria-label="Basic outlined example">
                      <a onclick="history.back()" class="btn btn-sm btn-outline-primary"><i
                          class="fa-solid fa-rotate-left"></i> Kembali</a>
                      <button type="submit" class="btn btn-sm btn-primary">Simpan <i
                          class="fa-solid fa-floppy-disk"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <div id="errorCreate" class="mb-3" style="display:none;">
                  <div class="alert alert-danger" role="alert">
                    <div class="alert-icon"><i class="flaticon-danger text-danger"></i></div>
                    <div class="alert-text">
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-3 align-self-center mb-0" for="kode">Nama Lengkap:</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama Lengkap"
                           value="{{ $data->name ?? '' }}">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-3 align-self-center mb-0" for="nama">Jabatan:</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="position" name="position" placeholder="Masukkan Jabatan"
                           value="{{ $data->position ?? '' }}">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-sm-3 align-self-center mb-0" for="nama">Title Tanda Tangan:</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="signature_title" name="signature_title" placeholder="Masukkan Title Tanda Tangan"
                           value="{{ $data->signature_title ?? '' }}">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>

  @push('scripts')
    <script>
      $(document).ready(function () {
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
                setTimeout(function () {
                  if (response.redirect === "" || response.redirect === "reload") {
                    location.reload();
                  } else {
                    location.href = response.redirect;
                  }
                }, 1000);
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

        $(".image").change(function () {
          let thumb = $(this).parent().find('img');
          if (this.files && this.files[0]) {
            let reader = new FileReader();
            reader.onload = function (e) {
              thumb.attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
          }
        });
      });
    </script>
  @endpush
</x-app-layout>
