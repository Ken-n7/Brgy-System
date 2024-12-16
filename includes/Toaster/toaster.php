<div class="toast-container position-fixed top-0 start-50 translate-middle-x p-3">
    <?php if (isset($_SESSION['notification'])): ?>
        <div class="toast <?= ($_SESSION['notification']['type'] == 'success') ? 'bg-success' : 'bg-danger' ?>" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
            <div class="toast-header">
                <strong class="me-auto text-white"><?= ($_SESSION['notification']['type'] == 'success') ? 'Success' : 'Error' ?></strong>
                <small class="text-muted"><?= date('H:i') ?></small>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body text-white">
                <?= $_SESSION['notification']['message'] ?>
            </div>
        </div>
        <?php unset($_SESSION['notification']); ?>
    <?php endif; ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var toastElement = document.querySelector('.toast');
        if (toastElement) {
            var toast = new bootstrap.Toast(toastElement);
            toast.show();
        }
    });


    //     window.onload = function () {
    //     var toastElement = document.querySelector('.toast');
    //     if (toastElement) {
    //         var toast = new bootstrap.Toast(toastElement);
    //         toast.show();
    //     }
    // };
</script>