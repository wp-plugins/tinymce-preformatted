<?php
/*
Plugin Name: MCE Preformatted
Plugin URI: http://firegoby.theta.ne.jp/wp/mce_preformatted
Description: Insert preformatted source.
Author: Takayuki Miyauchi
Version: 0.1
Author URI: http://firegoby.theta.ne.jp/
*/

require_once(dirname(__FILE__).'/mceplugins.class.php');
new mcePreformatted();

class mcePreformatted{

function __construct()
{
    $path = '/mce_preformatted/mce_plugins/plugins/preformatted';
    new mcePlugins(
        'preformatted',
        WP_PLUGIN_URL.$path.'/editor_plugin.js',
        WP_PLUGIN_DIR.$path.'/langs/langs.php',
        array(&$this, 'addPreformattedButton'),
        false
    );
}

public function addPreformattedButton($buttons){
    array_unshift($buttons, '|');
    array_unshift($buttons, 'preformatted');
    return $buttons;
}

}

?>
