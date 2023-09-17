<?php
 
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
 
class CategoryController extends Controller
{
    public function index(): view
    {
        $mainCategories = Category::where('parent_category_id', null)->get();

        return view('index', ['mainCategories' => $mainCategories]);
    }

    public function getSubcategories(string $parentCategoryId): JsonResponse
    {
        $parentCategory = Category::findOrFail($parentCategoryId);
    
        $subcategories = Category::where('parent_category_id', $parentCategoryId)->get();
        $subcategoriesCount = $subcategories->count();
        if ($subcategoriesCount === 0) {
            $subcategories = $this->createSubcategories($parentCategory);
        }
        return Response()->json($subcategories);
    }

    private function createSubcategories(Category $parentCategory): array
    {
        $firstSubcategory = $this->createSubcategory($parentCategory, 1);
        $secondSubcategory = $this->createSubcategory($parentCategory, 2);

        return [$firstSubcategory, $secondSubcategory];
    }

    private function createSubcategory(Category $parentCategory , int $appendix): Category
    {
        $subCategory = new Category;
        $subCategory->name = $this->getSubcategoryName($parentCategory, $appendix);
        $subCategory->parent_category_id = $parentCategory->id;
        $subCategory->save();

        return $subCategory;
    }

    private function getSubcategoryName(Category $parentCategory , int $appendix): string
    {
        if ($this->isFirstSubcategory($parentCategory)) {
            return 'SUB ' . $parentCategory->name  . $appendix;
        }

        return 'SUB ' . $parentCategory->name .'-' . $appendix;
    }

    private function isFirstSubcategory(Category $parentCategory): bool
    {
        return !str_contains($parentCategory->name, 'SUB');
    }
}