<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
// On va chercher notre classe Article qui contient les attributs pour notre table article
use App\Entity\Article;

class BlogController extends Controller {

    // @Route("réécriture d'url")
    // name="le nom de ma route" à mettre dans la vue 
    // $this->render('Le nom de ta page')
    //
    /**
     * @Route("/", name="home")
     */
    public function home() {
        return $this->render('blog/home.html.twig', [
                    'controller_name' => 'BlogController',
        ]);
    }

    /**
     * @Route("/Articles", name="articles")
     */
    public function articles() {
        $repo = $this->getDoctrine()->getRepository(Article::class);
        $articles = $repo->findAll();
        return $this->render('blog/article.html.twig', [
                    'controller_name' => 'BlogController',
                    'articles' => $articles,
        ]);
    }

    /**
     * @Route("/Article/{id}", name="showArticle")
     */
    public function showArticle($id) {
        // On va chercher dans notre repertoire (SELECT)
        $repo = $this->getDoctrine()->getRepository(Article::class);
        // // On cherche les id
        $article = $repo->find($id);
        return $this->render('blog/showArticle.html.twig', [
                    'article' => $article
        ]);
    }

    /**
     * @Route("/Creer-un-article", name="createArticle")
     * @Route("/Modifier-un-article{id}", name="updateArticle")
     */
    public function form(Article $article = null, ObjectManager $manager, Request $request) {
        if(!$article){
           $article = new Article(); 
        }
        $form = $this->createFormBuilder($article)
                ->add('title', TextType::class)
                ->add('content', TextareaType::class)
                ->add('image', TextType::class)
                ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if(!$article->getId()){
                $article->setCreatedAt(new \DateTime);
            }
            
            $manager->persist($article);
            $manager->flush();
            
            return $this->redirectToRoute('showArticle', ['id' => $article->getId()]);
        }

        return $this->render('blog/createArticle.html.twig', [
                    'controller_name' => 'BlogController',
                    'formArticle' => $form->createView(),
                    'editMode' => $article->getId() != null
        ]);
    }

}
