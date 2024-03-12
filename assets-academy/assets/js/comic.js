(function($){
    $(document).ready(function(){
        if($("#xkcd").length>0){
            const cominNumber = $("#xkcd").attr("number");
            $.get("https://xkcd.vercel.app/?comic="+cominNumber, function(data){
                const image = data.img;
                const comicHTML = `<img src="${image}" alt="${data.alt}" title="${data.alt}" />`;
                $("#xkcd").html(comicHTML);
            })
        }
    });
})(jQuery);