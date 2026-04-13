<?php

namespace App\Http\Controllers;

use App\Models\ImageGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class ImageGalleryController extends Controller
{
    // Predefined tags (can be moved to a config file later)
    private $predefinedTags = [
        'Concrete',
        'Vinyl',
        'Fibreglass',
        'Skimmer',
        'Overflow',
        'Infinity',
        'Residential Pool',
        'Commercial Pool',
        'Balinese',
        'Lampang',
        'Customised Tiling',
        'Jacuzzi',
        'Heated Pool',
        'Kids Pool',
        'Lightweight Panel Pool',
        'Timber Deck',
        'Concrete Deck',
        'Water Features',
        'Waterfall',
        'Nature',
        'Water Fountain',
        'Oasis',
        'Luxurious',
        'Landscape Design',
        'Wading Pool',
        'Private Pool',
        'Contemporary',
        'Swimming Pool',
        'Gazebos',
        'Minimalism',
        'LED Lights',
        'Fitness',
        'Backyard',
        'Mosaic Tiles',
        'Safety Fence'
    ];

    private function getTranslatedTags()
    {
        $translatedTags = [];
        foreach ($this->predefinedTags as $tag) {
            $translationKey = str_replace(' ', '_', strtolower($tag));
            $translatedTags[$tag] = __('strings.' . $translationKey);
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
                $q->where('image_name', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('image_description', 'LIKE', '%' . $request->search . '%');
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
        $galleryId = 'gallery_' . $searchTerm . (count($tags) > 0 ? '_' . implode('_', $tags) : '');
        $translatedTags = $this->getTranslatedTags();

        if ($request->ajax()) {
            return response()->json([
                'html' => view('image-gallery.grid', compact('images', 'galleryId', 'translatedTags'))->render(),
                'pagination' => (string) $images->links()
            ]);
        }
    
        // Regular page load
        return view('pages.08-pool-showcase-gallery', [
            'images' => $images,
            'tags' => $this->predefinedTags,
            'translatedTags' => $translatedTags, 
            'galleryId' => $galleryId // Pass the dynamic gallery ID to the view
        ]);
    }
    
}
