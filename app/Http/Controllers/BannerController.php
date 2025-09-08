<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
   public function banner_list()
   {
      $banner_list = Banner::all();
      return view('pages.banner.banner_list', compact('banner_list'));
   }
   public function banner_create()
   {
      return view('pages.banner.banner_create');
   }


   public function banner_store(Request $request)
   {
      $request->validate([
         'title' => 'required|max:200',
         'title_bn' => 'required|max:200',
         'description' => 'required|max:200',
         'description_bn' => 'required|max:200',
         'image' => 'required|image|mimes:jpeg,png,jpg|max:600',
      ]);

      try {
         $banner = new Banner();

         $img_path = '';
         if ($request->file('image')) {
            $image_file = $request->file('image');
            $img_path = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $image_file->storeAs('public/banner', $img_path);
         }



         $banner->title = $request->title ?? "";
         $banner->title_bn = $request->title_bn ?? "";
         $banner->description = $request->description ?? "";
         $banner->description_bn = $request->description_bn ?? "";
         $banner->image = $img_path ?? "";
         $banner->save();
      } catch (\Exception $e) {
         return redirect()->back()->with('error', $e->getMessage());
      }

      return redirect()->route('banner_list')->with('success', 'Banner Added Successfully');
   }


   public function banner_edit($id)
   {
      $edit_data = Banner::findOrFail($id);
      return view('pages.banner.banner_create', compact('edit_data'));
   }



   public function banner_update(Request $request, $id)
   {
      $request->validate([
         'title' => 'required|max:200',
         'title_bn' => 'required|max:200',
         'description' => 'required|max:200',
         'description_bn' => 'required|max:200',
         'image' => 'nullable|image|mimes:jpeg,png,jpg|max:600',
      ]);

      try {
         $banner = Banner::findOrFail($id);
         $img_path = '';
         if ($request->file('image')) {

            if ($banner->image != null || $banner->image != '') {
               Storage::delete('public/banner/' . $banner->image);
            }

            $image_file = $request->file('image');
            $img_path = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $image_file->storeAs('public/banner', $img_path);
         } else {
            $img_path = $banner->image;
         }



         $banner->title = $request->title ?? "";
         $banner->title_bn = $request->title_bn ?? "";
         $banner->description = $request->description ?? "";
         $banner->description_bn = $request->description_bn ?? "";
         $banner->image = $img_path ?? "";
         $banner->update();
      } catch (\Exception $e) {
         return redirect()->back()->with('error', $e->getMessage());
      }

      return redirect()->route('banner_list')->with('success', 'Banner Updated Successfully');
   }


   public function banner_delete($id)
   {

      try {
         $banner = Banner::findOrFail($id);
         
         if ($banner->image != null || $banner->image != '') {
            Storage::delete('public/banner/' . $banner->image);
         }
         $banner->delete();
      } catch (\Exception $e) {
         return redirect()->back()->with('error', $e->getMessage());
      }

      return redirect()->route('banner_list')->with('success', 'Banner Delete Successfully');
   }
}
