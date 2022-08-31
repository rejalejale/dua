<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" >
                <div class="sidebar-brand-text mx-3">{{ __('BKKBN') }}</div>
            </a>

            <!-- Divider -->
            <!-- Divider -->
            <hr class="sidebar-divider">

                                 <!-- Nav Item  -->
            <li class="nav-item {{ request()->is('admin/system_calendars') || request()->is('admin/system_calendars') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.system_calendars.index') }}">
                    <i class="fa fa-calendar"></i>
                    <span>{{ __('Jadwal') }}</span></a>
            </li>

            <li class="nav-item {{ request()->is('admin/users') || request()->is('admin/users') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.users.index') }}" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fa fa-id-card"></i>
                    <span>List Driver</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                </div>
            </li>

            <li class="nav-item {{ request()->is('admin/rooms') || request()->is('admin/rooms') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.rooms.index') }}" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fa fa-car"></i>
                    <span>List Kendaraan</span>
                </a>
            </li>
            
            <li class="nav-item {{ request()->is('admin/bookings') || request()->is('admin/bookings') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.bookings.index') }}"  aria-expanded="true" aria-controls="collapseTwo">
                <i class="fa fa-clock"></i>
                    <span>{{ __('Riwayat') }}</span>
                </a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="post">
                                    @csrf
                                </form>
            </li>




        </ul>