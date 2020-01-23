<?php


namespace App\Controller;


use  Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class DummySecurityController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * @Route(
     *     name="login",
     *     path="/login",
     *     methods={"GET"},
     * )
     */
    public function login()
    {
        return $this->render('security/login.html.twig', []);
    }


    /**
     * @Route(
     *     name="submitLogin",
     *     path="/submitLogin",
     *     methods={"POST"},
     * )
     */
    public function submitLoginCredentials(Request $request)
    {
        $user = $request->get('username');
        $pass = $request->get('password');

        //check credentials
        if ($user == 'test@test.com' && $pass == 'test') {

            $this->session->set('username', 'Test');
            $this->session->set('email', $user);
            $this->session->set('fullName', 'Johnny Baloney');

//            die($this->session->get('username'));

            return $this->render('dashboard.html.twig', [
                'pageName' => 'Dashboard',
                'fullName' => $this->session->get('fullName')
            ]);
//            return $this->render('dashboard.html.twig', []);


        } else {
            return $this->render('security/login.html.twig');
        }
    }

    /**
     * @Route(
     *     name="logout",
     *     path="/logout",
     *     methods={"GET"},
     * )
     */
    public function logout()
    {
        $this->session->clear();
        return $this->render('base.html.twig');
    }

}