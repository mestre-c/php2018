<?php

namespace App\Controller;

use App\Entity\Solution;
use App\Entity\Story;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CrudController extends Controller {

    /**
     * @return Response
     * @Route("/", name="home", methods={"GET"})
     */
    public function home()
    {
       $stories = $this->getDoctrine()
           ->getRepository(Story::class)
           ->findAll();

       $solutions = $this->getDoctrine()
           ->getRepository(Solution::class)
           ->findAll();
       return $this->render('crud/index.html.twig', [
           'stories' => $stories,
           'solutions' => $solutions,
       ]);
    }

    /**
     * @Route("/stories/save", methods={"GET"})
     */
    public function saveStories()
    {
        $enttityManager = $this->getDoctrine()->getManager();

        $story = new Story();
        $story->setTitle('The lord of the ring');
        $story->setBody('The best adventure story ever written.');

        $enttityManager->persist($story);

        $enttityManager->flush();

        return new Response('Saved a story with the id of ' . $story->getId());
    }

    /**
     * @Route("/solutions/store", methods={"GET"})
     */
    public function storeSolutions()
    {
        $enttityManager = $this->getDoctrine()->getManager();

        $solution = new Solution();
        $solution->setSubject('Increase the sales up to 95%');
        $solution->setContent('We need to hire new employers in order to increase our sales');

        $enttityManager->persist($solution);

        $enttityManager->flush();

        return new Response('Saved a solution with the id of ' . $solution->getId());
    }

    /**
     * @param $id
     * @Route("/story/{id}", name="story_show")
     */
    public function showStory($id)
    {
        $story = $this->getDoctrine()
            ->getRepository(Story::class)
            ->find($id);

        return $this->render('stories/show.html.twig', [
            'story' => $story,
        ]);
    }

    /**
     * @Route("/story/edit/{id}", name="edit_story", methods={"GET", "POST"})
     */
    public function update(Request $request, $id)
    {
        $story = new Story();
        $story = $this->getDoctrine()
            ->getRepository(Story::class)
            ->find($id);


        $form = $this->createFormBuilder($story)
            ->add('title', TextType::class, [
                'attr' => ['class' => 'form-control'],
            ])
            ->add('body', TextareaType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control']
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Update',
                'attr' => ['class' => 'btn btn-primary mt-3']
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->persist($story);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('stories/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @param $id
     * @Route("/solution/{id}", name="solution_show")
     */
    public function showSol($id)
    {
        $solution = $this->getDoctrine()
            ->getRepository(Solution::class)
            ->find($id);

        return $this->render('solutions/show.html.twig', [
            'solution' => $solution,
        ]);
    }

    /**
     * @Route("/stories/delete/{id}", methods={"DELETE"})
     */
    public function delete(Request $request, $id)
    {
        $story = $this->getDoctrine()
            ->getRepository(Story::class)
            ->find($id);

        $entityManager = $this->getDoctrine()
            ->getManager();
        $entityManager->remove($story);
        $entityManager->flush();

        $response = new Response();
        $response->send();
    }

    /**
     * @Route("/stories/new", name="new_story", methods={"GET", "POST"})
     */
    public function newStory(Request $request)
    {
        $story = new Story();

        $form = $this->createFormBuilder($story)
        ->add('title', TextType::class, [
            'attr' => ['class' => 'form-control'],
        ])
        ->add('body', TextareaType::class, [
            'required' => false,
            'attr' => ['class' => 'form-control']
        ])
        ->add('save', SubmitType::class, [
            'label' => 'Create',
            'attr' => ['class' => 'btn btn-primary mt-3']
        ])
        ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $story = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($story);
            $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        return $this->render('stories/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/solutions/new", name="new_solution", methods={"GET", "POST"})
     */
    public function newSolution(Request $request)
    {

    }
}
