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
require_once DOKU_PLUGIN.'blockinfo/helper.php';

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

    function handle($match, $state, $pos, &$handler)
    {
        $helper = blockinfoHelper::getInstance();

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

                    //Get option overrides
                    else if(preg_match("/<_([A-z\s]+)\s*:\s*(.*)>/", $line, $matches))
                    {
                        $helper->setOption($matches[1], $matches[2]);
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
        $helper = blockinfoHelper::getInstance();

        if($mode == 'xhtml')
        {
            list($state, $match) = $data;
            switch ($state)
            {
                //Start the info block
                case DOKU_LEXER_ENTER :
                    list($name, $image, $attributes) = $match;

                    $renderer->doc .= '<div class="block-info">';

                    $renderer->doc .= '<span class="title">'.$name.'</span>';
                    $renderer->doc .= '<span class="block-image">'.$helper->parseOutput($image, 'value', $this).'</span>';

                    $renderer->doc .= '<table>';

                    foreach($attributes as $attribute)
                    {
                        $renderer->doc .= '<tr>';

                        $renderer->doc .= '<th class="attribute" '.$helper->setCellStyling('attr', $this).'>';
                        $renderer->doc .= $helper->parseOutput($attribute[1], 'attr', $this);
                        $renderer->doc .= '</th>';

                        $renderer->doc .= '<td class="value" '.$helper->setCellStyling('value', $this).'>';
                        $renderer->doc .= $helper->parseOutput($attribute[2], 'value', $this);
                        $renderer->doc .= '</td>';

                        $renderer->doc .= '</tr>';
                    }

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
