$(document).ready(function(){



    var js = CodeMirror.fromTextArea(document.getElementById("codejs"), {
      mode:  "javascript",
      lineNumbers: true,
      theme: "dracula"
    });
    
    
    
    $("#run").click(function(){
    $( "#chalfunction" ).remove();
    var jsx = js.getValue();
    var s = document.createElement('script');
    s.setAttribute("id", "chalfunction");
    s.textContent = jsx;//inne
    document.body.appendChild(s);
    $( ".pconsole" ).remove();
    $(".console").append("<p class='pconsole indent'>" + challengeFunction() +" </p>");
    
    });
    });
    