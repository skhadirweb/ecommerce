<?php

namespace App\Controller;

use App\Classes\Search;
use App\Entity\Card;
use App\Entity\Product;
use App\Form\CardType;
use App\Form\SearchType;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/nos-produits", name="products")
     */
    public function index(Request $request): Response
    {
        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $products = $this->entityManager->getRepository(Product::class)->findWithSearch($search);
        } else {
            $products = $this->entityManager->getRepository(Product::class)->findAll();
        }

        return $this->render('product/index.html.twig', [
            'products' => $products,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/produit/{slug}", name="product")
     */
    public function show($slug, Request $request, FileUploader $fileUploader)
    {

        $product = $this->entityManager->getRepository(Product::class)->findOneBySlug($slug);

        $card = new Card();
        $form = $this->createForm(CardType::class, $card);
        $form->handleRequest($request);

        if(!$product) {
            return $this->redirectToRoute('products');
        }

        if ($form->isSubmitted() && $form->isValid()) {

            $date = new \DateTime();

            $card = $form->getData();
            $image = $form['image']->getData();
            $imageFilename = $fileUploader->upload($image);
            $card->setImage($imageFilename);
            $card->setCardRef($date->format('dmY').'-'.uniqid());
            $this->entityManager->persist($card);
            $this->entityManager->flush();

            return $this->redirectToRoute('add_to_cart', ['id'=>$product->getId()]);
        }


        return $this->render('product/show.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }
}
