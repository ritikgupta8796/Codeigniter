<select name="city" id="city" class="form-control form-control-sm shadow-sm">
    <option value="">Select City</option>
    <?php
        if(!empty($cities)){
                foreach ($cities as $key => $city) {
                ?>
                    <option value="<?php echo $city['id'] ?>"> <?php echo $city['name'] ?></option>
                <?php
            }
        }
      ?>
</select>