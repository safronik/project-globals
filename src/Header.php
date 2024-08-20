<?php

namespace Safronik\Globals;

/**
 * Header
 *
 * Usage:
 *   - $header_content = Header::get('header_name_in_lower_case');
 *
 * @author  Roman safronov
 * @version 1.0.0
 */
class Header extends Variables{
	
	private array $http_headers;
	
	protected function getVariable( $name ): mixed
    {
        if( ! isset( $this->http_headers ) ){
            $this->http_headers = self::getHTTPHeaders();
        }
        
        return $this->http_headers[ strtolower( $name ) ] ?? '';
	}
    
    protected function getAllVariablesNames(): array
    {
        return array_keys( $this->http_headers );
    }
    
    /**
     * Get all $_SERVER variables starts with http_|HTTP_ prefix
     *
     * @return array
     */
	public static function getHTTPHeaders(): array
    {
		$self = self::getInstance();
		if( isset( $self->http_headers ) ){
			return $self->http_headers;
		}
		
		foreach( $_SERVER as $key => $val ){
			if( 0 === stripos( $key, 'http_' ) ){
				$server_key = preg_replace( '/^http_/i', '', $key );
				$key_parts  = explode( '_', $server_key );
				if( strlen( $server_key ) > 2 ){
					foreach( $key_parts as $part_index => $part ){
						if( $part === '' ){
							continue;
						}
						$key_parts[ $part_index ]    = strtolower( $part );
						$key_parts[ $part_index ][0] = strtoupper( $key_parts[ $part_index ][0] );
					}
					$server_key = strtolower( implode( '-', $key_parts ) );
				}
				$self->http_headers[ $server_key ] = $val;
			}
		}
		
		return $self->http_headers;
	}
}