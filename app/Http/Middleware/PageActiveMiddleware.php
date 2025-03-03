<?php

namespace App\Http\Middleware;

use App\Models\Page;
use App\Repositories\PageRepository;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PageActiveMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $hash = $request->route()->parameter('hash');

        /**
         * @var PageRepository $pageRepository
         */
        $pageRepository = app(PageRepository::class);

        $page = $pageRepository->findByHash($hash);

        if (!$page || $page->isExpired()) {
            abort(Response::HTTP_NOT_FOUND );
        }

        return $next($request);
    }
}
