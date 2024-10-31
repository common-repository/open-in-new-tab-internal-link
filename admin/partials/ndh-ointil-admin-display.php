<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://nguyenduyhoang.com/
 * @since      1.0.0
 *
 * @package    Ndh_Ointil
 * @subpackage Ndh_Ointil/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrap">

    <h2><?php echo esc_html(get_admin_page_title()); ?></h2>
    <p><?php _e('Open the link in a new tab for the Internal Link in the content of single post.', $this->plugin_name); ?></p>

    <form method="post" name="ndhontil_options" action="options.php">
        
        <?php
            //Grab all options
            $options = get_option($this->plugin_name);

            $active = (isset($options['active'])) ? $options['active'] : 0;
        ?>

        <?php
            settings_fields($this->plugin_name);
            do_settings_sections($this->plugin_name);
        ?>

        <fieldset>
            <legend class="screen-reader-text"><span><?php _e('Active', $this->plugin_name); ?></span></legend>
            <label for="<?php echo $this->plugin_name; ?>-active">
                <input type="checkbox" id="<?php echo $this->plugin_name; ?>-active" name="<?php echo $this->plugin_name; ?>[active]" value="1" <?php checked($active, 1); ?> />
                <span><?php esc_attr_e('Active', $this->plugin_name); ?></span>
            </label>
        </fieldset>

        <?php submit_button(__('Save all changes', $this->plugin_name), 'primary','submit', TRUE); ?>

    </form>

</div>