<?php
/**
 * Default settings for the blockinfo plugin
 *
 * @author Bojan Nemcic <bnemcic@gmail.com>
 */

$conf['attr_uppercase']     = 'words';  // Automatically capitalize attribute names
                                        // 'none': no change, leave attribute name as defined in tag
                                        // 'first': capitalize first word, leave the rest as-is
                                        // 'words': capitalize each word
                                        // 'all': all caps

$conf['value_uppercase']    = 'none';   // Automatically capitalize values
                                        // 'none': no change, leave attribute name as defined in tag
                                        // 'first': capitalize first word, leave the rest as-is
                                        // 'words': capitalize each word
                                        // 'all': all caps
                                        // NOTE: only applicable if value_parse is false
                                        //       or value_format_force is true

$conf['value_parse']        = true;     // If true, values will be parsed as dokuwiki syntax

$conf['value_format_force'] = false;    // Force plugin to format values
                                        // even if they get parsed as dokuwiki syntax

