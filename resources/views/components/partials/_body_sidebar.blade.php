<aside class="sidebar sidebar-default navs-rounded-all" id="first-tour" data-toggle="main-sidebar" data-sidebar="responsive">
    <div class="sidebar-header d-flex align-items-center justify-content-start">
        <a href="{{route('dashboard')}}" class="navbar-brand" style="white-space: normal !important;">
          <img src="{{ asset('images/thumbnail/') }}/{{ Menu::settings()->logo }}" width="40px" height="40px" alt="">
          <h5 class="logo-title d-none d-sm-block" data-setting="example_app_name">{{env('APP_NAME')}}</h5>
        </a>
        <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
            <i class="icon">
                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.25 12.2744L19.25 12.2744" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M10.2998 18.2988L4.2498 12.2748L10.2998 6.24976" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </i>
        </div>
    </div>
    <div class="sidebar-body pt-0 data-scrollbar">
        <div class="sidebar-list" id="sidebar">
        @include('components.partials.vertical-nav')
        </div>
    </div>
    <div class="sidebar-footer"></div>
</aside>
