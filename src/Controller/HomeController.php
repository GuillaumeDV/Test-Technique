<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\SubCategory;
use App\Entity\SubSubCategory;

use App\Repository\CategoryRepository;
use App\Repository\SubCategoryRepository;
use App\Repository\SubSubCategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request, CategoryRepository $categoryRepository, SubCategoryRepository $subCategoryRepository, SubSubCategoryRepository $subSubCategoryRepository): Response
    {
        $categoryForm = $this->createFormBuilder()
            ->add('name', TextType::class,  ['label' => 'Famille'])
            ->add('submit', SubmitType::class)
            ->getForm();

        $subCategoryForm = $this->createFormBuilder()
            ->add('name', TextType::class,  ['label' => 'Sous Famille'])
            ->add('submit', SubmitType::class)
            ->getForm();
        
        $categoryForm->handleRequest($request);
        if ($categoryForm->isSubmitted() && $categoryForm->isValid()) {
            // $form->getData() holds the submitted values
            $inputCategory =str_replace(' ', '', strtolower($categoryForm->getData()['name']));
            //dump($value['name']);
            $category = $categoryRepository->findBy(
                ['name' => $inputCategory],
            );
            $subCategoryAnswer = $subCategoryRepository->findBy(
                ['category' => $category],
            );
            $subSubCategory = [];
            for($i = 0; $i <= count($subCategoryAnswer)-1; $i++) {
                //dump($subCategoryAnswer[$i]);
                $subSubCategoryAnswer = $subSubCategoryRepository->findBy(
                    ['subCategory' => $subCategoryAnswer[$i]],
                );
                $subSubCategory= array_merge($subSubCategory, $subSubCategoryAnswer);
                
            }
            
        }
        $subCategoryForm->handleRequest($request);
        if ($subCategoryForm->isSubmitted() && $subCategoryForm->isValid()) {
            // $form->getData() holds the submitted values
            $inputSubcategory =str_replace(' ', '', strtolower($subCategoryForm->getData()['name']));
            //dump($value['name']);
            $subCategory = $subCategoryRepository->findBy(
                ['name' => $inputSubcategory],
            );
            dump($subCategory);
            $subCategoryAnswer = $subCategoryRepository->findBy(
                ['category' => $category],
            );
            $subSubCategory = [];
            for($i = 0; $i <= count($subCategoryAnswer)-1; $i++) {
                //dump($subCategoryAnswer[$i]);
                $subSubCategoryAnswer = $subSubCategoryRepository->findBy(
                    ['subCategory' => $subCategoryAnswer[$i]],
                );
               $subSubCategory= array_merge($subSubCategory, $subSubCategoryAnswer);

            }
        }
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($task);
            // $entityManager->flush();

            //return $this->redirectToRoute('task_success');
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'categoryForm' => $categoryForm->CreateView(),
            'subCategoryForm' => $subCategoryForm->CreateView(),
            'categories' =>  $category,
            'subCategories' => $subCategoryAnswer,
            'subSubCategories' => $subSubCategory,
        ]);
    }
}
