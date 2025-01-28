document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.querySelector(".sidebar");
    const content = document.querySelector(".content");
    const sidebarToggle = document.querySelector(".sidebar-toggle");
    const loadingIndicator = document.querySelector(".loading-indicator");

    // Sidebar toggle functionality
    sidebarToggle.addEventListener("click", () => {
        sidebar.classList.toggle("show");
    });

    // Close sidebar when clicking outside on mobile
    document.addEventListener("click", (e) => {
        if (
            window.innerWidth <= 992 &&
            !sidebar.contains(e.target) &&
            !sidebarToggle.contains(e.target) &&
            sidebar.classList.contains("show")
        ) {
            sidebar.classList.remove("show");
        }
    });

    // Collapse sidebar on larger screens
    const collapseSidebar = () => {
        if (window.innerWidth > 992) {
            sidebar.classList.toggle("sidebar-collapsed");
            content.classList.toggle("content-expanded");
        }
    };

    // Double-click on sidebar to collapse
    sidebar.addEventListener("dblclick", collapseSidebar);

    // Loading indicator functionality
    const showLoader = () => loadingIndicator.classList.remove("d-none");
    const hideLoader = () => loadingIndicator.classList.add("d-none");

    // Show loader when navigating
    document.querySelectorAll("a").forEach((link) => {
        link.addEventListener("click", showLoader);
    });

    // Hide loader when page is fully loaded
    window.addEventListener("load", hideLoader);

    // Adjust layout for smaller screens
    const adjustLayout = () => {
        if (window.innerWidth <= 992) {
            sidebar.classList.remove("show");
            content.style.marginLeft = "0";
        } else {
            sidebar.classList.remove("sidebar-collapsed");
            content.classList.remove("content-expanded");
            content.style.marginLeft = `${sidebar.offsetWidth}px`;
        }
    };

    window.addEventListener("resize", adjustLayout);
    adjustLayout(); // Initial call
});
