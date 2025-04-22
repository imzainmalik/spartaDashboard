@php
$uniqueCount = App\Models\AssementFillup::distinct('assement_no')->count('assement_no');

@endphp
<div class="panelBox widgets">
    <div class="logo">
        <a href="{{ route('admin.dashboard') }}" title="Company Logo">
            <img src="{{ asset('assets/images/logo.png') }}" alt="">
        </a>
        <div class="menu-Bar">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <nav class="scrollcustom">
        <ul class="topMenu">
            <li>
                <a href="{{ route('admin.dashboard') }}" title="">
                    <div class="menuText">
                        <small><img src="{{ asset('assets/images/mix/icons/dashboard.png') }}" alt=""></small> Dashboard
                    </div>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.user-management.index') }}" title="">
                    <div class="menuText">
                        <small><img src="{{ asset('assets/images/mix/icons/dashboard.png') }}" alt=""></small> User Management
                    </div>
                </a>
            </li>

            <li>
                <a href="{{ route('admin.assessment-management.create') }}" title="">
                    <div class="menuText">
                        <small><img src="{{ asset('assets/images/mix/icons/dashboard.png') }}" alt=""></small> Start Assessment
                    </div>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.assessment-management.customers') }}" title="">
                    <div class="menuText">
                        <small><img src="{{ asset('assets/images/mix/icons/dashboard.png') }}" alt=""></small> Clients
                    </div>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.report.all_report') }}" title="">
                    <div class="menuText">
                        <small><img src="{{ asset('assets/images/mix/icons/dashboard.png') }}" alt=""></small> Reports
                    </div>
                    <span>{{ $uniqueCount }}</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.assessment-management.setting.index') }}" title="">
                    <div class="menuText">
                        <small><img src="{{ asset('assets/images/mix/icons/dashboard.png') }}" alt=""></small> Assessment Settings
                    </div>
                </a>
            </li>
        </ul>

    </nav>
</div>
