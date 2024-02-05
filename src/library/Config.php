<?php

namespace App\Library;

class Config
{

    protected $setting_parmas = [];

    public function __construct($setting_parmas)
    {
        $this->setting_parmas = $setting_parmas;
    }

    public function getAll()
    {
        return $this->setting_parmas;
    }

    public function getKey($key)
    {
        return $this->search_key($key, $this->setting_parmas);
    }

    private function search_key($needle, array $haystack)
    {
        if (!is_array($haystack)) return false;

        foreach ($haystack as $key => $value) {
            if ($key == $needle) {
                return $value;
            } else if (is_array($value)) {
                // multi search
                $key_result = $this->search_key($needle, $value);
                if ($key_result !== false) {
                    if ($key_result == $needle) {
                        return $value;
                    }
                    return $key_result;
                }
            }
        }
        return false;
    }
}
