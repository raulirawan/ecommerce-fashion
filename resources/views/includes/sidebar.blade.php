<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                @if (Auth::user()->roles == 'ADMIN')
                <li class="{{ request()->is('admin/dashboard*') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard.index') }}"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                </li>

                <li class="menu-title">Data</li><!-- /.menu-title -->
                <li class="{{ request()->is('admin/customer*') ? 'active' : '' }}">
                    <a href="{{ route('admin.customer.index') }}"><i class="menu-icon fa fa-user"></i>Customer </a>
                </li>
                <li class="{{ request()->is('admin/kategori*') ? 'active' : '' }}">
                    <a href="{{ route('admin.kategori.index') }}"><i class="menu-icon fa fa-list"></i>Kategori </a>
                </li>
                <li class="{{ request()->is('admin/produk*') ? 'active' : '' }}">
                    <a href="{{ route('admin.produk.list') }}"><i class="menu-icon fa fa-gift"></i>Produk </a>
                </li>
                <li class="{{ request()->is('admin/transaksi*') ? 'active' : '' }}">
                    <a href="{{ route('admin.transaksi.index') }}"><i class="menu-icon fa fa-file-text"></i>Transaksi </a>
                </li>
                @elseif (Auth::user()->roles == 'PIMPINAN')
                <li class="{{ request()->is('pimpinan/dashboard*') ? 'active' : '' }}">
                    <a href="{{ route('pimpinan.dashboard.index') }}"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                </li>
                <li class="{{ request()->is('pimpinan/transaksi*') ? 'active' : '' }}">
                    <a href="{{ route('pimpinan.transaksi.index') }}"><i class="menu-icon fa fa-file-text"></i>Transaksi </a>
                </li>
                @endif
                <li class="">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i class="menu-icon fa fa-sign-out"></i>Logout </a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>



            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>
