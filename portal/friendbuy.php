/**
 * Gets the PURL from the Friendbuy API.
 *
 * @param string e-mail address
 * @returns object API Response
 */
function friendbuy_get_purl( $email ) {

  // Verify param is actually an e-mail
  if ( ! is_email( $email ) ) {
    error_log( 'friendbuy-api.php: Not a valid e-mail' );
    return;
  }

  $id = 'f54f761c-secret';
  $pass = get_theme_mod( 'friendbuy-secret-key', false );
  if ( ! $pass ) {
    // error_log( 'friendbuy-api.php: No saved API password' );
    // return;
  }

  $data = array(
      'email' => $email,
      'campaign' => array( 'id' => 16175 )
  );

  $args = array(
    'method'  => 'POST',
      'headers'   => array(
        'Content-Type' => 'application/json'
        // 'Authorization' => 'Basic ' . base64_encode( $id . ':' . $pass )
      ),
      'timeout'   => 15,
      'sslverify' => false,
      'body' => json_encode( $data ),
  );

  $fb_api_url = 'https://' . $id . ':' . $pass . '@api.friendbuy.com/v1/referral_codes';

  error_log( $fb_api_url );

  $response = wp_remote_post( $fb_api_url, $args );

  error_log( print_r( $response, true ) );

  return $response;
}