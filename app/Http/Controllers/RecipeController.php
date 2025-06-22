<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Category;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RecipeController extends Controller
{
    public function indexBeforeLogin()
    {
        $recipes = Recipe::with('user')->latest()->get();
        return view('welcome', compact('recipes'));
    }

    public function indexAfterLogin()
    {
        $recipes = Recipe::with('user')->latest()->get();
        return view('berandaSetelahLogin', compact('recipes'));
    }

    public function search(Request $request)
    {
        Log::info('Search request received with query: ' . $request->query('query'));

        $query = trim($request->query('query'));
        $recipes = Recipe::with('user')
            ->when($query, function ($q) use ($query) {
                return $q->where('title', 'LIKE', '%' . $query . '%');
            })
            ->latest()
            ->get();

        Log::info('Found ' . $recipes->count() . ' recipes for query: ' . $query);

        $view = Auth::check() ? 'berandaSetelahLogin' : 'welcome';
        return view($view, compact('recipes'));
    }

    public function showMakanan()
    {
        $category = Category::where('name', 'Makanan')->firstOrFail();
        $recipes = Recipe::where('category_id', $category->id)
                        ->with('user')
                        ->latest()
                        ->get();
        return view('makanan', compact('recipes'));
    }

    public function showMinuman()
    {
        $category = Category::where('name', 'Minuman')->firstOrFail();
        $recipes = Recipe::where('category_id', $category->id)
                        ->with('user')
                        ->latest()
                        ->get();
        return view('minuman', compact('recipes'));
    }

    public function showCemilan()
    {
        $category = Category::where('name', 'Cemilan')->firstOrFail();
        $recipes = Recipe::where('category_id', $category->id)
                        ->with('user')
                        ->latest()
                        ->get();
        return view('cemilan', compact('recipes'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('uploadresep', compact('categories'));
    }

    public function store(Request $request)
    {
        Log::info('Recipe store request received with data:', $request->all());
        Log::info('Files in request:', $request->files->all());

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'porsi' => 'nullable|integer',
            'durasi' => 'nullable|integer',
            'bahan' => 'required|array',
            'bahan.*' => 'required|string|max:255',
            'langkah' => 'required|array',
            'langkah.*' => 'required|string',
            'foto_langkah' => 'nullable|array',
            'foto_langkah.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ], [
            'title.required' => 'Judul resep wajib diisi.',
            'bahan.required' => 'Setidaknya satu bahan wajib diisi.',
            'bahan.*.required' => 'Bahan tidak boleh kosong.',
            'langkah.required' => 'Setidaknya satu langkah wajib diisi.',
            'langkah.*.required' => 'Langkah tidak boleh kosong.',
            'foto.image' => 'Foto resep harus berupa gambar.',
            'foto.mimes' => 'Foto resep harus berformat JPEG, PNG, JPG, atau GIF.',
            'foto.max' => 'Ukuran foto resep tidak boleh lebih dari 2MB.',
            'foto_langkah.*.image' => 'Foto langkah harus berupa gambar.',
            'foto_langkah.*.mimes' => 'Foto langkah harus berformat JPEG, PNG, JPG, atau GIF.',
            'foto_langkah.*.max' => 'Ukuran foto langkah tidak boleh lebih dari 2MB.',
            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists' => 'Kategori tidak valid.',
        ]);

        try {
            $fotoPath = null;
            if ($request->hasFile('foto')) {
                Log::info('Main photo detected: ' . $request->file('foto')->getClientOriginalName());
                $fotoPath = $request->file('foto')->store('images/recipes', 'public');
            }

            $fotoLangkahPaths = [];
            if ($request->hasFile('foto_langkah')) {
                foreach ($request->file('foto_langkah') as $index => $fotoLangkah) {
                    if ($fotoLangkah && $fotoLangkah->isValid()) {
                        $path = $fotoLangkah->store('images/steps', 'public');
                        Log::info("Step photo {$index} stored at: {$path}");
                        $fotoLangkahPaths[] = $path;
                    } else {
                        Log::warning("Step photo {$index} is invalid or empty.");
                    }
                }
            }
            
            $recipe = new Recipe();
            $recipe->user_id = Auth::id();
            $recipe->title = $request->title;
            $recipe->description = $request->description;
            $recipe->servings = $request->porsi;
            $recipe->duration = $request->durasi;
            $recipe->category_id = $request->category_id;
            $recipe->main_image = $fotoPath;
            
            $filteredBahan = array_filter($request->bahan, function($value) {
                return is_string($value) && trim($value) !== '';
            });
            $filteredLangkah = array_filter($request->langkah, function($value) {
                return is_string($value) && trim($value) !== '';
            });

            $recipe->ingredients = json_encode(array_values($filteredBahan));
            $recipe->steps = json_encode(array_values($filteredLangkah));
            $recipe->step_images = json_encode(array_values(array_filter($fotoLangkahPaths))); 

            $recipe->save();

            Log::info('Recipe saved successfully: ' . $recipe->id);

            return redirect()->route('welcome')->with('success', 'Resep berhasil diunggah!');
        } catch (\Exception $e) {
            Log::error('Error saving recipe: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menyimpan resep: ' . $e->getMessage())->withInput();
        }
    }

    public function edit(Recipe $recipe)
    {

        $categories = Category::all();
        $recipe->ingredients = json_decode($recipe->ingredients, true);
        $recipe->steps = json_decode($recipe->steps, true);
        $recipe->step_images = json_decode($recipe->step_images, true);
        return view('editresep', compact('recipe', 'categories'));
    }

    public function update(Request $request, Recipe $recipe)
    {

        Log::info('Recipe update request received with data:', $request->all());
        Log::info('Files in request:', $request->files->all());

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'porsi' => 'nullable|string',
            'durasi' => 'nullable|string',
            'bahan' => 'required|array',
            'bahan.*' => 'required|string|max:255',
            'langkah' => 'required|array',
            'langkah.*' => 'required|string',
            'foto_langkah' => 'nullable|array',
            'foto_langkah.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ], [
            'title.required' => 'Judul resep wajib diisi.',
            'bahan.required' => 'Setidaknya satu bahan wajib diisi.',
            'bahan.*.required' => 'Bahan tidak boleh kosong.',
            'langkah.required' => 'Setidaknya satu langkah wajib diisi.',
            'langkah.*.required' => 'Langkah tidak boleh kosong.',
            'foto.image' => 'Foto resep harus berupa gambar.',
            'foto.mimes' => 'Foto resep harus berformat JPEG, PNG, JPG, atau GIF.',
            'foto.max' => 'Ukuran foto resep tidak boleh lebih dari 2MB.',
            'foto_langkah.*.image' => 'Foto langkah harus berupa gambar.',
            'foto_langkah.*.mimes' => 'Foto langkah harus berformat JPEG, PNG, JPG, atau GIF.',
            'foto_langkah.*.max' => 'Ukuran foto langkah tidak boleh lebih dari 2MB.',
            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists' => 'Kategori tidak valid.',
        ]);

        try {
            $fotoPath = $recipe->main_image;
            if ($request->hasFile('foto')) {
                if ($recipe->main_image && Storage::disk('public')->exists($recipe->main_image)) {
                    Storage::disk('public')->delete($recipe->main_image);
                }
                $fotoPath = $request->file('foto')->store('images/recipes', 'public');
                Log::info('New main photo stored at: ' . $fotoPath);
            }

            $fotoLangkahPaths = json_decode($recipe->step_images, true) ?? [];
            if ($request->hasFile('foto_langkah')) {
                // Hapus foto langkah lama jika diganti
                foreach ($fotoLangkahPaths as $path) {
                    if ($path && Storage::disk('public')->exists($path)) {
                        Storage::disk('public')->delete($path);
                    }
                }
                $fotoLangkahPaths = [];
                foreach ($request->file('foto_langkah') as $index => $fotoLangkah) {
                    if ($fotoLangkah && $fotoLangkah->isValid()) {
                        $path = $fotoLangkah->store('images/steps', 'public');
                        Log::info("Step photo {$index} stored at: {$path}");
                        $fotoLangkahPaths[] = $path;
                    } else {
                        Log::warning("Step photo {$index} is invalid or empty.");
                    }
                }
            }

            $recipe->title = $request->title;
            $recipe->description = $request->description;
            $recipe->servings = $request->porsi;
            $recipe->duration = $request->durasi;
            $recipe->category_id = $request->category_id;
            $recipe->main_image = $fotoPath;

            $filteredBahan = array_filter($request->bahan, function($value) {
                return is_string($value) && trim($value) !== '';
            });
            $filteredLangkah = array_filter($request->langkah, function($value) {
                return is_string($value) && trim($value) !== '';
            });

            $recipe->ingredients = json_encode(array_values($filteredBahan));
            $recipe->steps = json_encode(array_values($filteredLangkah));
            $recipe->step_images = json_encode(array_values(array_filter($fotoLangkahPaths)));

            $recipe->save();

            Log::info('Recipe updated successfully: ' . $recipe->id);

            return redirect()->route('profile.show')->with('success', 'Resep berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Error updating recipe: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal memperbarui resep: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Recipe $recipe)
    {

        try {
            if ($recipe->main_image && Storage::disk('public')->exists($recipe->main_image)) {
                Storage::disk('public')->delete($recipe->main_image);
            }

            $stepImages = json_decode($recipe->step_images, true) ?? [];
            foreach ($stepImages as $path) {
                if ($path && Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }

            $recipe->delete();
            Log::info('Recipe deleted successfully: ' . $recipe->id);

            return redirect()->route('profile.show')->with('success', 'Resep berhasil dihapus!');
        } catch (\Exception $e) {
            Log::error('Error deleting recipe: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menghapus resep: ' . $e->getMessage());
        }
    }

    public function toggleFavorite(Recipe $recipe)
    {
        try {
            $userId = Auth::id();
            $existingFavorite = Favorite::where('user_id', $userId)
                                       ->where('recipe_id', $recipe->id)
                                       ->first();

            if ($existingFavorite) {
                $existingFavorite->delete();
                return redirect()->back();
            }

            Favorite::create([
                'user_id' => $userId,
                'recipe_id' => $recipe->id,
            ]);

            return redirect()->back();
        } catch (\Exception $e) {
            Log::error('Error toggling favorite: ' . $e->getMessage());
            return redirect()->back();
        }
    }

    public function showFavorites()
    {
        $recipes = Recipe::whereHas('favorites', function ($query) {
            $query->where('user_id', Auth::id());
        })->with('user')->latest()->get();
        
        return view('koleksiAda', compact('recipes'));
    }

    public function show($id)
    {
        $recipe = Recipe::findOrFail($id);
        $recipe->ingredients = json_decode($recipe->ingredients, true);
        $recipe->steps = json_decode($recipe->steps, true);
        $recipe->step_images = json_decode($recipe->step_images, true);
        return view('halamanResep', compact('recipe'));
    }
}