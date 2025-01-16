<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{asset('backend/assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">{{env('APP_NAME')}}</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
     </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{route('admin.home')}}" >
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cog'></i>
                </div>
                <div class="menu-title active">Roles</div>
            </a>
            <ul>
                <li> <a href="{{route('admin.roles')}}"><i class='bx bx-radio-circle'></i>Roles</a>
                </li>
                {{-- <li> <a href="javascript:;"><i class='bx bx-radio-circle'></i>Permissions</a>
                </li> --}}
            </ul>
        </li>
        <li>
            <a href="{{route('admin.users')}}">
                <div class="parent-icon"><i class='bx bx-user'></i>
                </div>
                <div class="menu-title active">Users</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->
