<?php

class Iugu_Withdraw extends APIResource
{
    public static function create($attributes = [])
    {
        return self::createAPI($attributes);
    }
    
    public static function fetch($key)
    {
        return self::fetchAPI($key);
    }
    
    public function withdraw()
    {
        if ($this->is_new()) {
            return false;
        }
        
        try {
            $response = self::API()->request(
                'PUT',
                static::url($this).'/request_withdraw'
            );
            if (isset($response->errors)) {
                throw new IuguRequestException($response->errors);
            }
            $new_object = self::createFromResponse($response);
            $this->copy($new_object);
            $this->resetStates();
        } catch (Exception $e) {
            return false;
        }
        
        return true;
    }
}
