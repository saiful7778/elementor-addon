<?php

namespace Saiful_Islam_Addon\addon;

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}

final class Register_Elementor_Addon
{
  const MINIMUM_ELEMENTOR_VERSION = '3.20.0';
  const MINIMUM_PHP_VERSION = '7.4';
  private static $_instance = null;

  public function __construct()
  {
    if ($this->is_compatible()) {
      add_action('elementor/init', [$this, 'init']);
    }
  }
  public function init()
  {
    // add custom elementor categories
    add_action('elementor/elements/categories_registered', [$this, 'add_elementor_widget_categories']);
  }

  public function add_elementor_widget_categories($elements_manager)
  {
    $elements_manager->add_category(
      'saiful-islam-addon',
      [
        'title' => esc_html__('Saiful Islam Addon', 'saisad'),
        'icon' => 'fa fa-plug',
      ]
    );
  }

  public function is_compatible()
  {
    // Check if Elementor installed and activated
    if (!did_action('elementor/loaded')) {
      add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
      return false;
    }
    // Check for required Elementor version
    if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
      add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
      return false;
    }
    // Check for required PHP version
    if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
      add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
      return false;
    }
    return true;
  }

  // elementor install notice
  public function admin_notice_missing_main_plugin()
  {
    if (isset($_GET['activate'])) unset($_GET['activate']);
    $message = sprintf(
      esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'saisad'),
      '<strong>' . esc_html__('Saiful Islam Addon', 'saisad') . '</strong>',
      '<strong>' . esc_html__('Elementor', 'saisad') . '</strong>'
    );
    printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
  }

  // elementor version notice
  public function admin_notice_minimum_elementor_version()
  {
    if (isset($_GET['activate'])) unset($_GET['activate']);
    $message = sprintf(
      esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'saisad'),
      '<strong>' . esc_html__('Saiful Islam Addon', 'saisad') . '</strong>',
      '<strong>' . esc_html__('Elementor', 'saisad') . '</strong>',
      self::MINIMUM_ELEMENTOR_VERSION
    );
    printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
  }

  // php version notice
  public function admin_notice_minimum_php_version()
  {
    if (isset($_GET['activate'])) unset($_GET['activate']);
    $message = sprintf(
      esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'saisad'),
      '<strong>' . esc_html__('Saiful Islam Addon', 'saisad') . '</strong>',
      '<strong>' . esc_html__('PHP', 'saisad') . '</strong>',
      self::MINIMUM_PHP_VERSION
    );
    printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
  }

  public static function get_instance()
  {
    if (null === self::$_instance) {
      self::$_instance = new Self();
    }
    return self::$_instance;
  }
}
