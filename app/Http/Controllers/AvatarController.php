<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAvatarRequest;
use App\Http\Requests\UpdateAvatarRequest;
use App\Repositories\AvatarRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Avatar;

class AvatarController extends AppBaseController
{
    /** @var  AvatarRepository */
    private $avatarRepository;

    public function __construct(AvatarRepository $avatarRepo)
    {
        $this->avatarRepository = $avatarRepo;
    }

    /**
     * Display a listing of the Avatar.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $avatars = $this->avatarRepository->all();

        return view('avatars.index')
            ->with('avatars', $avatars);
    }

    /**
     * Show the form for creating a new Avatar.
     *
     * @return Response
     */
    public function create()
    {
        return view('avatars.create');
    }

    /**
     * Store a newly created Avatar in storage.
     *
     * @param CreateAvatarRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $avatar = new Avatar;
        $validator = \Validator::make($data = $request->all(), Avatar::rules());
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('image')) {
            $imageFiles = $request->file('image');
            $folderDir = "uploads/avatars/";
            $destinationPath = public_path('uploads/avatars');
            $ext = $imageFiles->getClientOriginalExtension();
            $destinationFileName = "avatar-".sha1(date('YmdHis') . str_random(30)).'.'.$ext;
            $imageFiles->move($destinationPath, $destinationFileName);
            if (\File::exists(public_path() . '/' . $avatar->image)) \File::delete(public_path() . '/' . $avatar->image);
            $avatar->image = $folderDir . $destinationFileName;
        }

        $avatar->user_id = Auth::user()->id;

        $avatar->save();

        Flash::success('Avatar saved successfully.');

        return redirect(route('avatars.index'));
    }

    /**
     * Display the specified Avatar.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $avatar = $this->avatarRepository->find($id);

        if (empty($avatar)) {
            Flash::error('Avatar not found');

            return redirect(route('avatars.index'));
        }

        return view('avatars.show')->with('avatar', $avatar);
    }

    /**
     * Show the form for editing the specified Avatar.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $avatar = $this->avatarRepository->find($id);

        if (empty($avatar)) {
            Flash::error('Avatar not found');

            return redirect(route('avatars.index'));
        }

        return view('avatars.edit')->with('avatar', $avatar);
    }

    /**
     * Update the specified Avatar in storage.
     *
     * @param int $id
     * @param UpdateAvatarRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $data = $request->all();
        $avatar = Avatar::find($id);

        if (empty($avatar)) {
            Flash::error('Avatar not found');

            return redirect(route('avatars.index'));
        }
        
        $validator = \Validator::make($data, Avatar::rules($id));
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('image')) {
            $imageFiles = $request->file('image');
            $folderDir = "uploads/avatars/";
            $destinationPath = public_path('uploads/avatars');
            $ext = $imageFiles->getClientOriginalExtension();
            $destinationFileName = "avatar-".sha1(date('YmdHis') . str_random(30)).'.'.$ext;
            $imageFiles->move($destinationPath, $destinationFileName);
            if (\File::exists(public_path() . '/' . $avatar->image)) \File::delete(public_path() . '/' . $avatar->image);
            $data['image'] = $folderDir . $destinationFileName;
        }

        $data['user_id'] = Auth::user()->id;

        $avatar->update($data);

        Flash::success('Avatar updated successfully.');

        return redirect(route('avatars.index'));
    }

    /**
     * Remove the specified Avatar from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $avatar = $this->avatarRepository->find($id);

        if (empty($avatar)) {
            Flash::error('Avatar not found');

            return redirect(route('avatars.index'));
        }

        $this->avatarRepository->delete($id);

        Flash::success('Avatar deleted successfully.');

        return redirect(route('avatars.index'));
    }
}
