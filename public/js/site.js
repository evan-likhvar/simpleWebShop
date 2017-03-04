/**
 * Created by root on 12.01.17.
 */
$(document).ready(function(){

    $("#prev a").hide();

    $("#prev a#intro1").show();

    $("#gal div:first img").mouseenter(function(){
        $("#text").text($("#gal div img:hover").attr('id'));
    });
    $("#gal div:first img").mouseenter(function(){
        $("#prev a").hide();
    });
    $("#gal div:first img").mouseenter(function(){
         $("#prev a").filter("#"+$("#gal div img:hover").attr('id')).show();
     });


    $('.fancybox').fancybox();

    $(".fancybox-effects-1").fancybox({
        wrapCSS    : 'fancybox-custom',
        closeClick : true,

        openEffect : 'none',

        helpers : {
            title : {
                type : 'inside'
            },
            overlay : {
                css : {
                    'background' : 'rgba(238,238,238,0.85)'
                }
            }
        }
    });


    $("table > tbody > tr:odd").addClass("odd");

});