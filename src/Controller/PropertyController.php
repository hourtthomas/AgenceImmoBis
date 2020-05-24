<?php
namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{    
    /**
     * repository
     *
     * @var PropertyRepository
     */
    private $repository;    
    /**
     * em
     *
     * @var ObjectManager
     */
    private $em;

    public function __construct(PropertyRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }


    /**
     * @Route("/biens", name="property.index")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('property/index.html.twig', 
        ['current_menu' => 'properties']);
    }
    
    /**
     * show
     * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
     * @return Response
     */
    public function show(Property $property, string $slug):Response
    {
        if ($property->getSLug() !==$slug){
            return $this->redirectToRoute('property.show',[
                'id' => $property->getId(),
                'slug'=>$property->getSLug()
            ], 301);
        }
        return $this->render('property/show.html.twig', [
            'property'=>$property,
            'current_menu' => 'properties'
            ]);
    }



}
