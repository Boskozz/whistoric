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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormInterface;
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
     * @IsGranted("ROLE_USER")
     * Lance la création de la partie en y renseignant le nom de chaque joueurs et le nombre de carté total
     *
     * @Route("/lancement-de-la-partie", name="whist_launch")
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
            $partie->setUtilisateur($this->getUser());
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
     * @IsGranted("ROLE_USER")
     * @Route("/la-partie-{id}", name="whist_show")
     * @param Partie $partie
     * @param Request $request
     * @param ObjectManager $manager
     * @param CarteRepository $repo
     * @return Response
     * @throws \Exception
     */
    public function show(Partie $partie, Request $request, ObjectManager $manager, CarteRepository $repo)
    {
        //$i;
        $score = 0;
        for ($i = $partie->getTotCarte(); $i >= 1; $i--){
            
            $carte = new Carte();
            $cartes = $repo->findByPartie($partie);
            $form = $this->createForm(CarteType::class, $carte, [
                'partieId' => $partie->getId(),
            ]);
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid()){
                $test = $this->verifyCarte($carte);
                if ($test == true) {
                    $carte->setFinDate(new \DateTime());
                    $carte->setPartie($partie);
                    $i = $carte->leBrin($i);
                    $pointCarte = $carte->points();
                    foreach ($partie->getJoueurs() as $joueur) {
                        $joueur->getPointsSuite($pointCarte, $carte);
                    }
                    $carte->setNumero($i);
                    $partie->setTotCarte($i - 1);
                    if ($partie->getTotCarte() == 1) {
                        $partie->setEnCours(false);
                    }
                    // PrePersist
                    $tot = $partie->getTotCarte();
                    $manager->persist($carte);
                    $manager->flush();

                    $this->addFlash(
                        'success',
                        "$tot carté(s) restant"
                    );
                } else {
                    $form->get('contrat')->addError(new FormError("Les informations transmisent ne sont pas correctes !"));
                }
               
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
    }

    /**
     * Permet de vérifier le carte à valider - renvoie true si valide
     * @param $carte
     * @return bool
     */
    private function verifyCarte(Carte $carte) {
        if ($carte->getContrat() == null) {
            return false;
        }
        $contrat = explode("_", $carte->getContrat())[0];
        $pli = explode("_", $carte->getContrat())[1];
        $nbPartants = 0;
        $accompagne = $carte->getAccompagne();
        foreach ($carte->getPartants() as $partant){
            $nbPartants += 1;
        }
        //dump($nbPartants, $contrat, $accompagne);
        if ($nbPartants == 2 and $accompagne == false){
            if ($contrat == "emb" or $contrat == "capot" or $contrat == "trou") {
                return true;
            }
            return false;
        } elseif ($nbPartants == 2 and $accompagne == true) {
            if ($contrat == "picoli" or $contrat == "picolo" or $contrat == "pmis") {
                return true;
            }
            return false;
        } elseif ($nbPartants == 1 and $accompagne == false) {
            if ($contrat == "solo" or $contrat == "abon" or $contrat == "abonst") {
                return true;
            }
            if ($contrat == "picoli" or $contrat == "picolo" or $contrat == "pmis") {
                return true;
            }
            if ($contrat == "ptsm" or $contrat == "gdsm" or $contrat == "gm") {
                return true;
            }
            return false;
        } else {
            return false;
        }
        //return false;
    }

    /**
     * @IsGranted("ROLE_USER")
     * Affiche la liste des parties de l'utilisateur en cours et terminée
     * @Route("/parties", name="partie_encours")
     * PartieRepository $repo
     * @return Response
     */
    public function enCours(){
        $user = $this->getUser();
        $parties = $user->getParties();
        return $this->render('whist/partie.html.twig', [
            'parties' => $parties
        ]);
    }

    /**
     * Création d'une configuration personnalisée et liste les configs déjà disponibles
     * @Route("/configurations/creation", name="config_create")
     * @IsGranted("ROLE_USER")
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
     * @IsGranted("ROLE_USER")
     * @return Response
     */
    public function showConfig(ContratConfigRepository $repo){
        $configs = $repo->findAll();
        return $this->render('whist/configShow.html.twig', [
            'configs' => $configs
        ]);
    }
}
