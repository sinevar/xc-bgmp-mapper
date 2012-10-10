<div class="wrap">
    <h2>Xtreemcoder Functionality Plugin</h2>
	  <form method="post" action="options.php">
        <?php settings_fields('xc_main_settings_group'); ?>
        <?php do_settings_sections('xc_main_settings_group'); ?>
	      <?php submit_button(); ?>	
	  </form>
</div>
