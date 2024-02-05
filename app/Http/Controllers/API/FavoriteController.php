<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use Illuminate\Support\Facades\DB;


class FavoriteController extends Controller
{
    public function index()
    {
        return Bookmark::all();
    }

    public function store()
    {
        try {
            DB::beginTransaction();
            $data = request()->validate([
                'parentId' => 'integer'
            ]);
            $result = Bookmark::firstOrCreate($data);
            DB::commit();

        } catch (\Exception $exception) {
            DB::rollBack();
            return $exception;
        }
        return $result;
    }

    public function destroy($bookmarkId)
    {
        $bookmark = Bookmark::find($bookmarkId);
        $bookmark->delete();
    }
}
