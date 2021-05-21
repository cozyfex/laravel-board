<?php

namespace CozyFex\LaravelBoard\Controllers;

use CozyFex\LaravelBoard\Models\Board;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Contracts\Foundation\Application;
use Symfony\Component\HttpFoundation\Test\Constraint\ResponseIsRedirected;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request): Response
    {
        $field = $request->get('field');
        $sort  = $request->get('sort');

        switch ($field) {
            case 'date':
            default:
                $orderField = 'boards.created_at';
                break;
            case 'title':
                $orderField = 'title';
                break;
            case 'name':
                $orderField = 'author';
                break;
            case 'id':
                $orderField = 'users.username';
                break;
        }

        switch ($sort) {
            case 'asc':
                $orderSort = 'ASC';
                break;
            case 'desc':
            default:
                $orderSort = 'DESC';
                break;
        }

        if ($orderSort == 'ASC') {
            $boards = Board::with('users')
                           ->join('users', 'boards.user_id', '=', 'users.id')
                           ->select('*')
                           ->orderBy($orderField)
                           ->paginate(10);
        } else {
            $boards = Board::with('users')
                           ->join('users', 'boards.user_id', '=', 'users.id')
                           ->select('*')
                           ->orderByDesc($orderField)
                           ->paginate(10);
        }

        return response()->view('board::board.list', [
            'currentMenu' => 'board',
            'title'       => 'Board',
            'boards'      => $boards,
            'field'       => $field,
            'sort'        => $sort,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return response()->view('board::board.form', [
            'currentMenu' => 'board',
            'title'       => 'Board',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     *
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $board          = new Board();
        $board->user_id = auth()->user()->id;
        $board->author  = $request->post('author');
        $board->title   = $request->post('title');
        $board->content = $request->post('content');
        $board->save();

        return redirect()->route('board.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Board  $board
     *
     * @return Response
     */
    public function show(Board $board): Response
    {
        $data = [
            'title'       => 'Board Show',
            'currentMenu' => 'board',
            'board'       => $board,
        ];

        return response()->view('board::board.form', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Board  $board
     *
     * @return Response
     */
    public function edit(Board $board): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Board  $board
     *
     * @return RedirectResponse
     */
    public function update(Request $request, Board $board): RedirectResponse
    {
        $board->author  = $request->post('author');
        $board->title   = $request->post('title');
        $board->content = $request->post('content');
        $board->update();

        return redirect()->route('board::board.show', $board);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Board  $board
     *
     * @return Response
     */
    public function destroy(Board $board): Response
    {
        //
    }
}
