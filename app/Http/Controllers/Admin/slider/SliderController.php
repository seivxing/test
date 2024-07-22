<?php

namespace App\Http\Controllers\Admin\slider;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderFormRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    public function edit(Slider $slider)
    {
        return view('pages.admin.slider.edit', compact('slider'));
    }

    public function update(SliderFormRequest $request, Slider $slider)
    {

        $validateData = $request->validated();

        if ($request->hasFile('image')) {

            $destination = $slider->image;

            if (File::exists($destination)) {
                File::delete($destination);
            }

            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/sliders', $filename);
            $validateData['image'] = "uploads/sliders/$filename";

        } else {
            $validateData['image'] = null; // Handle if no image uploaded
        }

        $validateData['status'] = $request->status == true ? '1' : '0';

        Slider::where('id', $slider->id)->update([
            'title' => $validateData['title'],
            'description' => $validateData['description'],
            'image' => $validateData['image'],
            'status' => $validateData['status'],
        ]);

        if(Auth::class()->role ==1 ){
            return redirect()->route('slider_index')->with('message', 'Slider Updated Successfully.');
        }else{
            return redirect()->route('slider_index_sale')->with('message', 'Slider Updated Successfully.');
        }
    }
    public function index()
    {
        $sliders = Slider::all();
        return view('pages.admin.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('pages.admin.slider.create');
    }

    public function store(SliderFormRequest $request)
    {
        $validateData = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;
            $file->move('uploads/sliders', $filename);
            $validateData['image'] = "uploads/sliders/$filename";
        } else {
            $validateData['image'] = null; // Handle if no image uploaded
        }

        $validateData['status'] = $request->status == true ? '1' : '0';

        // Create the Slider only with validated data
        Slider::create([
            'title' => $validateData['title'],
            'description' => $validateData['description'],
            'image' => $validateData['image'], // This should now be handled properly
            'status' => $validateData['status'],
        ]);

        return redirect()->route('slider_index')->with('message', 'Slider Created Successfully.');
    }


}
