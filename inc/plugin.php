<?php

namespace Saiful_Islam_Addon\addon;

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}

final class Register_Elementor_Addon
{
  private static $_instance = null;

  public function __construct()
  {
  }

  public static function get_instance()
  {
    if (null === self::$_instance) {
      self::$_instance = new Self();
    }
    return self::$_instance;
  }
}
