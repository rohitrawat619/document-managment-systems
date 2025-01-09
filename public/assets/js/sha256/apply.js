// Validate capital letters
var upperCaseLetters = /[A-Z]/g;
var lowerCaseLetters = /[a-z]/g;
var numbers = /[0-9]/g;
var special = /[!@#$%^&*]/g;
var message = "Password must have the followings-<ol class='ml20 mbn'>"
                + "<li>Must be a minimum of 8 characters</li>"
                + "<li>Must not be more than 32 characters</li>"
                + "<li>Must contain at least one upper case letter: (A – Z)</li>"
                + "<li>Must contain at least one lower case letter: (a - z)</li>"
                + "<li>Must contain at least one number: (0 - 9)</li>"
                + "<li>Must contain at least one special character: (! @ # $ % ^ & *)</li></ol>";
  
$(document).ready(function(){
    if(typeof saltKey != undefined){
        $('form').each(function(){
            var form = $(this);
            if(form.find('input[type="password"]').length > 0){
                form.on('submit', function(e){        
                    var encrypt_pass = true;
                    form.find('input[type="password"]').each(function(){
                        var has_form_error = (form.find('.form-error').length > 0 ? true : false);
                        
                        // validate security code
                        var validate_code = is_valid_code = false;
                        if(form.find('#code').length > 0){
                            validate_code = true;
                            if($.trim(form.find('#code').val()) != ''){
                               is_valid_code = true;
                            }
                            form.find('#code').parent().removeClass('has-error');
                            form.find('#code').parent().find('.text-danger').remove();
                        }
                        
                        // validate the user name
                        var validate_username = is_valid_username = false;
                        if(form.find('#username').length > 0){
                            validate_username = true;
                            if($.trim(form.find('#username').val()) != ''){
                               is_valid_username = true;
                            }
                            form.find('#username').parent().removeClass('has-error');
                            form.find('#username').parent().find('.text-danger').remove();
                        }
                        
                        // clear the form error
                        if(has_form_error){
                           form.find('.form-error').html('').addClass('hidden');
                        } else {
                            $(this).parent().removeClass('has-error');
                            $(this).parent().find('.text-danger').remove();
                        }
                        
                        var password = $.trim($(this).val());
                        if(password != '' && (!validate_username || (validate_username && is_valid_username)) && (!validate_code || (validate_code && is_valid_code))){
                            //alert(password.match(lowerCaseLetters) + '&&' + password.match(upperCaseLetters) + '&&' + password.match(numbers));
                            if(!$(this).hasClass('cza-password') || ($(this).hasClass('cza-password') && password.match(lowerCaseLetters) && password.match(upperCaseLetters) && password.match(numbers) && password.match(special) && password.length >= 8 && password.length <= 32))
                            {
                                //encrypt_pass = true;
                                //alert($.sha256('TY@g!1908'));
                            }
                            else
                            {
                                if(has_form_error) {
                                    form.find('.form-error').html(message).removeClass('hidden');
                                } else {
                                    $(this).parent().addClass('has-error');
                                    $(this).parent().append('<em class="text-danger" for="'+$(this).attr('id')+'">'+message+'</em>');
                                }
                                encrypt_pass = false;
                            }
                        } else {
                            if(validate_username && !is_valid_username) {
                                if(has_form_error) {
                                    form.find('.form-error').append('<p class="mbn text-danger">Please enter valid username or email address.</p>').removeClass('hidden');
                                } else {
                                    form.find('#username').parent().addClass('has-error');
                                    form.find('#username').parent().append('<em class="text-danger" for="username">Please enter valid username or email address.</em>');
                                }
                            }
                            if(password == ''){
                                if(has_form_error) {
                                    form.find('.form-error').append('<p class="mbn text-danger">Please enter valid password.</p>').removeClass('hidden');
                                } else {
                                    $(this).parent().addClass('has-error');
                                    $(this).parent().append('<em class="text-danger" for="'+$(this).attr('id')+'">Please enter valid password.</em>');
                                }
                            }
                            if(validate_code && !is_valid_code) {
                                if(has_form_error) {
                                    form.find('.form-error').append('<p class="mbn text-danger">Please enter the security code.</p>').removeClass('hidden');
                                } else {
                                    form.find('#code').parent().addClass('has-error');
                                    form.find('#code').parent().append('<em class="text-danger" for="code">Please enter the security code.</em>');
                                }
                            }
                            encrypt_pass = false;
                        }
                    });
                    
                    if(encrypt_pass){
                        form.find('input[type="password"]').each(function(){
                            var password = $.trim($(this).val());
                            if($(this).hasClass('cza-password') || $(this).hasClass('cza-confirm-password'))
                                $(this).val($.sha256(password));
                            else
                                $(this).val($.sha256($.sha256(password)+saltKey));
                        });
                    } else {
                        e.preventDefault();
                    }
                });
            }
        });
    }
});