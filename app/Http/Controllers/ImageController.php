<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateImageRequest;
use App\Http\Requests\UpdateImageRequest;
use App\Repositories\ImageRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Auth;
use Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;

class ImageController extends AppBaseController
{
    /** @var  ImageRepository */
    private $imageRepository;

    public function __construct(ImageRepository $imageRepo)
    {
        $this->imageRepository = $imageRepo;
    }

    /**
     * Display a listing of the Image.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $images = Image::where('user_id',Auth::user()->id)->orderBy('updated_at', 'desc')->paginate(20);

        return view('images.index')
            ->with('images', $images);
    }

    /**
     * Show the form for creating a new Image.
     *
     * @return Response
     */
    public function create()
    {
        //delete image when fileable_id = null
        $id = Auth::user()->id;
        $files = Image::where('status', null)->where('user_id', $id)->get();
        foreach ($files as $file) {
            $path = public_path() . $file->url;
            if (file_exists($path)) {
                Storage::delete($file->url);
            }
            $file->delete();
        }
        return view('images.create');
    }

    /**
     * Store a newly created Image in storage.
     *
     * @param CreateImageRequest $request
     *
     * @return Response
     */
    public function store(CreateImageRequest $request)
    {
        //save fileable_id for image
        $id = Auth::user()->id;
        Image::where('status', null)->where('user_id', $id)->update(['status' => 1]);

        Flash::success('Image saved successfully.');

        return redirect(route('images.index'));
    }

    /**
     * Display the specified Image.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $image = $this->imageRepository->find($id);

        if (empty($image)) {
            Flash::error('Image not found');

            return redirect(route('images.index'));
        }

        return view('images.show')->with('image', $image);
    }

    /**
     * Show the form for editing the specified Image.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $image = $this->imageRepository->find($id);

        if (empty($image)) {
            Flash::error('Image not found');

            return redirect(route('images.index'));
        }

        return view('images.edit')->with('image', $image);
    }

    /**
     * Update the specified Image in storage.
     *
     * @param int $id
     * @param UpdateImageRequest $request
     *
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $request->merge(['status' => intval($request->status)]);
        $data = $request->all();
        $image = Image::find($id);

        if (empty($image)) {
            Flash::error('Image not found');

            return redirect(route('images.index'));
        }
        
        $validator = Validator::make($data, Image::rules());
        if ($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('image')) {
            $imageFiles = $request->file('image');
            $folderDir = "uploads/images/";
            $destinationPath = public_path('uploads/images');
            $ext = $imageFiles->getClientOriginalExtension();
            $destinationFileName = "girl-".sha1(date('YmdHis') . str_random(30)).'.'.$ext;
            $imageFiles->move($destinationPath, $destinationFileName);
            if (\File::exists(public_path() . '/' . $image->image)) \File::delete(public_path() . '/' . $image->image);
            $data['image'] = $folderDir . $destinationFileName;
        }

        $data['user_id'] = Auth::user()->id;

        $image->update($data);

        Flash::success('Image updated successfully.');

        return redirect(route('images.index'));
    }

    /**
     * Remove the specified Image from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $image = $this->imageRepository->find($id);

        if (empty($image)) {
            Flash::error('Image not found');

            return redirect(route('images.index'));
        }

        if (\File::exists(public_path() . '/' . $image->image)) \File::delete(public_path() . '/' . $image->image);

        $this->imageRepository->delete($id);

        Flash::success('Image deleted successfully.');

        return redirect(route('images.index'));
    }

    public function postImages(Request $request)
    {
        if ($request->hasFile('file')) {
            $imageFiles = $request->file('file');
            $folderDir = "uploads/images/";
            $destinationPath = public_path('uploads/images');
            $ext = $imageFiles->getClientOriginalExtension();
            $destinationFileName = "girl-".sha1(date('YmdHis') . str_random(30)).'.'.$ext;
            $imageFiles->move($destinationPath, $destinationFileName);
            // save file in database
            $file = new Image;
            $file->image = $folderDir . $destinationFileName;
            $file->user_id = Auth::user()->id;
            $file->save();
            return response()->json(['id'=>$file->id]);
        }
    }

    public function destroyImages(Request $request)
    {
        $image_id = $request->imageId;
        $uploaded_image = $this->imageRepository->find($image_id);
 
        if (empty($uploaded_image)) {
            return Response::json(['message' => 'Sorry file does not exist'], 400);
        }
 
        $file_path = public_path() . $uploaded_image->url;
        // $resized_file = $this->photos_path . '/' . $uploaded_image->resized_name;
 
        if (file_exists($file_path)) {
            Storage::delete($uploaded_image->url);
        }
 
        // if (file_exists($resized_file)) {
        //     unlink($resized_file);
        // }
 
        if (!empty($uploaded_image)) {
            $uploaded_image->delete();
        }
 
        return Response::json(['message' => 'File successfully delete'], 200);
    }
}
