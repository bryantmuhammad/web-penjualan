<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ Request::is('dashboard/index') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard.index') }}"><i class="fas fa-fire"></i>
                    <span>Dashboard</span></a>
            </li>

            @can('crud_admin')
                <li class="menu-header">Data Master</li>
                <li
                    class="nav-item dropdown {{ in_array(request()->segment(2), ['admins', 'kategoris', 'produks', 'suppliers']) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                        <span>Data Master</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ Request::is('dashboard/admins*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('dashboard.admins.index') }}">Admin</a>
                        </li>
                        <li class="{{ Request::is('dashboard/kategoris*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('dashboard.kategoris.index') }}">Kategori</a>
                        </li>
                        <li class="{{ Request::is('dashboard/produks*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('dashboard.produks.index') }}">Produk</a>
                        </li>
                        <li class="{{ Request::is('dashboard/suppliers*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('dashboard.suppliers.index') }}">Supplier</a>
                        </li>
                    </ul>
                </li>
            @endcan



            <li class="menu-header">Transaksi</li>
            @can('crud_admin')
                <li class="nav-item dropdown {{ in_array(request()->segment(2), ['pembelians']) ? 'active' : '' }}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i>
                        <span>Pembelian</span></a>
                    <ul class="dropdown-menu">
                        <li class="{{ Request::is('dashboard/pembelians*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('dashboard.pembelians.index') }}">Pembelian</a>
                        </li>
                    </ul>
                </li>
            @endcan


            <li class="nav-item dropdown ">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i>
                    <span>Components</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('components-article') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('components-article') }}">Article</a>
                    </li>
                    <li class="{{ Request::is('components-avatar') ? 'active' : '' }}">
                        <a class="nav-link beep beep-sidebar" href="{{ url('components-avatar') }}">Avatar</a>
                    </li>
                    <li class="{{ Request::is('components-chat-box') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('components-chat-box') }}">Chat Box</a>
                    </li>
                    <li class="{{ Request::is('components-empty-state') ? 'active' : '' }}">
                        <a class="nav-link beep beep-sidebar" href="{{ url('components-empty-state') }}">Empty
                            State</a>
                    </li>
                    <li class="{{ Request::is('components-gallery') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('components-gallery') }}">Gallery</a>
                    </li>
                    <li class="{{ Request::is('components-hero') ? 'active' : '' }}">
                        <a class="nav-link beep beep-sidebar" href="{{ url('components-hero') }}">Hero</a>
                    </li>
                    <li class="{{ Request::is('components-multiple-upload') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('components-multiple-upload') }}">Multiple Upload</a>
                    </li>
                    <li class="{{ Request::is('components-pricing') ? 'active' : '' }}">
                        <a class="nav-link beep beep-sidebar" href="{{ url('components-pricing') }}">Pricing</a>
                    </li>
                    <li class="{{ Request::is('components-statistic') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('components-statistic') }}">Statistic</a>
                    </li>
                    <li class="{{ Request::is('components-tab') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('components-tab') }}">Tab</a>
                    </li>
                    <li class="{{ Request::is('components-table') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('components-table') }}">Table</a>
                    </li>
                    <li class="{{ Request::is('components-user') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('components-user') }}">User</a>
                    </li>
                    <li class="{{ Request::is('components-wizard') ? 'active' : '' }}">
                        <a class="nav-link beep beep-sidebar" href="{{ url('components-wizard') }}">Wizard</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown ">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-file-alt"></i>
                    <span>Forms</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('forms-advanced-form') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('forms-advanced-form') }}">Advanced Form</a>
                    </li>
                    <li class="{{ Request::is('forms-editor') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('forms-editor') }}">Editor</a>
                    </li>
                    <li class="{{ Request::is('forms-validation') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('forms-validation') }}">Validation</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown ">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-plug"></i> <span>Modules</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('modules-calendar') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('modules-calendar') }}">Calendar</a>
                    </li>
                    <li class="{{ Request::is('modules-chartjs') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('modules-chartjs') }}">ChartJS</a>
                    </li>
                    <li class="{{ Request::is('modules-datatables') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('modules-datatables') }}">DataTables</a>
                    </li>
                    <li class="{{ Request::is('modules-flag') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('modules-flag') }}">Flag</a>
                    </li>
                    <li class="{{ Request::is('modules-font-awesome') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('modules-font-awesome') }}">Font Awesome</a>
                    </li>
                    <li class="{{ Request::is('modules-ion-icons') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('modules-ion-icons') }}">Ion Icons</a>
                    </li>
                    <li class="{{ Request::is('modules-owl-carousel') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('modules-owl-carousel') }}">Owl Carousel</a>
                    </li>
                    <li class="{{ Request::is('modules-sparkline') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('modules-sparkline') }}">Sparkline</a>
                    </li>
                    <li class="{{ Request::is('modules-sweet-alert') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('modules-sweet-alert') }}">Sweet Alert</a>
                    </li>
                    <li class="{{ Request::is('modules-toastr') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('modules-toastr') }}">Toastr</a>
                    </li>
                    <li class="{{ Request::is('modules-vector-map') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('modules-vector-map') }}">Vector Map</a>
                    </li>
                    <li class="{{ Request::is('modules-weather-icon') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('modules-weather-icon') }}">Weather Icon</a>
                    </li>
                </ul>
            </li>
            <li class="menu-header">Pages</li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="far fa-user"></i> <span>Auth</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('auth-forgot-password') ? 'active' : '' }}">
                        <a href="{{ url('auth-forgot-password') }}">Forgot Password</a>
                    </li>
                    <li class="{{ Request::is('auth-login') ? 'active' : '' }}">
                        <a href="{{ url('auth-login') }}">Login</a>
                    </li>
                    <li class="{{ Request::is('auth-login2') ? 'active' : '' }}">
                        <a class="beep beep-sidebar" href="{{ url('auth-login2') }}">Login 2</a>
                    </li>
                    <li class="{{ Request::is('auth-register') ? 'active' : '' }}">
                        <a href="{{ url('auth-register') }}">Register</a>
                    </li>
                    <li class="{{ Request::is('auth-reset-password') ? 'active' : '' }}">
                        <a href="{{ url('auth-reset-password') }}">Reset Password</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown ">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-exclamation"></i>
                    <span>Errors</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('error-403') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('error-403') }}">403</a>
                    </li>
                    <li class="{{ Request::is('error-404') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('error-404') }}">404</a>
                    </li>
                    <li class="{{ Request::is('error-500') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('error-500') }}">500</a>
                    </li>
                    <li class="{{ Request::is('error-503') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('error-503') }}">503</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-bicycle"></i>
                    <span>Features</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('features-activities') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('features-activities') }}">Activities</a>
                    </li>
                    <li class="{{ Request::is('features-post-create') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('features-post-create') }}">Post Create</a>
                    </li>
                    <li class="{{ Request::is('features-post') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('features-post') }}">Posts</a>
                    </li>
                    <li class="{{ Request::is('features-profile') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('features-profile') }}">Profile</a>
                    </li>
                    <li class="{{ Request::is('features-settings') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('features-settings') }}">Settings</a>
                    </li>
                    <li class="{{ Request::is('features-setting-detail') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('features-setting-detail') }}">Setting Detail</a>
                    </li>
                    <li class="{{ Request::is('features-tickets') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('features-tickets') }}">Tickets</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-ellipsis-h"></i>
                    <span>Utilities</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('utilities-contact') ? 'active' : '' }}">
                        <a href="{{ url('utilities-contact') }}">Contact</a>
                    </li>
                    <li class="{{ Request::is('utilities-invoice') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('utilities-invoice') }}">Invoice</a>
                    </li>
                    <li class="{{ Request::is('utilities-subscribe') ? 'active' : '' }}">
                        <a href="{{ url('utilities-subscribe') }}">Subscribe</a>
                    </li>
                </ul>
            </li>
            <li class="{{ Request::is('credits') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('credits') }}"><i class="fas fa-pencil-ruler">
                    </i> <span>Credits</span>
                </a>
            </li>
        </ul>

        <div class="hide-sidebar-mini mt-4 mb-4 p-3">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
            </a>
        </div>
    </aside>
</div>
