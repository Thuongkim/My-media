<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGit_userRequest;
use App\Http\Requests\UpdateGit_userRequest;
use App\Repositories\Git_userRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class Git_userController extends AppBaseController
{
    /** @var  Git_userRepository */
    private $gitUserRepository;

    public function __construct(Git_userRepository $gitUserRepo)
    {
        $this->gitUserRepository = $gitUserRepo;
    }

    /**
     * Display a listing of the Git_user.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $gitUsers = $this->gitUserRepository->all();

        return view('git_users.index')
            ->with('gitUsers', $gitUsers);
    }

    /**
     * Show the form for creating a new Git_user.
     *
     * @return Response
     */
    public function create()
    {
        return view('git_users.create');
    }

    /**
     * Store a newly created Git_user in storage.
     *
     * @param CreateGit_userRequest $request
     *
     * @return Response
     */
    public function store(CreateGit_userRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = \Auth::user()->id;

        $gitUser = $this->gitUserRepository->create($input);

        Flash::success('Git User saved successfully.');

        return redirect(route('gitUsers.index'));
    }

    /**
     * Display the specified Git_user.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $gitUser = $this->gitUserRepository->find($id);

        if (empty($gitUser)) {
            Flash::error('Git User not found');

            return redirect(route('gitUsers.index'));
        }

        return view('git_users.show')->with('gitUser', $gitUser);
    }

    /**
     * Show the form for editing the specified Git_user.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $gitUser = $this->gitUserRepository->find($id);

        if (empty($gitUser)) {
            Flash::error('Git User not found');

            return redirect(route('gitUsers.index'));
        }

        return view('git_users.edit')->with('gitUser', $gitUser);
    }

    /**
     * Update the specified Git_user in storage.
     *
     * @param int $id
     * @param UpdateGit_userRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateGit_userRequest $request)
    {
        $gitUser = $this->gitUserRepository->find($id);

        if (empty($gitUser)) {
            Flash::error('Git User not found');

            return redirect(route('gitUsers.index'));
        }

        $gitUser = $this->gitUserRepository->update($request->all(), $id);

        Flash::success('Git User updated successfully.');

        return redirect(route('gitUsers.index'));
    }

    /**
     * Remove the specified Git_user from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $gitUser = $this->gitUserRepository->find($id);

        if (empty($gitUser)) {
            Flash::error('Git User not found');

            return redirect(route('gitUsers.index'));
        }

        $this->gitUserRepository->delete($id);

        Flash::success('Git User deleted successfully.');

        return redirect(route('gitUsers.index'));
    }
}
