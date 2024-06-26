<?php

/**
 * Register the custom settings for the General Settings page.
 */
function wpc_register_settings() {
    register_setting( 'general', 'wpc_subscription_form_id', array(
        'type' => 'number',
        'description' => 'Subscription Form ID',
        'sanitize_callback' => 'absint',
        'default' => '',
    ) );

    register_setting( 'general', 'wpc_terms_and_conditions_id', array(
        'type' => 'number',
        'description' => 'Terms and conditions page ID',
        'sanitize_callback' => 'absint',
        'default' => '',
    ) );
}
add_action( 'admin_init', 'wpc_register_settings' );

/**
 * Add a new section to the General Settings page.
 */
function wpc_add_settings_section() {
    add_settings_section(
        'wpc_settings_section',
        'WPC Plugin Settings',
        'wpc_section_callback',
        'general'
    );
}
add_action( 'admin_init', 'wpc_add_settings_section' );

/**
 * Add a new field to the General Settings page.
 */
function wpc_add_settings_field() {
    add_settings_field(
        'wpc_subscription_form_id',
        'Subscription Form ID',
        'wpc_field_callback',
        'general',
        'wpc_settings_section',
        array(
            'label_for' => 'wpc_subscription_form_id',
            'class' => 'wpc-class',
        )
    );

    add_settings_field(
        'wpc_terms_and_conditions_id',
        'Terms and conditions page ID',
        'wpc_terms_callback',
        'general',
        'wpc_settings_section',
        array(
            'label_for' => 'wpc_subscription_form_id',
            'class' => 'wpc-class',
        )
    );
}
add_action( 'admin_init', 'wpc_add_settings_field' );

/**
 * Render the number input field
 *
 * @param array $args
 */
function wpc_field_callback( $args ) {
    $id = get_option( 'wpc_subscription_form_id', 0 );
    echo '<input type="number" id="' . esc_attr( $args['label_for'] ) . '" name="wpc_subscription_form_id" value="' . esc_attr( $id ) . '" />';
}

/**
 * Render the input field for terms and conditions page id
 *
 * @param array $args
 */
function wpc_terms_callback( $args ) {
    $id = get_option( 'wpc_terms_and_conditions_id');
    echo '<input type="number" id="' . esc_attr( $args['label_for'] ) . '" name="wpc_terms_and_conditions_id" value="' . esc_attr( $id ) . '" />';
}


/**
 * Display the section description.
 */
function wpc_section_callback() {
    echo '<p>Additional custom settings</p>';
}
