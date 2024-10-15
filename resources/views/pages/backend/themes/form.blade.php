<x-app-layout :config="$config ?? []" :assets="$assets ?? []" :isBanner="false" :isToastr="true"
              :isSelect2="true">
  <div>
    <form id="formStore" action="{{ $config['form']->action }}" method="POST">
      @method($config['form']->method)
      @csrf

      <div class="row">
        <div class="col-sm-12 col-lg-6">
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
                <!-- Sidebar types start here -->

                <h5 class="mt-4 mb-3">Sidebar Types</h5>

                <div class="d-grid gap-3 grid-cols-3 mb-4">
                  <div data-setting="checkbox" class="text-center">
                    <input type="checkbox" value="sidebar-mini" class="btn-check" name="sidebar_type" id="sidebar-mini" autocomplete="off">
                    <label class="btn btn-border p-0 d-block overflow-hidden" for="sidebar-mini">
                      <img src="{{ asset('images/settings/dark/03.png') }}" alt="mini" class="mode dark-img img-fluid">
                      <img src="{{ asset('images/settings/light/03.png') }}" alt="mini" class="mode light-img img-fluid">
                    </label>
                    <span class="mt-2">Mini</span>
                  </div>
                  <div data-setting="checkbox" class="text-center">
                    <input type="checkbox" value="sidebar-hover" data-extra="{target: '.sidebar', ClassListAdd: 'sidebar-mini'}" class="btn-check" name="sidebar_type" id="sidebar-hover" autocomplete="off">
                    <label class="btn btn-border p-0 d-block overflow-hidden" for="sidebar-hover">
                      <img src="{{ asset('images/settings/dark/04.png') }}" alt="hover" class="mode dark-img img-fluid">
                      <img src="{{ asset('images/settings/light/04.png') }}" alt="hover" class="mode light-img img-fluid">
                    </label>
                    <span class="mt-2">Hover</span>
                  </div>
                  <div data-setting="checkbox" class="text-center" >
                    <input type="checkbox" value="sidebar-boxed" class="btn-check" name="sidebar_type" id="sidebar-boxed" autocomplete="off">
                    <label class="btn btn-border p-0 d-block overflow-hidden" for="sidebar-boxed">
                      <img src="{{ asset('images/settings/dark/05.png') }}" alt="boxed" class="mode dark-img img-fluid">
                      <img src="{{ asset('images/settings/light/03.png') }}" alt="boxed" class="mode light-img img-fluid">
                    </label>
                    <span class="mt-2">Boxed</span>
                  </div>
                </div>

                <!-- Sidebar types end here -->
                <!-- Color customizer start here -->
                <div>
                  <div class="d-flex align-items-center justify-content-between">
                    <h6 class="mt-4 mb-3">Color Customizer</h6>
                    <div class="d-flex align-items-center">
                      <a href="#custom-color" data-bs-toggle="collapse" role="button" aria-expanded="false"
                         aria-controls="custom-color">Custom</a>
                      <div data-setting="radio">
                        <input type="radio" value="theme-color-default" class="btn-check" name="theme_color"
                               id="theme-color-default" data-colors='{"primary": "#3a57e8", "info": "#08B1BA"}'>
                        <label class="btn bg-transparent" for="theme-color-default" data-bs-toggle="tooltip"
                               data-bs-placement="top" title="Reset Color" data-bs-original-title="Reset color">
                          <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                               xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M21.4799 12.2424C21.7557 12.2326 21.9886 12.4482 21.9852 12.7241C21.9595 14.8075 21.2975 16.8392 20.0799 18.5506C18.7652 20.3986 16.8748 21.7718 14.6964 22.4612C12.518 23.1505 10.1711 23.1183 8.01299 22.3694C5.85488 21.6205 4.00382 20.196 2.74167 18.3126C1.47952 16.4293 0.875433 14.1905 1.02139 11.937C1.16734 9.68346 2.05534 7.53876 3.55018 5.82945C5.04501 4.12014 7.06478 2.93987 9.30193 2.46835C11.5391 1.99683 13.8711 2.2599 15.9428 3.2175L16.7558 1.91838C16.9822 1.55679 17.5282 1.62643 17.6565 2.03324L18.8635 5.85986C18.945 6.11851 18.8055 6.39505 18.549 6.48314L14.6564 7.82007C14.2314 7.96603 13.8445 7.52091 14.0483 7.12042L14.6828 5.87345C13.1977 5.18699 11.526 4.9984 9.92231 5.33642C8.31859 5.67443 6.8707 6.52052 5.79911 7.74586C4.72753 8.97119 4.09095 10.5086 3.98633 12.1241C3.8817 13.7395 4.31474 15.3445 5.21953 16.6945C6.12431 18.0446 7.45126 19.0658 8.99832 19.6027C10.5454 20.1395 12.2278 20.1626 13.7894 19.6684C15.351 19.1743 16.7062 18.1899 17.6486 16.8652C18.4937 15.6773 18.9654 14.2742 19.0113 12.8307C19.0201 12.5545 19.2341 12.3223 19.5103 12.3125L21.4799 12.2424Z"
                              fill="#31BAF1"/>
                            <path
                              d="M20.0941 18.5594C21.3117 16.848 21.9736 14.8163 21.9993 12.7329C22.0027 12.4569 21.7699 12.2413 21.4941 12.2512L19.5244 12.3213C19.2482 12.3311 19.0342 12.5633 19.0254 12.8395C18.9796 14.283 18.5078 15.6861 17.6628 16.8739C16.7203 18.1986 15.3651 19.183 13.8035 19.6772C12.2419 20.1714 10.5595 20.1483 9.01246 19.6114C7.4654 19.0746 6.13845 18.0534 5.23367 16.7033C4.66562 15.8557 4.28352 14.9076 4.10367 13.9196C4.00935 18.0934 6.49194 21.37 10.008 22.6416C10.697 22.8908 11.4336 22.9852 12.1652 22.9465C13.075 22.8983 13.8508 22.742 14.7105 22.4699C16.8889 21.7805 18.7794 20.4073 20.0941 18.5594Z"
                              fill="#0169CA"/>
                          </svg>
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="collapse" id="custom-color">
                    <div class="form-group d-flex justify-content-between align-items-center">
                      <label class="" for="custom-primary-color">Primary</label>
                      <input class="" name="theme_color" data-extra="primary" type="color" id="custom-primary-color"
                             value="#3a57e8" data-setting="color">
                    </div>
                    <div class="form-group d-flex d-flex justify-content-between align-items-center">
                      <label class="" for="custom-info-color">Secondary</label>
                      <input class="" name="theme_color" data-extra="info" type="color" id="custom-info-color"
                             value="#08B1BA" data-setting="color">
                    </div>
                  </div>
                  <div class="grid-cols-5 mb-4 d-grid gap-3">
                    <div data-setting="radio">
                      <input type="radio" value="theme-color-blue" class="btn-check" name="theme_color"
                             id="theme-color-1" data-colors='{"primary": "#00C3F9", "info": "#573BFF"}'>
                      <label class="btn btn-border d-block bg-transparent" for="theme-color-1" data-bs-toggle="tooltip"
                             data-bs-placement="top" title="Theme-1" data-bs-original-title="Theme-1">
                        <svg class="customizer-btn" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="26"
                             height="26">
                          <circle cx="12" cy="12" r="10" fill="#00C3F9"/>
                          <path d="M2,12 a1,1 1 1,0 20,0" fill="#573BFF"/>
                        </svg>
                      </label>
                    </div>
                    <div data-setting="radio">
                      <input type="radio" value="theme-color-gray" class="btn-check" name="theme_color"
                             id="theme-color-2" data-colors='{"primary": "#91969E", "info": "#FD8D00"}'>
                      <label class="btn btn-border d-block bg-transparent" for="theme-color-2" data-bs-toggle="tooltip"
                             data-bs-placement="top" title="Theme-2" data-bs-original-title="Theme-2">
                        <svg class="customizer-btn" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="26"
                             height="26">
                          <circle cx="12" cy="12" r="10" fill="#91969E"/>
                          <path d="M2,12 a1,1 1 1,0 20,0" fill="#FD8D00"/>
                        </svg>
                      </label>
                    </div>
                    <div data-setting="radio">
                      <input type="radio" value="theme-color-red" class="btn-check" name="theme_color"
                             id="theme-color-3" data-colors='{"primary": "#DB5363", "info": "#366AF0"}'>
                      <label class="btn btn-border d-block bg-transparent" for="theme-color-3" data-bs-toggle="tooltip"
                             data-bs-placement="top" title="Theme-3" data-bs-original-title="Theme-3">
                        <svg class="customizer-btn" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="26"
                             height="26">
                          <circle cx="12" cy="12" r="10" fill="#DB5363"/>
                          <path d="M2,12 a1,1 1 1,0 20,0" fill="#366AF0"/>
                        </svg>
                      </label>
                    </div>
                    <div data-setting="radio">
                      <input type="radio" value="theme-color-yellow" class="btn-check" name="theme_color"
                             id="theme-color-4" data-colors='{"primary": "#EA6A12", "info": "#6410F1"}'>
                      <label class="btn btn-border d-block bg-transparent" for="theme-color-4" data-bs-toggle="tooltip"
                             data-bs-placement="top" title="Theme-4" data-bs-original-title="Theme-4">
                        <svg class="customizer-btn" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="26"
                             height="26">
                          <circle cx="12" cy="12" r="10" fill="#EA6A12"/>
                          <path d="M2,12 a1,1 1 1,0 20,0" fill="#6410F1"/>
                        </svg>
                      </label>
                    </div>
                    <div data-setting="radio">
                      <input type="radio" value="theme-color-pink" class="btn-check" name="theme_color"
                             id="theme-color-5" data-colors='{"primary": "#E586B3", "info": "#25C799"}'>
                      <label class="btn btn-border d-block bg-transparent" for="theme-color-5" data-bs-toggle="tooltip"
                             data-bs-placement="top" title="Theme-5" data-bs-original-title="Theme-5">
                        <svg class="customizer-btn" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="26"
                             height="26">
                          <circle cx="12" cy="12" r="10" fill="#E586B3"/>
                          <path d="M2,12 a1,1 1 1,0 20,0" fill="#25C799"/>
                        </svg>
                      </label>
                    </div>
                  </div>
                </div>
                <!-- Color customizer end here -->
                <div class="col-md-12">
                  <div class="border border-2 rounded">
                    <div class="px-3 pt-3 text-center">
                      <h5 class="d-inline-block">Advanced</h5>
                      <span class="badge rounded-pill bg-warning">Pro</span>
                    </div>
                    <div class="p-3">
                      <h6 class="mb-3 d-inline-block">App Name</h6>
                      <span data-bs-toggle="tooltip" data-bs-placement="right"
                            title="Edit the App Name with your business name to familiarize your audience. ">
                      <svg class="icon-20" width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="none"
                           viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                      </svg>
                    </span>
                      <div class="d-grid gap-3 grid-cols-1 mb-4">
                        <div class="form-group mb-0">
                          <input type="text" data-setting="input" maxlength="10" name="app_name" class="form-control"
                                 value="">
                        </div>
                      </div>
                      <div class="d-flex justify-content-between">
                        <h6 class="d-inline-block">Font</h6>
                        <a href="javascript:void(0)" data-reset="body-heading-font">
                          <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
                               xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M21.4799 12.2424C21.7557 12.2326 21.9886 12.4482 21.9852 12.7241C21.9595 14.8075 21.2975 16.8392 20.0799 18.5506C18.7652 20.3986 16.8748 21.7718 14.6964 22.4612C12.518 23.1505 10.1711 23.1183 8.01299 22.3694C5.85488 21.6205 4.00382 20.196 2.74167 18.3126C1.47952 16.4293 0.875433 14.1905 1.02139 11.937C1.16734 9.68346 2.05534 7.53876 3.55018 5.82945C5.04501 4.12014 7.06478 2.93987 9.30193 2.46835C11.5391 1.99683 13.8711 2.2599 15.9428 3.2175L16.7558 1.91838C16.9822 1.55679 17.5282 1.62643 17.6565 2.03324L18.8635 5.85986C18.945 6.11851 18.8055 6.39505 18.549 6.48314L14.6564 7.82007C14.2314 7.96603 13.8445 7.52091 14.0483 7.12042L14.6828 5.87345C13.1977 5.18699 11.526 4.9984 9.92231 5.33642C8.31859 5.67443 6.8707 6.52052 5.79911 7.74586C4.72753 8.97119 4.09095 10.5086 3.98633 12.1241C3.8817 13.7395 4.31474 15.3445 5.21953 16.6945C6.12431 18.0446 7.45126 19.0658 8.99832 19.6027C10.5454 20.1395 12.2278 20.1626 13.7894 19.6684C15.351 19.1743 16.7062 18.1899 17.6486 16.8652C18.4937 15.6773 18.9654 14.2742 19.0113 12.8307C19.0201 12.5545 19.2341 12.3223 19.5103 12.3125L21.4799 12.2424Z"
                              fill="currentColor"/>
                            <path
                              d="M20.0941 18.5594C21.3117 16.848 21.9736 14.8163 21.9993 12.7329C22.0027 12.4569 21.7699 12.2413 21.4941 12.2512L19.5244 12.3213C19.2482 12.3311 19.0342 12.5633 19.0254 12.8395C18.9796 14.283 18.5078 15.6861 17.6628 16.8739C16.7203 18.1986 15.3651 19.183 13.8035 19.6772C12.2419 20.1714 10.5595 20.1483 9.01246 19.6114C7.4654 19.0746 6.13845 18.0534 5.23367 16.7033C4.66562 15.8557 4.28352 14.9076 4.10367 13.9196C4.00935 18.0934 6.49194 21.37 10.008 22.6416C10.697 22.8908 11.4336 22.9852 12.1652 22.9465C13.075 22.8983 13.8508 22.742 14.7105 22.4699C16.8889 21.7805 18.7794 20.4073 20.0941 18.5594Z"
                              fill="currentColor"/>
                          </svg>
                        </a>
                      </div>
                      <div class="d-grid gap-3 grid-cols-2 mb-4">
                        <div>
                          <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="label">
                              <label class="mb-0 d-inline-block">Body Font</label>
                            </div>
                          </div>
                          <div class="form-group mb-0">
                            <select name="body_font_family" class="form-control" data-select="font"
                                    data-setting="select">
                              <option value="">Select Body Font</option>
                            </select>
                          </div>
                        </div>

                        <div>
                          <div class="d-flex justify-content-between align-items-center mb-2">
                            <div class="label">
                              <label class="mb-0 d-inline-block">Heading Font</label>
                            </div>
                          </div>
                          <div class="form-group mb-0">
                            <select name="heading_font_family" class="form-control" data-select="font"
                                    data-setting="select">
                              <option value="">Select Heading Font</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <!-- Page container start here -->
                      <div>
                        <h6 class="d-inline-block mb-3 me-2">Page Style </h6>
                        <small class="badge bg-warning rounded-pill">Pro</small>
                        <span data-bs-toggle="tooltip" data-bs-placement="right"
                              title="Wrap your content layout and select Full Width or Boxed styles.  ">
                        <svg class="icon-20" width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                      </span>
                      </div>
                      <div class="d-grid gap-3 grid-cols-2 mb-4">
                        <div data-setting="radio">
                          <input type="radio" value="container" class="btn-check" name="page_layout"
                                 id="page-layout-boxed">
                          <label class="btn btn-border d-block" for="page-layout-boxed">Boxed</label>
                        </div>
                        <div data-setting="radio">
                          <input type="radio" value="container-fluid" class="btn-check" name="page_layout"
                                 id="page-layout-full-width" checked>
                          <label class="btn btn-border d-block" for="page-layout-full-width">Full Width</label>
                        </div>
                      </div>
                      <!-- Page container start here -->

                      <!-- Style appearance start here -->

                      <div>
                        <h6 class="d-inline-block mb-3 me-2">Style Appearance </h6>
                        <small class="badge bg-warning rounded-pill">Pro</small>
                      </div>
                      <div class="d-grid gap-3 grid-cols-3 mb-4">
                        <div data-setting="checkbox">
                          <input type="checkbox" value="theme-flat" class="btn-check" name="theme_style_appearance"
                                 id="theme-style-appearance-flat">
                          <label class="btn btn-border d-block" for="theme-style-appearance-flat">Flat</label>
                        </div>
                        <div data-setting="checkbox">
                          <input type="checkbox" value="theme-bordered" class="btn-check" name="theme_style_appearance"
                                 id="theme-style-appearance-bordered">
                          <label class="btn btn-border d-block" for="theme-style-appearance-bordered">Bordered</label>
                        </div>
                        <div data-setting="checkbox">
                          <input type="checkbox" value="theme-sharp" class="btn-check" name="theme_style_appearance"
                                 id="theme-style-appearance-sharp">
                          <label class="btn btn-border d-block" for="theme-style-appearance-sharp">Sharp</label>
                        </div>
                      </div>

                      <!-- Style appearance end here -->

                      <!-- Page Animation start here -->
                      <div>
                        <h6 class="d-inline-block mb-3 me-2">Page Transition </h6>
                        <small class="badge bg-warning rounded-pill">Pro</small>
                      </div>
                      <div class="d-grid gap-3 grid-cols-2 mb-4">
                        <div data-setting="radio">
                          <input type="radio" value="theme-with-animation" class="btn-check" name="theme_transition"
                                 id="page-animation" checked>
                          <label class="btn btn-border d-block" for="page-animation">Animation</label>
                        </div>
                        <div data-setting="radio">
                          <input type="radio" value="theme-without-animation" class="btn-check" name="theme_transition"
                                 id="without-page-animation">
                          <label class="btn btn-border d-block" for="without-page-animation">No Animation</label>
                        </div>
                      </div>
                      <!-- Page Animation start here -->

                      <div>
                        <h6 class="mb-3 d-inline-block">Storage</h6>
                        <span data-bs-toggle="tooltip" data-bs-placement="right"
                              title="You can save the setting changes you made for your project on either Local storage, Session storage.">
                        <svg class="icon-20" width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                      </span>
                      </div>
                      <div class="d-grid gap-3 grid-cols-3 mb-4">
                        <div data-setting="radio">
                          <input type="radio" value="localStorage" class="btn-check" name="saveLocal"
                                 id="save-localstorage">
                          <label class="btn btn-border d-block" for="save-localstorage">Local</label>
                        </div>
                        <div data-setting="radio">
                          <input type="radio" value="sessionStorage" class="btn-check" name="saveLocal"
                                 id="save-sessionstorage">
                          <label class="btn btn-border d-block" for="save-sessionstorage">Session</label>
                        </div>
                        <div data-setting="radio">
                          <input type="radio" value="null" class="btn-check" name="saveLocal" id="save-none" checked>
                          <label class="btn btn-border d-block" for="save-none">None</label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <a class="btn btn-fixed-end btn-warning btn-icon btn-setting" id="settingbutton" data-bs-toggle="offcanvas" data-bs-target="#live-customizer" role="button" aria-controls="live-customizer">
        <svg class="icon-24 animated-rotate" width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" clip-rule="evenodd" d="M20.8064 7.62361L20.184 6.54352C19.6574 5.6296 18.4905 5.31432 17.5753 5.83872V5.83872C17.1397 6.09534 16.6198 6.16815 16.1305 6.04109C15.6411 5.91402 15.2224 5.59752 14.9666 5.16137C14.8021 4.88415 14.7137 4.56839 14.7103 4.24604V4.24604C14.7251 3.72922 14.5302 3.2284 14.1698 2.85767C13.8094 2.48694 13.3143 2.27786 12.7973 2.27808H11.5433C11.0367 2.27807 10.5511 2.47991 10.1938 2.83895C9.83644 3.19798 9.63693 3.68459 9.63937 4.19112V4.19112C9.62435 5.23693 8.77224 6.07681 7.72632 6.0767C7.40397 6.07336 7.08821 5.98494 6.81099 5.82041V5.82041C5.89582 5.29601 4.72887 5.61129 4.20229 6.52522L3.5341 7.62361C3.00817 8.53639 3.31916 9.70261 4.22975 10.2323V10.2323C4.82166 10.574 5.18629 11.2056 5.18629 11.8891C5.18629 12.5725 4.82166 13.2041 4.22975 13.5458V13.5458C3.32031 14.0719 3.00898 15.2353 3.5341 16.1454V16.1454L4.16568 17.2346C4.4124 17.6798 4.82636 18.0083 5.31595 18.1474C5.80554 18.2866 6.3304 18.2249 6.77438 17.976V17.976C7.21084 17.7213 7.73094 17.6516 8.2191 17.7822C8.70725 17.9128 9.12299 18.233 9.37392 18.6717C9.53845 18.9489 9.62686 19.2646 9.63021 19.587V19.587C9.63021 20.6435 10.4867 21.5 11.5433 21.5H12.7973C13.8502 21.5001 14.7053 20.6491 14.7103 19.5962V19.5962C14.7079 19.088 14.9086 18.6 15.2679 18.2407C15.6272 17.8814 16.1152 17.6807 16.6233 17.6831C16.9449 17.6917 17.2594 17.7798 17.5387 17.9394V17.9394C18.4515 18.4653 19.6177 18.1544 20.1474 17.2438V17.2438L20.8064 16.1454C21.0615 15.7075 21.1315 15.186 21.001 14.6964C20.8704 14.2067 20.55 13.7894 20.1108 13.5367V13.5367C19.6715 13.284 19.3511 12.8666 19.2206 12.3769C19.09 11.8873 19.16 11.3658 19.4151 10.928C19.581 10.6383 19.8211 10.3982 20.1108 10.2323V10.2323C21.0159 9.70289 21.3262 8.54349 20.8064 7.63277V7.63277V7.62361Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
          <circle cx="12.1747" cy="11.8891" r="2.63616" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></circle>
        </svg>
      </a>
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
      });
    </script>
  @endpush
</x-app-layout>
