<div class="wrap">
   <h1><?php _e('Address Book','wedevs-academy'); ?></h1>
   <a href="<?php echo admin_url('admin.php?page=dusra-academy&action=new', ); ?>"> add new </a>

   <form action="" method="post">
        <?php
        $table = new Dusra\Academy\Admin\Address_List();
        $table->prepare_items();
        $table->display();
        ?>
   </form>
</div>
