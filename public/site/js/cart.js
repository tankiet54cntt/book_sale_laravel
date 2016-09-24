$(document).ready(function(){
    // khi click add to cart
		//$(".yourcart").on("click",function(){
		$(document).on('click','.yourcart', function(){
	      var id =parseInt($(this).attr("data-id")); // chuyển về dạng số
	      var slug=$(this).attr("title");
	       //$(".notifyjs-corner").fadeIn("fast").delay(3000).fadeOut();
	       $.ajax({
	       		url: base_url+"mua-hang/"+id+"/"+slug,
	       		type : 'GET',
	       		cache:false,
	       		data:{},
	       		success: function(result){
				if(result){
					
					// $(".addtext").text("Sách đã được thêm vào giỏ hàng");
					 $(".add_cart").fadeIn("fast").delay(3000).fadeOut();
	         		 $("#giohang").load(base_url+" #giohang");  // chỉ load trên giỏ hàng thôi
					}
	        	}
	      	});
	       });
	
 });
