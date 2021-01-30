<?php

namespace App\Http\Controllers\Media;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\Media\MediaResourceCollection;
use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $media = Media::latest()->paginate();
        return ApiResponse::successResponse(
            'Media List',
            new MediaResourceCollection($media)
        );
    }
}
