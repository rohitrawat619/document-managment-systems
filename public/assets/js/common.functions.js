var $ = jQuery;

$(document).ready(function(){
    toggleCMSPageFormFields();
    $('#frmCMSPage #iPageType').change(function(){
        toggleCMSPageFormFields();
    });
});

function toggleCMSPageFormFields()
{
    if(parseInt($('#frmCMSPage #iPageType').val()) == 1){
        $('#frmCMSPage #szPageTitle').parent().removeClass('hidden');
        $('#frmCMSPage #szMetaTitle').parent().removeClass('hidden');
        $('#frmCMSPage #szMetaKeywords').parent().removeClass('hidden');
        $('#frmCMSPage #szMetaDescription').parent().removeClass('hidden');
        $('#frmCMSPage #szPageContent').parent().removeClass('hidden');
        
        $('#frmCMSPage #szLinkName').parent().addClass('hidden');
        $('#frmCMSPage #szLinkUrl').parent().addClass('hidden');
    } else if(parseInt($('#frmCMSPage #iPageType').val()) == 2){
        $('#frmCMSPage #szPageTitle').parent().addClass('hidden');
        $('#frmCMSPage #szMetaTitle').parent().addClass('hidden');
        $('#frmCMSPage #szMetaKeywords').parent().addClass('hidden');
        $('#frmCMSPage #szMetaDescription').parent().addClass('hidden');
        $('#frmCMSPage #szPageContent').parent().addClass('hidden');
        
        $('#frmCMSPage #szLinkName').parent().removeClass('hidden');
        $('#frmCMSPage #szLinkUrl').parent().removeClass('hidden');
    }
}


function reloadTRCaptcha(obj){

    $(obj).button('loading');
    var url = curr_url + 'reloadTRCaptcha';
    //alert(url); exit();
    $.ajax({
        method: 'POST',
        url: url,
        success: function(result){
            $(obj).button('reset');
            $(obj).parent().find('img').replaceWith(result);
        }
    });
}


function reloadCZACaptcha(obj){

    $(obj).button('loading');
    var url = curr_url + 'reloadCZACaptcha';
    //alert(url); exit();
    $.ajax({
        method: 'POST',
        url: url,
        success: function(result){
            $(obj).button('reset');
            $(obj).parent().find('img').replaceWith(result);
        }
    });
}

function remove_image_preview(field_id)
{
    $("#image_previewer_container_"+field_id).addClass('hidden');
    $("#image_field_container_"+field_id).removeClass('hidden');
    $("#croped_image_"+field_id).val('');
    
}

function readFile(input,$uploadCrop, field_id) 
{ 
    if (input.files && input.files[0]) {
        $("#image_crop_type").val(field_id);
        //field_id
        var reader = new FileReader();
        reader.onload = function (e) { 
            $uploadCrop.croppie('bind', {
                url: e.target.result
            }).then(function () { 
            });
        };
        var validExtensions = ['jpg', 'gif', 'png','jpeg'];
        var fileName = input.files[0].name;
        var fileNameExt = fileName.substr(fileName.lastIndexOf('.') + 1);
        if ($.inArray(fileNameExt.toLowerCase(), validExtensions) == -1) {
            alert("Invalid image. Only accept jpg,gif,png"); 
        } else {
            reader.readAsDataURL(input.files[0]);
            $("#crop_image_modal").modal({
                backdrop: 'static',
                keyboard: false
            });
        } 
    }
}

function uploadImage(type,img_content,field_key)
{
    //addOverlay(); 
    var url = BASE_ADMIN_URL + 'uploadImage';   
    $.ajax({
        type: "POST", 
        url: url, 
        data: {type:type, img_content: img_content},
        success: function(response)
        { 
            var result_ary = response.split("||||"); 
            if(result_ary[0]=='SUCCESS')
            { 
                $("#"+field_key).val('');
                $("#croped_image_"+field_key).val(result_ary[1]);  
            }
            else
            {
                alert("Image could not be uploaded. Please try again later.");
            }
            //removeOverlay();
        },
        async:false
    });
}

function initialize_cropie(width, height, type)
{
    var boundary_width = parseInt(width)+ 50;
    var boundary_height = parseInt(height)+ 50;
    
    $uploadCrop = $("#crop_image_area").croppie({
        viewport: {
            width: width,
            height: height,
            type: 'square'
        },
        boundary: {
            width: boundary_width,
            height: boundary_height
        }
    }); 
}

function toggleFooterLinksFormFields()
{
    if(parseInt($('#frmFooterLinks #iLinkType').val()) == 1){
        
        $('#frmFooterLinks #idCmsPage').parent().removeClass('hidden');
        $('#frmFooterLinks #idCmsPageHindi').parent().removeClass('hidden');  
        
        $('#frmFooterLinks #szLinkUrl').parent().addClass('hidden');
        $('#frmFooterLinks #szLinkUrlHindi').parent().addClass('hidden');
        
    } else if(parseInt($('#frmFooterLinks #iLinkType').val()) == 2){
        $('#frmFooterLinks #idCmsPage').parent().addClass('hidden');
        $('#frmFooterLinks #idCmsPageHindi').parent().addClass('hidden'); 
        
        $('#frmFooterLinks #szLinkUrl').parent().removeClass('hidden');
        $('#frmFooterLinks #szLinkUrlHindi').parent().removeClass('hidden');
    }
}

function czaAlert(msg)
{
    bootbox.alert({
        title: "BSI Alert",
        message: msg
    });
}

function czaConfirm(obj, e)
{
    e.preventDefault();
    bootbox.confirm({
        title: "Confirm?",
        message: "<p class='text-danger'>"+$(obj).data('message')+"</p>",
        buttons: {
            cancel: {
                label: '<i class="fa fa-times"></i> Cancel'
            },
            confirm: {
                label: '<i class="fa fa-check"></i> Confirm'
            }
        },
        callback: function (result) {
        	if(result) {
        		if($(obj).data('href') != undefined){
        			window.location = $(obj).data('href');
        		} else {
        			window.location = $(obj).attr('href');
        		}
                
        	}
        }
    });
}

function openUploadDocumentModal(obj)
{
    $('#doc_modal').remove();
    $(obj).button('loading');
    $.ajax({
        type: "POST",
        url: BASE_ADMIN_URL + 'document', 
        data: 'data[p_upload_path]='+$(obj).data('upload-path')+'&data[p_selector]='+$(obj).data('selector'),
        success: function(response){ 
            $(obj).button('reset');
            var result_ary = response.split("||||"); 
            if(result_ary[0]=='SUCCESS') { 
                $('.breadcrumbs').after(result_ary[1]);
                $($(obj).data('target')).modal('show');
            }
            else
            {
                czaAlert(result_ary[1]);
            }
        },
        error: function(){
            $(obj).button('reset');
            czaAlert('Something went wrong, please try again after some time.');
        }
    });
}

function selectDocument(obj)
{
    $('#documents a').removeClass('selected');
    $(obj).addClass('selected');
    $('#btn-doc-selected').removeClass('btn-default').addClass('btn-primary');
}

function documentSelected()
{
    if($('#documents a.selected').length == 1){        
        $('#' + $('#p_selector').val()).val($('#documents a.selected .doc-name').text());
        $('#btn-' + $('#p_selector').val()).find('.btn-outline-success').html($('#documents a.selected h1').html() + " " + $('#documents a.selected .doc-name').text()).css("display", "inline-block");;
        $('#btn-' + $('#p_selector').val() + ' a').html('<i class="fa fa-times-circle"></i> Change').removeClass('btn-outline-primary').addClass('btn-outline-danger');
        $('#doc_modal').modal('hide');
    } else {
        czaAlert('Please select a document.');
    }
}

function uploadNewDocument(obj)
{
    $(obj).button('loading');
    $('.form-error').addClass('hidden');
    
    var formData = new FormData();
    formData.append('data[p_upload_path]', $('#p_upload_path').val());
    formData.append('data[p_func]', 'Upload New Document');
    // Attach file
    formData.append('p_document', $('#p_document').prop('files')[0]);  
    
    $.ajax({
        type: "POST",
        url: $(obj).closest('form').attr('action'), 
        data: formData,
        processData: false,
        contentType: false,
        cache: false,
        success: function(response){ 
            $(obj).button('reset');
            var result_ary = response.split("||||"); 
            if(result_ary[0]=='SUCCESS')
            { 
                $('#p_document').val('');
                $('#upload_text').text('Browse to Upload New Document');
                $('.form-error').addClass('hidden');
                $("#documents-filter").val('');
                $("#documents .doc-item").toggle(true);
                
                $('#documents').prepend('<div class="col-sm-3 doc-item">'+
                    '<a href="javascript:void(0);" onclick="selectDocument(this);">'+
                        '<div class="alert alert-secondary">'+
                            '<h1 class="text-center"><i class="fa fa-'+result_ary[2]+'"></i></h1>'+
                            '<p class="text-center doc-name">'+result_ary[1]+'</p>'+
                            '<div class="text-center"><button type="button" class="btn btn-sm btn-success">Select</button></div>'+
                        '</div>'+
                    '</a>'+
                '</div>');
            }
            else
            {
                $('.form-error').html(result_ary[1]).removeClass('hidden');
            }
        },
        error: function(){
            $(obj).button('reset');
            $('.form-error').html('Something went wrong, please try again after some time.').removeClass('hidden');
        }
    });
}