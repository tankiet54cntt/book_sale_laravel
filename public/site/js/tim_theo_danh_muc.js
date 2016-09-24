$(document).ready(function(){
	function ChangeToSlug(name)
                {
                    var title, slug;          
                    //Lấy text từ thẻ input title 
                    title = name;
                    //Đổi chữ hoa thành chữ thường
                    slug = title.toLowerCase();
                    //Đổi ký tự có dấu thành không dấu
                    slug = slug.replace(/á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ|å|ä|æ|ā|ą|ǻ|ǎ/gi, 'a');
                    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|ë|ē|ĕ|ę|ė/gi, 'e');
                    slug = slug.replace(/í|ì|ỉ|ĩ|ị|î|ï|ī|ĭ|ǐ|į|ı/gi, 'i');
                    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|ö|ø|ǿ|ǒ|ō|ŏ|ő/gi, 'o');
                    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|û|ū|ŭ|ü|ů|ű|ų|ǔ|ǖ|ǘ|ǚ|ǜ/gi, 'u');
                    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ|ÿ|ŷ/gi, 'y');
                    slug = slug.replace(/ź|ż|ž/gi, 'z');
                    slug = slug.replace(/đ/gi, 'd');
                    //Xóa các ký tự đặt biệt
                    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '-');
                    //Đổi khoảng trắng thành ký tự gạch ngang
                    slug = slug.replace(/ /gi, "-");
                    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
                    slug = slug.replace(/\-\-\-\-\-/gi, '-');
                    slug = slug.replace(/\-\-\-\-/gi, '-');
                    slug = slug.replace(/\-\-\-/gi, '-');
                    slug = slug.replace(/\-\-/gi, '-');
                    //Xóa các ký tự gạch ngang ở đầu và cuối
                    slug = '@' + slug + '@';
                    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                    return slug;
                }
	$(".danh_muc_cha").click(function()
	{
		 var ten_danh_muc= $(this).text();
		 var slug= ChangeToSlug(ten_danh_muc);
		 var url=base_url+"tim-kiem-theo-danh-muc/tukhoa=";
		 $.ajax({
		 	url : url+slug,
		 	type:"GET",
		 	cache:false,
		 	data:{},
		 	success:function(ketqua)
		 	{
		 			window.location=url+slug;
		 	}

		 });
	});
});