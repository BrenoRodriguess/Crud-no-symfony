<?php

namespace App\Controller;

use App\Entity\VideoGame;
use App\Form\Type\VideoGameType;
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
     * @Route("/pagina", name="_pagina", methods={"GET", "POST"})
     */
    public function pagina(Request $request )
    {
        // just set up a fresh $task object (remove the example data)
        $VideoGame = new VideoGame();

        $form = $this->createForm(VideoGameType::class, $VideoGame);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $VideoGame = $form->getData();
            return $this->redirectToRoute('video_game_show');
        }


        return $this->render("paginagame.html.twig", ['abacaxi'=>$form->createView()]);
    }
    /**
     * @Route("/show", name="_show", methods={"GET", "POST"})
     */
    public function showPagina(Request $request, VideoGameRepository $videoGameRepository)
    {
        $all = $videoGameRepository->findAll();


        return $this->render('show.html.twig',['videogames'=>$all]);
    }
    /**
     * @Route("/create", name="_create", methods={"POST"})
     */
    public function create(Request $request,VideoGameRepository $gameRepository): JsonResponse

    {
        //pegando os dados que foram mandados na requisição
        $data = $request->request->all();
        
        //mandando dados para entidade 
        $videoGame = new VideoGame();
        $videoGame->setName($data['name']);
        $videoGame
            ->setCreatedAt(new \Datetime("now", new \DateTimeZone("America/Sao_Paulo")))
            ->setUpdatedAt(new \Datetime("now", new \DateTimeZone("America/Sao_Paulo")))
            ;
        $gameRepository->persist($videoGame);

        // devolvendo os dados salvos na tabela
        return $this->json([
            'video game salvo' =>$videoGame
        ]);
    }

    /**
     * @Route("/", name="_get_all", methods={"GET"})
     */
    public function index(VideoGameRepository $gameRepository): JsonResponse
    {
        return $this->json($gameRepository->findAll());
    }

    /**
     * @Route("/update/{id}", name="_update", methods={"PUT"})
     */
    public function update(VideoGame $videoGame, Request $request): JsonResponse

    {
        //pegando os dados que foram mandados na requisição
        $data = $request->request->all();

        //inserindo o dado que será alterado
        $videoGame->setName($data['name']);

        //atualizando data da ultima atualização dessa entidade no banco
        $videoGame->setUpdatedAt(new \DateTime("now", new \DateTimeZone("America/Sao_Paulo")));

        // salvando as alterações no banco
        $doctrine = $this->getDoctrine()->getManager();
        $doctrine->flush();

        // retornando entidade em um objeto json
        return $this->json($videoGame);
    }
    
    /**
     * @Route("/delete/{id}", name="_delete", methods={"DELETE"})
     */
    public function delete(VideoGame $videoGame): JsonResponse
    {
        // pegando a entidade e chamando o doctrine
        // para remover os dados dela do banco
        $doctrine = $this->getDoctrine()->getManager();
        $doctrine->remove($videoGame);
        $doctrine->flush();

        return $this->json([ "removed" => true ]);
    }

}
