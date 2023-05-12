<?php 


namespace App\Service;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class LastVisitedPageService
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public function setLastVisitedPage($route)
    {
        $this->session->set('last_visited_page', $route);
    }

    public function getLastVisitedPage()
    {
        return $this->session->get('last_visited_page');
    }
}












?>