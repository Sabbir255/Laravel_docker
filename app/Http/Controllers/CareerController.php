<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CareerController extends Controller
{
    public function career_list()
    {
       $career = Career::all();
       return view('pages.career.career_list', compact('career'));
    }
    public function career_create()
    {
       return view('pages.career.career_create');
    }
 
 
    public function career_store(Request $request)
    {
       $request->validate([
          'title' => 'required|max:200',
          'description' => 'required|max:200',
          'image' => 'required|image|mimes:jpeg,png,jpg|max:600',
       ]);
 
       try {
          $career = new Career();
 
          $img_path = '';
          if ($request->file('image')) {
             $image_file = $request->file('image');
             $img_path = time() . '.' . $request->file('image')->getClientOriginalExtension();
             $image_file->storeAs('public/career', $img_path);
          }
 
 
 
          $career->title = $request->title ?? "";
          $career->description = $request->description ?? "";
          $career->image = $img_path ?? "";
          $career->save();
       } catch (\Exception $e) {
          return redirect()->back()->with('error', $e->getMessage());
       }
 
       return redirect()->route("career_list")->with('success', 'Career Added Successfully');
    }
 
 
    public function career_edit($id)
    {
       $edit_data = Career::findOrFail($id);
       return view('pages.career.career_create', compact('edit_data'));
    }
 
 
 
    public function career_update(Request $request, $id)
    {
       $request->validate([
          'title' => 'required|max:200',
          'description' => 'required|max:200',
          'image' => 'nullable|image|mimes:jpeg,png,jpg|max:600',
       ]);
 
       try {
          $career = Career::findOrFail($id);
          $img_path = '';
          if ($request->file('image')) {
 
             if ($career->image != null || $career->image != '') {
                Storage::delete('public/career/' . $career->image);
             }
 
             $image_file = $request->file('image');
             $img_path = time() . '.' . $request->file('image')->getClientOriginalExtension();
             $image_file->storeAs('public/career', $img_path);
          } else {
             $img_path = $career->image;
          }
 
 
 
          $career->title = $request->title ?? "";
          $career->description = $request->description ?? "";
          $career->image = $img_path ?? "";
          $career->update();
       } catch (\Exception $e) {
          return redirect()->back()->with('error', $e->getMessage());
       }
 
       return redirect()->route('career_list')->with('success', 'Career Updated Successfully');
    }
 
 
    public function career_delete($id)
    {
 
       try {
          $career = Career::findOrFail($id);
          
          if ($career->image != null || $career->image != '') {
             Storage::delete('public/career/' . $career->image);
          }
          $career->delete();
       } catch (\Exception $e) {
          return redirect()->back()->with('error', $e->getMessage());
       }
 
       return redirect()->route('career_list')->with('success', 'Career Delete Successfully');
    }
 }
 
