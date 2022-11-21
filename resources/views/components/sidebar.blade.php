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

        </ul>


    </aside>
</div>
