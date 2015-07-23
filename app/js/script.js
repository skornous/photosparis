 $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();

	$(document).ready(function(){
		$('ul.tabs').tabs();
	});

	 $('.datepicker').pickadate({
		 selectMonths: true, // Creates a dropdown to control month
		 selectYears: 15 // Creates a dropdown of 15 years to control year
	 });

	$("#grille").justifiedGallery({
	    rowHeight : 150,
	    lastRow : 'nojustify',
	    margins : 3,
	    captions:true
	});

	 //$('.fixed_param').removeClass('active');
     //
	 //$('.fixed_param').hover(function(){
		// openMenu_Params($(this));
	 //});
	 //$('.fixed_param').mouseleave(function(){
		// closeMenu_Params($(this));
	 //});

	 $('#settings_button').click(function(){
		 $('#settings_bar').toggleClass('active','');
		 $(this).toggleClass('active','');
	 });

	 $('#photo_album ul.photo_list li').click(function(){
		$('#photo_album .photo_list li').removeClass('active');
		 $(this).addClass('active');
	 });


 //    $('.modal-trigger.photo').click(function(){
 //    	// open modal
 //    	$('#modal_photo').openModal();
 //    	// change modal photo
	// 	$('#modal_photo img.photo').attr('src', $(this).find('img').first().attr('src'));

	// 	resizeModalImg();
	// });

	// $(window).resize(resizeModalImg);
	var minilike = '<div class="lb_minilike valign-wrapper right"><span class="valign">100</span><i class="material-icons red-text small pointer valign">favorite_border</i></div>'
	$('#lightbox .lb-closeContainer').append(minilike);

	$('.lb_minilike').click(function(){
		$(this).toggleClass('like');
		if($(this).hasClass('like')){
			$(this).find('i').html('favorite');
		}else{
			$(this).find('i').html('favorite_border');
		}
	})
	$('select').material_select();

});


function resizeModalImg() {
	var wMax = $(window).width() * 0.8;
	var hMax = $(window).height() * 0.69;

	// get img width & height
	var imgW = parseInt($('#modal_photo img.photo').css('width'));
	var imgH = parseInt($('#modal_photo img.photo').css('height'));

	// set #modal_photo's width @ img.width
	// set #modal_photo's height @ img.height


	

	// $('#modal_photo img.photo').attr('src', $(this).find('img').first().attr('src'));
	// $('#modal_photo img.photo').css('width','auto');
	// $('#modal_photo img.photo').css('height','auto');

	// hMax = 200;
	if($('#modal_photo img.photo').height() > hMax){
		$('#modal_photo img.photo').css('width','auto');
		$('#modal_photo img.photo').css('height',hMax);
	}

	var w = $('#modal_photo img.photo').width();
	w = (w>wMax) ? wMax : w;

	// $('#modal_photo img.photo').css('width',w);
	// $('#modal_photo img.photo').css('height','auto');

	
	// if($('#modal_photo img.photo').width() > $('#modal_photo img.photo').height()){
	// 	$('#modal_photo img.photo').width(wMax);
	// 	$('#modal_photo img.photo').height('auto');
	// }else{
	// 	$('#modal_photo img.photo').width('auto');
	// 	$('#modal_photo img.photo').height(hMax);
	// }
	

	// w = (w>wMax)?wMax:w;
	$('#modal_photo').width(w);

	/*console.log(imgW + " " + imgH);
	console.log(wMax + " " + hMax);

	if (imgW <= wMax) {
		console.log("imgW <= wMax");
		if (imgH > hMax) {
			console.log("imgH > hMax");
			
			$('#modal_photo img.photo').css('height', hMax + "px");
			console.log("new img height : " + $('#modal_photo img.photo').css('height'));
			$('#modal_photo').css("width", $('#modal_photo img.photo').css('width'));
			console.log("modal width : " + $('#modal_photo').css('width'));
			$('#modal_photo').css('height', hMax + "px");
			console.log("modal height : " + $('#modal_photo').css('height'));
		} else {
			console.log("imgH <= hMax");
			$('#modal_photo').css("width", imgW + "px");
			$('#modal_photo').css('height', imgH + "px");
		}
	} else {
		console.log("imgW > wMax");
		if (imgH > hMax) {
			console.log("imgH > hMax");
		} else {
			console.log("imgH <= hMax");
		}
	}*/
}

	// $('.grille-item .img img').each(function(){

	// 	w = $('.grille-item .img').first().width();
	// 	h = $('.grille-item .img').first().height();

	// 	if($(this).width()<w){
	// 		$(this).height('auto');
	// 		$(this).width(w);

	// 		$(this).css('top','-'+(($(this).height()-h)/2)+'px');
	// 	}else{
	// 		$(this).css('left','-'+(($(this).width()-w)/2)+'px');
	// 	}

	// });


 var openMenu_Params = function (btn) {
	 $this = btn;
	 if ($this.hasClass('active') === false) {
		 $this.addClass('active');
		 $this.find('ul .btn-floating').velocity(
			 { scaleY: ".4", scaleX: ".4", translateY: "-30px"},
			 { duration: 0 });

		 var time = 0;
		 $this.find('ul .btn-floating').reverse().each(function () {
			 $(this).velocity(
				 { opacity: "1", scaleX: "1", scaleY: "1", translateY: "10px"},
				 { duration: 80, delay: time });
			 time += 40;
		 });
	 }
 };

 var closeMenu_Params = function (btn) {
	 $this = btn;
	 $this.removeClass('active');
	 var time = 0;
	 $this.find('ul .btn-floating').velocity("stop", true);
	 $this.find('ul .btn-floating').velocity(
		 { opacity: "0", scaleX: ".4", scaleY: ".4", translateY: "-30px"},
		 { duration: 80 }
	 );
 };