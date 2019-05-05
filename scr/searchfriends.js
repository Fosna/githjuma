$(document).ready(function(){
    $('.search-box1 .search1').on("keyup input", function(){
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result1");
        if(inputVal.length){
            $.get("scr/searchfriends.scr.php", {term: inputVal}).done(function(data){
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    $(document).on("click", ".result1 p", function(){
        $(this).parents(".search-box1").find('.search1').val($(this).text());
        $(this).parent(".result1").empty();
    });
});
