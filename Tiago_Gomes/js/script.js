/* $(document).ready(function () {
    $("p").click(function(){
        $(this).hide();
        
    });
    alert('DOM is loaded and ready to be manipulated');
});
 */



/* $(document).ready(function () {
    //outro selector: $("div p frist")
    $("div p").first().css("border", "1px solid red");//outro metedo: $("div p").first()
}); */




/* $(document).ready(function () {
    $("div p").last().css("border", "1px solid red");
});
    */

/* 
$(document).ready(function () {
    $("#p1").hover(function () {
        console.log("You entered p1!");
    },
        function () {
            console.log("Bye! You leave p1!");
        });
});
 */
/* 
$(document).ready(function () {
    $("p").on({
        mouseenter: function () {
            $(this).css("background-color", "lightgray");
        },
        mouseleave: function () {
            $(this).css("background-color", "lightblue");
        },
        click: function () {
            $(this).css("background-color", "yellow");
        },
    })
}); */

/* 
$(document).ready(function () {
    $("#hide").click(function () {
        $("p").hide();
    });

    $("#show").click(function () {
        $("p").show();
    });
}) */

$(document).ready(function () {
    $("#content").html("<p> Vamos Ver </p>");
});