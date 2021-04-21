<!-- need to remove -->
<li class="nav-item pt-1">
    <a href="{{ route('home') }}" class="nav-link active">
      <i class="nav-icon fas fa-tachometer-alt"></i>
      <p>
        Dashboard
      </p>
    </a>
  </li>
  <div class="dropdown-divider"></div>
  <li class="nav-header pt-1"><b>KELOLA DATA</b></li>

  <li class="nav-item active">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-th"></i>
      <p>
        Setting User
        <i class="fas fa-angle-left right"></i>
        <span class="badge badge-info right">Admin</span>
      </p>
    </a>
    <ul class="nav nav-treeview">

      <li class="nav-item">
        <a href="{{ route('role.index') }}" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Role</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('permission.index') }}" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Permission</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('role.index') }}" class="nav-link">
          <i class="far fa-circle nav-icon"></i>
          <p>Role & Permisiion User</p>
        </a>
      </li>
    </ul>
  </li>

  <li class="nav-item">
    <a href="{{ route('staf.index') }}" class="nav-link">
      <i class="nav-icon fas fa-user-friends"></i>
      <p>
        Staf
      </p>
    </a>
  </li>
  <li class="nav-item">
    <a href="{{ route('category.index') }}" class="nav-link">
      <i class="nav-icon fas fa-list-alt"></i>
      <p>
        Category
      </p>
    </a>
  </li>
  <li class="nav-item">
    <a href="{{ route('category.show') }}" class="nav-link">
      <i class="nav-icon fas fa-list"></i>
      <p>
        List Category
      </p>
    </a>
  </li>
  <div class="dropdown-divider"></div>
  <li class="nav-header pt-2"><b>LIST TRANSAKSI</b></li>
  <li class="nav-item ">
    <a href="{{ route('loan.index') }}" class="nav-link">
      <i class="nav-icon fas fa-exchange-alt"></i>
      <p>
        Loan Transaksi
      </p>
    </a>
  </li>
  <li class="nav-item ">
    <a href="#" class="nav-link">
      <i class="nav-icon fas fa-exchange-alt"></i>
      <span class="badge badge-danger right">On Going</span>
      <p>
        Buy Transaksi
      </p>
    </a>
  </li>
  <div class="dropdown-divider"></div>



