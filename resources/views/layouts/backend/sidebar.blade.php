@php
use Illuminate\Support\Facades\Session;
@endphp

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
        
        @php
         $userPermissions = session::get('user_permissions');
         @endphp

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-detail'></i></div>
                <div class="menu-title active">Document Type</div>
            </a>
            <ul>
                @if(in_array('8', $userPermissions))
                    <li><a href="{{ route('admin.document.office_memorandum.index') }}"><i class='bx bx-radio-circle'></i> Office Memorandum</a></li>
                @endif
                @if(in_array('9', $userPermissions))
                    <li><a href="{{ route('admin.document.office_order.index') }}"><i class='bx bx-radio-circle'></i> Office Order</a></li>
                @endif
                @if(in_array('10', $userPermissions))
                    <li><a href="{{ route('admin.document.notification.index') }}"><i class='bx bx-radio-circle'></i> Notification</a></li>
                @endif
                @if(in_array('11', $userPermissions))
                    <li><a href="{{ route('admin.document.letter.index') }}"><i class='bx bx-radio-circle'></i> Letters </a></li>
                @endif
                @if(in_array('12', $userPermissions))
                    <li><a href="{{ route('admin.document.records_of_discussion.index') }}"><i class='bx bx-radio-circle'></i> Record of Discussion (ROD) </a></li>
                @endif
                @if(in_array('13', $userPermissions))
                    <li><a href="{{ route('admin.document.minutes_of_metting.index') }}"><i class='bx bx-radio-circle'></i> Minutes of Meeting (MoM) </a></li>
                @endif
               
                @if(in_array('15', $userPermissions))
                    <li><a href="{{ route('error404') }}"><i class='bx bx-radio-circle'></i> International Meetings (COPs, G20, etc)
                    </a></li>
                @endif
                @if(in_array('16', $userPermissions))
                    <li><a href="{{ route('admin.document.gazette_notification.index') }}"><i class='bx bx-radio-circle'></i> Gazette Notifications</a></li>
                @endif
                @if(in_array('17', $userPermissions))
                    <li><a href="{{ route('admin.document.recruitment.index') }}"><i class='bx bx-radio-circle'></i> Recruitment Rules</a></li>
                @endif
                @if(in_array('18', $userPermissions))
                    <li><a href="{{ route('admin.document.guideline.index') }}"><i class='bx bx-radio-circle'></i> Guidelines</a></li>
                @endif
                @if(in_array('19', $userPermissions))
                    <li><a href="{{ route('admin.document.achievenment.index') }}"><i class='bx bx-radio-circle'></i> Achievements</a></li>
                @endif
                @if(in_array('20', $userPermissions))
                    <li><a href="{{ route('admin.document.rebuttals.index') }}"><i class='bx bx-radio-circle'></i> Rebuttals</a></li>
                @endif
                @if(in_array('21', $userPermissions))
                    <li><a href="{{ route('admin.document.presentations.index') }}"><i class='bx bx-radio-circle'></i> Presentations</a></li>
                @endif
                @if(in_array('22', $userPermissions))
                    <li><a href="{{ route('error404') }}"><i class='bx bx-radio-circle'></i> Parliament Questions (Lok Sabha)</a></li>
                @endif
                @if(in_array('23', $userPermissions))
                    <li><a href="{{ route('error404') }}"><i class='bx bx-radio-circle'></i> Parliament Questions (Rajya Sabha)</a></li>
                @endif
                @if(in_array('24', $userPermissions))
                    <li><a href="{{ route('error404') }}"><i class='bx bx-radio-circle'></i> Office</a></li>
                @endif
                @if(in_array('25', $userPermissions))
                    <li><a href="{{ route('error404') }}"><i class='bx bx-radio-circle'></i> Court Case</a></li>
                @endif
                @if(in_array('26', $userPermissions))
                    <li><a href="{{ route('admin.document.pm_reference.index') }}"><i class='bx bx-radio-circle'></i> PM Reference</a></li>
                @endif
                @if(in_array('27', $userPermissions))
                    <li><a href="{{ route('admin.document.vip_reference.index') }}"><i class='bx bx-radio-circle'></i> VIP Reference</a></li>
                @endif
                @if(in_array('28', $userPermissions))
                    <li><a href="{{ route('admin.document.cabinet_note.index') }}"><i class='bx bx-radio-circle'></i> Cabinet Note</a></li>
                @endif
                @if(in_array('29', $userPermissions))
                    <li><a href="{{ route('admin.document.pragati.index') }}"><i class='bx bx-radio-circle'></i> Pragati</a></li>
                @endif
                @if(in_array('30', $userPermissions))
                    <li><a href="{{ route('error404') }}"><i class='bx bx-radio-circle'></i> Prayas</a></li>
                @endif
                @if(in_array('31', $userPermissions))
                    <li><a href="{{ route('error404') }}"><i class='bx bx-radio-circle'></i> Cabinet Observation</a></li>
                @endif
                @if(in_array('32', $userPermissions))
                    <li><a href="{{ route('error404') }}"><i class='bx bx-radio-circle'></i> 	
                    eSamikSha</a></li>
                @endif
                @if(in_array('33', $userPermissions))
                    <li><a href="{{ route('error404') }}"><i class='bx bx-radio-circle'></i> Annual Report</a></li>
                @endif
                @if(in_array('34', $userPermissions))
                    <li><a href="{{ route('error404') }}"><i class='bx bx-radio-circle'></i> MEF Speech</a></li>
                @endif
                @if(in_array('35', $userPermissions))
                    <li><a href="{{ route('error404') }}"><i class='bx bx-radio-circle'></i> Subordinate Legislations</a></li>
                @endif
                @if(in_array('36', $userPermissions))
                    <li><a href="{{ route('error404') }}"><i class='bx bx-radio-circle'></i> Public Grievance</a></li>
                @endif
                @if(in_array('37', $userPermissions))
                    <li><a href="{{ route('error404') }}"><i class='bx bx-radio-circle'></i> RTI</a></li>
                @endif
                @if(in_array('38', $userPermissions))
                    <li><a href="{{ route('error404') }}"><i class='bx bx-radio-circle'></i> Bilateral / Multilateral</a></li>
                @endif
                @if(in_array('39', $userPermissions))
                    <li><a href="{{ route('error404') }}"><i class='bx bx-radio-circle'></i> International</a></li>
                @endif
            </ul>
        </li>
            <!--end navigation-->
        </div>
        <!--end sidebar wrapper -->
