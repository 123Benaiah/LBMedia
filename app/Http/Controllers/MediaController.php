<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        // Fetch all categories from the database
        $categories = Category::all();

        $query = Media::query();

        $search = $request->input('search');

        // Query the media and paginate
        $media = Media::where('title', 'like', '%' . $search . '%')
            ->paginate(10);

        return view('media.index', compact('media', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    { // Fetch all categories from the database
        $categories = Category::all();
        return view('media.create', compact('categories'));
    }
    //store new uploaded file

    // public function upload(Request $request)
    // {
    //     // Validate the incoming request
    //     $request->validate([
    //         'title'       => 'required|string|max:255',
    //         'file'        => 'required|mimes:jpg,png,jpeg,mp4,mp3,wav|max:20480', // 20MB max
    //         'category_id' => 'required|exists:categories,id',
    //     ]);

    //     // Check if file is uploaded
    //     if (!$request->hasFile('file')) {
    //         return redirect()->back()->withErrors(['file' => 'Please upload a valid file.'])->withInput();
    //     }

    //     try {
    //         // Upload the file to Cloudinary
    //         $uploadedFile = Cloudinary::upload($request->file('file')->getRealPath());

    //         // Get the secure URL of the uploaded file
    //         $fileUrl = $uploadedFile->getSecurePath();

    //         // Save file details to the database
    //         Media::create([
    //             'title'       => $request->input('title'),
    //             'file_path'   => $fileUrl, // Store the Cloudinary URL
    //             'type'        => $request->file('file')->getClientOriginalExtension(),
    //             'category_id' => $request->input('category_id'),
    //         ]);

    //         // Redirect with success message
    //         return redirect()->route('media.index')->with('success', 'File uploaded successfully!');
    //     } catch (\Exception $e) {
    //         // Log the error
    //         \Log::error('File upload failed: ' . $e->getMessage());

    //         // Handle exceptions (e.g., storing errors)
    //         return redirect()->back()->withErrors(['file' => 'There was an error uploading the file: ' . $e->getMessage()])->withInput();
    //     }
    // }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'title'       => 'required|string|max:255',
            'file'        => 'required|mimes:jpg,png,jpeg,mp4,mp3,wav|max:100480', // 100MB max
            'category_id' => 'required|exists:categories,id',
        ]);

        // Check if a file is uploaded
        if (! $request->hasFile('file')) {
            return redirect()->back()->withErrors(['file' => 'Please upload a valid file.'])->withInput();
        }

        try {
            $file      = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $type      = $this->mapFileType($extension); // Map extension to type

            // Fetch category name from database
            $category = Category::find($request->input('category_id'));

            if (! $category) {
                return redirect()->back()->withErrors(['file' => 'Invalid category selected.'])->withInput();
            }

            // Convert category name to lowercase for comparison
            $categoryName = strtolower($category->name);

            // Validate category and file type match
            if ($categoryName !== $type) {
                return redirect()->back()->withErrors(['file' => "Selected category '{$category->name}' does not match the file type '{$type}'."])->withInput();
            }

            // Define subfolder based on file type
            $folder = match ($type) {
                'image' => 'images',
                'video' => 'videos',
                'audio' => 'audio',
                default => 'others',
            };

            // Store the file in `public/media/{folder}`
            $path = $file->storeAs("media/{$folder}", $file->getClientOriginalName(), 'public');

            // Save file details in the database
            $media = Media::create([
                'title'       => $request->input('title'),
                'file_path'   => "storage/{$path}",
                'type'        => $type,
                'category_id' => $request->input('category_id'),
            ]);

            // Redirect based on file type
            if ($type === 'audio') {
                return redirect()->back()->with('success', 'Audio file uploaded successfully!');
            }
            if ($type === 'image') {
                return redirect()->back()->with('success', 'Image file uploaded successfully!');
            }
            if ($type === 'video') {
                return redirect()->back()->with('success', 'Video file uploaded successfully!');
            }

            return redirect()->route('media.index')->with('success', 'File uploaded successfully!');
        } catch (\Exception $e) {
            \Log::error('File upload failed: ' . $e->getMessage());

            return redirect()->back()->withErrors(['file' => 'Error uploading file: ' . $e->getMessage()])->withInput();
        }
    }

    /**
     * Map file extension to type.
     *
     * @param string $extension
     * @return string
     */
    private function mapFileType($extension)
    {
        $imageExtensions = ['jpg', 'png', 'jpeg'];
        $videoExtensions = ['mp4'];
        $audioExtensions = ['mp3', 'wav'];

        if (in_array($extension, $imageExtensions)) {
            return 'image';
        } elseif (in_array($extension, $videoExtensions)) {
            return 'video';
        } elseif (in_array($extension, $audioExtensions)) {
            return 'audio';
        }

        throw new \Exception('Unsupported file type: ' . $extension);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $media = Media::findOrFail($id);
        $media->increment('views');
        return view('media.show', compact('media'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            // Find the media record
            $media = Media::findOrFail($id);

            // Delete the file from storage
            Storage::delete($media->file_path);

            // Delete the record from the database
            $media->delete();

            // Get the type of the media (audio, image, or video)
            $type = $media->type;

            // Return a success message based on the file type
            if ($type === 'audio') {
                return redirect()->back()->with('success', 'Audio file deleted successfully!');
            }
            if ($type === 'image') {
                return redirect()->back()->with('success', 'Image file deleted successfully!');
            }
            if ($type === 'video') {
                return redirect()->back()->with('success', 'Video file deleted successfully!');
            }

            // Fallback success message
            return redirect()->route('media.index')->with('success', 'File deleted successfully!');
        } catch (\Exception $e) {
            // Log the error
            \Log::error('File deletion failed: ' . $e->getMessage());

            // Redirect with error message
            return redirect()->route('media.index')->withErrors(['error' => 'There was an error deleting the file: ' . $e->getMessage()]);
        }
    }

    public function audio()
    {
        // Fetch category from the database
        $categories = Category::where('name', 'audio')->get();
        $item       = Media::where('type', 'audio')->get();
        return view('media.audio.audio', compact('item', 'categories'));
    }

    public function video()
    {
         // Fetch category from the database
        $categories = Category::where('name', 'Video')->get();
        $videos = Media::where('type', 'video')->get();
        return view('media.video.video', compact('videos','categories'));
    }
    /**
     * Display a listing of the images.
     */
    public function image()
{
    // Get all images sorted by latest first
    $images = Media::where('type', 'image')
                ->latest()
                ->get();

    $categories = Category::where('name', 'Image')->get();
    return view('media.image.image', [
        'images' => $images,
        'categories' => $categories,
    ]);
}

}
