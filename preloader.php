<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="crossorigin="anonymous"></script>
<div class="loadin-page">
    <div class="counter">
        <h1></h1>
        <h2>LOADED...</h2>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        var counter = 0;
        var c = 0;
        var i = setInterval(function(){
            $(".loading-page .counter h1").html(c);
            $(".loading.page").css("width", c + "%");

            counter++;
            c++;
            if(counter == 101){
                clearInterval(i);
            }
        }, 35);
    });
</script>
<style>
    body{
        background: #002155;
        padding: 0;
        width: 100vw;
        height: 100vh;
        overflow:hidden;
    }
    .loading-page{
        background: #143975;
        width: 100vh;
        height: 100vh;
    }
    .loading-page .counter h1 {
        position: fixed;
        top: 50%;
        left:50%;
        transform: translate(-50%, -50%);
        color white;
        font-size: 300px;
        font-weight: bolder;
        margin-top: -10px;
    }
    h2{
        position: fixed;
        top: 70%;
        left: 40%;
        color: white;
        font-size: 50px;
        font-weight: normal;
        margin-top: -10px;
    }
</style>