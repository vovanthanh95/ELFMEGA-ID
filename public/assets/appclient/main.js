$(document).ready(function () {
    $("form[ajax]").ajaxForm({
        beforeSubmit: function (arr, $form, options) {
            if ($form.hasClass("sending"))
                return false;

            $("#ContentPlaceHolder1_updateProgress").css({ "display": "block" });

            $form.addClass("sending");
            $('body').removeClass('loaded');
        },
        error: function (http, result, message, $form) {
            $('body').addClass('loaded');
            $form.removeClass("sending");
            $("#ContentPlaceHolder1_updateProgress").css({ "display": "none" });

            swal({
                title: "Error!!!",
                type: "error",
                html: "Connect to server failed."
            });
        },
        success: async function (response, result, http, $form) {
            $('body').addClass('loaded');
            $form.removeClass("sending");
            $form[0].reset();
            $form.find(".refreshCaptcha").click();
            $("#ContentPlaceHolder1_updateProgress").css({ "display": "none" });

            if (response.type === "alert_response") {
				if (response.code !== 200) {
                    swal({
                        html: response.msg
                    });
                    return;
                }
				
                delete response.type;
                var isIOS = navigator.userAgent.indexOf("iPhone") >= 0 || navigator.userAgent.indexOf("iPad") >= 0;
                if (isIOS) {
                    $("#IsIosVule").html(JSON.stringify(response));
                    return;
                }
                alert(JSON.stringify(response));
				
                return;
            }

            var redirectUrl = response.data ? response.data.redirectUrl : '';
            if (response.message && response.message.length > 0) {
                var click = await swal({
                    title: "Alert",
                    type: response.error ? "error" : "success",
                    html: response.message
                });

                if (click.value) {
                    if (redirectUrl && redirectUrl.length > 0)
                        location.href = redirectUrl;
                }

                return;
            }

            if (redirectUrl && redirectUrl.length > 0)
                location.href = redirectUrl;
        }
    });

    $(".refreshCaptcha").click(function () {
        var $button = $(this);
        var $img = $button.find('img[data-url]');
        $img.attr("src", $img.data("url") + "?t=" + (new Date()).getTime());
    });
});

function GetProtectCode() {
    $('body').removeClass('loaded');
    $.post("/Home/ResendProtectCode", {}, "json").done(async function (response) {
        $('body').addClass('loaded');
        if (response.message && response.message.length > 0) {
            var click = await swal({
                title: "Alert",
                type: response.error ? "error" : "success",
                html: response.message
            });


        }
    }).
        fail(function () {
            $('body').addClass('loaded');

            swal({
                title: "Alert!!!",
                type: "error",
                html: "Connect to server failed."
            });
        });
}

function getUtcTime() {
    $('body').removeClass('loaded');
    $.post("/Home/GetUTCTime", {}, "json").done(function (response) {
        $('body').addClass('loaded');
        swal({
            title: "Alert",
            type: "info",
            html: `<div style="text-align: center"><small>${response.data.time} (UTC+0)</small></div><div style="text-align: center"><strong>${response.data.date}</strong></div>`
        });
    }).
    fail(function () {
        $('body').addClass('loaded');

        swal({
            title: "Alert!!!",
            type: "error",
            html: "Connect to server failed."
        });
    });
}