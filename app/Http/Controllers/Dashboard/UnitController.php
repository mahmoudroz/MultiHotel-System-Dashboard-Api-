<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\RequiredIf;

class UnitController extends BackEndController
{
    public function __construct(Unit $model)
    {
        parent::__construct($model);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //get all data of Model
        $rows = $this->model->with('category')->when($request->search,function($q) use ($request){
            $q->whereTranslationLike('name','%' .$request->search. '%')
              ->orWhere('status','like','%'.$request->search.'%')
              ->orWhereHas('category',function($q) use($request){
                $q->whereTranslationLike('name','%'.$request->search.'%');
              });
        });
        $rows = $this->filter($rows,$request);
        $module_name_plural = $this->getClassNameFromModel();
        $module_name_singular = $this->getSingularModelName();
        // return $module_name_plural;
        return view('dashboard.' . $module_name_plural . '.index', compact('rows', 'module_name_singular', 'module_name_plural'));


    }

    public function store(Request $request)
    {
        $request->validate([
            'ar.name'          => 'required|min:3|max:60',
            'en.name'          => 'required|min:3|max:60',
            'status'           => ['required',Rule::in('active','pending')],
            'category_id'      => 'required|exists:categories,id',
            'image'            =>'nullable | image',
            'hotel_id'         => new RequiredIf(auth()->user()->hotel_id === null),
        ]);
        $request_data = $request->except(['image','hotel_id']);
        if ($request->image) {
            $request_data['image'] = $this->uploadImage($request->image, 'units');
        }
        if(auth()->user()->hotel_id == null)
        {
            $request_data['hotel_id']=$request->hotel_id;
        }else{
            $request_data['hotel_id']=auth()->user()->hotel_id;
        }
        Unit::create($request_data);
        session()->flash('success', __('site.add_successfuly'));
        return redirect()->route('dashboard.'.$this->getClassNameFromModel().'.index');
    }

    public function update(Request $request, $id)
    {
        $unit = $this->model->findOrFail($id);
        $request->validate([
            'ar.name'          => ['required', 'min:3'],
            'en.name'          => ['required', 'max:60'],
            'status'           => ['required',Rule::in('active','pending')],
            'category_id'      => ['required','exists:categories,id'],
            'hotel_id'         => new RequiredIf(auth()->user()->hotel_id === null),

        ]);
        $request_data = $request->except(['image','hotel_id']);
        if ($request->image) {
            if ($unit->image != null) {
                Storage::disk('public_uploads')->delete('/units/' . $unit->image);
            }
            $request_data['image'] = $this->uploadImage($request->image, 'units');
        } //end of if
        if(auth()->user()->hotel_id == null)
        {
            $request_data['hotel_id']=$request->hotel_id;
        }else{
            $request_data['hotel_id']=auth()->user()->hotel_id;
        }
        $unit->update($request_data);
        session()->flash('success', __('site.updated_successfuly'));
        return redirect()->route('dashboard.'.$this->getClassNameFromModel().'.index');

    }

    public function destroy($id, Request $request)
    {
        $unit = $this->model->findOrFail($id);
        if ($unit->image != null) {
            Storage::disk('public_uploads')->delete('/units/' . $unit->image);
        }
        $unit->delete();
        session()->flash('success', __('site.deleted_successfuly'));
        return redirect()->route('dashboard.'.$this->getClassNameFromModel().'.index');
    }

}
