<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdsRequest;
use App\Http\Requests\UpdateAdsRequest;
use App\Models\Panel\Ads;
use App\Repository\ads\adsRepo;
use App\Repository\tag\tagRepo;
use App\Service\mediaService;
use Illuminate\Support\Str;

class AdsController extends Controller
{
    public function __construct(public adsRepo $adsRepo)
    {
    }

    public function index()
    {
        return $ads = $this->adsRepo->index();
    }

    public function store(StoreAdsRequest $request, tagRepo $tagRepo): \Illuminate\Http\JsonResponse
    {
        $tags = $tagRepo->getFindIdMany($request->tags);
        $file_path = mediaService::imagee_ads($request->file('image')) ?? null;
        $store = $this->adsRepo->create($request, $file_path);
        $tagRepo->sluggable($store, $tags);
        return response()->json(['message' => 'success create ads', 'success' => ' success'], 200);
    }


    public function show($ads)
    {
        return $this->adsRepo->getFindId($ads);
    }

    public function update(UpdateAdsRequest $request, $ads, tagRepo $tagRepo): \Illuminate\Http\JsonResponse
    {
        $id = $this->adsRepo->getFindId($ads);
        $file_path = mediaService::imagee_ads($request->file('image')) ?? null;
        $this->adsRepo->update($request, $ads, $file_path);
        if ($request->tags) {
            $tagRepo->tags($request->tags, $id);
        }
        return response()->json(['message' => 'success create ads', 'success' => ' success'], 200);
    }

    public function destroy($ads): \Illuminate\Http\JsonResponse
    {
        $deleted = $this->adsRepo->delete($ads);
        if ($deleted === 0)
            return response()->json(['message' => 'not found ads', 'status' => 'error'], 404);
        return response()->json(['message' => 'success', 'status' => 'success'], 200);
    }
}
