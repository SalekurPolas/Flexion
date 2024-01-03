<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckAdmin;
use App\Mail\ProductCreated;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller {
    /**
     * Instantiate a new controller instance.
     */
    public function __construct() {
        // adding middleware to check if user is admin using middleware alias
        // $this->middleware('check.admin');

        // adding middleware to check if user is admin using middleware class
        $this->middleware(CheckAdmin::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        //
        ProductCreated::dispatch()->onQueue('emails');

        // TODO: remove these lines
        // php artisan queue:work --queue=high,default
        // php artisan queue:table
        // php artisan migrate
        // QUEUE_CONNECTION=database
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        //
    }

    public function import(Request $request) {
        $file = $request->file('file');
        $fileContents = file($file->getPathname());

        foreach ($fileContents as $line) {
            $data = str_getcsv($line);

            Product::create([
                'name' => $data[0],
                'price' => $data[1],
                // Add more fields as needed
            ]);
        }

        return redirect()->back()->with('success', 'CSV file imported successfully.');
    }

    public function export() {
        
    }
}
