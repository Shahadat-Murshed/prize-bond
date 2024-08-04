<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrizeBond\PrizeBondStoreRequest;
use App\Http\Requests\PrizeBond\PrizeBondUpdateRequest;
use App\Models\PrizeBond;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class PrizeBondController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PrizeBondStoreRequest $request)
    {
        try {
            $validatedData = $request->validated();

            PrizeBond::create([
                ...$validatedData,
                'user_id' => auth()->id(),
            ]);
            return response()->json(
                [
                    'message' => 'Prize-bond created successfully.',
                ],
                Response::HTTP_CREATED
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'message' => $th->getMessage(),
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $bond = PrizeBond::where('user_id', Auth::user()->id)->findOrFail($id);

            return response()->json($bond, Response::HTTP_OK);
        } catch (ModelNotFoundException) {
            return response()->json(
                [
                    'message' => "This Prize-bond doesn't exist",
                ],
                Response::HTTP_NOT_FOUND
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'message' => $th->getMessage(),
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PrizeBond $prizeBond)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PrizeBondUpdateRequest $request, string $id)
    {
        try {
            $validatedData = $request->validated();

            $bond = PrizeBond::where('user_id', Auth::user()->id)->findOrFail($id);

            $exists = PrizeBond::where('prefix', $validatedData['prefix'])
                ->where('serial', $validatedData['serial'])
                ->where('id', '!=', $id)
                ->exists();

            if ($exists) {
                return response()->json(
                    [
                        'message' => 'The given data was invalid.',
                        'errors' => [
                            'prefix_serial' => ['This prize-bond already exists.'],
                        ],
                    ],
                    422
                );
            }

            $bond->update(
                $validatedData
            );

            return response()->json(
                [
                    'message' => "Prize-bond updated successfully",
                ],
                Response::HTTP_OK
            );
        } catch (ModelNotFoundException) {
            return response()->json(
                [
                    'message' => "This Prize-bond doesn't exist",
                ],
                Response::HTTP_NOT_FOUND
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'message' => $th->getMessage(),
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $bond = PrizeBond::findOrFail($id);

            $bond->delete();

            return response()->json(
                [
                    'status' => 'success',
                    'message' => 'Prize-bond deleted successfully!',
                ],
                Response::HTTP_OK
            );
        } catch (ModelNotFoundException) {
            return response()->json(
                [
                    'message' => 'Prize-bond not found.',
                ],
                Response::HTTP_NOT_FOUND
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'message' => $th->getMessage(),
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
