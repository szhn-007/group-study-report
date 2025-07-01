<!-- js -->
<script src="{{ asset('assets/vendors/scripts/core.js') }}"></script>
<script src="{{ asset('assets/vendors/scripts/script.min.js') }}"></script>
<script src="{{ asset('assets/vendors/scripts/process.js') }}"></script>
<script src="{{ asset('assets/vendors/scripts/layout-settings.js') }}"></script>
<script src="{{ asset('assets/src/plugins/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/vendors/scripts/dashboard.js') }}"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-119386393-1');

    document.addEventListener('DOMContentLoaded', function() {
        // Function to update header title
        function updateHeaderTitle() {
            // Check for active sidebar item
            const activeItem = document.querySelector('.sidebar-item.active');
            if (activeItem) {
                document.getElementById('currentSection').textContent = activeItem.dataset.section;
            }

            // Check URL for deeper nested pages
            const path = window.location.pathname;
            if (path.includes('/forms/basic')) {
                document.getElementById('currentSection').textContent = 'Basic Form';
            }
            // Add more path checks as needed
        }

        // Initial update
        updateHeaderTitle();

        // Set up event listeners for sidebar clicks
        document.querySelectorAll('.sidebar-item').forEach(item => {
            item.addEventListener('click', function() {
                // Update active class
                document.querySelectorAll('.sidebar-item').forEach(i => i.classList.remove('active'));
                this.classList.add('active');

                // Update header title
                document.getElementById('currentSection').textContent = this.dataset.section;
            });
        });

        // Update on browser back/forward
        window.addEventListener('popstate', updateHeaderTitle);
    });
</script>
