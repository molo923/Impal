
$(document).ready(function(){
	
	$("#form-wizard").formwizard({ 
		formPluginEnabled: true,
		validationEnabled: true,
		focusFirstInput : true,
		disableUIStyles : true,
	
		formOptions :{
			success: function(data){$("#status").fadeTo(500,1,function(){ $(this).html("<span>Form was submitted!</span>").fadeTo(5000, 0); })},
			beforeSubmit: function(data){$("#submitted").html("<span>Form was submitted with ajax. Data sent to the server: " + $.param(data) + "</span>");},
			dataType: 'json',
			resetForm: true
		},
		validationOptions : {
			rules: {
				namabs: "required",
				alamat: "required",
				username: "required",
				idinduk: "required",
				nohp: {required:true, number:true, minlength:11,maxlength:12},
				password: {required:true,minlength:8,maxlength:30},
				password2: {
					equalTo: "#password"
				},
				email: { required: true, email: true },
				eula: "required"
			},
			messages: {
				idinduk : "Masukan Kode Induk",
				namabs: "Masukan nama bank sampah",
				alamat: "Masukan alamat bank sampah",
				nohp:{required:"Masukan nomor hp bank sampah", minlength:"Nomor hp salah",maxlength:"Nomor hp salah"},
				username: "Masukan username",
				password: {required:"Harap masukan password", minlength:"Terlalu pendek",maxlength:'Terlalu panjang'},
				password2: { equalTo: "Password tidak sama" },
				email: { required: "Masukan email bank sampah", email: "format email adalah name@domain.com" },
				eula: "You must accept the eula"
			},
			errorClass: "help-inline",
			errorElement: "span",
			highlight:function(element, errorClass, validClass) {
			$(element).parents('.control-group').addClass('error');
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).parents('.control-group').removeClass('error');
			}
		}
	});	
});
