$(function () {
    $(".pluginButtonLabel").click(function () {
        voteFor($(this).data("fbid"));
    });

    function voteFor(photoID) {
        console.log("vote for : " + photoID);
        FB.api('/me/' + photoID, 'get', {}, function (data) {
            //var fb_id = data.id || null;
            //if (fb_id !== null) {
                console.log(data);
                //$.post(SITE_URL + "ajax/photoVote", {
                //    id: fb_id
                //}).success(function (data) {
                //    console.log(data);
                //});
            //}
        });
    }
});

