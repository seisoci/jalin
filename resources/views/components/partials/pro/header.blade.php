<div>
  <!-- Simplicity is an acquired taste. - Katharine Gerould -->
</div>@props(['title'])
<nav class="nav navbar navbar-expand-xl navbar-light iq-navbar">
  <div class="container-fluid navbar-inner">
    <a href="{{ route('dashboard') }}" class="navbar-brand" style="white-space: normal !important;">
      <img src="{{ asset('images/thumbnail/') }}/{{ Menu::settings()->logo }}" width="28px" height="28px" alt="">
      <h6 class="logo-title d-block d-xl-none">{{ config('app.name') ?? '' }}</h6>
    </a>
{{--    <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">--}}
{{--      <i class="icon d-flex">--}}
{{--        <svg width="20px" viewBox="0 0 24 24">--}}
{{--          <path fill="currentColor" d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z"/>--}}
{{--        </svg>--}}
{{--      </i>--}}
{{--    </div>--}}
    <div class="d-flex align-items-center justify-content-between product-offcanvas">
      <div class="breadcrumb-title border-end me-3 pe-3 d-none d-xl-block">
        <a href="{{ route('dashboard') }}"><small class="mb-0 text-capitalize"><strong>{{ config('app.name') ?? '' }}</strong></small></a>
      </div>
      <div class="offcanvas offcanvas-end shadow-none iq-product-menu-responsive on-rtl end" id="offcanvasBottom">
        <div class="offcanvas-body">
          <ul class="iq-nav-menu list-unstyled">
            {!! Menu::header_sidebar() !!}
          </ul>
        </div>
      </div>
    </div>
    <div class="d-flex align-items-center">
      <button id="navbar-toggle" class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
              data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
              aria-label="Toggle navigation">
        <span class="navbar-toggler-icon">
           <span class="navbar-toggler-bar bar1 mt-1"></span>
           <span class="navbar-toggler-bar bar2"></span>
           <span class="navbar-toggler-bar bar3"></span>
        </span>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="mb-2 navbar-nav ms-auto align-items-center navbar-list mb-lg-0 pb-0">
        {{--
                <li class="nav-item dropdown me-0 me-xl-3">
                  <div class="d-flex align-items-center mr-2 iq-font-style" role="group" aria-label="First group"
                       data-setting="radio">
                    <input type="radio" class="btn-check" name="theme_font_size" value="theme-fs-sm" id="font-size-sm">
                    <label for="font-size-sm" class="btn btn-border border-0 btn-icon rounded-1 btn-sm" data-bs-toggle="tooltip"
                           title="Font size 14px" data-bs-placement="bottom">
                      <span class="mb-0 h6" style="color: inherit !important;">A</span>
                    </label>
                    <input type="radio" class="btn-check" name="theme_font_size" value="theme-fs-md" id="font-size-md">
                    <label for="font-size-md" class="btn btn-border border-0 btn-icon rounded-1" data-bs-toggle="tooltip"
                           title="Font size 16px" data-bs-placement="bottom">
                      <span class="mb-0 h4" style="color: inherit !important;">A</span>
                    </label>
                    <input type="radio" class="btn-check" name="theme_font_size" value="theme-fs-lg" id="font-size-lg">
                    <label for="font-size-lg" class="btn btn-border border-0 btn-icon rounded-1" data-bs-toggle="tooltip"
                           title="Font size 18px" data-bs-placement="bottom">
                      <span class="mb-0 h2" style="color: inherit !important;">A</span>
                    </label>
                  </div>
                </li>
        --}}
        <li class="nav-item dropdown" id="itemdropdown1">
          <a class="py-0 nav-link d-flex align-items-center" href="#" id="navbarDropdown" role="button"
             data-bs-toggle="dropdown" aria-expanded="false">
            <div class="btn-icon btn-sm rounded-pill border border-primary">
              <img style="width: 100%; height: 100%"
                   src="{{ auth()->user()->image != NULL ? asset("storage/images/thumbnail/".auth()->user()->image) : asset('images/no-content.svg') }}"
                   alt="User-Profile"
                   class="img-fluid rounded-pill" loading="lazy">
            </div>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <li>
              <a class="dropdown-item" href="{{ route('profile.index') }}">Ubah Profile</a>
            </li>
            <li>
              <a class="dropdown-item" href="{{ route('change-password', auth()->id()) }}">Ganti Password</a>
            </li>
            <li>
              <form method="POST" action="{{route('logout')}}">
                @csrf
                <a href="javascript:void(0)" class="dropdown-item"
                   onclick="event.preventDefault();
                            this.closest('form').submit();">
                  {{ __('Log out') }}
                </a>
              </form>
            </li>
          </ul>
        </li>
        <li class="nav-item iq-full-screen d-none d-xl-block" id="fullscreen-item">
          <a href="#" class="nav-link" id="btnFullscreen" data-bs-toggle="dropdown">
            <div class="btn btn-primary btn-icon btn-sm rounded-pill">
                     <span class="btn-inner">
                        <svg class="normal-screen" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                           <path d="M18.5528 5.99656L13.8595 10.8961" stroke="white" stroke-width="1.5"
                                 stroke-linecap="round" stroke-linejoin="round"></path>
                           <path d="M14.8016 5.97618L18.5524 5.99629L18.5176 9.96906" stroke="white" stroke-width="1.5"
                                 stroke-linecap="round" stroke-linejoin="round"></path>
                           <path d="M5.8574 18.896L10.5507 13.9964" stroke="white" stroke-width="1.5"
                                 stroke-linecap="round" stroke-linejoin="round"></path>
                           <path d="M9.60852 18.9164L5.85775 18.8963L5.89258 14.9235" stroke="white" stroke-width="1.5"
                                 stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <svg class="full-normal-screen d-none" width="24" height="24" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                           <path d="M13.7542 10.1932L18.1867 5.79319" stroke="white" stroke-width="1.5"
                                 stroke-linecap="round" stroke-linejoin="round"></path>
                           <path d="M17.2976 10.212L13.7547 10.1934L13.7871 6.62518" stroke="currentColor"
                                 stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                           <path d="M10.4224 13.5726L5.82149 18.1398" stroke="white" stroke-width="1.5"
                                 stroke-linecap="round" stroke-linejoin="round"></path>
                           <path d="M6.74391 13.5535L10.4209 13.5723L10.3867 17.2755" stroke="currentColor"
                                 stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                     </span>
            </div>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
