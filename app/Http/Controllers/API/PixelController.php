<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\CreatePixelRequest;
use App\Http\Requests\API\UpdatePixelRequest;
use App\Http\Resources\PixelResource;
use App\Pixel;
use App\Traits\PixelTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PixelController extends Controller
{
    use PixelTrait;

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $search = $request->input('search');
        $sort = ($request->input('sort') == 'asc' ? 'asc' : 'desc');
        $perPage = (($request->input('per_page') >= 10 && $request->input('per_page') <= 100) ? $request->input('per_page') : config('settings.paginate'));

        return PixelResource::collection(Pixel::where('user_id', $user->id)
            ->when($search, function($query) use ($search) {
                return $query->searchName($search);
            })
            ->orderBy('id', $sort)
            ->paginate($perPage)
            ->appends(['search' => $search, 'sort' => $sort, 'per_page' => $perPage]))
            ->additional(['status' => 200]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreatePixelRequest $request
     * @return PixelResource|\Illuminate\Http\JsonResponse
     */
    public function store(CreatePixelRequest $request)
    {
        $created = $this->pixelCreate($request);

        if ($created) {
            return PixelResource::make($created);
        }

        return response()->json([
            'message' => 'Resource not found.',
            'status' => 404
        ], 404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return PixelResource|\Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $user = Auth::user();

        $link = Pixel::where([['id', '=', $id], ['user_id', $user->id]])->first();

        if ($link) {
            return PixelResource::make($link);
        }

        return response()->json([
            'message' => 'Resource not found.',
            'status' => 404
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePixelRequest $request
     * @param int $id
     * @return PixelResource
     */
    public function update(UpdatePixelRequest $request, $id)
    {
        $user = Auth::user();

        $pixel = Pixel::where([['id', '=', $id], ['user_id', '=', $user->id]])->firstOrFail();

        $updated = $this->pixelUpdate($request, $pixel);

        if ($updated) {
            return PixelResource::make($updated);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $user = Auth::user();

        $pixel = Pixel::where([['id', '=', $id], ['user_id', '=', $user->id]])->first();

        if ($pixel) {
            $pixel->delete();

            return response()->json([
                'id' => $pixel->id,
                'object' => 'pixel',
                'deleted' => true,
                'status' => 200
            ], 200);
        }

        return response()->json([
            'message' => 'Resource not found.',
            'status' => 404
        ], 404);
    }
}
