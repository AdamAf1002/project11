<?php 
namespace App\EventListener;
use App\Service\LastVisitedPageService;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Http\Event\LogoutEvent;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class SessionListener
{
    private $session;
    private $flashBag;
    private $lastVisitedPageService;

    public function __construct(LastVisitedPageService $lastVisitedPageService,SessionInterface $session, FlashBagInterface $flashBag)
    {
        $this->session = $session;
        $this->flashBag = $flashBag;
        $this->lastVisitedPageService = $lastVisitedPageService;
    }

    public function onLogout(LogoutEvent $event)
    {
        // Récupérer l'URL de la dernière page visitée avant la déconnexion
        $referer = $event->getRequest()->headers->get('referer');

        // Stocker l'URL de la dernière page visitée dans la session flash
        if (!empty($referer)) {
            $this->flashBag->add('lastVisitedPage', $referer);
        }

        // Rediriger vers la page de login
        $event->setResponse(new RedirectResponse('/login'));
    }
}



?>