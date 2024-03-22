<?php
/*
* Plugin Name: Saiful Islam Addon
* Description: This is custom elementor addon made by Saiful Islam.
* Plugin URI: https://example.com
* Version: 1.0.0
* Require At Least: 5.2
* Requires PHP: 7.2
* License: GPL v2 or later
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
* Author: Saiful Islam
* Author URI: https://portfolio-saiful7778.vercel.app
* Text Domain: saisad
* Requires Plugins: elementor
* Elementor tested up to: 3.20.1
* Elementor Pro tested up to: 3.20.0
*/

/**
 * Main plugin namespace
 */

namespace Saiful_Islam_Addon;

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}

final class SaifulIslamAddon
{
  private static $_instance = null;

  public function __construct()
  {
    add_action("init", [$this, "i18n"]);
  }

  public function i18n()
  {
    load_plugin_textdomain("saisad");
  }

  public static function get_instance()
  {
    if (null === self::$_instance) {
      self::$_instance = new Self();
    }
    return self::$_instance;
  }
}

SaifulIslamAddon::get_instance();
