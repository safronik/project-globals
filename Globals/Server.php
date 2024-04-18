<?php

namespace Safronik\Globals;

/**
 * Server
 *
 * Usage:
 *   - $server_param = Server::get('server_param_name');
 *
 * @author  Roman safronov
 * @version 1.0.0
 */

final class Server extends Variables{
    
    protected function getVariable( $name ): mixed
	{
		if ( function_exists('filter_input') ) {
            $value = filter_input(INPUT_SERVER, $name);
        }

        if ( empty($value) ) {
            $value = $_SERVER[ $name ] ?? '';
        }

        return $value;
	}
    
    protected function getAllVariablesNames(): array
    {
        return array_keys( $_SERVER );
    }
}