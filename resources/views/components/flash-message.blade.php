@props(['type' => 'success', 'message'])

@if(session($message))
    <div id="flash-message" class="alert alert-{{ $type }}">
        {{ session($message) }}
    </div>

    <script>
        setTimeout(function() {
            const msg = document.getElementById('flash-message');
            if (msg) {
                msg.style.transition = "opacity 0.5s ease";
                msg.style.opacity = 0;
                setTimeout(() => msg.remove(), 500);
            }
        }, 3000);
    </script>
@endif
