<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("news.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("news.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "title" => "required|string",
            "description" => "required|string",
            "status" => "required",
        ]);

        $data["user_id"] = 1;

        $imageName = NULL;

        if($request->banner_image != NULL){
            $imageObject = $request->banner_image;

            $imageExtension = $imageObject->getClientOriginalExtension();
            $newImageName = time().".".$imageExtension;

            $imageObject->move(public_path("images"), $newImageName);

            $imageName = $newImageName;
        }
        
        $data["banner_image"] = $imageName;
        
        News::create($data);

        return to_route('news.create')->with("success", "News created");
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        return view("news.show");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        return view("news.edit");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        //
    }
}
