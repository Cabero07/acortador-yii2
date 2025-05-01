document.addEventListener('DOMContentLoaded', function () {
    const elements = document.querySelectorAll('.track-click');
    elements.forEach(element => {
        element.addEventListener('click', function () {
            const linkId = this.dataset.linkId; // Obtiene el ID del enlace
            if (linkId) {
                fetch(`/link/track/${linkId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Token CSRF si es necesario
                    }
                }).then(response => response.json())
                  .then(data => {
                      if (data.success) {
                          console.log(data.message); // Mensaje de éxito
                      } else {
                          console.error(data.message); // Mensaje de error
                      }
                  })
                  .catch(error => {
                      console.error('Error en la solicitud:', error);
                  });
            }
        });
    });
});