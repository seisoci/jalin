<x-app-layout :assets="$assets ?? []" :config="$config ?? []" isSelect2="true" isTour="true" isFlatpickr="true"
              :isSidebar="true" :isBanner="false" :isPageContainer="true">
  <div class="row">
    <div class="col-lg-3 col-md-6">
      <div class="card card border-bottom border-4 border-0 border-primary">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div class="bg-primary text-white rounded p-3">
              <i class="fa-duotone fa-users"> </i>
            </div>
            <div class="text-end">
              <strong>Data Pengguna</strong>
              <h2 class="counter">{{ $data['user_count'] ?? '' }}</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6">
      <div class="card card border-bottom border-4 border-0 border-warning">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div class="bg-warning text-white rounded p-3">
              <i class="fa-duotone fa-file-alt"> </i>
            </div>
            <div class="text-end">
              <strong>Data File Jalin</strong>
              <h2 class="counter">{{ $data['jalin_count'] ?? '' }}</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6">
      <div class="card card border-bottom border-4 border-0 border-info">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div class="bg-info text-white rounded p-3">
              <i class="fa-duotone fa-file"> </i>
            </div>
            <div class="text-end">
              <strong>Data File Core</strong>
              <h2 class="counter">{{ $data['core_count'] ?? '' }}</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-6">
      <div class="card card border-bottom border-4 border-0 border-success">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div class="bg-success text-white rounded p-3">
              <i class="fa-duotone fa-bank"> </i>
            </div>
            <div class="text-end">
              <strong>Data Bank</strong>
              <h2 class="counter">{{ $data['bank_count'] ?? '' }}</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
