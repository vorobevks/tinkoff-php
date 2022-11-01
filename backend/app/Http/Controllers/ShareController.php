<?php

namespace App\Http\Controllers;

use App\Models\Share;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ShareController extends Controller
{
    public function getAll()
    {
        return Share::all();
    }

    public function setSubscription(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'share_id' => 'required|exists:shares,id|unique:subscriptions,share_id',
        ]);

        if ($validator->fails()) return response()->json($validator->messages(), 422);

        $subscription = new Subscription();
        $subscription->share_id = $request->share_id;
        $subscription->save();

        return response()->json($subscription);
    }
}
