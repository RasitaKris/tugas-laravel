<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    // 5 categories (key => label)
    private function getCategories()
    {
        return [
            'registration' => 'Registration & Tuition',
            'exams' => 'Exams',
            'books' => 'Books & Materials',
            'items' => 'School Items',
            'programs' => 'Programs & Activities',
        ];
    }

    // 30 products (English)
    private function getProducts()
    {
        return [
            ['id'=>1,'name'=>'School Registration Fee','description'=>'New student enrollment administration fee','category'=>'registration','price'=>150000],
            ['id'=>2,'name'=>'Elementary Tuition Fee (SPP SD)','description'=>'Monthly tuition for Elementary level','category'=>'registration','price'=>250000],
            ['id'=>3,'name'=>'Junior High Tuition Fee (SPP SMP)','description'=>'Monthly tuition for Junior High level','category'=>'registration','price'=>300000],
            ['id'=>4,'name'=>'Elementary Mid-Semester Exam Fee','description'=>'Mid-term exam fee for elementary','category'=>'exams','price'=>125000],
            ['id'=>5,'name'=>'Junior High Mid-Semester Exam Fee','description'=>'Mid-term exam fee for junior high','category'=>'exams','price'=>150000],
            ['id'=>6,'name'=>'Elementary Final Semester Exam Fee','description'=>'End-of-semester exam for elementary','category'=>'exams','price'=>175000],
            ['id'=>7,'name'=>'Junior High Final Semester Exam Fee','description'=>'End-of-semester exam for junior high','category'=>'exams','price'=>200000],
            ['id'=>8,'name'=>'Elementary Graduation Exam Fee','description'=>'Graduation exam fee for elementary','category'=>'exams','price'=>180000],
            ['id'=>9,'name'=>'Junior High Graduation Exam Fee','description'=>'Graduation exam fee for junior high','category'=>'exams','price'=>200000],
            ['id'=>10,'name'=>'Christian Religious Education Book','description'=>'Textbook for Christian Religious Education','category'=>'books','price'=>55000],
            ['id'=>11,'name'=>'Mathematics Textbook','description'=>'Mathematics learning textbook','category'=>'books','price'=>60000],
            ['id'=>12,'name'=>'Bahasa Indonesia Textbook','description'=>'Bahasa Indonesia learning textbook','category'=>'books','price'=>55000],
            ['id'=>13,'name'=>'Civics (PPKN) Textbook','description'=>'Civics subject textbook','category'=>'books','price'=>50000],
            ['id'=>14,'name'=>'Arts & Culture (SBDP) Textbook','description'=>'Arts and culture textbook','category'=>'books','price'=>50000],
            ['id'=>15,'name'=>'Physical Education (PE) Textbook','description'=>'PE subject textbook','category'=>'books','price'=>52000],
            ['id'=>16,'name'=>'English Textbook','description'=>'English learning textbook','category'=>'books','price'=>60000],
            ['id'=>17,'name'=>'Science (IPA) Textbook','description'=>'Science subject textbook','category'=>'books','price'=>65000],
            ['id'=>18,'name'=>'Social Studies (IPS) Textbook','description'=>'Social studies textbook','category'=>'books','price'=>62000],
            ['id'=>19,'name'=>'Handcraft & Skills Book','description'=>'Handcraft and skills textbook','category'=>'books','price'=>48000],
            ['id'=>20,'name'=>'School Uniform','description'=>'Complete school uniform','category'=>'items','price'=>180000],
            ['id'=>21,'name'=>'Student ID Card','description'=>'Official student identification card','category'=>'items','price'=>35000],
            ['id'=>22,'name'=>'Lanyard','description'=>'Lanyard for ID card','category'=>'items','price'=>15000],
            ['id'=>23,'name'=>'Uniform + ID Card + Lanyard Set','description'=>'Full set: uniform, ID card, and lanyard','category'=>'items','price'=>220000],
            ['id'=>24,'name'=>'Extracurricular Activity Fee','description'=>'Fee for extracurricular programs','category'=>'programs','price'=>160000],
            ['id'=>25,'name'=>'Practical Activity Fee','description'=>'Hands-on practical activity fee','category'=>'programs','price'=>85000],
            ['id'=>26,'name'=>'Elementary Graduation Ceremony Fee','description'=>'Graduation ceremony cost for elementary','category'=>'programs','price'=>300000],
            ['id'=>27,'name'=>'Junior High Graduation Ceremony Fee','description'=>'Graduation ceremony cost for junior high','category'=>'programs','price'=>350000],
            ['id'=>28,'name'=>'Elementary Graduation Gown','description'=>'Graduation gown for elementary students','category'=>'items','price'=>200000],
            ['id'=>29,'name'=>'Junior High Graduation Gown','description'=>'Graduation gown for junior high students','category'=>'items','price'=>220000],
            ['id'=>30,'name'=>'Offline School Activity Fee','description'=>'Fee for offline school events and outings','category'=>'programs','price'=>120000],
        ];
    }

    // INDEX: list + search + category + price filter + sort
    public function index(Request $request)
    {
        $products = $this->getProducts();
        $categories = $this->getCategories();

        // Search by name or description
        if ($request->filled('search')) {
            $q = strtolower($request->search);
            $products = array_filter($products, function($p) use ($q) {
                return str_contains(strtolower($p['name']), $q) || str_contains(strtolower($p['description']), $q);
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $cat = $request->category;
            $products = array_filter($products, fn($p) => $p['category'] === $cat);
        }

        // Filter by price range
        if ($request->filled('min_price')) {
            $min = (int) $request->min_price;
            $products = array_filter($products, fn($p) => $p['price'] >= $min);
        }
        if ($request->filled('max_price')) {
            $max = (int) $request->max_price;
            $products = array_filter($products, fn($p) => $p['price'] <= $max);
        }

        // Sorting
        if ($request->filled('sort')) {
            if ($request->sort === 'name') {
                usort($products, fn($a,$b) => strcmp($a['name'],$b['name']));
            } elseif ($request->sort === 'price') {
                usort($products, fn($a,$b) => $a['price'] <=> $b['price']);
            }
        }

        // make sure products is array (array_filter returns array with preserved keys)
        $products = array_values($products);

        return view('products.list', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        return view('products.form', ['categories' => $this->getCategories()]);
    }

    public function edit($id)
    {
        return view('products.edit', compact('id'));
    }

    public function show($id)
    {
        return view('products.show', compact('id'));
    }

    public function store(Request $request)
    {
        // dummy store
        return redirect()->route('products')->with('success', 'Product stored (dummy only).');
    }

    public function update(Request $request, $id)
    {
        // dummy update
        return redirect()->route('products')->with('success', "Product updated: $id (dummy only).");
    }
}
