// Search functionality
function initializeSearch(tableId, searchInputId) {
    const searchInput = document.getElementById(searchInputId);
    const tableBody = document.getElementById(tableId);
    let searchTimeout;

    if (!searchInput || !tableBody) return;

    // Guardar el contenido original de la tabla
    const originalTableContent = tableBody.innerHTML;

    searchInput.addEventListener("input", function (e) {
        const searchTerm = e.target.value.toLowerCase();

        // Clear previous timeout
        if (searchTimeout) {
            clearTimeout(searchTimeout);
        }

        // Show loading state
        tableBody
            .closest(".table-responsive")
            .classList.add("loading-table", "active");

        // Debounce search
        searchTimeout = setTimeout(() => {
            const rows = tableBody.getElementsByTagName("tr");

            // Si el término de búsqueda está vacío, restablecer la tabla al estado original
            if (searchTerm === "") {
                tableBody.innerHTML = originalTableContent;
                tableBody
                    .closest(".table-responsive")
                    .classList.remove("loading-table", "active");
                return;
            }

            Array.from(rows).forEach((row) => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? "" : "none";
            });

            // Remove loading state
            tableBody
                .closest(".table-responsive")
                .classList.remove("loading-table", "active");

            // Show no results message if needed
            const visibleRows = Array.from(rows).filter(
                (row) => row.style.display !== "none"
            );
            if (visibleRows.length === 0) {
                const noResultsRow = document.createElement("tr");
                noResultsRow.innerHTML = `
                    <td colspan="7" class="text-center py-4">
                        <div class="d-flex flex-column align-items-center">
                            <i class="bi bi-search display-4 text-muted mb-2"></i>
                            <p class="text-muted mb-0">No se encontraron resultados para "${searchTerm}"</p>
                        </div>
                    </td>
                `;
                tableBody.innerHTML = "";
                tableBody.appendChild(noResultsRow);
            }
        }, 300);
    });
}
