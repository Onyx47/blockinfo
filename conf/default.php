<?php
/**
 * Default settings for the blockinfo plugin
 *
 * @author Bojan Nemcic <bnemcic@gmail.com>
 */

$conf['block_class']            = 'block-info'; // Class name to use for the block info container div
                                                // WARNING: If you change this make sure you edit your CSS files
                                                //          and set the proper class name!

/*
 * FORMATTING OPTIONS
 */
$conf['attr_uppercase']         = 'words';      // Automatically capitalize attribute names
                                                // 'none': no change, leave attribute name as defined in tag
                                                // 'first': capitalize first word, leave the rest as-is
                                                // 'words': capitalize each word
                                                // 'all': all caps

$conf['attr_parse']             = false;        // If true, attributes will be parsed as dokuwiki syntax
$conf['attr_format_force']      = false;        // Force plugin to format attributes
                                                // even if they get parsed as dokuwiki syntax

$conf['value_uppercase']        = 'none';       // Automatically capitalize values
                                                // 'none': no change, leave attribute name as defined in tag
                                                // 'first': capitalize first word, leave the rest as-is
                                                // 'words': capitalize each word
                                                // 'all': all caps
                                                // NOTE: only applicable if value_parse is false
                                                //       or value_format_force is true

$conf['value_parse']            = true;         // If true, values will be parsed as dokuwiki syntax
$conf['value_format_force']     = false;        // Force plugin to format values
                                                // even if they get parsed as dokuwiki syntax

