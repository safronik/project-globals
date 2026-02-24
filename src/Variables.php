<?php

namespace Safronik\Globals;

use Safronik\CodePatterns\Generative\MultitonByClassname;

/**
 * Variables
 *
 * Abstract class to get|set globals extends by:
 * - Cookies::class
 * - Get::class
 * - Post::class
 * - Request::class
 * - Server::class
 *
 * Uses Multiton to store once initialized subclass.
 * Stores its condition to hash retrieved data
 *
 * @author  Roman safronov
 * @version 1.0.0
 */
abstract class Variables{
    
    use MultitonByClassname;
 
    protected array $variables;
    
	abstract protected function getVariable( $name ): mixed;
	abstract protected function getAllVariablesNames(): array;
 
	public static function get( $name ): string|array|int
    {
		$self  = static::getInstance();
        $value = $self->recall( $name ) ?? $self->getVariable( $name );
        
        isset( $value ) && $self->rememberVariable( $name, $value );
        
        return $value;
	}
	
    public static function getAllVariables(): array
    {
        $self = static::getInstance();
        
        foreach( $self->getAllVariablesNames() as $variable_name ){
            $self->variables[ $variable_name ] = $self->getVariable( $variable_name );
        }
        
        return $self->variables;
    }
    
	private function recall( $name ): array|string|int|null
    {
		return $this->variables[ static::class ][ $name ] ?? null;
	}
	
	private function rememberVariable( $name, $value ): void
    {
		$this->variables[ static::class ][ $name ] = $value;
	}
}