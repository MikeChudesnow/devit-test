<?php

namespace App\Http\Controllers;


use App\Http\Resources\PostResource;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request, PostService $postService)
    {
        return PostResource::collection($postService->index($request));
    }
}
