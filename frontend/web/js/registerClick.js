function registerClick(linkId) {
    fetch(`/link-stats/register-click/${linkId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                console.log('Clic registrado correctamente.');
            } else {
                console.error('Error:', data.message);
            }
        })
        .catch(error => console.error('Error:', error));
}