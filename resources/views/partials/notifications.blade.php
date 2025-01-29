@if ($notifications->isEmpty())
    <div class="alert alert-info">
        No hay notificaciones para mostrar.
    </div>
@else
    <ul class="list-group">
        @foreach ($notifications as $notification)
            <li class="list-group-item {{ $notification->is_read ? '' : 'list-group-item-warning' }}">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1">{{ $notification->title }}</h5>
                        <p class="mb-1">{{ $notification->message }}</p>
                        <small>{{ $notification->created_at->diffForHumans() }}</small>
                    </div>
                    @if (!$notification->is_read)
                        <a href="#" class="btn btn-sm btn-primary mark-as-read" data-id="{{ $notification->id }}">
                            Marcar como leída
                        </a>
                    @endif
                </div>
            </li>
        @endforeach
    </ul>
@endif