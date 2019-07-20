<?php

namespace App\Http\Controllers\Frontend;

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
            ->paginate(2);

        return Response::sendJSON(compact('tiles'));
    }


}
