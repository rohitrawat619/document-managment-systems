function submitSearchForm(e)
{
    if (e.which == 13) {
        var szSearchContent = $("#header_search_field").val();
        if(jQuery.trim(szSearchContent)!='')
        {
            szSearchContent = encodeURIComponent(szSearchContent);  
            var redirect_url = BASE_URL + "search/" + szSearchContent;
            $(location).attr('href', redirect_url)
        } 
        return false;
    } 
}

function validateEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(email);
}

function validateNewletter() { 
  var email = $("#szNewsletterEmail").val();  
  if (validateEmail(email)) {
     submitNewsletter();
  } else {
    $("#szNewsletterEmail").addClass('error');
  }
  return false;
}

function submitNewsletter()
{
    $.post(BASE_URL+"/newsletter",$('#cza_newletter_form').serialize(),function(result){
        $("#cza_newletter_container").html(result);  
    });
}

function showMoreImage()
{
    var iPageNumber = parseInt($("#iPageNumber").val());
    if(iPageNumber>0)
    {
        iPageNumber = iPageNumber + 1;
    }
    else
    {
        iPageNumber = 1;
    }
    $.post(BASE_URL+"/image-gallery/"+iPageNumber,{mode: 'SHOW_MORE'},function(result){
        if(jQuery.trim(result)=='NO_RESULT')
        {
            $("#show_more_button").hide();
        }
        else
        {
            $("#image-galery-images-container").append(result);  
            $("#iPageNumber").val(iPageNumber);
        } 
    });
}

function showMoreVideos()
{
    var iPageNumber = parseInt($("#iPageNumber").val());
    if(iPageNumber>0)
    {
        iPageNumber = iPageNumber + 1;
    }
    else
    {
        iPageNumber = 1;
    }
    $.post(BASE_URL+"video-gallery/"+iPageNumber,{mode: 'SHOW_MORE'},function(result){
        if(jQuery.trim(result)=='NO_RESULT')
        {
            $("#show_more_button").hide();
        }
        else
        {
            $("#video-galery-thumb-container").append(result);  
            $("#iPageNumber").val(iPageNumber);
        } 
    });
}
function showMoreSlideshow()
{
    var iPageNumber = parseInt($("#iPageNumber").val());
    if(iPageNumber>0)
    {
        iPageNumber = iPageNumber + 1;
    }
    else
    {
        iPageNumber = 1;
    }
    $.post(BASE_URL+"slide-shows/"+iPageNumber,{mode: 'SHOW_MORE'},function(result){
        if(jQuery.trim(result)=='NO_RESULT')
        {
            $("#show_more_button").hide();
        }
        else
        {
            $("#video-galery-thumb-container").append(result);  
            $("#iPageNumber").val(iPageNumber);
        } 
    });
}