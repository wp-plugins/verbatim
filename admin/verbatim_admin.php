<div class="wrap">
    <h2>Verbatim</h2>
    <form method="post" action="options.php">

    <?php settings_fields( 'verbatim_settings_group' ); ?>
    <?php do_settings_sections( 'verbatim_settings_page' ); ?>

    <table class="form-table">

        <tr valign="top">
            <th scope="row">Search Container</th>
            <td>
                <input type="text" name="vrbtm_search_container" value="<?php echo get_option('vrbtm_search_container', 'body'); ?>" />
            </td>
        </tr>

        <tr valign="top">
            <th scope="row">Highlight Parent Element</th>
            <td>
                <?php $highlight_parent_option = get_option('vrbtm_highlight_parent', 1); ?>
                <input type="checkbox" name="vrbtm_highlight_parent" value='1' <?php checked($highlight_parent_option, 1);?> />
            </td>
        </tr>

         <tr valign="top">
            <th scope="row">Enable Default Styling</th>
            <td>
                <?php $default_styling = get_option('vrbtm_default_styling', 1); ?>
                <input type="checkbox" name="vrbtm_default_styling" value='1' <?php checked($default_styling, 1);?> />
            </td>
        </tr>

        <tr valign="top">
            <th scope="row">Enable Amimated Scrolling To Content</th>
            <td>
                <?php $animated = get_option('vrbtm_animated', 1); ?>
                <input type="checkbox" name="vrbtm_animated" value='1' <?php checked($animated, 1);?> />
            </td>
        </tr>

         <tr valign="top">
            <th scope="row">Speed of Scrolling Animation</th>
            <td>
                <input type="text" name="vrbtm_animation_speed" value="<?php echo get_option('vrbtm_animation_speed', 2000); ?>" />
            </td>
        </tr>

        <tr valign="top">
            <th scope="row">Amount of Offset in Pixels From Top of Window</th>
            <td>
                <input type="text" name="vrbtm_scrolling_offset" value="<?php echo get_option('vrbtm_scrolling_offset', 200); ?>" />
            </td>
        </tr>

        <tr valign="top">
            <th scope="row">CSS Class To Add To Found Elements</th>
            <td>
                <input type="text" name="vrbtm_added_class" value="<?php echo get_option('vrbtm_added_class', 'verbatim-found-content'); ?>" />
            </td>
        </tr>

         <tr valign="top">
            <th scope="row">CSS Class To Add To Highlighted Elements</th>
            <td>
                <input type="text" name="vrbtm_highlighted_class" value="<?php echo get_option('vrbtm_highlighted_class', 'highlight'); ?>" />
            </td>
        </tr>

        <tr valign="top">
            <th scope="row">Default Color of Highlights</th>
            <td>
                <input type="text" name="vrbtm_highlighted_color" value="<?php echo get_option('vrbtm_highlighted_color', '#FFFF00'); ?>" />
            </td>
        </tr>

        <tr valign="top">
            <th scope="row">CSS Class to Add To Selected Text When Copying Link</th>
            <td>
                <input type="text" name="vrbtm_selected_class" value="<?php echo get_option('vrbtm_selected_class', 'verbatim-selected-text');?>" />
            </td>
        </tr>

        <tr valign="top">
            <th scope="row">CSS Class to Add To Copy Link Button</th>
            <td>
                <input type="text" name="vrbtm_button_class" value="<?php echo get_option('vrbtm_button_class', 'verbatim-button-container'); ?>" />
            </td>
        </tr>

        <tr valign="top">
            <th scope="row">Add Bitly Token to Enable Short Links</th>
            <td>
                <input type="text" name="vrbtm_bitly_token" value="<?php echo get_option('vrbtm_bitly_token'); ?>" />
            </td>
        </tr>
    </table>

    <?php submit_button(); ?>

    </form>
</div>
