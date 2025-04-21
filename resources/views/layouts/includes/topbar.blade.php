<div class="topBar">
    <div class="search-box">
        <input type="text" placeholder="Search...">
        <i class="fas fa-search"></i>
    </div>
    <div class="filter">
        <select name="" id="">
            <option value="">This Year</option>
            <option value="">This Year</option>
        </select>
    </div>
    <div class="icons">
        {{-- <div class="icon"><i class="fas fa-bell"></i></div>
        <div class="icon"><i class="fas fa-flag-usa"></i></div> --}}
        <div class="profile">
            <div class="img-box">
                <img src="{{ asset('user-images/'.auth()->user()->profile_avatar.' ') }}" alt="some user image">
            </div>
        </div>
        <div class="menu">
            <ul>
                <li><a href="#"><i class="ph-bold ph-user"></i>&nbsp;Profile</a>
                </li>
                {{-- <li><a href="#"><i class="ph-bold ph-envelope-simple"></i>&nbsp;Inbox</a>
                </li>
                <li><a href="#"><i class="ph-bold ph-gear-six"></i>&nbsp;Settings</a></li>
                <li><a href="#"><i class="ph-bold ph-question"></i>&nbsp;Help</a>
                </li> --}}
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="ph-bold ph-sign-out"></i>&nbsp;Sign Out
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
