<footer class="main-footer bg-dark text-light py-3">
    <div class="container d-flex justify-content-between align-items-center">
        <div>
            <strong>&copy; <?= date('Y') ?> CaberoTech.</strong> Todos los derechos reservados.
        </div>
        <div class="text-end">
            <b>Versión:</b> 1.1.0
        </div>
    </div>
</footer>

<style>
    .main-footer {
        position: fixed;
        bottom: 0;
        width: 100%;
        z-index: 1030;
        box-shadow: 0 -1px 5px rgba(0, 0, 0, 0.1);
    }
</style>