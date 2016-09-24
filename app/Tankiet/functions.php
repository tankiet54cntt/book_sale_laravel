<?php

// Mở composer.json
// Thêm vào trong "autoload" chuỗi sau
// "files": [
//         "app/function/function.php"
// ]

// Chạy cmd : composer  dumpautoload

function changeTitle($str,$strSymbol='-',$case=MB_CASE_LOWER){// MB_CASE_UPPER / MB_CASE_TITLE / MB_CASE_LOWER
  $str=trim($str);
  if ($str=="") return "";
  $str =str_replace('"','',$str);
  $str =str_replace("'",'',$str);
  $str = stripUnicode($str);
  $str = mb_convert_case($str,$case,'utf-8');
  $str = preg_replace('/[\W|_]+/',$strSymbol,$str);
  return $str;
}

function stripUnicode($str){
  if(!$str) return '';
  //$str = str_replace($a, $b, $str);
  $unicode = array(
    'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ|å|ä|æ|ā|ą|ǻ|ǎ',
    'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ|Å|Ä|Æ|Ā|Ą|Ǻ|Ǎ',
    'ae'=>'ǽ',
    'AE'=>'Ǽ',
    'c'=>'ć|ç|ĉ|ċ|č',
    'C'=>'Ć|Ĉ|Ĉ|Ċ|Č',
    'd'=>'đ|ď',
    'D'=>'Đ|Ď',
    'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|ë|ē|ĕ|ę|ė',
    'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ|Ë|Ē|Ĕ|Ę|Ė',
    'f'=>'ƒ',
    'F'=>'',
    'g'=>'ĝ|ğ|ġ|ģ',
    'G'=>'Ĝ|Ğ|Ġ|Ģ',
    'h'=>'ĥ|ħ',
    'H'=>'Ĥ|Ħ',
    'i'=>'í|ì|ỉ|ĩ|ị|î|ï|ī|ĭ|ǐ|į|ı',   
    'I'=>'Í|Ì|Ỉ|Ĩ|Ị|Î|Ï|Ī|Ĭ|Ǐ|Į|İ',
    'ij'=>'ĳ',    
    'IJ'=>'Ĳ',
    'j'=>'ĵ',   
    'J'=>'Ĵ',
    'k'=>'ķ',   
    'K'=>'Ķ',
    'l'=>'ĺ|ļ|ľ|ŀ|ł',   
    'L'=>'Ĺ|Ļ|Ľ|Ŀ|Ł',
    'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|ö|ø|ǿ|ǒ|ō|ŏ|ő',
    'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ|Ö|Ø|Ǿ|Ǒ|Ō|Ŏ|Ő',
    'Oe'=>'œ',
    'OE'=>'Œ',
    'n'=>'ñ|ń|ņ|ň|ŉ',
    'N'=>'Ñ|Ń|Ņ|Ň',
    'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|û|ū|ŭ|ü|ů|ű|ų|ǔ|ǖ|ǘ|ǚ|ǜ',
    'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự|Û|Ū|Ŭ|Ü|Ů|Ű|Ų|Ǔ|Ǖ|Ǘ|Ǚ|Ǜ',
    's'=>'ŕ|ŗ|ř',
    'R'=>'Ŕ|Ŗ|Ř',
    's'=>'ß|ſ|ś|ŝ|ş|š',
    'S'=>'Ś|Ŝ|Ş|Š',
    't'=>'ţ|ť|ŧ',
    'T'=>'Ţ|Ť|Ŧ',
    'w'=>'ŵ',
    'W'=>'Ŵ',
    'y'=>'ý|ỳ|ỷ|ỹ|ỵ|ÿ|ŷ',
    'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ|Ÿ|Ŷ',
    'z'=>'ź|ż|ž',
    'Z'=>'Ź|Ż|Ž'
  );
  foreach($unicode as $khongdau=>$codau) {
    $arr=explode("|",$codau);
    $str = str_replace($arr,$khongdau,$str);
  }
  return $str;
}
 // tạo hàm phân cấp đa cấp hay nhất // sủ dụng hàm đệ quy
function cate_parent($data,$parent=0,$str='--',$select=0){
    foreach($data as $key=>$value){
        $id=$value['id'];//$value->id là id của bảng cate nếu $value["id"] thì bên controller  phải $parent=Cate::select('id','name','parent_id')->get()->toArray nhé nếu ko có thì nó là object;
        $name=$value['name'];
        // nếu cái nào có status là hiện thì mới cho hiện ra
     //   if($value['status']==1){
          if($value['parent_id']==$parent){ // nếu parent_id=0 thì cấp 1 hiện ra parent_id=$id thì nó là cấp thứ $id thôi
          if($select!=0 && $id==$select)
          {
              echo  "<option value='$id' selected='selected'>$str $name</option>";  // cái này hiển thị cái selected thôi hỗ trợ cho việc sửa  (hiện ra những danh mục là con của parent_id=0)
          }
          else{
              echo  "<option value='$id' >$str $name</option>";  // hiện ra danh mục có parent_id=0
          }
              cate_parent($data,$id,$str.'--',$select); // đệ quy
          }
     // }
    }
}
// hỗ trợ cho bên book (do ta muốn cái danh mục có parent_id=0 ko hiện ra)
function cate_parent_book($data,$parent,$str='--',$select=0){
    foreach($data as $key=>$value){
        $id=$value['id'];//$value->id là id của bảng cate nếu $value["id"] thì bên controller  phải $parent=Cate::select('id','name','parent_id')->get()->toArray nhé nếu ko có thì nó là object;
        $name=$value['name'];
        // nếu cái nào có status là hiện thì mới cho hiện ra
     //   if($value['status']==1){
        if($value['parent_id']==$parent){ // nếu parent_id=0 thì cấp 1 hiện ra parent_id=$id thì nó là cấp thứ $id thôi
          if($select!=0 && $id==$select)
          {
              echo  "<option value='$id' selected='selected'>$str $name</option>";  // cái này hiển thị cái selected thôi hỗ trợ cho việc sửa 
          }
          else{
              echo  "<option value='$id' disabled='disabled'>$str $name</option>"; //dùng thuộc tính disabled để ko được chọn
          }
              cate_parent($data,$id,$str.'--',$select); // đệ quy
          }
        }
     
}
// hiện sách theo thể loại
function Sach_Theo_TheLoai($parent_id){
    $arr=array();
  // theo id luôn
   $book=DB::table('books')->where([['category_id',$parent_id],['published',1]])->get();
                    foreach ($book as $key => $b) {
                        $arr[]=array(
                            'id'=>$b->id,
                            'category_id'=>$b->category_id,
                            'title'=>$b->title,
                            'slug'=>$b->slug,
                            'image'=>$b->image,
                            'info'=>$b->info,
                            'content'=>$b->content,
                            'price'=>$b->price,
                            'sale_price'=>$b->sale_price,
                            'pages'=>$b->pages,
                            "link_download"=>$b->link_download,
                            "published"=>$b->published,
                            "created_at"=>$b->created_at,
                            "updated_at"=>$b->updated_at
                            );
                    }
    // parent_id con của parent_id cha
    $cate=DB::table('categories')->where('parent_id',$parent_id)->get();
        foreach ($cate as $key => $value) {
            $book=DB::table('books')->where([['category_id',$value->id],['published',1]])->get();
                    foreach ($book as $key => $b) {
                        $arr[]=array(
                            'id'=>$b->id,
                            'category_id'=>$b->category_id,
                            'title'=>$b->title,
                            'slug'=>$b->slug,
                            'image'=>$b->image,
                            'info'=>$b->info,
                            'content'=>$b->content,
                            'price'=>$b->price,
                            'sale_price'=>$b->sale_price,
                            'pages'=>$b->pages,
                            "link_download"=>$b->link_download,
                            "published"=>$b->published,
                            "created_at"=>$b->created_at,
                            "updated_at"=>$b->updated_at
                            );
                    }
          }

      // parent_id còn của parent_id con  
      foreach ($cate as $key => $cate_con)
      {
        $cate=DB::table('categories')->where('parent_id',$cate_con->id)->get();
        foreach ($cate as $key => $value) {
            $book=DB::table('books')->where([['category_id',$value->id],['published',1]])->get();
                    foreach ($book as $key => $b) {
                        $arr[]=array(
                            'id'=>$b->id,
                            'category_id'=>$b->category_id,
                            'title'=>$b->title,
                            'slug'=>$b->slug,
                            'image'=>$b->image,
                            'info'=>$b->info,
                            'content'=>$b->content,
                            'price'=>$b->price,
                            'sale_price'=>$b->sale_price,
                            'pages'=>$b->pages,
                            "link_download"=>$b->link_download,
                            "published"=>$b->published,
                            "created_at"=>$b->created_at,
                            "updated_at"=>$b->updated_at
                            );
                    }
          }
      }
  rsort($arr);  // sắp xếp theo id giảm dần đó
  return $arr;
}

// hiển thị submenu toàn bộ luôn cap n
function sub_menu_cap_n($data,$id,$cate_id){
    echo "<ul>";
    foreach ($data as $key => $item) {
          if($item["parent_id"]==$id)
          {
            // chủ yếu để cho nó hiện class được chọn trong category thôi chứ ko có gì cả dựa và id của thằng được chọn nêu trùng thì active lên thôi
              if($item['id']==$cate_id){ 
                $str="class='active_cate'";
                }
              else
              {
                $str="class=''";
              }
              $url=$item["slug"].".html";  // danh-muc- ở đau ra vậy ta ?
              echo "<li><a href='$url' <?php echo $str; ?> ".$item['name']."</a>";
                sub_menu_cap_n($data,$item["id"],$cate_id); // để quy // muốn có đệ quy thì phải có điều kiện
              echo "</li>";
          }
    }
    echo "</ul>";
}

/*
function sub_menu_more($data,$id)
{
    echo "<ul>";
    foreach ($data as $key => $item) {
          if($item["parent_id"]==$id)
          {
            // chủ yếu để cho nó hiện class được chọn trong category thôi chứ ko có gì cả dựa và id của thằng được chọn nêu trùng thì active lên thôi
             
              $url="danh-muc/".$item["slug"].".html";  // danh-muc- ở đau ra vậy ta ?
              echo "<li ><a href='$url'?> ".$item['name']."</a>";
                sub_menu_more($data,$item["id"]); // để quy // muốn có đệ quy thì phải có điều kiện
              echo "</li>";
          }
    }
    echo "</ul>";

}
*/

function DSTG($data)
{
  foreach ($data as $key => $item) {
      $writer=DB::tables('writers')->join('books_writers','writers.id','books_writers.writer_id')->json('books','books.id','books_writers.book_id')->where('books.category_id',$item['category_id'])->get();
      $arr=array();
      foreach ($writer as $key => $b) {
                        $arr[]=array(
                            'id'=>$b->id,
                            'name'=>$b->name,
                            'story'=>$b->story,
                            "created_at"=>$b->created_at,
                            "updated_at"=>$b->updated_at
                            );
                    }
    rsort($arr);  // sắp xếp theo id giảm dần đó
    return $arr;
  }
}


function tim_id_parent($data)
{
    if($data->parent_id==0)
       return $data->id;
    else
    {
     $cate=DB::table('categories')->where('id',$data->parent_id)->first();
       return tim_id_parent($cate);
    }
}


// tạo mã xác thực khi thực hiện quên mật khẩu
function generate_code()
{
  $random_number=rand(1000000,9999999);
  $code=md5($random_number);
  return $code;
}
