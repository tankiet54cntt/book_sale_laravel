<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Writer;
class WritersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list=Writer::orderby('id','DESC')->get();
        return View('admin.writers.list',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('admin.writers.add');
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
                    'txt_writer_slug'=>'unique:writers,slug',
                    'txt_writer'=>'required|unique:writers,name',
                ],
                [
                    'txt_writer_slug.unique'=>'Tên Tác giả đã tồn tại',
                    'txt_writer.required'=>'Tên Tác giả Không được bỏ trống',
                    'txt_writer.unique'=>'Tên Tác Giả đã tồn tại',
                ]
            );
       // Kiểm tra thành công thì thêm vào
        $writer=new Writer;
        $writer->name=$request->txt_writer;
        $writer->slug=changeTitle($request->txt_writer);
        $writer->story=$request->txt_story;
        $writer->save();
        // chuyển tới trang danh sách
        return redirect()->route('writers.index')->with(['flash_level'=>'success','flash_message'=>'Thêm Tác Giả Thành Công']);
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
        $writer_edit=Writer::findOrFail($id);
        return View('admin.writers.edit',compact('writer_edit'));
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
                    'txt_writer'=>'required',
                ],
                [
                    'txt_writer.required'=>'Tên Tác giả Không được bỏ trống'
                ]
            );

        $writer_edit=Writer::findOrFail($id);
        $writer_edit->name=$request->txt_writer;
        $writer_edit->slug=changeTitle($request->txt_writer);
        $writer_edit->story=$request->txt_story;
        $writer_edit->save();
        // chuyển tới trang danh sách
        return redirect()->route('writers.index')->with(['flash_level'=>'success','flash_message'=>'Sửa thông tin tác giả thành công']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $writer=Writer::findOrFail($id);
        $writer->delete();
        // chuyển tới trang danh sách
        return redirect()->route('writers.index')->with(['flash_level'=>'success','flash_message'=>'Xóa thành công']);
    }
}
