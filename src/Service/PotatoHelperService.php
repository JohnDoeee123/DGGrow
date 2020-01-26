<?php


namespace App\Service;

use Symfony\Component\HttpFoundation\RequestStack;

class PotatoHelperService
{
    protected $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    protected function getCurrentPageName()
    {
        $currentRequest = $this->requestStack->getCurrentRequest();
        return $currentRequest->getPathInfo();
    }

    protected function getFullNameFromSession()
    {
        $session = $this->requestStack->getCurrentRequest()->getSession();
        return $session->get('fullName');
    }

    public function getCurrentPageInfo()
    {
        return [
            'pageName' => $this->getCurrentPageName(),
            'fullName' => $this->getFullNameFromSession()
        ];
    }

    public function loggedInUserExists()
    {
        $session = $this->requestStack->getCurrentRequest()->getSession();
        return $session->get('fullName') ? true : false;
    }
}