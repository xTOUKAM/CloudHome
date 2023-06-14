$(".tab ul li a").click(function(e){
    let link = $(this),
    li = link.parent();

    setTabActive(li.parent(), li);

    return false;
});

function setTabActive(nav, li){
    ul.find("li").removeClass("active");
    li.addClass("active");
}