/*  Author: Grapheme Group
 *  http://grapheme.ru/
 */
function runFormValidation() {
	
	var registerForm = $("#admin-form-register").validate({
		rules : {
			email : {required : true,email : true}
		},
		messages : {
			email : {
				required : 'Пожалуйста, введите Ваш адрес электронной почты',
				email : 'Пожалуйста, введите правильный адрес электронной почты'
			},
		},
		errorPlacement : function(error,element) {
			error.insertAfter(element.parent());
		},
		submitHandler: function(form) {
			var options = {target: null,dataType:'json',type:'post'};
			options.beforeSubmit = function(formData,jqForm,options){
				$(".alert").remove();
				$(jqForm).find('button').attr('disabled','disabled').find('i').removeClass('hidden');
			},
			options.success = function(response,status,xhr,jqForm){
				$(jqForm).find('button').removeAttr('disabled').find('i').addClass('hidden');
				if(response.status){
					$(jqForm).resetForm();
					showMessage.constructor(response.responseText,'');
					showMessage.smallSuccess();
				}else{
					showMessage.constructor(response.responseText,'');
					showMessage.smallError();
				}
			}
			$(form).ajaxSubmit(options);
		}
	});
	var replenishmentBalace = $("#user-replenishment-balace").validate({
		rules : {
			account : {required : true, number : true},
			summa : {required : true, number : true}
		},
		messages : {
			account : {
				required : 'Отсутствует ID пользователя',
				number : 'ID пользователя должен быть числом'
			},
			summa : {
				required : 'Пожалуйста, введите сумму пополнения',
				number : 'Сумма должна быть числом'
			},
		},
		errorPlacement : function(error,element) {
			error.insertAfter(element.parent());
		},
		submitHandler: function(form) {
			var options = {target: null,dataType:'json',type:'post'};
			options.beforeSubmit = function(formData,jqForm,options){
				$(".alert").remove();
				$(jqForm).find('button').attr('disabled','disabled').find('i').removeClass('hidden');
			},
			options.success = function(response,status,xhr,jqForm){
				$(jqForm).find('button').removeAttr('disabled').find('i').addClass('hidden');
				if(response.status){
					$(jqForm).resetForm();
					showMessage.constructor(response.responseText,'');
					showMessage.smallSuccess();
					$('#replenishment-balace').modal('hide');
				}else{
					showMessage.constructor(response.responseText,'');
					showMessage.smallError();
				}
			}
			$(form).ajaxSubmit(options);
		}
	});
	var profileCommunication = $("#communication-form").validate({
		rules : {
			account : {required : true, number : true},
			content : {required : true}
		},
		messages : {
			account : {
				required : 'Отсутствует ID пользователя',
				number : 'ID пользователя должен быть числом'
			},
			content : {
				required : 'Пожалуйста, введите текс сообщения',
			},
		},
		errorPlacement : function(error,element) {
			error.insertAfter(element.parent());
		},
		submitHandler: function(form) {
			var options = {target: null,dataType:'json',type:'post'};
			options.beforeSubmit = function(formData,jqForm,options){
				$(".alert").remove();
				$(form).find('.btn-form-submit').elementDisabled(true);
			},
			options.success = function(response,status,xhr,jqForm){
				$(form).find('.btn-form-submit').elementDisabled(false);
				if(response.status){
					$(jqForm).resetForm();
					$("ul.messages-list").append(response.responseComment);
					showMessage.constructor(response.responseText,'');
					showMessage.smallSuccess();
				}else{
					showMessage.constructor(response.responseText,'');
					showMessage.smallError();
				}
			}
			$(form).ajaxSubmit(options);
		}
	});
}