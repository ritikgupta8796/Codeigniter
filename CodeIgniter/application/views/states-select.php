<select name="state" id="state" class="form-control form-control-sm shadow-sm">
    <option value="">Select State</option>
    <?php
        if(!empty($states)){
                foreach ($states as $key => $state) {
                ?>
                    <option value="<?php echo $state['id'] ?>"> <?php echo $state['name'] ?></option>
                <?php
            }
        }
      ?>
</select>