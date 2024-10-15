
<nav class="navbar iq-auth-logo">
    <div class="container-fluid">
        <a href="{{route('dashboard')}}" class="iq-link d-flex align-items-center">
            <img src="{{asset('images/thumbnail/')}}/{{ Menu::settings()->logo }}" alt="logo" height="20px" width="20px" loading="lazy" />
            <h4 data-setting="app_name" class="mb-0">{{env('APP_NAME')}}</h4>
        </a>
    </div>
</nav>
<div class="iq-banner-logo d-none d-lg-block">
    <img class="auth-image" src="{{asset('images/01.png')}}" alt="logo-img" loading="lazy" />
</div>
<div class="container-inside">
    <div class="main-circle circle-small"></div>
    <div class="main-circle circle-medium"></div>
    <div class="main-circle circle-large"></div>
    <div class="main-circle circle-xlarge"></div>
    <div class="main-circle circle-xxlarge"></div>
</div>
