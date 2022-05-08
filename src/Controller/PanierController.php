<?php

namespace App\Controller;
use Stripe\Stripe;
use App\Repository\ProductsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Stripe\Checkout\Session;


class PanierController extends AbstractController
{

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/cart", name="cart")
     */
    public function index(SessionInterface $session , ProductsRepository $ProductRepository)
    {
        //recupere le panier actuel
        $pannier = $session->get('pannier', []);
        $pannierxithData = [];
        foreach ($pannier as $id => $quantity) {
            $pannierxithData[] = [
                'produit' => $ProductRepository->find($id),
                'quantity' => $quantity,
            ];
        }
        //get full cart  total
        //dd('total', $pannierxithData);
        $total =0;
        foreach($pannierxithData as $item) {
            $totalItem = $item['produit']->getPrix() * $item['quantity'];
            $total += $totalItem;
        }
        //$items=$paginator->paginate($pannierxithData,$request->query->getInt('page',1),2);
        return $this->render('panier/index.html.twig', [
            'items' => $pannierxithData,
            'total' =>$total,
        ]);
    }
    /**
     * @Route("/cart/add/{id}", name="cart_add")
     */
    public function add($id, SessionInterface $session)
    {
        $pannier = $session->get('pannier', []);

        if (!empty($pannier[$id])) {
            $pannier[$id]++;
        } else {
            $pannier[$id] = 1;
        }
        $session->set('pannier', $pannier);

        return $this->redirectToRoute('cart');

    }

    /*
     * @Route("/cart/remove/{id}", name="cart_remove")
     */
    public function remove($id, SessionInterface $session)
    {
        $pannier = $session->get('pannier', []);
        if (!empty($pannier[$id])) {
            unset($pannier[$id]);
        }
        $session->set('pannier', $pannier);
        return $this->redirectToRoute('cart');
    }


    /**
     * @Route("/cart/remove/", name="cart_remove_all")
     */
    public function removeAll(SessionInterface $session)
    {
        $pannier = $session->get('pannier', []);
        unset($pannier);

        $session->set('pannier', []);
        return $this->redirectToRoute('cart');
    }
    /**
     * @Route("/comm/{total}", name="comm_all")
     */
public function commande (int $total){


    Stripe::setApiKey('sk_test_51KpExdF9iBgMr9KtelIclB86Kdt08yTWbAnfeVekpuYWqmchRZ7vwSO71OnqCIvdDzBV5FCaDLauitKJYIaDGmM000LpTGuwE4');


    $session = Session::create([
        'payment_method_types' => ['card'],
        'line_items'           => [
            [
                'price_data' => [
                    'currency'     => 'ttd',
                    'product_data' => [
                        'name' => 'Subsciption',
                    ],
                    'unit_amount'  =>$total * 100,
                ],
                'quantity'   => 1,
            ]
        ],
        'mode'                 => 'payment',
        'success_url'          => $this->generateUrl('success_url', [], UrlGeneratorInterface::ABSOLUTE_URL),
        'cancel_url'           => $this->generateUrl('cancel_url', [], UrlGeneratorInterface::ABSOLUTE_URL),

    ]);











    /*    $message = (new \Swift_Message('Confirmation dajout devenement'))
            ->setFrom('tnsharedinc@gmail.com')
            ->setTo('mohamedkhalil.chaouch@esprit.tn');

        $mailer->send($message);

    return $this->redirectToRoute('cart');*/

    return $this->redirect($session->url, 303);
}
    /**
     * @Route("/cancel-url", name="cancel_url")
     */
    public function cancelUrl(): Response
    {
        return $this->render('panier/cancel.html.twig', []);
    }


    /**
     * @Route("/success_url", name="success_url")
     */
    public function successUrl(): Response
    {
        return $this->render('panier/success.html.twig', []);
    }

}