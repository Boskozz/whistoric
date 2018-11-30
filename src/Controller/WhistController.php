<?php

namespace App\Controller;

use App\Entity\Carte;
use App\Entity\Partie;
use App\Form\CarteType;
use App\Form\PartieType;
use App\Entity\JoueurLocal;
use App\Entity\ContratConfig;
use App\Form\ContratConfigType;
use App\Repository\CarteRepository;
use App\Repository\PartieRepository;
use App\Repository\ContratConfigRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WhistController extends AbstractController
{
    /**
     * Page d'accueil
     * @Route("/", name="whist_index")
     */
    public function index()
    {
        return $this->render('whist/index.html.twig');
    }

    /**
     * Lance la création de la partie en y renseignant le nom de chaque joueurs et le nombre de carté total
     *
     * @Route("/launch", name="whist_launch")
     * @return Response
     */
    public function launch(Request $request, ObjectManager $manager) 
    {
        $partie = new Partie();

        for ($i=1; $i <5; $i++){
            ${'joueur'.$i} = new JoueurLocal();
            ${'joueur'.$i}->setNom('Joueur '.$i);
            ${'joueur'.$i}->setOrdre($i);
            ${'joueur'.$i}->setScore(0);
            $partie->addJoueur(${'joueur'.$i});
        }

        $form = $this->createForm(PartieType::class, $partie);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            for ($i=1; $i <5; $i++)$manager->persist(${'joueur'.$i});
            $manager->persist($partie);
            $manager->flush();

            $this->addFlash(
                'success',
                "La partie à bien été créée, vous pouvez dès lors commencer ! Bon amusement :) "
            );

            return $this->redirectToRoute('whist_show', [
                'id' => $partie->getId(),
                'start' => 1,
                'carte' => $partie->getTotCarte()
            ]);
        }

        return $this->render('whist/launch.html.twig', [
            'form' => $form->createView()
        ]);
    }
    
    /**
     * Permet d'afficher la partie en cours
     *
     * @Route("/show/{id}", name="whist_show")
     * @return Response
     */
    public function show(Partie $partie, Request $request, ObjectManager $manager, CarteRepository $repo)
    {
        $i;
        $score = 0;
        for ($i = $partie->getTotCarte(); $i >= 1; $i--){
            
            $carte = new Carte();
            $cartes = $repo->findByPartie($partie);
            $form = $this->createForm(CarteType::class, $carte, [
                'partieId' => $partie->getId(),
            ]);
            dump($i);
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                $carte->setFinDate(new \DateTime());
                $carte->setPartie($partie);
                $i = $carte->leBrin($i);
                $pointCarte = $carte->points();
                foreach ($partie->getJoueurs() as $joueur){
                    $joueur->getPointsSuite($pointCarte, $carte);
                }
                $carte->setNumero($i);
                $partie->setTotCarte($i-1);
                if ($partie->getTotCarte() == 1){
                    $partie->setEnCours(false);
                }
                // PrePersist
                $manager->persist($carte);
                $manager->flush();
                
                $this->addFlash(
                    'success',
                    "$i carté(s) restant"
                );
               
            }
            return $this->render('whist/show.html.twig', [
                'partie' => $partie,
                'form'   => $form->createView(),
                'cartes' => $cartes,
                'i' => $i
            ]);
        }
        $cartes = $partie->getCartes();
        return $this->render('whist/show.html.twig', [
            'partie' => $partie,
            'cartes' => $cartes,
            'i' => $i
        ]);

        //$config = $partie->getConfig();
            //dump($carte);

           //die;
            
    }

    /**
     * Affiche les parties en cours
     * @Route("/parties", name="partie_encours")
     *
     * @return void
     */
    public function enCours(PartieRepository $repo){
        $parties = $repo->findAll();
        return $this->render('whist/partie.html.twig', [
            'parties' => $parties
        ]);
    }

    /**
     * Création d'une configuration personnalisée et liste les configs déjà disponibles
     * @Route("/configuration/creation", name="config_create")
     *
     * @return Response
     */
    public function createConfig(Request $request, ObjectManager $manager){
        $config = new ContratConfig();

        $form = $this->createForm(ContratConfigType::class, $config);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($config);
            $manager->flush();
            $this->addFlash(
                'success',
                "Configuration correctement enregistrée !"
            );
            return $this->redirectToRoute('config_show');
        }
        return $this->render('whist/config.html.twig', [
            'form' => $form->createView(),

        ]);
    }

    /**
     * Visualisation des configs disponibles
     * @Route("/configurations", name="config_show")
     * @return Response
     */
    public function showConfig(ContratConfigRepository $repo){
        $configs = $repo->findAll();
        return $this->render('whist/configShow.html.twig', [
            'configs' => $configs
        ]);
    }
}
