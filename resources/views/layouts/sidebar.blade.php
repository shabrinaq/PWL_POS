<div class="sidebar">
  <!-- Sidebar Search Form -->
  <div class="form-inline mt-2">
      <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
              <button class="btn btn-sidebar">
                  <i class="fas fa-search fa-fw"></i>
              </button>
          </div>
      </div>
  </div>

  <!-- Sidebar Menu -->
  <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
              <a href="{{ url('/') }}" class="nav-link {{ ($activeMenu == 'dashboard') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>Dashboard</p>

                  <a href="{{ url('/profile') }}" class="nav-link {{ ($activeMenu == 'profile') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-circle"></i>
                        <p>profile</p>
                    </a>
                </a>
          </li>

          <li class="nav-header">User Data</li>
          <li class="nav-item">
              <a href="{{ url('/level') }}" class="nav-link {{ ($activeMenu == 'level') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-layer-group"></i>
                  <p>Level User</p>
              </a>
          </li>
          <li class="nav-item">
              <a href="{{ url('/user') }}" class="nav-link {{ ($activeMenu == 'user') ? 'active' : '' }}">
                  <i class="nav-icon far fa-user"></i>
                  <p>Data User</p>
              </a>
          </li>

          <li class="nav-header">Item Data</li>
          <li class="nav-item">
              <a href="{{ url('/kategori') }}" class="nav-link {{ ($activeMenu == 'kategori') ? 'active' : '' }}">
                  <i class="nav-icon far fa-bookmark"></i>
                  <p>Goods Category</p>
              </a>
          </li>
          <li class="nav-item">
              <a href="{{ url('/barang') }}" class="nav-link {{ ($activeMenu == 'barang') ? 'active' : '' }}">
                  <i class="nav-icon far fa-list-alt"></i>
                  <p>Goods Data</p>
              </a>
          </li>

          <li class="nav-header">Transaction Data</li>
          <li class="nav-item">
              <a href="{{ url('/stok') }}" class="nav-link {{ ($activeMenu == 'stok') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-cubes"></i>
                  <p>Stock of Goods</p>
              </a>
          </li>
          <li class="nav-item">
              <a href="{{ url('/penjualan') }}" class="nav-link {{ ($activeMenu == 'penjualan') ? 'active' : '' }}">
                  <i class="nav-icon fas fa-cash-register"></i>
                  <p>Sales Transactions</p>
              </a>
          </li>
          <li class="nav-item">
              <a href="{{ url('/penjualan_detail') }}" class="nav-link {{ ($activeMenu == 'penjualan_detail') ? 'active' : '' }}">
                  <i class="nav-icon far fa-user"></i>
                  <p>Sales Transaction Details</p>
              </a>
          </li>
          <li class="nav-item">
            <form id="logout-form-sidebar" action="{{ url('logout') }}" method="GET">
                @csrf
                <button type="submit" class="nav-link btn btn-danger text-left w-100">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </li>
      </ul>
  </nav>
</div>