<?php

namespace App\Http\Controllers;

use App\Repositories\PageRepository;
use Symfony\Component\HttpFoundation\Response;

class PageController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(PageRepository $pageRepository, string $hash)
    {
        $page = $pageRepository->findByHash($hash);

        if (!$page) {
            abort(Response::HTTP_NOT_FOUND);
        }

        return view('page', ['hash' => $hash, 'page' => $page]);
    }
}
