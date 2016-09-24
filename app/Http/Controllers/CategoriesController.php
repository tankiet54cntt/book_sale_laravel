<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

// thêm Model
use App\Category;
class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list=Category::select('id','parent_id','name','description')->orderby('id','DESC')->get();

        return View('admin.categories.list',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent=Category::select('id','name','slug','description','parent_id')->get(); // để hiện thị chọn category
        return View('admin.categories.add',compact('parent')); // truyền biến parent qua view của chúng ta
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation trong laravel 5.3
        $this->validate($request,
                [
                    'txtCateName_slug'=>'unique:categories,slug',
                    'txtCateName'=>'required|unique:categories,name',
                    'txtDescription'=>'required',
                ],
                [
                    'txtCateName_slug.unique'=>'Category đã tồn tại',
                    'txtCateName.required'=>'Category Không được bỏ trống',
                    'txtCateName.unique'=>'Category đã tồn tại',
                    'txtDescription.required'=>'Mô tả không được bỏ trống'
                ]
            );
        // kiểm tra lỗi ở trên ....
        // nếu ko có lỗi
        if($request->sltParent=="")
            $request->sltParent=0;
        $cate=new Category;
        $cate->parent_id=$request->sltParent;
        $cate->name=$request->txtCateName;
        $cate->slug=changeTitle($request->txtCateName);
        $cate->description=$request->txtDescription;
        $cate->save(); // lưu vào csdl
        // chuyển về trang list cate
        // chuyển trang
        return redirect()->route('categories.index')->with(['flash_level'=>'success','flash_message'=>'Thêm Category Thành Công']);
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
        $parent=Category::select('id','name','description','parent_id')->get(); // để hiện thị chọn category
        $cate_edit=Category::findOrFail($id); // find : tìm chính xác id đó còn findOrFail nếu tìm chính xác ko thấy id thì báo lỗi
        return View('admin.categories.edit',compact('cate_edit','parent'));
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
        // validation trong laravel 5.3
        $this->validate($request,
                [
                    'txtCateName'=>'required',
                    'txtDescription'=>'required',
                ],
                [
                    'txtCateName.required'=>'Category Không được bỏ trống',
                    'txtDescription.required'=>'Mô tả không được bỏ trống'
                ]
            );
        // kiểm tra lỗi ở trên ....
        // nếu ko có lỗi
        $cate_edit=Category::findOrFail($id);
        $cate_edit->parent_id=$request->sltParent;
        $cate_edit->name=$request->txtCateName;
        $cate_edit->slug=changeTitle($request->txtCateName);
        $cate_edit->description=$request->txtDescription;
        $cate_edit->save(); // lưu vào csdl
        // chuyển về trang list cate
        // chuyển trang
        return redirect()->route('categories.index')->with(['flash_level'=>'success','flash_message'=>'Sửa Category Thành Công']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //nếu không có parent thì được phép xóa 
        $parent=Category::where('parent_id',$id)->count();

        //nếu có parent thì ko được xóa
         if($parent==0){
                $cate=Category::findOrFail($id);
                $cate->delete();
                // chuyển tới index
                return redirect()->route('categories.index')->with(['flash_level'=>'success','flash_message'=>'Success Complete Delete Category']);
            }
        else{
                return redirect()->route('categories.index')->with(['flash_level'=>'danger','flash_message'=>'You Cannot delete this Category!']);; // trả về trang danh sách và hiện thông báo lỗi
           }
    }
}
