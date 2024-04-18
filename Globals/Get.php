<?php

namespace Safronik\Globals;

/**
 * Get
 *
 * Usage:
 *   - $get_param = Get::get('get_param_name');
 *
 * @author  Roman safronov
 * @version 1.0.0
 */
class Get extends Variables{
	
	protected function getVariable( $name ): mixed
    {
		if ( function_exists('filter_input') ) {
            $value = filter_input(INPUT_GET, $name);
        }

        if ( empty($value) ) {
            $value = $_GET[ $name ] ?? '';
        }

        return $value;
	}
    
    protected function getAllVariablesNames(): array
    {
        return array_keys( $_GET );
    }

}