
(function ($) {
    $(document).ready(function () {
    //    $(".navbar").hide();
        $(function () {
            $(window).scroll(function () {
           // 	var myElem = document.getElementById('myElementId');
								//	if (myElem === null) alert('does not exist!');
                if ($(this).scrollTop() > 10) {
                $('.navbar').attr("style", "background-color:#F3EFF5 !important; border-bottom: solid #454955 1px !important;");
                  $('#ulnav').addClass('navlinksB');
                  $('#ulnav').removeClass('navlinksA');
                 $('#search').addClass('navlinksB');
                  $('#search').removeClass('navlinksA');
                  $('#logo').addClass('navlinksB');
                  $('#logo').removeClass('navlinksA');
                } else {
                    $('.navbar').attr("style", "background-color: transparent !important");
                    $('#ulnav').addClass('navlinksA');
                	  $('#ulnav').removeClass('navlinksB');
                    $('#search').addClass('navlinksA');
                	  $('#search').removeClass('navlinksB');
                    $('#logo').addClass('navlinksA');
                	  $('#logo').removeClass('navlinksB');
                }
            });
        });

    });
}(jQuery));
