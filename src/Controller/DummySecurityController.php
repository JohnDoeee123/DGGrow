<?php


namespace App\Controller;


use App\Service\PotatoHelperService;
use  Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class DummySecurityController extends AbstractController
{
    private $potatoHelper;
    private $session;

    public function __construct(SessionInterface $session, PotatoHelperService $potatoHelper)
    {
        $this->potatoHelper = $potatoHelper;
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
        if ($this->potatoHelper->loggedInUserExists()) {
            return $this->redirectToRoute('productDashboard');
        }
        return $this->render('security/login.html.twig');
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

            return $this->redirectToRoute('productDashboard');
        } else {
            return $this->render('security/login.html.twig', ['failedLogin' => 'true']);
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
        return $this->render('logout.html.twig');
    }

}