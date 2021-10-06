      <!-- Sidebar Menu -->
      <nav class="mt-2">
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/dashboard " class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                  <dl class="row">
                    <dt class="col-sm-2">
                      <i class="fas fa-desktop"></i>
                    </dt>
                    <dd class="col-sm-10">Dashboard</dd>
                  </dl>
                </a>
              </li>
              @can('admin')
              <li class="nav-item">
                <a href="/employees" class="nav-link {{ Request::is('employees') ? 'active' : '' }}">
                  <dl class="row">
                    <dt class="col-sm-2">
                      <i class="fas fa-users"></i>
                    </dt>
                    <dd class="col-sm-10">Employees</dd>
                  </dl>
                </a>
              </li>
              <li class="nav-item">
                <a href="/companies" class="nav-link {{ Request::is('companies') ? 'active' : '' }}">
                  
                  <dl class="row">
                    <dt class="col-sm-2">
                      <i class="fas fa-building"></i>
                    </dt>
                    <dd class="col-sm-10">Companies</dd>
                  </dl>
                </a>
              </li>
              @endcan
            </ul>
      </nav>
      <!-- /.sidebar-menu -->