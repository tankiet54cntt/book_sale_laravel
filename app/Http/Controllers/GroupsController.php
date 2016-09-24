<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Group;
class GroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list=Group::orderby('id','DESC')->get();
        return View('admin.groups.list',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('admin.groups.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
                [
                    'txt_group'=>'required|unique:groups,name|min:3'
                ],
                [
                    'txt_group.required'=>'Tên Nhóm Không bỏ trống',
                    'txt_group.unique'=>'Tên Nhóm đã tồn tại',
                    'txt_group.min'=>'Tên Nhóm ít nhất 3 ký tự'
                ]
            );

        $group=new Group;
        $group->name=$request->txt_group;
        $group->description=$request->txt_description;
        $group->level=$request->rdoLevel;
        $group->save();

        return redirect()->route('groups.index')->with(['flash_level'=>'success','flash_message'=>'Thêm Thành Công']);
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
        $group_edit=Group::findOrFail($id);
        return View('admin.groups.edit',compact('group_edit'));
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
        $this->validate($request,
                [
                    'txt_group'=>'required|min:3'
                ],
                [
                    'txt_group.required'=>'Tên Nhóm Không bỏ trống',
                    'txt_group.min'=>'Tên Nhóm ít nhất 3 ký tự'
                ]
            );
        $group=Group::findOrFail($id);
        $group->name=$request->txt_group;
        $group->description=$request->txt_description;
        $group->level=$request->rdoLevel;
        $group->save();

        return redirect()->route('groups.index')->with(['flash_level'=>'success','flash_message'=>'Sửa Thành Công']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $group=Group::findOrFail($id);
       $group->delete();
        return redirect()->route('groups.index')->with(['flash_level'=>'success','flash_message'=>'Xóa Thành Công']);
    }
}
