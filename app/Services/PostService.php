<?php

namespace App\Services;

use App\Models\Post;

class PostService
{
    public function index($request)
    {
        $isPaginate = $request->is_paginate == 1 ? 1 : null;
        $perPage = $request->per_page ?? 10;

        return $isPaginate ? Post::paginate($perPage) : Post::all();

    }
}
