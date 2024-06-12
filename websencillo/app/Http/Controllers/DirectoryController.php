<?php

namespace App\Http\Controllers;

use App\Models\Directory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\DirectoryRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class DirectoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $directories = Directory::paginate();

        return view('directory.index', compact('directories'))
            ->with('i', ($request->input('page', 1) - 1) * $directories->perPage());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $directory = new Directory();

        return view('directory.create', compact('directory'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DirectoryRequest $request): RedirectResponse
    {
        Directory::create($request->validated());

        return Redirect::route('directories.index')
            ->with('success', 'Directory created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id): View
    {
        $directory = Directory::find($id);

        return view('directory.show', compact('directory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id): View
    {
        $directory = Directory::find($id);

        return view('directory.edit', compact('directory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DirectoryRequest $request, Directory $directory): RedirectResponse
    {
        $directory->update($request->validated());

        return Redirect::route('directories.index')
            ->with('success', 'Directory updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        Directory::find($id)->delete();

        return Redirect::route('directories.index')
            ->with('success', 'Directory deleted successfully');
    }
}
