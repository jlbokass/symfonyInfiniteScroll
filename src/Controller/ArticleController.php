<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ArticleController extends AbstractController
{
    #[Route('/article', name: 'app_article')]
    public function index(HttpClientInterface $client): Response
    {
        $response = $client->request(
            'GET',
            'https://127.0.0.1:8001/api/articles'
        );

        // $contentType = 'application/json'
        $contents = $response->getContent();

        $contents = $response->toArray();


        return $this->render('article/index.html.twig', [
            'articles' => $contents,
        ]);
    }
}
