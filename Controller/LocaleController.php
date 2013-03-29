<?php

namespace Success\LocaleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LocaleController extends Controller {

  protected $useReferrer = true;

  protected $redirectToRoute = null;

  protected $redirectToUrl;  
  
  public function switchLanguageAction($_locale) {
    $request = $this->getRequest();

    $this->redirectToUrl = '/';

    // Redirect the User
    if ($request->headers->has('referer') && true === $this->useReferrer) {
      return new RedirectResponse($request->headers->get('referer'));
    }

    if (null !== $this->redirectToRoute) {
      return new RedirectResponse($this->container->get('router')->generate($this->redirectToRoute));
    }

    return new RedirectResponse($request->getScheme() . '://' . $request->getHttpHost() . $this->redirectToUrl);
  }

}