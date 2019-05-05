$(document).ready(function(){
    $('.search-box .search').on("keyup input", function(){
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("scr/search.scr.php", {term: inputVal}).done(function(data){
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('.search').val($(this).text());
        $(this).parent(".result").empty();
    });
});
