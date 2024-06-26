<?php

/**
 * Handle actions after saving data in Contact Form 7.
 *
 * @param int $insertId The ID of the saved form entry.
 */
function wpc_cfdb7_after_save_data($insertId) {
    global $wpdb;
    
    $formData = $wpdb->get_row( $wpdb->prepare(
        "SELECT * FROM " . $wpdb->prefix . "db7_forms WHERE form_id = %d",
        $insertId
    ) );
    
    if ( !$formData ) {
        return;
    }
    
    $subscriptionFormId = get_option( 'wpc_subscription_form_id', 0 );
    $formId = $formData->form_post_id; 
    if($subscriptionFormId !== $formId) {
        return;
    }

    $data = unserialize($formData->form_value);
    $email = $data['your-email'];
    
    $confirmationLink = get_option('home').'/?confirmation_hash=' . $insertId;

    $subject = 'Email Confirmation';
    $message = 'Thank you for subscribing. Please confirm your email by clicking the link: <a href="' . $confirmationLink.'">click here</a>';
    $headers = array('Content-Type: text/html; charset=UTF-8');
    wp_mail( $email, $subject, $message, $headers );
}
add_action('cfdb7_after_save_data', 'wpc_cfdb7_after_save_data');

/**
 * Handle email confirmation.
 */
function wpc_handle_email_confirmation() {
    if (!isset($_GET['confirmation_hash'])) {
        return;
    }

    $confirmationHash = absint($_GET['confirmation_hash']);
    global $wpdb;

    $formData = $wpdb->get_row( $wpdb->prepare(
        "SELECT * FROM " . $wpdb->prefix . "db7_forms WHERE form_id = %d",
        $confirmationHash
    ) );

    if (!$formData) {
        echo 'Invalid confirmation link.';
        exit;
    }

    $data = unserialize($formData->form_value);
    $data['email_confirmed'] = true;
    $updatedFormValue = serialize($data);

    $wpdb->update(
        $wpdb->prefix . "db7_forms",
        array('form_value' => $updatedFormValue),
        array('form_id' => $confirmationHash),
        array('%s'),
        array('%d')
    );

    echo 'Email confirmed successfully.';
    exit;
}
add_action('init', 'wpc_handle_email_confirmation');