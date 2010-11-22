<?php
/*
Plugin Name: TinyMCE Preformatted
Plugin URI: http://firegoby.theta.ne.jp/wp/mce_preformatted
Description: Insert preformatted source.
Author: Takayuki Miyauchi
Version: 0.1
Author URI: http://firegoby.theta.ne.jp/
*/

/*
Copyright (c) 2010 Takayuki Miyauchi (THETA NETWORKS Co,.Ltd).

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/

define('TINYMCE_PREFORMATTED_PLUGIN_URL', WP_PLUGIN_URL.'/'.dirname(plugin_basename(__FILE__)));

require_once(dirname(__FILE__).'/mceplugins.class.php');
new mcePreformatted();

class mcePreformatted{

function __construct()
{
    $path = '/mce_plugins/plugins/preformatted';
    new mcePlugins(
        'preformatted',
        TINYMCE_PREFORMATTED_PLUGIN_URL.'/mce_plugins/plugins/preformatted/editor_plugin.js',
        dirname(__FILE__).'/mce_plugins/plugins/preformatted/langs/langs.php',
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
