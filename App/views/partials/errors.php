 <?php if (isset($errors)) : ?>
     <?php foreach ($errors as $error) : ?>
         <div class="bg-red-100 my-3 p-3 message"><?php echo $error; ?></div>
     <?php endforeach; ?>
 <?php endif; ?>