<?php

namespace App\Controller;

use App\Entity\Jogo;
use App\Entity\VideoGame;
use App\Form\Type\JogoType;
use App\Form\Type\VideoGameType;
use App\Repository\JogoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\VideoGameRepository;
/**
 * @Route("/videoGame", name="video_game")
 */

class VideoGameController extends AbstractController
{
    /**
     * @Route("/createvideogame", name="_createvideogame", methods={"GET", "POST"})
     */
    public function createvideogame(Request $request, VideoGameRepository  $videoGameRepository)
    {
        // just set up a fresh $task object (remove the example data)
        $videoGame = new VideoGame();

        $form = $this->createForm(VideoGameType::class, $videoGame);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $videoGame = $form->getData();
            $videoGameRepository->persist($videoGame);
            return $this->redirectToRoute('video_game_show');
        }



        return $this->render("paginagame.html.twig", ['abacaxi'=>$form->createView()]);
    }

    /**
     * @Route("/createjogo", name="_createjogo", methods={"GET", "POST"})
     */
    public function createjogo(Request $request, JogoRepository $jogoRepository)
    {
        // just set up a fresh $task object (remove the example data)
        $jogo = new Jogo();

        $form = $this->createForm(JogoType::class, $jogo);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $jogo = $form->getData();
            $jogoRepository->persist($jogo);
            return $this->redirectToRoute('video_game_show');
        }



        return $this->render("paginagame.html.twig", ['abacaxi'=>$form->createView()]);
    }
    /**
     * @Route("/show", name="_show", methods={"GET", "POST"})
     */
    public function showPagina(Request $request, VideoGameRepository $videoGameRepository, JogoRepository  $jogoRepository)

    {
        $videoGames = $videoGameRepository->findAll();

        return $this->render('show.html.twig',['videogames'=>$videoGames]);
    }


    /**
     * @Route("/", name="_get_all", methods={"GET"})
     */
    public function index(VideoGameRepository $gameRepository): JsonResponse
    {
        return $this->json($gameRepository->findAll());
    }


}
