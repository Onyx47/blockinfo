<?php
/**
 * DokuWiki Plugin blockinfo (Syntax Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Bojan Nemcic <bnemcic@gmail.com>
 */

// must be run within Dokuwiki
if (!defined('DOKU_INC')) die();

if (!defined('DOKU_LF')) define('DOKU_LF', "\n");
if (!defined('DOKU_TAB')) define('DOKU_TAB', "\t");
if (!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');

require_once DOKU_PLUGIN.'syntax.php';

class syntax_plugin_blockinfo extends DokuWiki_Syntax_Plugin {
    public function getType() {
        return 'FIXME: container|baseonly|formatting|substition|protected|disabled|paragraphs';
    }

    public function getPType() {
        return 'FIXME: normal|block|stack';
    }

    public function getSort() {
        return FIXME;
    }


    public function connectTo($mode) {
        $this->Lexer->addSpecialPattern('<FIXME>',$mode,'plugin_blockinfo');
//        $this->Lexer->addEntryPattern('<FIXME>',$mode,'plugin_blockinfo');
    }

//    public function postConnect() {
//        $this->Lexer->addExitPattern('</FIXME>','plugin_blockinfo');
//    }

    public function handle($match, $state, $pos, &$handler){
        $data = array();

        return $data;
    }

    public function render($mode, &$renderer, $data) {
        if($mode != 'xhtml') return false;

        return true;
    }
}

// vim:ts=4:sw=4:et:
