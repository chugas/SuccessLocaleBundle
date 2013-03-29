<?php

namespace Success\LocaleBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;

class LocaleExtension extends \Twig_Extension {

  /**
   *  @var  $pagebar
   */
  protected $container;

  public function __construct(ContainerInterface $container) {
    $this->container = $container;
  }

  /**
   *  @return array
   *  @see \Twig_Extension
   */
  public function getFunctions() {
    return array(
        'selector_locales_render' => new \Twig_Function_Method($this, 'render', array('is_safe' => array('html')))
    );
  }

  public function render($view = null) {
    $view = (!is_null($view)) ? $view : 'LocaleBundle:Locale:selector_locale_render.html.twig';
    $options = array();
    return $this->container->get('templating')->render($view, $options);
  }

  /**
   *  @return string
   */
  public function getName() {
    return 'selector_locale_extension';
  }

}

