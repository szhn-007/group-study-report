{{-- <div class="pre-loader">
    <div class="pre-loader-box">
        <div class="loader-logo"><img src="{{ asset('assets/vendors/images/deskapp-logo.svg') }}" alt=""></div>
        <div class='loader-progress' id="progress_div">
            <div class='bar' id='bar1'></div>
        </div>
        <div class='percent' id='percent1'>0%</div>
        <div class="loading-text">
            Loading...
        </div>
    </div>
</div> --}}

<div class="header">
    <div class="header-left">
        <div class="menu-icon dw dw-menu"></div>
        <div class="header-title ml-3">
            <h4 id="currentSection">Dashboard</h4>
        </div>
    </div>
    <div class="header-right">
        <div class="user-info-dropdown">
            <div class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                    <span class="user-icon">
                        <img src="{{ Auth::guard('admin')->user()->image ?? asset('assets/vendors/images/default-user.jpg') }}" alt="">
                    </span>
                    <span class="user-name">
                        {{ Auth::guard('admin')->user()->name }}
                        {{ Auth::guard('admin')->user()->surname ?? '' }}
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                    <a class="dropdown-item" href=""><i class="dw dw-user1"></i> Profile</a>
                    <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                       <i class="dw dw-logout"></i> Log Out
                    </a>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get DOM elements
    const currentSectionElement = document.getElementById('currentSection');
    const sidebarItems = document.querySelectorAll('.sidebar-item');

    // Function to update section title
    function updateSectionTitle(sectionName) {
        if (sectionName && currentSectionElement) {
            currentSectionElement.textContent = sectionName;
            localStorage.setItem('currentSection', sectionName);
        }
    }

    // Set initial title from localStorage or active menu item
    const storedSection = localStorage.getItem('currentSection');
    if (storedSection) {
        updateSectionTitle(storedSection);
    } else {
        // Find active menu item and set its title
        const activeItem = document.querySelector('.sidebar-menu li.active .sidebar-item');
        if (activeItem) {
            updateSectionTitle(activeItem.getAttribute('data-section'));
        }
    }

    // Update title when sidebar items are clicked
    sidebarItems.forEach(item => {
        item.addEventListener('click', function() {
            const sectionName = this.getAttribute('data-section');
            updateSectionTitle(sectionName);
        });
    });

    // Handle page load with URL matching
    const currentPath = window.location.pathname;
    sidebarItems.forEach(item => {
        if (item.href && currentPath.startsWith(new URL(item.href).pathname)) {
            updateSectionTitle(item.getAttribute('data-section'));
        }
    });

    // Your existing logout handling
    const logoutLinks = document.querySelectorAll('[onclick*="logout-form"]');
    logoutLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('logout-form').submit();
        });
    });
});
</script>
@endpush
