<?php

namespace App\Http\Controllers\Web\Admin;

use App\Data\Repositories\Roles;
use App\Http\Controllers\Controller;
use App\Data\Repositories\Users as UsersRepository;
use App\Http\Requests\User as UserRequest;
use Silber\Bouncer\Bouncer;
use Silber\Bouncer\Database\Role as BouncerRole;

class Users extends Controller
{
    /**
     * @var UsersRepository
     */
    private $usersRepository;

    /**
     * Users constructor.
     *
     * @param UsersRepository $usersRepository
     */
    public function __construct(UsersRepository $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function show($id)
    {
        $user = app(UsersRepository::class)->findById($id);

        //TODO selecionar só as roles possíveis em allRoles
        return view('users.form')
            ->with('allRoles', BouncerRole::all())
            ->with('user', $user)
            ->with('formDisabled', true);
    }

    /**
     * @param UserRequest     $request
     * @param UsersRepository $repository
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request, UsersRepository $repository)
    {
        $repository->createFromRequest($request);

        dd($request->all());
        dd($request->get('assigned-roles'));

        return redirect()
            ->route('users.index')
            ->with('');
    }

    /**
     * @return $this
     */
    public function index()
    {
        return view('users.index')->with(
            'users',
            $this->usersRepository->all()
        );
    }
}
