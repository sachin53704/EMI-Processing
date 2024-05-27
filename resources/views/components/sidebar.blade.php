<div class="l-navbar" id="nav-bar">
    <nav class="nav">
        <div id="main-menu">
            <a href="{{ route('dashboard') }}" class="nav_logo">
                <i class='bx bx-layer nav_logo-icon'></i>
                <span class="nav_logo-name">EMI Processing</span>
            </a>
            <div class="nav_list">
                <a href="{{ route('dashboard') }}" class="nav_link  @if(Route::is('dashboard')) active @endif">
                    <i class='bx bx-grid-alt nav_icon'></i>
                    <span class="nav_name">Loan Details</span>
                </a>
            </div>
            <div class="nav_list">
                <a href="{{ route('emi-details.index') }}" class="nav_link">
                    <i class='bx bx-grid-alt nav_icon'></i>
                    <span class="nav_name">Emi Details</span>
                </a>
            </div>
        </div>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav_link">
            <i class='bx bx-log-out nav_icon'></i>
            <span class="nav_name">SignOut</span>
        </a>
    </nav>
</div>