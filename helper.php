<?php

    class blockinfoHelper
    {
        private static $initialized = false;

        private static function initialize()
        {
            if (self::$initialized)
                return;

            self::$initialized = true;
        }

        public static function parseOutput($string, $type, $obj)
        {
            self::initialize();

            $do_formatting  = true;
            $uppercase_mode = $obj->getConf($type.'_uppercase');
            $output         = '';

            if($obj->getConf($type.'_parse') == true)
            {
                $string = p_render('xhtml',p_get_instructions($string),$info);

                if($obj->getConf($type.'_format_force') == false)
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