<?php

// Creating the widget
class ms_widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            // Base ID of your widget
            'ms_widget',

            // Widget name will appear in UI
            __('Scheduled Sessions', 'ms'),

            // Widget description
            [
                'description' => __('This Widget  will display all scheduled sessions', 'ms'),
            ]
        );
    }

    // Creating widget front-end
    public function widget($args, $instance)
    {
        $title = apply_filters('widget_title', $instance['title']);
        $number_of_posts = apply_filters('number_of_posts', $instance['number_of_posts']);
        
        // before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if (!empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        // This is where you run the code and display the output
        echo __('Scheduled Mentoring Sessions', 'ms');
        $posts = get_posts([
            'post_type' => 'appointment',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'orderby' => 'meta_value',
            'order'=>'asc',
            'meta_query' => [
                [
                    'key'   => 'appointment_date',
                    'compare' => '>=',
                    'value'   => date('Y-m-d'),
                ]
            ],
        ]);

        foreach ($posts as $appointment) {
            $ap_date = get_post_meta($appointment->ID, 'appointment_date', true);
            $date = new DateTimeImmutable($ap_date);
            
?>  
            <div class="mentoring-item">
                <h4><?php echo $appointment->post_title ?></h4>
                
                <p>Date: <?php echo $date->format('m/d/Y'). ' ' . get_post_meta($appointment->ID, 'appointment_time', true); ?></p>
                <p>Notes: <?php echo $appointment->post_content ?></p>
            </div>

        <?php
        }
        // echo '<pre>';
        //         var_dump( $posts );

        echo $args['after_widget'];
    }

    // Widget Settings Form
    public function form($instance)
    {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('New title', 'ms');
        }
        if (isset($instance['number_of_posts'])) {
            $number_of_posts = $instance['number_of_posts'];
        } else {
            $number_of_posts = 6;
        }

        // Widget admin form
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>">
                <?php _e('Title:', 'ms'); ?>
            </label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number_of_posts'); ?>">
                <?php _e('Number of posts:', 'ms'); ?>
            </label>
            <input class="widefat" id="<?php echo $this->get_field_id('number_of_posts'); ?>" name="<?php echo $this->get_field_name('number_of_posts'); ?>" type="text" value="<?php echo esc_attr($number_of_posts); ?>" />
        </p>
<?php
    }

    // Updating widget replacing old instances with new
    public function update($new_instance, $old_instance)
    {
        $instance          = [];
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['number_of_posts'] = (!empty($new_instance['number_of_posts'])) ? strip_tags($new_instance['number_of_posts']) : 6;

        return $instance;
    }

    // Class ms_widget ends here
}

// Register and load the widget
function wpb_load_widget()
{
    register_widget('ms_widget');
}

add_action('widgets_init', 'wpb_load_widget');
