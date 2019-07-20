<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\Tile;
use App\Lib\Facades\Response;
use App\Http\Controllers\Controller;

class TileController extends Controller
{
    public function index()
    {
        $tiles = Tile::query()
            ->orderBy('created_at')
            ->get();

        return view('backend.tiles.index', compact('tiles'));
    }

    public function create()
    {
        return view('backend.tiles.create');
    }

    public function store(Request $request)
    {
        $name = $request->input('name');

        Tile::query()
            ->create([
                'name' => $name
            ]);

        return redirect()->route('admin.tiles.index')->withFlashSuccess('Tile created successfully');
    }

    public function edit(Tile $tile)
    {
        return view('backend.tiles.edit', compact('tile'));
    }

    public function update(Tile $tile, Request $request)
    {
        $name = $request->input('name');

        $tile->update([
            'name' => $name
        ]);

        return redirect()->route('admin.tiles.index')->withFlashSuccess('Tile updated successfully');
    }

    public function delete(Tile $tile)
    {
        $tile->forceDelete();

        return Response::sendJSON('success');
    }
}
