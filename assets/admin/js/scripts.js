if ($('.js-example-basic-single').length) {
	$('.js-example-basic-single').select2();
}
if ($('.basic-select').length) {
	$('.basic-select').select2();
}

var successClick = function(msg){
    $.notify({

      // options

      title: '<strong></strong>',

      message: "<br>"+msg,

        icon: 'glyphicon glyphicon-ok',
    },{

      // settings

      element: 'body',

      //position: null,

      type: "success",

      //allow_dismiss: true,

      //newest_on_top: false,

      showProgressbar: false,

      placement: {

        from: "top",

        align: "left"

      },

      offset: 150,

      spacing: 10,

      z_index: 1031,

      delay: 3000,

      timer: 1000,

      url_target: '_blank',

      mouse_over: null,

      animate: {

        enter: 'animated fadeInDown',

        exit: 'animated fadeOutRight'

      },

      onShow: null,

      onShown: null,

      onClose: null,

      onClosed: null,

      icon_type: 'class',
    });
} 
if ($('.alert-success').length) {
		setTimeout(function(){
				$('.alert-success').hide();
		},3000);
}
function review () {
	$('.area_select').each(function(){
		var product = $(this).find('option:selected').data('product');
		if ($('.product_bill[data-product="'+product+'"]').length == 0) {
			var text = '<div class="row product_bill" data-product="'+product+'">\
			    <div class="col-md-12"> <h5 class="text-center">'+product+'</h5></div>\
			    <div class="col-md-4"> </br>\
		 		    <label class="control-lablel" >'+total_weight_name+' : <span class="total_weight"></span> </label> \
		         </div>\
		         <div class="col-md-4"> </br>\
		 		    <label class="control-lablel" >'+total_quantity_name+' : <span class="total_quantity"></span> </label> \
		         </div>\
		         <div class="col-md-4"> </br>\
		 		    <label class="control-lablel" >'+support_name+' : <span class="total_support"></span> </label> \
		         </div>\
		        \
			     </div></hr>';
			$('#products_div').append(text);
		}
	})
	product_bill();
}
$('#add_item').click(function(){
    
	if(typeof fertilization_types !== 'undefined'){
		var text  =  '<div class="row grv_item"> <a class="close_item">X</a>';
		text+='<div class="col-md-3">\
		          <label class="control-lablel" >'+fertilization_name+'</label>\
		          <select required name="item_id[]" class="form-control basic-select ">';
		$.each(stocks, function( index, value ) {
		       text+='<option value="'+index+'">'+value.name+'</option>';
		  });
		text+='</select></div>';
		text+='<div class="col-md-3">\
	          <label class="control-lablel" >'+type_name+'</label>\
	          <select required name="fertilization_type_id[]" class="form-control client-grv-product">';
		$.each(fertilization_types, function( index, value ) {
		       text+='<option value="'+value.id+'" data-name="'+value.quantity_name+'">'+value.name+'</option>';
		  });
		text+='</select></div>';
		//+fertilization_types[0].quantity_name+ // item_unit
		text +='<div class="col-md-3">\
			<label class="control-lablel quantity_unit" >'+quantity_name+'</label>\
	          <input type="number" required class="form-control" step="any" value="1" min=".01" name="quantity[]">\
			</div>';
		text +='<div class="col-md-3">\
				<label class="control-lablel" >'+date_name+'</label> \
	            <input name="date[]"   class="form-control"  type="date">\
		         </div>';
		
		text+='</div>';
	}else{
		var text  =  '<div class="row grv_item"> <a class="close_item">X</a>';
		text+='<div class="col-md-4">\
		          <label class="control-lablel" >'+fertilization_name+'</label>\
		          <select required name="item_id[]" class="form-control fertilization_type_id basic-select client-grv-product">';
		$.each(stocks, function( index, value ) {
		       text+='<option value="'+index+'">'+value.name+'</option>';
		  });
		text+='</select></div>';
		
		text +='<div class="col-md-4">\
			<label class="control-lablel" >'+quantity_name+'</label>\
	          <input type="number" required class="form-control" step="any" value="1" min=".01" name="quantity[]">\
			</div>';
		text +='<div class="col-md-4">\
				<label class="control-lablel" >'+date_name+'</label> \
	            <input name="date[]"   class="form-control"  type="date">\
		         </div>';
		
		text+='</div>';
	}
	$('.basic-select').select2().change(function(){
		console.log(11);
	});
    $('.basic-select').on('select2:selecting', function(e) {
	    console.log('Selecting: ' , e.params.args.data);
	  });
	
	$('#stocks_items').append(text);
	$('.close_item').click(function(){
		$(this).parent().remove();
	});
	$('.basic-select').select2();
	$('.client-grv-product').change(function(){
		var name = $(this).find('option:selected').data('name');
		$(this).parent().parent().find('.item_unit').html(name);
		if (typeof pesticide !== 'undefined') {
			$('.quantity_unit').text(name);
		};
		
		
	})
	$('.client_gr').change(function(){
			client_grv();
	});
	
})
$('.close_item').click(function(){
	$(this).parent().remove();
	review();
})
$('#stock_id').change(function(){
	var max = $(this).find('option:selected').data('max');
    $('#quantity').attr({'max':max});
})
function product_bill () {
    	$('.product_bill').each(function(){
    		var product =  $(this).data('product');
    		if ($('option:selected[data-product="'+product+'"]').length == 0) {
    			$(this).remove();
    		}
    		var  current = $(this);
    		var  total           =  0;
    	    var  total_quantity  =  0;
    	    var  total_support   =  0;
    	    var   total_weight   = 0;
    		$('option:selected[data-product="'+product+'"]').each(function(){
    		   var el  =  $(this).parent().parent().parent();
    		   var quantity    =  (parseFloat(el.find('.sell_quantity').val()) > 0)?parseFloat(el.find('.sell_quantity').val()):0;
    		   var weight      =  (el.find('.sell_weight').val() > 0)?el.find('.sell_weight').val():0;
    		   var discount    =  (parseFloat(el.find('.discount').val()) > 0)?parseFloat(el.find('.discount').val()):0;
    		   //var unit_price  =  (el.find('.unit_price').val() > 0)?el.find('.unit_price').val():0;
    		 //  var  item_price =  quantity*unit_price - (quantity*unit_price*discount/100);
    		   total_quantity +=  quantity;
    		  // total += item_price;
    		   total_weight     +=  quantity*weight;
    		   var support     = el.find(".area_select option:selected").data('support') ;
    		  // alert(support);
	    		if (support > 0) {
	    			total_support += support*weight*quantity;
	    		}
    		})
    		//current.find('.total_price').html(total);
	    	 current.find('.total_weight').html(total_weight.toFixed(2));
	    	 current.find('.total_support').html(total_support.toFixed(2));
	    	 current.find('.total_quantity').html(total_quantity.toFixed(2));
    	})
}
function update_sell () {
	var total           =  0;
	var  total_quantity =  0;
	var total_support   =  0;
	$('.sell_weight').each(function(e){
		var el          =  $(this).parent().parent();
		var quantity    =  (parseFloat(el.find('.sell_quantity').val()) > 0)?parseFloat(el.find('.sell_quantity').val()):0;
		var weight      =  (el.find('.sell_weight').val() > 0)?el.find('.sell_weight').val():0;
		el.find('.total_weight').html(weight*quantity);
		var discount    =  (parseFloat(el.find('.discount').val()) > 0)?parseFloat(el.find('.discount').val()):0;
		var unit_price  =  (el.find('.unit_price').val() > 0)?el.find('.unit_price').val():0;
		total           =   total + weight*quantity;
		var  item_price =  quantity*unit_price - (quantity*unit_price*discount/100);
		el.find('.sell_total').val(item_price);
		total_quantity +=  quantity;
		var support     = el.find(".area_select option:selected").data('support') ;
		if (support > 0) {
			total_support += (support*weight*quantity);
		}
	});
	$('#total_weight').html(total.toFixed(2));
	$('#total_quantity').html(total_quantity.toFixed(2));
	$('#total_support').html(total_support.toFixed(2));
	var total = 0;
	$('.sell_total').each(function(e){
		if ($(this).val() > 0) {
			total = total +  parseFloat($(this).val());
		}
	});
	$('#total_price').html(total);
	product_bill();
}
$('#add_sell').click(function(){
		var text  =  '<div class="row grv_item"> <a class="close_item">X</a>';
		text+='<div class="col-md-6">\
		          <label class="control-lablel" >'+client_name+'</label>\
		          <select required name="client_id[]" class="form-control basic-select">\
		           ';
		$.each(clients, function( index, value ) {
		       text+='<option  value="'+value.id+'">'+value.name+'</option>';
		  });
		text+='</select></div>';
		text+='<div class="col-md-6">\
		          <label class="control-lablel" >'+farm_name+'</label>\
		          <select required name="farm_id[]" class="form-control basic-select area_select">\
		           <option value="" disabled selected>'+choose_area_name+'</option>';
		$.each(farms, function( index, value ) {
		       text+='<option data-product="'+value.product+'" data-support="'+value.support+'" value="'+value.id+'">'+value.name+'</option>';
		  });
		text+='</select></div>';
		text +='<div class="col-md-4">\
				<label class="control-lablel" >'+quantity_name+'</label> \
	            <input name="quantity[]"  required min="1"  class="form-control sell_quantity"  type="number">\
		         </div>';
		text +='<div class="col-md-4">\
				<label class="control-lablel" >'+unit_weight_name+'</label> \
	            <input name="unit_weight[]" required value="1" min="0" step="any"  class="form-control sell_weight"  type="number">\
		         </div>';
		text+='<div class="col-md-4">\
		          <label class="control-lablel" >'+package_name+'</label>\
		          <select required name="stock_id[]" class="form-control basic-select ">\
		           <option value="" disabled selected>'+package_name+'</option>';
		$.each(packages, function( index, value ) {
		       text+='<option  value="'+value.id+'">'+value.name+'</option>';
		  });
		text+='</select></div>';
		// text +='<div class="col-md-2">\
		// 		<label class="control-lablel" >'+discount_name+'</label> \
	 //            <input name="discount[]" max="100" required  min="0" step="any"  class="form-control discount"  type="number">\
		//          </div>';
		// text +='<div class="col-md-2">\
		// 		<label class="control-lablel" >'+total_price_name+'</label> \
	 //            <input name="total_price[]" required min="0" step="any"  class="form-control sell_total"  type="number">\
		//          </div>';
		// text +='<div class="col-md-6"> </br>\
		// 		    <label class="control-lablel" >'+total_weight_name+' : <span class="total_weight"></span> </label> \
		//         </div>'; 
		// text +='<div class="col-md-6"></br>\
		// 		    <label class="control-lablel" >'+support_name+' : <span class="total_support"></span> </label> \
		//         </div>';  
		text+='</div>';

    $('#sell_items').append(text);
    $('.sell_total').change(function(){
    	var total = 0;
    	$('.sell_total').each(function(e){
    		if (parseFloat($(this).val()) > 0) {
    			total = total + parseFloat($(this).val());
    		}
    	});
    	$('#total_price').html(total);
    });
    $('.sell_weight,.sell_quantity,.unit_price,.discount').change(function(){
    	update_sell();
    });
    $('.area_select').change(function(){
    	var product = $(this).find('option:selected').data('product');
    	if ($('.product_bill[data-product="'+product+'"]').length == 0) {
    		var text = '<div class="row product_bill" data-product="'+product+'">\
    		    <div class="col-md-12"> <h5 class="text-center">'+product+'</h5></div>\
    		    <div class="col-md-4"> </br>\
		 		    <label class="control-lablel" >'+total_weight_name+' : <span class="total_weight"></span> </label> \
		         </div>\
		         <div class="col-md-4"> </br>\
		 		    <label class="control-lablel" >'+total_quantity_name+' : <span class="total_quantity"></span> </label> \
		         </div>\
		         <div class="col-md-4"> </br>\
		 		    <label class="control-lablel" >'+support_name+' : <span class="total_support"></span> </label> \
		         </div>\
		       </div></hr>';
    		$('#products_div').append(text);
    	}
    	product_bill();
    })
	$('.close_item').click(function(){
		$(this).parent().remove();
		update_sell();
	})
});
$('.sell_total').change(function(){
	var total = 0;
	$('.sell_total').each(function(e){
		if (parseFloat($(this).val()) > 0) {
			total = total + parseFloat($(this).val());
		}
	});
	$('#total_price').html(total);
});
$('.sell_weight,.sell_quantity,.discount,.unit_price,.sell_weight').change(function(){
	update_sell();

});
$('.close_item').click(function(){
	$(this).parent().remove();
	
	update_sell();
})
$('.area_select').change(function(){
	var product = $(this).find('option:selected').data('product');
	if ($('.product_bill[data-product="'+product+'"]').length == 0) {
		var text = '<div class="row product_bill" data-product="'+product+'">\
		    <div class="col-md-12"> <h5 class="text-center">'+product+'</h5></div>\
		    <div class="col-md-4"> </br>\
	 		    <label class="control-lablel" >'+total_weight_name+' : <span class="total_weight"></span> </label> \
	         </div>\
	         <div class="col-md-4"> </br>\
	 		    <label class="control-lablel" >'+total_quantity_name+' : <span class="total_quantity"></span> </label> \
	         </div>\
	         <div class="col-md-4"> </br>\
	 		    <label class="control-lablel" >'+support_name+' : <span class="total_support"></span> </label> \
	         </div>\
		     </div></hr>';
		$('#products_div').append(text);
	}
	product_bill();
})

if ($('#products_div').length) {
	review();
};
$('.ajax_form').submit(function(e){
	e.preventDefault();
	var  url  =  $(this).attr('action');
	var el =  $(this);
	el.addClass('form_loader');
	 var formData = new FormData(this);

	 $.ajax({
        url: url,
        type: 'POST',
        data: formData,
        success: function (data) {
            if (data.state == 1) {
				  	 
				  	 $('.modal').modal('hide');

				  	 if (el.hasClass('add_form')) {
				  	 	el[0].reset();
				  	 }
		  	         $('select[name="'+data.item_name+'"]')
		  	         .append("<option value='"+data.item.id+"'>"+data.item.name+"</option>")
		  	
		   }else{
		   	 el.children('.alert_msg').html('<h3>'+data.msg+'</h3>');
		   }
	           el.removeClass('form_loader');
        },
        cache: false,
        contentType: false,
        processData: false
    });
	
});