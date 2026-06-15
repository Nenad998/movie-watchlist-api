<?php

namespace App\Http\Controllers\Api;

use App\Actions\Watchlist\AddMovieToWatchlistAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Watchlist\AddMovieRequest;
use App\Http\Requests\Watchlist\UpdateWatchlistItemRequest;
use App\Http\Resources\WatchlistItemResource;
use App\Models\WatchlistItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use RuntimeException;

class WatchlistController extends Controller
{
    public function index(Request $request)
    {
        $items = WatchlistItem::query()
            ->where('user_id', $request->user()->id)
            ->with('movie')
            ->when(
                $request->filled('status'),
                fn($query) =>
                $query->where('status', $request->string('status'))
            )
            ->latest()
            ->paginate($request->integer('per_page', 10));

        return WatchlistItemResource::collection($items);
    }

    public function store(AddMovieRequest $request, AddMovieToWatchlistAction $action): JsonResponse
    {
        try {
            $item = $action->execute($request->user(), $request->validated());
        } catch (RuntimeException $exception) {
            return response()->json([
                'message' => $exception->getMessage(),
            ], 404);
        }

        return response()->json([
            'data' => new WatchlistItemResource($item->load('movie')),
        ], 201);
    }

    public function show(Request $request, WatchlistItem $watchlistItem): WatchlistItemResource
    {
        abort_unless($watchlistItem->user_id === $request->user()->id, 404);

        return new WatchlistItemResource($watchlistItem->load('movie'));
    }

    public function update(
        UpdateWatchlistItemRequest $request,
        WatchlistItem $watchlistItem
    ): WatchlistItemResource {
        abort_unless($watchlistItem->user_id === $request->user()->id, 404);

        $watchlistItem->update($request->validated());

        return new WatchlistItemResource($watchlistItem->load('movie'));
    }

    public function destroy(Request $request, WatchlistItem $watchlistItem): JsonResponse
    {
        abort_unless($watchlistItem->user_id === $request->user()->id, 404);

        $watchlistItem->delete();

        return response()->json(null, 204);
    }
}
