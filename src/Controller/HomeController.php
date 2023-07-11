<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

/**
 *
 */
class HomeController extends AbstractController
{
    /**
     * @return Response
     */
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    /**
     * @param ArticleRepository $repository
     * @param SerializerInterface $serializer
     * @param int $page
     * @param int $limit
     * @return JsonResponse
     */
    #[Route('/articles/{page}/{limit}', name: 'app_home_articles')]
    public function articles(
        ArticleRepository $repository,
        SerializerInterface $serializer,
        int $page,
        int $limit
    ): JsonResponse
    {
        $articles = $repository->findByLimitAndPage($limit, $page);
        $jsonArticles = $serializer->serialize($articles, 'json');

        return new JsonResponse(
            $jsonArticles,
            Response::HTTP_OK,
            [],
            true
        );
    }


    /**
     * Return articles in Json format
     * @param ArticleRepository $articleRepository
     * @param SerializerInterface $serializer
     *
     * @return JsonResponse
     */
    #[Route('/api/articles')]
    public function articlesAPI(
        ArticleRepository $articleRepository,
        SerializerInterface $serializer
    ): JsonResponse
    {
        $articles = $articleRepository->findAll();
        $jsonArticle = $serializer->serialize($articles, 'json');

        return new JsonResponse(
            $jsonArticle,
            Response::HTTP_OK,
            [],
            true
        );
    }
}
