<?php
/**
 * Plugin blockinfo: Provides syntax to describe a Minecraft block
 *
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Bojan Nemcic <bnemcic@gmail.com>
 */

// must be run within DokuWiki
if(!defined('DOKU_INC')) die();

if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
require_once DOKU_PLUGIN.'syntax.php';

/**
 * All DokuWiki plugins to extend the parser/rendering mechanism
 * need to inherit from this class
 */
class syntax_plugin_blockinfo extends DokuWiki_Syntax_Plugin {

    function getInfo() {
        return array('author' => 'Bojan Nemcic',
                     'email'  => 'bnemcic@gmail.com',
                     'date'   => '2013-05-24',
                     'name'   => 'Block Info',
                     'desc'   => 'Provides syntax to describe a Minecraft block',
                     'url'    => 'https://github.com/Onyx47/blockinfo');
    }

    function getType() { return 'substition'; }
    function getPType() { return 'normal'; }
    function getAllowedTypes() { return array('substition', 'formatting', 'container', 'baseonly'); }
    function getSort() { return 10; }

    function connectTo($mode) { $this->Lexer->addEntryPattern('<blockinfo.*>(?=.*?</blockinfo>)',$mode,'plugin_blockinfo'); }
    function postConnect() { $this->Lexer->addExitPattern('</blockinfo>','plugin_blockinfo'); }

    function handle($match, $state, $pos, &$handler) {
        switch ($state) {
            case DOKU_LEXER_ENTER :

                $lines = preg_split('/\r?\n/', $match);
                $attributes = array();

                foreach ($lines as $line)
                {
                    //Get block name
                    if(preg_match("/<name\s*:\s*(.+)>/i", $line, $matches))
                    {
                        $name = $matches[1];
                    }

                    //Get block image
                    else if(preg_match("/<image\s*:\s*(.+)>/i", $line, $matches))
                    {
                        $image = $matches[1];
                    }

                    //Get attributes
                    else if(preg_match("/<([A-z\s]+)\s*:\s*(.*)>/", $line, $matches))
                    {
                        array_push($attributes, $matches);
                    }
                }

                return array($state, array($name, $image, $attributes));

            case DOKU_LEXER_UNMATCHED :  return array($state, $match);
            case DOKU_LEXER_EXIT :       return array($state, '</div>');
        }
        return array();
    }

    function render($mode, &$renderer, $data)
    {
        if($mode == 'xhtml')
        {
            list($state, $match) = $data;
            switch ($state)
            {
                //Start the info block
                case DOKU_LEXER_ENTER :
                    list($name, $image, $attributes) = $match;

                    $renderer->doc .= '<div class="block-info">';

                    $renderer->doc .= '<table>';
                    $renderer->doc .= '<tbody>';

                    $renderer->doc .= '<tr>';
                    $renderer->doc .= '<th colspan="2">'.$name.'</th>';
                    $renderer->doc .= '</tr>';

                    if($this->getConf('value_parse') == true)
                    {
                        //Render image as a dokuwiki tag
                        $image_val = p_render('xhtml',p_get_instructions($image),$info);
                    }
                    else
                    {
                        $image_val = $image;
                    }

                    $renderer->doc .= '<tr>';
                    $renderer->doc .= '<td colspan="2">';
                    $renderer->doc .= $image_val;
                    $renderer->doc .= '</td>';
                    $renderer->doc .= '</tr>';

                    $attr_uppercase_mode = $this->getConf('attr_uppercase');
                    $value_uppercase_mode = $this->getConf('value_uppercase');

                    foreach($attributes as $attribute)
                    {
                        $renderer->doc .= '<tr>';
                        $renderer->doc .= '<th>';

                        $attr_name = '';

                        $words = explode(' ', trim($attribute[1]));

                        foreach($words as $key => $word)
                        {
                            switch($attr_uppercase_mode)
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

                            $attr_name .= $word.' ';
                        }

                        $attr_name = trim($attr_name);

                        $renderer->doc .= $attr_name;

                        $renderer->doc .= '</th>';
                        $renderer->doc .= '<td>';

                        $value = '';

                        //Allow dokuwiki to parse attribute values
                        if($this->getConf('value_parse') == true)
                        {
                            $value_raw = p_render('xhtml', p_get_instructions($attribute[2]),$info);
                        }
                        else
                        {
                            $value_raw = $attribute[2];
                        }

                        if($this->getConf('value_parse') == false || $this->getConf('value_format_force') == true)
                        {
                            //Strip all HTML from output
                            $value_raw = trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($value_raw))))));

                            $words = explode(' ', strip_tags($value_raw));

                            foreach($words as $key => $word)
                            {
                                switch($value_uppercase_mode)
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

                                $value .= $word.' ';
                            }
                        }
                        else
                        {
                            $value = $value_raw;
                        }

                        $value = trim($value);

                        $renderer->doc .= $value;
                        $renderer->doc .= '</td>';
                        $renderer->doc .= '</tr>';
                    }

                    $renderer->doc .= '</tbody>';
                    $renderer->doc .= '</table>';

                break;

                //Print any unmatched content as-is
                case DOKU_LEXER_UNMATCHED :  $renderer->doc .= $renderer->_xmlEntities($match); break;
                //Close the info block container
                case DOKU_LEXER_EXIT :       $renderer->doc .= "</div>"; break;
            }
            return true;
        }
        return false;
    }
}
