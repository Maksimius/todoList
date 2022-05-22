<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Doings;
use Illuminate\Http\Request;

class DoingsController extends Controller
{
    public function index()
    {
        return Doings::get()->all();
    }

    public function store(Request $request)
    {
        $doing = new Doings($request->safe());
        if ($doing->validate($request->safe())) {
            $doing->save();
            return $doing;
        }
        return response()->json(['error' => __('Data validation error')], 400);
    }

    public function moveToUrgent($id)
    {
        $doing = Doings::findOrFail($id);
        $doing->setUrgent(true);
        $doing->save();
        return $doing;
    }

    public function moveToRegular($id)
    {
        $doing = Doings::findOrFail($id);
        $doing->setUrgent(false);
        $doing->save();
        return $doing;
    }

    public function markDone($id)
    {
        $doing = Doings::findOrFail($id);
        $doing->setDone(true);
        $doing->save();
        return $doing;
    }

    public function unmarkDone($id)
    {
        $doing = Doings::findOrFail($id);
        $doing->setDone(false);
        $doing->save();
        return $doing;
    }

    public function delete($id)
    {
        $doing = Doings::findOrFail($id);
        $doing->delete();
        return response()->json(['success' => __('Deleted')], 204);
    }


}
