<?php

namespace App\Http\Controllers\Admin;

use App\Models\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Repositories\ImageUploader;


class LocationController extends Controller
{

    public function __construct(ImageUploader $imageUploader)
    {
        $this->imageUplaoder = $imageUploader;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::orderBy('created_at', 'asc')->orderBy('created_at', 'desc')->get();
        return view('admin.locations.list')->with('locations', $locations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.locations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $validator = Validator::make($data, [
                'title' => 'required|unique:locations'
            ]);
            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $location = Location::create($data);
            $location->save();

            return redirect('auth/location/'. $location->id .'/edit')
                ->with('successMessage', 'Location has been created!');

        } catch(Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $location = Location::where('id', $id)->first();
        return view('admin.locations.edit')->with(['location' => $location]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();
            $validator = Validator::make($data, [
                'title' => 'required|unique:locations,id,' . $id,
                'content' => 'required',
                'lat' => 'required',
                'lng' => 'required'
            ]);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            isset($data['published']) ? $data['published'] = 1 : $data['published'] = 0;

            # Image upload
            if(isset($data['image'])) {
                $data['image'] = $this->imageUplaoder->uploadImage($data['image'], 'blog');
            } else {
                unset($data['image']);
            }

            $location = Location::find($id);
            $location->fill($data);
            $location->save();

            return redirect('auth/location/'. $location->id .'/edit')
                ->with('successMessage', 'Location has been updated!');

        } catch(\Exception $ex) {

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Location::destroy($id);
            return redirect('/auth/location');
        } catch(\Exception $ex) {

        }
    }
}
