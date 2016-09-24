<?php
// validate image : 'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use App\Category;
use App\Book;
use App\Writer;
use App\Book_Writer;
// sử dụng File để xử lý hình ảnh
use File;
use Illuminate\Support\Facades\Input; // sử dụng thư viện Input (chỗ kiểm tra file)

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $writer=Writer::all();
        $category=Category::all();
        $list=Book::orderby('id','DESC')->get();
        return View('admin.books.list',compact('writer','list','category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $writer=Writer::all();
        $category=Category::all();
        return View('admin.books.add',compact('writer','category'));
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
                    'sltParent'=>'required',
                    'txtTitle_slug'=>'unique:books,slug',
                    'txtTitle'=>'required|min:3|unique:books,title',
                    'fImages'=>'mimes:jpeg,jpg,png,gif|required|max:10000', // max 10000kb
                    'txtPrice'=>'required|numeric',
                    'txtSale_price'=>'required|numeric',
                    'txtSotrang'=>'required|numeric',
                    'txtIntro'=>'required',
                    'txtContent'=>'required',
                    'sltParent_tacgia'=>'required'
                ],
                [
                    'sltParent.required'=>'Sách phải có danh mục',
                    'txtTitle_slug.unique'=>'Title đã tồn tại',
                    'txtTitle.required'=>'Title không bỏ trống',
                    'txtTitle.min'=>'Title ít nhất 3 ký tự',
                    'txtTitle.unique'=>'Title đã tồn tại',
                    'fImages.mimes'=>'chưa đúng định dạng ảnh', // max 10000kb
                    'fImages.required'=>'ảnh không bỏ trống',
                    'fImages.max'=>'ảnh tối đa 10000KB',
                    'txtPrice.required'=>'Giá tiền gốc ko bỏ trống',
                    'txtPrice.numeric'=>'Giá tiền gốc phải là con số',
                    'txtSale_price.required'=>'Giá bìa không bỏ trống',
                    'txtSale_price.numeric'=>'Giá bìa phải là con số',
                    'txtSotrang.required'=>'Tổng số trang không bỏ trống',
                    'txtSotrang.numeric'=>'Tổng số trang phải là con số',
                    'txtIntro.required'=>'Intro không bỏ trống',
                    'txtContent.required'=>'Nội dung không được bỏ trống',
                    'sltParent_tacgia.required'=>'Sách phải có tác giả'
                ]
            );
        
        // khi không có lỗi
         // lấy ra tên hình     
         $file_name=rand().'_'.$request->file('fImages')->getClientOriginalName();// Lấy ra tên hình // ta them rand().'_' để cho nó khỏi bị trùng
         $book = new Book;
         $book->category_id=$request->sltParent;
         $book->title=$request->txtTitle;
         $book->slug=ChangeTitle($request->txtTitle);
         $book->image=$file_name;
         $book->info=$request->txtIntro;
         $book->content=$request->txtContent;
         $book->price=$request->txtPrice;
         $book->sale_price=$request->txtSale_price;
         $book->pages=$request->txtSotrang;
         $book->link_download=$request->txt_linkdown;
         $book->published=$request->rdoStatus;
         $book->hot_banchay=$request->rdoHot;
         // chuyển hình ảnh vào thư mục
         $request->file('fImages')->move('resources/upload/book/',$file_name);
         // lưu vào csdl
         $book->save();
         // lấy ra id book vừa được thêm
         $id_book=$book->id;

         // PHẦN BOOK-WRITER
          $tacgia = $request->sltParent_tacgia;  // do dữ liệu trong select multipe là mảng nên ta có ntn
          foreach ($tacgia as $key => $value) {
              $book_writer=new Book_Writer;
              $book_writer->book_id=$id_book;
              $book_writer->writer_id=$value;
              // lưu vào csdl
              $book_writer->save();
          }
        return redirect()->route('books.index')->with(['flash_level'=>'success','flash_message'=>'Thêm Thành Công']);
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
        $writer=Writer::all();
        $category=Category::all();
        $book_edit=Book::findOrFail($id);
        $book_writer=Book_Writer::where('book_id',$id)->get(); // để selected tác giả nào viết thôi
        return View('admin.books.edit',compact('writer','category','book_edit','book_writer'));
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
                    'sltParent'=>'required',
                    'txtTitle'=>'required|min:3',
                    'fImages'=>'mimes:jpeg,jpg,png,gif|max:10000', // max 10000kb
                    'txtPrice'=>'required|numeric',
                    'txtSale_price'=>'required|numeric',
                    'txtSotrang'=>'required|numeric',
                    'txtIntro'=>'required',
                    'txtContent'=>'required',
                    'sltParent_tacgia'=>'required'
                ],
                [
                    'sltParent.required'=>'Sách phải có danh mục',
                    'txtTitle.required'=>'Title không bỏ trống',
                    'txtTitle.min'=>'Title ít nhất 3 ký tự',
                    'fImages.mimes'=>'chưa đúng định dạng ảnh', // max 10000kb
                    'fImages.max'=>'ảnh tối đa 10000KB',
                    'txtPrice.required'=>'Giá tiền gốc ko bỏ trống',
                    'txtPrice.numeric'=>'Giá tiền gốc phải là con số',
                    'txtSale_price.required'=>'Giá bìa không bỏ trống',
                    'txtSale_price.numeric'=>'Giá bìa phải là con số',
                    'txtSotrang.required'=>'Tổng số trang không bỏ trống',
                    'txtSotrang.numeric'=>'Tổng số trang phải là con số',
                    'txtIntro.required'=>'Intro không bỏ trống',
                    'txtContent.required'=>'Nội dung không được bỏ trống',
                    'sltParent_tacgia.required'=>'Sách phải có tác giả'
                ]
            );
         // image current
            $anh_hientai="resources/upload/book/".$request->image_current;
         $book=Book::findOrFail($id);
        // kiểm tra xem có thay đổi ảnh ko nếu có thì xóa ảnh cũ và thêm ảnh mới đó vào
         if(Input::hasFile('fImages'))  // nếu như có file ảnh khác được thêm vào
         {
            
            echo $anh_hientai;
            // kiểm tra thử ảnh đó có trong thư mục ko nếu có thì xóa
            // xóa ảnh hiện tại đi
            if(File::exists($anh_hientai))  // nếu tồn tại ảnh cũ và xóa nó đi
            {
                echo "có";
                File::delete($anh_hientai); 
            }
        
            // thêm ảnh mới sửa vào
            $file_name=rand().'_'.$request->file('fImages')->getClientOriginalName();
            $book->image=$file_name;
            // bỏ vào thư mục ảnh trong laravel
            $request->file('fImages')->move('resources/upload/book/',$file_name);
        
         }
    
        // thực hiện sửa
         $book->category_id=$request->sltParent;
         $book->title=$request->txtTitle;
         $book->slug=ChangeTitle($request->txtTitle);
         $book->info=$request->txtIntro;
         $book->content=$request->txtContent;
         $book->price=$request->txtPrice;
         $book->sale_price=$request->txtSale_price;
         $book->pages=$request->txtSotrang;
         $book->link_download=$request->txt_linkdown;
         $book->published=$request->rdoStatus;
         $book->hot_banchay=$request->rdoHot;
         // lưu vào csdl
         $book->save();
        
         // làm việc bên book_writers
         $book_writer=Book_Writer::where('book_id',$id)->delete(); //xóa hết các dòng trong bảng bookswriter có id book đó
         $tacgia = $request->sltParent_tacgia;  // do dữ liệu trong select multipe là mảng nên ta có ntn
          foreach ($tacgia as $key => $value) {
              $book_writer=new Book_Writer;
              $book_writer->book_id=$id;
              $book_writer->writer_id=$value;
              // lưu vào csdl
              $book_writer->save();
          }

        return redirect()->route('books.index')->with(['flash_level'=>'success','flash_message'=>'Update Thành Công']);
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $book=Book::findOrFail($id);
       File::delete('resources/upload/book/'.$book->image);
       $book->delete();  // do ta đã ràng buộc khóa ngoại và định nghĩa cascade nên khi xóa bảng book ở bảng book_writer cũng xóa luôn
       return redirect()->route('books.index')->with(['flash_level'=>'success','flash_message'=>'Xóa Thành Công']);
    }
}
