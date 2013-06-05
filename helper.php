<?php

    class blockinfoHelper
    {
        private static $p_instance;
        private static $options;

        private function __construct() {}

        public static function getInstance()
        {
            if(!self::$p_instance)
            {
                self::$p_instance = new blockinfoHelper();
            }

            return self::$p_instance;
        }

        private static function getOverride($option, $obj)
        {
            if(isset(static::$options[$option]))
                return static::$options[$option];
            else
                return $obj->getConf($option);
        }

        public function setOption($key, $value)
        {
            static::$options[$key] = $value;
        }

        public function getOption($key)
        {
            return static::$options[$key];
        }


        public function parseOutput($string, $type, $obj)
        {
            $do_formatting  = true;

            $uppercase_mode = self::getOverride($type.'_uppercase', $obj);
            $parse          = self::getOverride($type.'_parse', $obj);

            $output         = '';

            if($parse)
            {
                $string = p_render('xhtml',p_get_instructions($string),$info);

                if(!(self::getOverride($type.'_format_force', $obj)))
                    $do_formatting = false;
            }

            if($do_formatting)
            {
                //Strip all HTML from output
                $string = trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($string))))));

                $words = explode(' ', $string);

                foreach($words as $key => $word)
                {
                    switch($uppercase_mode)
                    {
                        case 'first':
                            if($key == 0) $word = ucfirst(strtolower($word));
                            break;

                        case 'words':
                            $word = ucfirst(strtolower($word));
                            break;

                        case 'all':
                            $word = strtoupper($word);
                            break;
                    }

                    $output .= $word.' ';
                }
            }
            else
            {
                $output = $string;
            }

            return trim($output);
        }
    }

?>