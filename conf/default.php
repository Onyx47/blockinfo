<?php
/**
 * Default settings for the blockinfo plugin
 *
 * @author Bojan Nemcic <bnemcic@gmail.com>
 */

/*
 * STYLING OPTIONS
 */

$conf['box_border_width']       = 5;            /* Block info box border width, in pixels*/
$conf['box_sizing_policy']      = 'max-width';  /* Box sizing policy.
                                                        'min-width': set minimum width to the given value
                                                        'max-width': set maximum width to the given value
                                                        'width':     set fixed width to the given value */
$conf['box_size']               = '250';        /* Box width, in pixels */


/* Set any of the following color settings to a valid hex color code
   like #ff0000 (or #f00) OR a valid CSS color name if you want to set a custom color.
   If set to blank or 'inherit' wiki template border styles will be used */

$conf['box_border_color']       = 'inherit';    // Block info box border color
$conf['title_background']       = 'inherit';    // Block info title background color
$conf['title_color']            = 'inherit';    // Block info title text color
$conf['attr_background']        = 'inherit';    // Attribute name background color
$conf['attr_color']             = 'inherit';    // Attribute name text color
$conf['value_background']       = 'inherit';    // Value background color
$conf['value_color']            = 'inherit';    // Value text color
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

