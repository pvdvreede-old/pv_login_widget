<?php
/*
  Plugin Name: Login Widget
  Plugin URI: http://www.vdvreede.net
  Description: Plugin that creates a widget for logging in.
  Author: Paul Van de Vreede
  Version: 0.9
  Author URI: http://www.vdvreede.net
 */

add_action('widgets_init', create_function('', 'return register_widget("PV_Login_Widget");'));

class PV_Login_Widget extends WP_Widget {

    /** constructor */
    function PV_Login_Widget() {
        parent::WP_Widget('pv_login_widget', $name = 'Login Widget');
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        echo $before_widget;
        if ($title)
            echo $before_title . $title . $after_title;

        if (!is_user_logged_in()) {
            ?>
            <form class="form-stacked" method="post" action="<?php echo get_bloginfo('url'); ?>/wp-login.php">
                <label for="log">Username:</label>
                <input type="text" name="log" />
                <label for="pwd">Password:</label>
                <input type="password" name="pwd" />
                <p>
                    <input type="checkbox" name="rememberme" value="forever" />
                    <label for="rememberme">Remember me</label>
                </p>
                <input class="btn" type="submit" value="Log in" />

                <input type="hidden" name="redirect_to" value="<?php echo get_bloginfo('url'); ?>" />
            </form>

            <p><a href="<?php echo get_bloginfo('url'); ?>/wp-login.php?action=lostpassword">Lost your password?</a></p>
            <?php
        } else {
            $current_user = wp_get_current_user();
            ?>
            <p>Welcome back, <?php echo $current_user->user_login; ?>.</p>
            <?php if (current_user_can('edit_posts')) : ?>
            <p><a href="<?php echo get_bloginfo('url'); ?>/wp-admin/">Administration</a></p>
            <?php endif; ?>
            <p><a href="<?php echo wp_logout_url( ); ?> ">Logout</a></p>           
            <?php
        }

        echo $after_widget;
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        return $instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {
        if ($instance) {
            $title = esc_attr($instance['title']);
        } else {
            $title = __('New title', 'text_domain');
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <?php
    }

}

//register_widget('PV_Login_Widget');
