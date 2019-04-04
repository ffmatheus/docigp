<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Congressman as CongressmanRequest;

use App\Data\Repositories\Congressmen as CongressmenRepository;

class Congressmen extends Controller
{
    /**
     * @var CongressmenRepository
     */
    private $congressmenRepository;

    /**
     * Users constructor.
     *
     * @param CongressmenRepository $congressmenRepository
     */
    public function __construct(CongressmenRepository $congressmenRepository)
    {
        $this->congressmenRepository = $congressmenRepository;
    }


    public function create()
    {
        return view('admin.congressmen.form')->with([
            'congressman' => $this->congressmenrepository->new(),
        ]);
    }

    public function store(
        CongressmanRequest $request
    ) {
        $this->congressmenrepository->createFromRequest($request);

        return redirect()->route('admin.congressmen.index');
    }

    public function index(Request $request)
    {
        return view('admin.congressmen.index')
            ->with('congressmen', $this->congressmenRepository->all()
            );
    }

    public function show($id)
    {
        $congressman = app(CongressmenRepository::class)->findById($id);

        //TODO selecionar as roles possíveis
        return view('admin.congressmen.form')
            ->with('congressman', $congressman)
            ->with('formDisabled', true);
    }
}
