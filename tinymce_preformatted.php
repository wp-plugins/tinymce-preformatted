<?php
/*
Plugin Name: TinyMCE Preformatted
Plugin URI: http://firegoby.theta.ne.jp/wp/mce_preformatted
Description: Insert preformatted source.
Author: Takayuki Miyauchi
Version: 0.4.0
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

define('TINYMCE_PREFORMATTED_PLUGIN_URL', plugins_url('', __FILE__));

require_once(dirname(__FILE__).'/includes/mceplugins.class.php');
new mcePreformatted();

class mcePreformatted{

function __construct()
{
    if (is_admin()) {
        add_action('admin_head', array($this, 'admin_head'));
        add_action('plugins_loaded', array($this, 'plugins_loaded'));
        add_filter('wp_fullscreen_buttons', array($this, 'wp_fullscreen_buttons'));
    }
}

public function admin_head()
{
    echo '<style type="text/css">';
    printf(
        'span.mce_preformatted{background-image: url(%s) !important; background-position: center center !important;}',
        TINYMCE_PREFORMATTED_PLUGIN_URL.'/mce_plugins/plugins/preformatted/img/icon.png'
    );
    echo '</style>';
}

public function wp_fullscreen_buttons($buttons)
{
    $buttons[] = 'separator';
    $buttons['preformatted'] = array(
        'title' => __('Preformatted'),
        'onclick' => "tinyMCE.execCommand('mcePreformatted');",
        'both' => false
    );
    return $buttons;
}

public function plugins_loaded()
{
    $path = '/mce_plugins/plugins/preformatted';
    new mcePlugins(
        'preformatted',
        TINYMCE_PREFORMATTED_PLUGIN_URL.'/mce_plugins/plugins/preformatted/editor_plugin.js',
        dirname(__FILE__).'/mce_plugins/plugins/preformatted/langs/langs.php',
        array($this, 'add_button'),
        false
    );
}

public function add_button($buttons){
    array_unshift($buttons, '|');
    array_unshift($buttons, 'preformatted');
    return $buttons;
}

}

