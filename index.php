<?php

/**
 * Plugin Name: Reschedule Post
 * Description: This plugin allows you to reschedule a post by entering a custom date and time.
 * Version: 1.0
 * Author: Muhammet ILBAS
 */

function add_custom_datetime_field()
{
    add_meta_box('custom-datetime-metabox', 'Custom Reschedule', 'show_custom_datetime_field', 'post', 'side', 'default');
}
add_action('add_meta_boxes', 'add_custom_datetime_field');

function show_custom_datetime_field($post)
{
    wp_nonce_field('custom_datetime_nonce', 'custom_datetime_nonce');
    $custom_datetime = get_post_meta($post->ID, '_custom_reschedule_datetime', true);
?>
    <input type="datetime-local" id="custom_reschedule_datetime" name="custom_reschedule_datetime" value="<?php echo esc_attr($custom_datetime); ?>">
<?php
}

function save_custom_reschedule_datetime($post_id)
{

    if (!isset($_POST['custom_datetime_nonce']) || !wp_verify_nonce($_POST['custom_datetime_nonce'], 'custom_datetime_nonce'))
        return $post_id;

    if (isset($_POST['custom_reschedule_datetime'])) {
        $custom_datetime = sanitize_text_field($_POST['custom_reschedule_datetime']);
        update_post_meta($post_id, '_custom_reschedule_datetime', $custom_datetime);
    }
}
add_action('save_post', 'save_custom_reschedule_datetime');




add_filter('cron_schedules', 'custom_cron_schedules');
function custom_cron_schedules($schedules)
{
    $schedules['everyminute'] = array(
        'interval' => 60,
        'display' => __('Every 1 minute')
    );
    return $schedules;
}

add_action('custom_reschedule_posts', 'custom_reschedule_posts');
if (!wp_next_scheduled('custom_reschedule_posts')) {
    wp_schedule_event(time(), 'everyminute', 'custom_reschedule_posts');
}

function custom_reschedule_posts()
{

    $args = array(
        'post_type' => 'post',
        'meta_key' => '_custom_reschedule_datetime',
        'post_status' => 'publish',
        'posts_per_page' => -1,
    );

    $reschedule_query = new WP_Query($args);

    while ($reschedule_query->have_posts()) {
        $reschedule_query->the_post();
        $post_id = get_the_ID();
        $custom_datetime = get_post_meta($post_id, '_custom_reschedule_datetime', true);
        $custom_datetime_timestamp = strtotime($custom_datetime);
        if ($custom_datetime_timestamp <= current_time('timestamp')) {
            $post_date = date('Y-m-d H:i:s', $custom_datetime_timestamp);
            wp_update_post(array(
                'ID' => $post_id,
                'post_date' => $post_date,
                'post_status' => 'publish'
            ));
        }
    }
    wp_reset_postdata();
}
