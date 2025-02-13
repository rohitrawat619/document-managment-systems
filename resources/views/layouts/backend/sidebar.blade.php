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
        @if(Auth::user()->is_admin==1)
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-cog'></i>
                    </div>
                    <div class="menu-title active">System</div>
                </a>
                <ul>
                    <li> <a href="{{ route('admin.roles.index') }}"><i class='bx bx-radio-circle'></i>Roles</a>
                    </li>
                    <li> <a href="{{ route('admin.permission.index') }}"><i class='bx bx-radio-circle'></i>Permission</a>
                    </li>
                    <li> <a href="{{ route('admin.designation.index') }}"><i class='bx bx-radio-circle'></i>Designation</a>
                    </li>
                    <li> <a href="{{ route('admin.division.index') }}"><i class='bx bx-radio-circle'></i>Division</a>
                    </li>
                    <li> <a href="{{route('admin.division.index')}}"><i class='bx bx-radio-circle'></i>Division</a>
                    </li>
                </ul>
            </li>
        @endif
        @if(Auth::user()->is_admin==1 || Auth::user()->role_id==1)
            <li>
                <a href="{{route('admin.users.index')}}">
                    <div class="parent-icon"><i class='bx bx-user'></i>
                    </div>
                    <div class="menu-title active">Users</div>
                </a>
            </li>
        @endif
        <li class="menu-label">File Managemant</li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-detail'></i>
                </div>
                <div class="menu-title active">Document Type</div>
            </a>
            <ul>
                <li> <a href="{{route('admin.document.office_memorandum.index')}}"><i class='bx bx-radio-circle'></i>Office Memorandum</a>
                </li>
                <li> <a href="{{route('admin.document.office_order.index')}}"><i class='bx bx-radio-circle'></i>Office Order</a>
                </li>
                <li> <a href="{{route('admin.document.notification.index')}}"><i class='bx bx-radio-circle'></i>Notification</a>
                </li>
                <!-- <li> <a href="{{route('admin.document.letter.index')}}"><i class='bx bx-radio-circle'></i>Letters</a>
                </li> -->
                {{-- <li> <a href="javascript:;"><i class='bx bx-radio-circle'></i>Permissions</a>
                </li> --}}
            </ul>
        </li>
    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->
