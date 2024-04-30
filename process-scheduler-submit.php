<?php 


        // Sanitize and validate form data
        $date  = sanitize_text_field($_POST['ms_date']);
        $time  = sanitize_text_field($_POST['ms_time']);
        $name  = sanitize_text_field($_POST['ms_name']);
        $notes = sanitize_textarea_field($_POST['ms_notes']);

        // Create custom post type 'appointment'
        $post_id = wp_insert_post(array(
            'post_title'   => $name,
            'post_content' => $notes,
            'post_status'  => 'publish',
            'post_type'    => 'appointment'
        ));

        // Add custom fields (meta data)
        if (!is_wp_error($post_id)) {
            update_post_meta($post_id, 'appointment_date', $date);
            update_post_meta($post_id, 'appointment_time', $time);
        }

        // Return response
        if (!is_wp_error($post_id)) {
            header('Location: '.$_SERVER['REQUEST_URI'].'?appointment-saved');
        } else {
            wp_die('Error saving appointment.');
        }
  
        