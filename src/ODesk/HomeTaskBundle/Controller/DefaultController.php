<?php

namespace ODesk\HomeTaskBundle\Controller;

use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\Constraints as Assert;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $defaultData = array('word' => 'ABCD', 'cels' => 5);
        $form = $this->createFormBuilder($defaultData)
            ->add('word', 'text',  array(
                'label' => 'Word',
                'required' => true,
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\Length(array('min' => 1, 'max' => 100))
                )
            ))
            ->add('cels', 'integer', array(
                'label' => 'Side of matix',
                'precision' => 0,
                'required' => true,
                'constraints' => array(
                    new Assert\NotBlank(),
                    new Assert\Range(array('min' => 1, 'max' => 100))
                )
            ))
            ->add('send', 'submit', array('label' => 'Generate'))
            ->getForm();

        $matrix = false;

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);


            if ($form->isValid()) {
                $data = $form->getData();
                $matrix = $this->get('matrix_util')->genSpiralMatrix($data['word'], $data['cels']);
            }
        }

        return $this->render('ODeskHomeTaskBundle:Default:index.html.twig', array(
            'form' => $form->createView(),
            'matrix' => $matrix
        ));
    }
}
