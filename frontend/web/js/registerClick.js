document.addEventListener('DOMContentLoaded', function () {
    const elements = document.querySelectorAll('.track-click');
    elements.forEach(element => {
        element.addEventListener('click', function (event) {
            const linkId = this.dataset.linkId; // Obtiene el ID del enlace
            const originalUrl = this.href; // URL de redirección

            // Prevenir comportamiento por defecto
            event.preventDefault();

            if (linkId) {
                fetch(`/link/track/${linkId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                }).catch(error => {
                    console.error('Error al registrar clic:', error);
                }).finally(() => {
                    // Redirigir al enlace original
                    window.location.href = originalUrl;
                });
            } else {
                // Redirigir directamente si no hay ID
                window.location.href = originalUrl;
            }
        });
    });
});