document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.querySelector(".sidebar");
    const content = document.getElementById("main-content");
    const sidebarToggle = document.querySelector(".sidebar-toggle");
    const toggleSidebarBtn = document.querySelector(".expand-sidebar-btn");

    function toggleSidebar() {
        sidebar.classList.toggle("sidebar-collapsed");
        sidebar.classList.toggle("sidebar-expanded"); // Añadimos esta clase
        content.classList.toggle("content-expanded");
        const icon = toggleSidebarBtn.querySelector("i");

        if (sidebar.classList.contains("sidebar-collapsed")) {
            icon.classList.remove("bi-chevron-left");
            icon.classList.add("bi-chevron-right");
        } else {
            icon.classList.remove("bi-chevron-right");
            icon.classList.add("bi-chevron-left");
        }
        adjustContentMargin();
    }

    function adjustContentMargin() {
        content.style.marginLeft = sidebar.classList.contains(
            "sidebar-collapsed"
        )
            ? "var(--sidebar-width-collapsed)"
            : "var(--sidebar-width)";
    }

    sidebarToggle.addEventListener("click", () => {
        sidebar.classList.toggle("show");
    });

    toggleSidebarBtn.addEventListener("click", toggleSidebar);

    document.addEventListener("click", (e) => {
        if (
            window.innerWidth <= 992 &&
            !sidebar.contains(e.target) &&
            !sidebarToggle.contains(e.target)
        ) {
            sidebar.classList.remove("show");
        }
    });

    function adjustLayout() {
        if (window.innerWidth <= 992) {
            sidebar.classList.remove("show");
            content.style.marginLeft = "0";
        } else {
            adjustContentMargin();
        }
    }

    window.addEventListener("resize", adjustLayout);
    adjustLayout();
});
