<?php

namespace Safronik\Globals;

/**
 * Cookies
 *
 * Usage:
 *  - $cookie = Cookie::get('cookie_name');
 *  - Cookie::set('cookie_name', 'cookie_value', 0, '/', 'domain', true, true, 'Lax' );
 *  - Cookie::set('cookie_name', 'cookie_value' );
 *
 * Supports old PHP 5.6 syntax if you want to use it without dependencies
 *
 * @author  Roman safronov
 * @version 1.0.0
 */
final class Cookie extends Variables{
    
	protected function getVariable( $name ): mixed
    {
		if ( function_exists('filter_input') ) {
            $value = filter_input(INPUT_COOKIE, $name);
        }

        if ( empty($value) ) {
            $value = $_COOKIE[ $name ] ?? '';
        }

        return $value;
	}
	
    protected function getAllVariablesNames(): array
    {
        return array_keys( $_COOKIE );
    }
    
    public static function set( $name, $value = '', $expires = 0, $path = '', $domain = '', $secure = null, $httponly = false, $same_site = 'Lax')
    {
	    $secure = ! is_null( $secure )
		    ? $secure
		    : in_array( Server::get( 'HTTPS' ), ['on', '1', true]) || Server::get( 'SERVER_PORT' ) == 443;

        // For PHP 7.3+ and above
	    if ( version_compare( phpversion(), '7.3.0', '>=' ) ) {
            $options = array(
                'expires'  => $expires,
                'path'     => $path,
                'domain'   => $domain,
                'secure'   => $secure,
                'httponly' => $httponly,
                'samesite' => $same_site,
            );
            
            $out = setcookie($name, $value, $options);

        // For PHP 5.6 - 7.2
        } else {
            $out = setcookie($name, $value, $expires, $path, $domain, $secure, $httponly);
        }

        return $out;
    }
}