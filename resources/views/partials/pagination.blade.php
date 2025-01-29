<div class="custom-pagination">
    {{ $paginator->links() }}
</div>

<style>
    /* Estilos personalizados para la paginación de Bootstrap */
    .custom-pagination {
        margin: 2rem 0;
    }

    .custom-pagination .pagination {
        justify-content: center;
        flex-wrap: wrap;
        gap: 0.25rem;
    }

    .custom-pagination .page-link {
        color: #333;
        border-color: #dee2e6;
        padding: 0.5rem 0.75rem;
        transition: all 0.2s ease-in-out;
        border-radius: 4px;
        margin: 0 2px;
    }

    .custom-pagination .page-link:hover {
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
        text-decoration: none;
    }

    .custom-pagination .page-item.active .page-link {
        background-color: #007bff;
        border-color: #007bff;
        color: #fff;
    }

    .custom-pagination .page-item.disabled .page-link {
        color: #6c757d;
        pointer-events: none;
        background-color: #fff;
        border-color: #dee2e6;
    }

    /* Estilos para pantallas pequeñas */
    @media (max-width: 576px) {
        .custom-pagination .page-link {
            padding: 0.4rem 0.6rem;
            font-size: 0.9rem;
        }

        .custom-pagination .pagination {
            gap: 0.15rem;
        }
    }
</style>