<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
// On va chercher notre classe Article qui contient les attributs pour notre table article
use App\Entity\Article;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Permet de créer 10 articles
        for($i = 1; $i <= 10; $i++){
            // On instancie notre classe
            $article = new Article();
            // Puis on insert les données voulu dans nos setter
            $article->setTitle("Titre de l'article numéro $i")
                    ->setContent("<p>Contenu de l'article $i</p>")
                    ->setImage("https://media3.giphy.com/media/26FmQY8bpav0BjiCc/giphy.gif")
                    ->setCreatedAt(new \DateTime());
            // Sauvegarde les données
            $manager->persist($article);
        }
        // Balance la requête SQL dans la base de données (INSERT)
        $manager->flush();
    }
}
