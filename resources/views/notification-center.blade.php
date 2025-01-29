@extends('layouts.app2')

@section('title', 'Centro de Notificaciones')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Centro de Notificaciones</h1>
        <button id="refreshNotifications" class="btn btn-custom">
            <i class="fas fa-sync-alt"></i> Actualizar
        </button>
    </div>

    <div class="mb-3">
        <select class="form-select" id="notificationFilter">
            <option value="all">Todas las notificaciones</option>
            <option value="unread">No leídas</option>
        </select>
    </div>

    <div id="notificationList">
        @include('partials.notifications', ['notifications' => $notifications])
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        function renderNotifications(filter = 'all') {
            $.ajax({
                url: '{{ route("notificaciones.index") }}',
                method: 'GET',
                data: { filter: filter },
                success: function (response) {
                    $('#notificationList').html(response);
                }
            });
        }

        function markAsRead(id) {
            $.ajax({
                url: `/notificaciones/${id}/marcar-como-leido`,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (response.success) {
                        renderNotifications($('#notificationFilter').val());
                        updateUnreadCount();
                    }
                }
            });
        }

        function updateUnreadCount() {
            $.ajax({
                url: '{{ route("notificaciones.unread-count") }}',
                method: 'GET',
                success: function (response) {
                    $('.notification-count').text(response.count);
                }
            });
        }

        // Event handler for filter changes
        $('#notificationFilter').on('change', function () {
            renderNotifications($(this).val());
        });

        // Event handler for refresh button
        $('#refreshNotifications').on('click', function () {
            renderNotifications($('#notificationFilter').val());
            updateUnreadCount();
        });

        // Event handler for marking notifications as read
        $(document).on('click', '.mark-as-read', function (e) {
            e.preventDefault();
            markAsRead($(this).data('id'));
        });

        // Initial load of notifications
        renderNotifications();
        updateUnreadCount();
    });
</script>
@endsection