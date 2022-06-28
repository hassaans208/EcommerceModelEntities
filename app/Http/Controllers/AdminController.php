<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Brands;
use Illuminate\Http\Request;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\Auth;
use Image;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{


    //Users
    function Profile(){
        return view('admin.index');
    }
    function viewUsers(){
        $data = User::latest()->get();
        return view('admin.view_user', compact('data'));
    }
    function deleteUsers($id){
        $data = User::find($id);
        User::findOrfail($id)->delete();
        return redirect()->back()->with('success', 'Successfuly deleted');
    }

    //Logout
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return view('auth.login');
    }

    //Brand Controller
    public function Brandview()
    {

        $data = Brands::latest()->get();
        return view('admin.brand', compact('data'));
    }
    public function BrandEdit($id)
    {
        $data = Brands::latest()->get();
        $get = Brands::findOrfail($id);
        return view('admin.brand', compact('data', 'get'));
    }
    public function Brandadd(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|max:10',
            'image' => 'required',
        ], [
            'brand_name.required' => 'Brand Name is required',
            'brand_name.min' => 'Brand Name must be maximum 10 Chars',
            'image.required' => 'Image is required',

        ]);
        if ($request->file('image')){
            $b_image = $request->file('image');
 
            $name_gen = hexdec(uniqid()) . '.' .  $b_image->getClientOriginalExtension();


            Image::make($b_image)->resize(200, 200)->save('image/brand/'. $name_gen);

            $image_path = 'image/brand/'. $name_gen;

            Brands::insert([
                'name' => $request->brand_name,
                'image' => $image_path,
                'holder_admin' => Auth::user()->id,
                'created_at' => Carbon::now(),

            ]);

            return redirect()->back();

        }


         
    }


    public function BrandEditPost(Request $request, $id)
    {
        if ($request->file('image')){
            $data = Brands::findOrfail($id);
            if(file_exists($data->image)){
                unlink($data->image);

            }

            $request->validate([
                'brand_name' => 'required|max:10',
                'image' => 'required',
            ], [
                'brand_name.required' => 'Brand Name is required',
                'brand_name.min' => 'Brand Name must be maximum 10 Chars',
                'image.required' => 'Image is required',
    
            ]);
            $b_image = $request->file('image');
 
            $name_gen = hexdec(uniqid()) . '.' .  $b_image->getClientOriginalExtension();


            Image::make($b_image)->resize(200, 200)->save('image/brand/'. $name_gen);

            $image_path = 'image/brand/'. $name_gen;

            Brands::find($id)->update([
                'name' => $request->brand_name,
                'image' => $image_path,
                'holder_admin' => Auth::user()->id,
                'updated_at' => Carbon::now(),

            ]);

            return redirect()->back()->with('success', 'Brand Updated Successfully');
            
        } else {
            $request->validate([
                'brand_name' => 'required|max:10',
              ], [
                'brand_name.required' => 'Brand Name is required',
                'brand_name.min' => 'Brand Name must be maximum 10 Chars',
    
            ]);

            
            Brands::find($id)->update([
                'name' => $request->brand_name,
                'holder_admin' => Auth::user()->id,
                'updated_at' => Carbon::now(),

            ]);

            return redirect()->back()->with('success', 'Brand Updated Successfully, without image');

        }


         
    }
    public function BrandDelete($id)
    {

        $brand = Brands::findOrfail($id);



        if (file_exists($brand->image)){
            unlink($brand->image);
        }

        Brands::findOrfail($id)->delete();
        
        return redirect()->back();

         
    }


    //Categories
    public function Catview()
    {
        $data = Brands::latest()->get();
        return view('admin.category', compact('data'));
    }



}
