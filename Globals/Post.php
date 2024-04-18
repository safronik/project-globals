<?php

namespace Safronik\Globals;

/**
 * Post
 *
 * Usage:
 *   - $post_param = Post::get('post_param_name');
 *
 * @author  Roman safronov
 * @version 1.0.0
 */
class Post extends Variables{
	
	protected function getVariable( $name ): mixed
    {
		if ( function_exists('filter_input') ) {
            $value = filter_input(INPUT_POST, $name);
        }

        if ( empty($value) ) {
            $value = $_POST[ $name ] ?? '';
        }

        return $value;
	}
    
    protected function getAllVariablesNames(): array
    {
        return array_keys( $_POST );
    }

}