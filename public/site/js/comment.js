$(document).ready(function(){
	$(".btn_comment").on("click",function(){
		   if($("#ten_an").val()=="")
		   {
		   	  $(".show_login").show();
		   }
		   else
		   {
		   	  $("#error_comment").remove();
		   		if($("#txtComment").val()=="")
		   		{
		   			$("#error_noidung_comment").append('<span id="error_comment"> Chưa nhập nội dung comment</span>');
		   			return ;
		   		}
		   		else
		   		{
		   			var book_id=parseInt($(this).attr("bookid"));
		   			var content=$("#txtComment").val();
		   			var user_id=parseInt($("#ten_an").val());
		   			var dem_comment=parseInt($("#dem_comment").text());
		   			// gửi ajax
		   			$.ajax({
		   				url: base_url+"comment/"+book_id,
		   				type: "GET",
		   				cache: false,
		   				data: {"user_id":user_id,"content":content},
		   				success: function(ketqua)
		   				{
		   						if(ketqua)
		   						{
		   							$("#txtComment").val("");  // xóa nội dung comment
		   							
		   							$("#dem_comment").text((dem_comment+1));  // hiển thị số comment trong bài chi tiết sách

		   							$(".comment-list").prepend(ketqua);// hiển thị bình luận vừa được thêm vào
		   							
		   						}
		   				}
		   			});
		   		}
		   }
	});

	// khi click vào đóng login
	$("#dong_login").on("click",function(){
			$(".show_login").hide();
	});
});