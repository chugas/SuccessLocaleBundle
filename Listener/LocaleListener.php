<?php

namespace Success\LocaleBundle\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
//use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class LocaleListener implements EventSubscriberInterface {

  private $defaultLocale;

  public function __construct($defaultLocale) {
    $this->defaultLocale = $defaultLocale;
  }

  public function onKernelRequest(GetResponseEvent $event) {
    $request = $event->getRequest();

    if (!$request->hasPreviousSession()) {
      return;
    }
    
    $locale = $request->attributes->get('_locale');
    if ($locale) {
      $request->getSession()->set('_locale', $locale);
    } else {
      $request->setLocale($request->getSession()->get('_locale', $this->defaultLocale));
    }
  }

  static public function getSubscribedEvents() {
    return array(
        // must be registered before the default Locale listener
        KernelEvents::REQUEST => array(array('onKernelRequest', 17)),
    );
  }

}
