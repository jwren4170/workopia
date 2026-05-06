<?php if (isset($_SESSION['success_message'])) : ?>
    <div class="bg-green-100 my-3 p-3 text-center message">
        <?= $_SESSION['success_message']; ?>
    </div>
    <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error_message'])) : ?>
    <div class="bg-red-100 my-3 p-3 text-center message">
        <?= $_SESSION['error_message']; ?>
    </div>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<script>
    setTimeout(() => {
        const messages = document.querySelectorAll('.message');
        messages.forEach(message => {
            message.style.transition = 'opacity 0.5s';
            message.style.opacity = '0';
            setTimeout(() => message.remove(), 500);
        });
    }, 3000);
</script>