<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateMetaTagsRequest;
use App\Models\MetaTag;
use Illuminate\Http\Request;

final class MetaTagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.pages.meta-tags.index')->with('meta', MetaTag::first());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(MetaTag $metaTag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MetaTag $metaTag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMetaTagsRequest $request, MetaTag $metaTag)
    {
        $data = $request->validated();

        $metaTag->update($data);

        return redirect(route('meta-tags.index'))->with('success', 'Мета тег обновлен');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MetaTag $metaTag)
    {
        //
    }
}
