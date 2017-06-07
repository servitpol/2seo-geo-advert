<?php

//Отображение настроек
function ga_options_page() {
   global $wpdb;
   $table_name = $wpdb->prefix . "twoseo_ga";
   $select = 'SELECT * FROM ' . $table_name;
   $results = $wpdb->get_results($select);
   $i = 1;
?>
<form method="post">
   <div class="append-block container-fluid">
   <nav class="navbar navbar-default">
   <div class="form-group header">
      <h2>Настройки Geo Advert</h2>
      <strong>Код сохраненный в правом окне, будет отображаться только украинским пользователям, заменяя собой код указанный в левом окне...
      </strong>
   </div>
   </nav>
<?php 
if(!empty($results)){
foreach($results as $short) { ?>
      <div class="shorts-block" id="short' . $i++ .'">
         <div class="default col-lg-8">
            <textarea name="block_in[]" class="area-in" placeholder="Вставьте сюда код который хотите заменить" required="required"><?php echo $short->script_in; ?></textarea>
            <textarea name="block_out[]" class="area-out" placeholder="Вставьте сюда код на который хотите заменить" required="required"><?php echo $short->script_out; ?></textarea>
         </div>
         <div class="info col-lg-4">

         <?php 
         echo '<button type="submit" class="btn btn-danger del-block" name="delete" value="' . $short->id . '"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>';
         echo 'Используйте шорткод:<p><xmp>[ga_advert name="'.$short->short_name.'"]</xmp></p><p></p>';
         echo 'Для вставки в код php используйте шаблон: <p><xmp><?php echo do_shortcode("[ga_advert name="'.$short->short_name.'"]"); ?></xmp></p>';
         ?>
            
         </div>
      </div>
      <div class="name-block">
         <input type="text" name="short_name[]" value="<?php echo $short->short_name; ?>" class="name-input" placeholder="Введите имя шорткода (одно слово до 20 символов)" required="required"/>
      </div><hr>
<?php } 
} else {
?>
      <div class="shorts-block" id="short' . $i++ .'">
         <div class="default col-lg-8">
            <textarea name="block_in[]" class="area-in" placeholder="Вставьте сюда код который хотите заменить" required="required"></textarea>
            <textarea name="block_out[]" class="area-out" placeholder="Вставьте сюда код на который хотите заменить" required="required"></textarea>
         </div>
         <div class="info col-lg-4"></div>
      </div>
      <div class="name-block">
         <input type="text" name="short_name[]" value="<?php echo $short->short_name; ?>" class="name-input" placeholder="Введите имя шорткода (одно слово до 20 символов)" required="required"/>
      </div><hr>
<?php } ?>
</div>
   <div class="container-fluid">
      <div class="form-group">
         <button id="add-block" class="btn btn-success">+</button>
      </div>
      <div class="form-group">
         <button name="save" type="submit" class="btn btn-primary">Сохранить</button>
      </div>
   </div>   
</form>
<?php
}

add_action('admin_menu', 'ga_add_menu');
function ga_add_menu() {
	add_options_page('2SEO Geo Advert', '2SEO Geo Advert', 8, __FILE__, 'ga_options_page');
}

include_once('ga-save-short.php');