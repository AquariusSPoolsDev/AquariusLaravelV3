<?php

namespace App\Http\Controllers;

use App\Enums\PoolTags;
use App\Models\ImageGallery;
use Illuminate\Http\Request;

class ImageGalleryController extends Controller
{
    private function getTranslatedTags(): array
    {
        $translatedTags = [];
        foreach (array_keys(PoolTags::options()) as $tag) {
            $translatedTags[$tag] = PoolTags::translate($tag);
        }

        return $translatedTags;
    }

    public function index(Request $request)
    {
        // Base query for published images
        $query = ImageGallery::published()->orderBy('created_at', 'desc');

        // Search functionality
        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('image_name', 'LIKE', '%'.$request->search.'%')
                    ->orWhere('image_description', 'LIKE', '%'.$request->search.'%');
            });
        }

        // Multiple Tag filtering
        if ($request->has('tags') && is_array($request->tags)) {
            $tags = $request->tags; // Ensure tags is an array
            $query->where(function ($q) use ($tags) {
                foreach ($tags as $tag) {
                    $q->orWhereJsonContains('image_tags', $tag);
                }
            });
        }

        // Paginate results
        $images = $query->paginate(16);

        $searchTerm = urlencode($request->search);
        $tags = is_array($request->tags) ? $request->tags : [];
        $galleryId = 'gallery_'.$searchTerm.(count($tags) > 0 ? '_'.implode('_', $tags) : '');
        $translatedTags = $this->getTranslatedTags();

        if ($request->ajax()) {
            return response()->json([
                'html' => view('components.image-gallery.grid', compact('images', 'galleryId', 'translatedTags'))->render(),
                'pagination' => (string) $images->links(),
            ]);
        }

        // Regular page load
        return view('pages.08-pool-showcase-gallery', [
            'images' => $images,
            'tags' => array_keys(PoolTags::options()),
            'translatedTags' => $translatedTags,
            'galleryId' => $galleryId, // Pass the dynamic gallery ID to the view
        ]);
    }
}
