<div class="wrap">
    <?php var_dump($this->errors); ?>
    <form action="" method="post">
        <table class="form-table">
            <tbody>
                <tr>
                    <th>
                        <label for="name">
                            <?php _e('Name', 'dusra-academy'); ?>
                        </label>
                    </th>
                    <td>
                        <input type="text" name="name" id="name" class="regular-text" value="">
                        <?php  if(isset($this->errors['name'])){
                            echo '<p>'.$this->errors['name'].'</p>';
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="address">
                            <?php _e('Address', 'dusra-academy'); ?>
                        </label>
                    </th>
                    <td>
                        <textarea name="address" id="address" cols="30" rows="10" class="regular-text"></textarea>
                        <?php  if(isset($this->errors['address'])){
                            echo '<p>'.$this->errors['address'].'</p>';
                        }?>
                    
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="phone">
                            <?php _e('Phone', 'dusra-academy'); ?>
                        </label>
                    </th>
                    <td>
                        <input type="text" name="phone" id="phone" class="regular-text" value="">
                        <?php  if(isset($this->errors['phone'])){
                            echo '<p>'.$this->errors['phone'].'</p>';
                        }?>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="email">
                            <?php _e('Email', 'dusra-academy'); ?>
                        </label>
                    </th>
                    <td>
                        <input type="text" name="email" id="email" class="regular-text" value="">
                        <?php  if(isset($this->errors['email'])){
                            echo '<p>'.$this->errors['email'].'</p>';
                        }?>
                    </td>
                </tr>
            </tbody>
        </table>
        <?php wp_nonce_field('new-address'); ?>
        <?php submit_button( __('Add Address','dusra-academy'),'primary','submit_address'); ?>
    </form>
</div>
