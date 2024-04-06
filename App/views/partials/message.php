<?php

use JWord\Framework\Session;

$success_message = Session::get_flash_message('success_message');
$error_message = Session::get_flash_message('error_message');
?>

<?php if ($success_message !== null) : ?>
    <div class="message bg-green-100 p-3 my-3 text-center font-bold">
        <?= $success_message ?>
    </div>
<?php endif; ?>

<?php if ($error_message !== null) : ?>
    <div class="message bg-red-100 p-3 my-3 text-center font-bold">
        <?= $error_message  ?>
    </div>
<?php endif; ?>