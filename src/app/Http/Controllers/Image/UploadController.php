<?php

namespace App\Http\Controllers\Image;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\UploadMediaRule;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'string|max:50',
            'provider' => 'required|exists:providers,id',
            'image_file' => 'required|image|mimes:jpeg,jpg,gif|max:5120',
        ]);
        
        $file = $request->file('image_file');
        $fileExtensionType = $file->getClientOriginalExtension();
        $fileSize = $file->getSize();
        [$imageWidth, $imageHeight] = getimagesize($file);

        $getMediaRules = UploadMediaRule::where([
            ['media_type', $fileExtensionType],
            ['media', 'image'],
            ['provider_id', $request->provider]
        ])->first();

        if (!$getMediaRules) {
            return ApiResponse::validationFailure('Current provider does not support such media type', []);
        }

        if (!$getMediaRules->aspect_ratio && $this->getAspectRatio($imageWidth, $imageHeight) !== $getMediaRules->aspect_ratio) {
            return ApiResponse::validationFailure('The image aspect ration should be '.$getMediaRules->aspect_ratio, []);
        }
        
        if ($this->convertBytesToMb($fileSize) > $getMediaRules->max_media_size_mb) {
            return ApiResponse::validationFailure('The image size should be less than '.$getMediaRules->max_media_size_mb.' MB', []);
        }

        $filePath = $request->file('image_file')->store('public/'.$getMediaRules->provider->name.'/image');

        //store your file into database
        $media = new Media();
        $media->provider_id = $request->provider;
        $media->name = $request->has('name') ? $request->name : '';
        $media->path = $filePath;
        $media->save();
        
        return response()->json([
            "success" => true,
            "message" => "Media successfully uploaded",
            "file" => [
                'name' => basename($filePath),
                'url' => \Storage::disk('public')->url($filePath),
                "mime" => $file->getClientMimeType()
            ]
        ]);
    }

    public function getAspectRatio(int $width, int $height)
    {
        $greatestCommonDivisor = static function ($width, $height) use (&$greatestCommonDivisor) {
            return ($width % $height) ? $greatestCommonDivisor($height, $width % $height) : $height;
        };

        $divisor = $greatestCommonDivisor($width, $height);

        return $width / $divisor . ':' . $height / $divisor;
    }

    /**
     * Format bytes to kb, mb, gb, tb
     *
     * @param  integer $size
     * @param  integer $precision
     * @return integer
     */
    public static function convertBytesToMb($fileSize)
    {
        return round($fileSize / 1024 / 1024, 4);
    }
}
