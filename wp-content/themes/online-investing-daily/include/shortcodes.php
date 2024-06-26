<?php

/**
 * Retrieves and displays the current price and icon of a cryptocurrency.
 *
 * @param array $atts Shortcode attributes
 * @return string Output HTML
 */
function get_crypto_price($atts) {
    $atts = shortcode_atts(array(
        'symbol' => 'bitcoin',
    ), $atts, 'crypto_price');

    $symbol = $atts['symbol'];

    $responce = wp_remote_get("https://api.coingecko.com/api/v3/coins/$symbol");

    if (is_wp_error($responce)) {
        // $error_message = $responce->get_error_message();
        echo "<div>Unable to retrieve the cryptocurrency price at this moment. The maximum number of requests per minute has been reached.</div>";
    }

    $data = json_decode(wp_remote_retrieve_body($responce), true);
    $priceUsd = $data['market_data']['current_price']['usd'] ?? '';
    $iconUrl = isset($data['image']['large']) ? $data['image']['large'] : '';

    $output = '<div class="crypto-price">';
    $output .= '<img src="' . esc_url($iconUrl) . '" alt="' . esc_attr($symbol) . ' icon" style="width:20px; height:20px;"> ';
    $output .= '<span>' . ucfirst(esc_html($symbol)) . ': $' . esc_html($priceUsd) . '</span>';
    $output .= '</div>';

    return $output;
}
add_shortcode('crypto_price', 'get_crypto_price');
