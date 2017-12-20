<?php

namespace App\Controller;

use App\Form\MappingType;
use App\FormDTO\MappingDTO;
use App\FormDTO\ObjectMappingDTO;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MainController extends Controller
{
    /**
     * @Route("")
     *
     * @param Request $request
     * @return Response
     */
    public function home(Request $request)
    {
        $columns = [
            'First column',
            'Second column',
            'Third column',
            'Fourth column',
            'Fifth column',
        ];

        // Initialize form data.
        $dto = new MappingDTO();
        $dto->contextMapping = [
            new ObjectMappingDTO('First context'),
            new ObjectMappingDTO('Second context', 'Second column'),
            new ObjectMappingDTO('Third context'),
            new ObjectMappingDTO('Fourth context'),
        ];
        $dto->filterMapping = [
            new ObjectMappingDTO('First filter', 'Second column'),
            new ObjectMappingDTO('Second filter', 'Fourth column'),
            new ObjectMappingDTO('Third filter'),
        ];

        $form = $this->createForm(MappingType::class, $dto, [
            'columns' => $columns,
        ]);
        $form->handleRequest($request);
        $form->isSubmitted() && $form->isValid();

        return $this->render('Main/home.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
