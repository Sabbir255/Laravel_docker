<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\WeDo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WeDoController extends Controller
{
    public function wedo_list()
    {
       $wedo = WeDo::all();
       return view('pages.wedo.wedo_list', compact('wedo'));
    }
    public function wedo_create()
    {
       return view('pages.wedo.create_wedo');
    }
 
 
    public function wedo_store(Request $request)
    {
       $request->validate([
          'title' => 'required|max:200',
          'title_bn' => 'required|max:200',
          'description_bn' => 'required|max:200',
          'image' => 'required|image|mimes:jpeg,png,jpg|max:600',
       ]);
 
       try {
          $wedo = new WeDo();
 
          $img_path = '';
          if ($request->file('image')) {
             $image_file = $request->file('image');
             $img_path = time() . '.' . $request->file('image')->getClientOriginalExtension();
             $image_file->storeAs('public/wedo', $img_path);
          }
 
 
 
          $wedo->title = $request->title ?? "";
          $wedo->title_bn = $request->title_bn ?? "";
          $wedo->description = $request->description ?? "";
          $wedo->description_bn = $request->description_bn ?? "";
          $wedo->image = $img_path ?? "";
          $wedo->save();
       } catch (\Exception $e) {
          return redirect()->back()->with('error', $e->getMessage());
       }
 
       return redirect()->route('wedo_list')->with('success', 'We do Added Successfully');
    }
 
 
    public function wedo_edit($id)
    {
       $edit_data = WeDo::findOrFail($id);
       return view('pages.wedo.create_wedo', compact('edit_data'));
    }
 
 
 
    public function wedo_update(Request $request, $id)
    {
       $request->validate([
          'title' => 'required|max:200',
          'title_bn' => 'required|max:200',
          'description_bn' => 'required|max:200',
          'image' => 'nullable|image|mimes:jpeg,png,jpg|max:600',
       ]);
 
       try {
          $wedo = WeDo::findOrFail($id);
          $img_path = '';
          if ($request->file('image')) {
 
             if ($wedo->image != null || $wedo->image != '') {
                Storage::delete('public/wedo/' . $wedo->image);
             }
 
             $image_file = $request->file('image');
             $img_path = time() . '.' . $request->file('image')->getClientOriginalExtension();
             $image_file->storeAs('public/wedo', $img_path);
          } else {
             $img_path = $wedo->image;
          }
 
 
 
          $wedo->title = $request->title ?? "";
          $wedo->description = $request->description ?? "";
          $wedo->image = $img_path ?? "";
          $wedo->update();
       } catch (\Exception $e) {
          return redirect()->back()->with('error', $e->getMessage());
       }
 
       return redirect()->route('wedo_list')->with('success', 'We do updated Successfully');
    }
 
 
    public function wedo_delete($id)
    {
 
       try {
          $wedo = WeDo::findOrFail($id);
          
          if ($wedo->image != null || $wedo->image != '') {
             Storage::delete('public/wedo/' . $wedo->image);
          }
          $wedo->delete();
       } catch (\Exception $e) {
          return redirect()->back()->with('error', $e->getMessage());
       }
 
       return redirect()->route('wedo_list')->with('success', 'We do Delete Successfully'); 
    }
}
