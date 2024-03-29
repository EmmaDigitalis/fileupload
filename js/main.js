function toggleCheckbox(item){
    if ($(item).text() == "X"){
        $(item).text("");
    }else{
        $(item).text("X");
    }
}

$(document).on("click", ".checkbox", function() {
    toggleCheckbox(this);
});

function toggleHiddenArt(){
    let num = $('.hidden-art').length;

    if (num > 0){
        $('.hidden-art').addClass('showed-art');
        $('.hidden-art').removeClass('hidden-art');
    }else{
        $('.showed-art').addClass('hidden-art');
        $('.showed-art').removeClass('showed-art');
    }
}


//-------------------------------------------
function setItemPreview(entryValue){
    $.ajax({
        type:       "POST",
        url:        "../src/entry-request.php",
        data:       { entryID : entryValue }, 
        dataType:   "JSON",
        success: function(data) {
            /* If succesful: get database info as JSON object */
            displayPreview(data);
            //$.getJSON(data, displayPreview(jd));
        },
        error:   function() {
            /* If php does not work: kick a generic error */
            alert("Somehow couldn't get data from database")
        }
    });

    function displayPreview(data){
        let jsonResults = data;

        $('form>h2>span').text(jsonResults[0].id);
        $("#manage-img").attr("src","uploads/" + jsonResults[0].filename + "." + jsonResults[0].extension);
        $('form>figure>figcaption').text(jsonResults[0].filename + "." + jsonResults[0].extension)

        $("#manage-id").val(jsonResults[0].id);
        $("#manage-title").val(jsonResults[0].title);
        $("#manage-desc").val(jsonResults[0].description);
        $("#manage-date").val(jsonResults[0].date);

        if (jsonResults[0].unfinished == 1){
            $("#manage-unfinished").prop("checked", true);
        }else{
            $("#manage-unfinished").prop("checked", false);
        }

        $('#manage-update').prop("disabled", false);
        $('#manage-delete').prop("disabled", false);
    }
}

$('#itemslist').on('change', function() {
    setItemPreview(this.value);
});

//-------------------------------------------
function deleteEntry(entryValue, directory){
    $.ajax({
        type:       "POST",
        url:        "../src/entry-delete.php",
        data:       {   entryID : entryValue,
                        dir     : directory},
        dataType:   "html",
        success: function(data){
            alert(data);
            location.reload();
        }
    });
}

$('#manage-delete').on('click', function() {
   deleteEntry($('#itemslist').val(), "../uploads/");
});

//Update DB entry-------------------------------------
$('#manage-update').on('click', function() {
    $('form').attr('action', 'src/entry-update.php');
    $('form').submit();
});