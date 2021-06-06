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
    public function index(
        Request $request,
        CategoryRepository $categoryRepository,
        SubCategoryRepository $subCategoryRepository,
        SubSubCategoryRepository $subSubCategoryRepository
        ): Response {
        
        $category = array();
        $subCategory = array();
        $subSubCategory = array();
        $error = '';

        $categoryForm = $this->createFormBuilder()
            ->add('category', TextType::class,  ['label' => 'Famille', 'required' => false])
            ->add('subCategory', TextType::class,  ['label' => 'Sous Famille', 'required' => false])
            ->add('subSubCategory', TextType::class,  ['label' => 'Sous Sous Famille', 'required' => false])
            ->add('submit', SubmitType::class)
            ->getForm();

        $categoryForm->handleRequest($request);

        if ($categoryForm->isSubmitted() && $categoryForm->isValid()) {
            $inputCategory =str_replace('?', 'e', mb_convert_encoding(strtolower($categoryForm->getData()['category']), "utf8"));
            $inputSubCategory =str_replace('?', 'e', mb_convert_encoding(strtolower($categoryForm->getData()['subCategory']), "utf8"));
            $inputSubSubCategory =str_replace('?', 'e', mb_convert_encoding(strtolower($categoryForm->getData()['subSubCategory']), "utf8"));

            $category = $categoryRepository->findBy(
                ['name' => $inputCategory],
            );
            $subCategory = $subCategoryRepository->findBy(
                ['name' => $inputSubCategory],
            );
            $subSubCategory = $subSubCategoryRepository->findBy(
                ['name' =>$inputSubSubCategory],
            );

            if (!empty($category)) {
                $subCategory = $subCategoryRepository->findBy(
                    ['category' => $category],
                );

                for($i = 0; $i <= count($subCategory)-1; $i++) {
                    $subSubCategoryAnswer = $subSubCategoryRepository->findBy(
                        ['subCategory' => $subCategory[$i]],
                    );
                    $subSubCategory= array_merge($subSubCategory, $subSubCategoryAnswer);
                    
                }

            } elseif (!empty($subCategory)) {
                $category = $categoryRepository->findBy(
                    ['id' => $subCategory[0]->getCategory()->getId()],
                );

                $subSubCategory = $subSubCategoryRepository->findBy(
                    ['subCategory' => $subCategory],
                );

            } elseif (!empty($subSubCategory)) {
                $subCategory = $subCategoryRepository->findBy(
                    ['id' => $subSubCategory[0]->getSubCategory()->getId()],
                );
                $category = $categoryRepository->findBy(
                    ['id' => $subCategory[0]->getCategory()->getId()],
                );
            } else {
                $error = 'aucune correspondance trouvée';
            }

        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'form' => $categoryForm->CreateView(),
            'categories' =>  $category,
            'subCategories' => $subCategory,
            'subSubCategories' => $subSubCategory,
            'error' => $error,
        ]);
    }
}
