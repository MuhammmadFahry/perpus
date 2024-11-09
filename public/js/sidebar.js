document.addEventListener('DOMContentLoaded', function () {
    const menuButton = document.querySelector('#menuButton');
    const sidebar = document.querySelector('#sidebar');
    const content = document.querySelector('#content');

    // Open sidebar
    menuButton.addEventListener('click', function (event) {
        event.stopPropagation();
        // toggleSidebar(true);
        sidebar.classList.toggle('show-sidebar');
        content.classList.toggle('content-shifted');
    });


    // Prevent sidebar from closing when clicking inside it
    sidebar.addEventListener('click', function (event) {
        event.stopPropagation();
    });

    // Function to toggle sidebar
    function toggleSidebar(open) {
        if (open) {
            sidebar.classList.add('show-sidebar');
            content.classList.add('content-shifted');
        } else {
            sidebar.classList.remove('show-sidebar');
            content.classList.remove('content-shifted');
        }
    }

    // Close sidebar on outside click
    // document.addEventListener('click', function() {
    //     if (sidebar.classList.contains('show-sidebar')) {
    //         toggleSidebar(false);
    //     }
    // });

    // Adjust layout on window resize
    window.addEventListener('resize', function () {
        if (window.innerWidth > 768) {
            if (sidebar.classList.contains('show-sidebar')) {
                sidebar.classList.add('show-sidebar');
                content.classList.add('content-shifted');
            }
        } else {
            sidebar.classList.remove('show-sidebar');
            content.classList.remove('content-shifted');
        }
    });

    // Initial layout setup
    if (window.innerWidth > 768) {
        toggleSidebar(true);
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Mobile sidebar toggle
        const sidebarToggle = document.querySelector('.navbar-toggler');
        const sidebar = document.querySelector('.sidebar');
        const content = document.querySelector('.content');

        if (sidebarToggle && sidebar) {
            sidebarToggle.addEventListener('click', function () {
                sidebar.classList.toggle('show-sidebar');
                content.classList.toggle('content-shifted');
            });
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function (event) {
            if (window.innerWidth <= 768) {
                const isClickInsideSidebar = sidebar.contains(event.target);
                const isClickOnToggler = sidebarToggle.contains(event.target);

                if (!isClickInsideSidebar && !isClickOnToggler && sidebar.classList.contains('show-sidebar')) {
                    sidebar.classList.remove('show-sidebar');
                    content.classList.remove('content-shifted');
                }
            }
        });

        // Prevent default on sidebar links to close sidebar
        const sidebarLinks = sidebar.querySelectorAll('.nav-link');
        sidebarLinks.forEach(link => {
            link.addEventListener('click', function () {
                if (window.innerWidth <= 768) {
                    sidebar.classList.remove('show-sidebar');
                    content.classList.remove('content-shifted');
                }
            });
        });
    });
});
