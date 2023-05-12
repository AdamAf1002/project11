<?php
  namespace App\EventListener;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use App\Service\LastVisitedPageService;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBag;
use Symfony\Component\HttpFoundation\Session\Session;

class SecurityListener
{
    private $router;
    private $flashBag;

    public function __construct(RouterInterface $router, FlashBag $flashBag)
    {
        $this->router = $router;
        $this->flashBag = $flashBag;
    }

    public function onAuthenticationSuccess(InteractiveLoginEvent $event)
    {
        // Récupérer l'URL de la dernière page visitée avant l'expiration de la session
        $lastVisitedPage = $this->flashBag->get('lastVisitedPage');

        if (!empty($lastVisitedPage)) {
            // Rediriger vers la dernière page visitée avant l'expiration de la session
            return new RedirectResponse($lastVisitedPage[0]);
        } else {
            // Rediriger vers la page d'accueil par défaut
            return new RedirectResponse($this->router->generate('homepage'));
        }
    }
}












?>