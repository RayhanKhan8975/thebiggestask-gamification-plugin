(function ($) {

    $('.like-review').on('click', function (evt) {

        data = {
            action: 'tba_like_reply',
            _wpnonce: $(this).data('_wpnonce'),
            reply_id: $(this).data('reply-id'),
            _wp_http_referer: $(this).data('_wp_http_referer')
        }

        var like_review = $(this);
        var total_likes = like_review.siblings('.tba_total_likes');
        $.post(tba.ajax_url, data,
            function (data) {
                if (data['user_liked'] === true) {
                    console.log(like_review.siblings('.tba_total_likes'));
                    like_review[0].innerHTML = '<i class="fa fa-thumbs-up" aria-hidden="true"></i>You liked this ';
                    total_likes[0].innerHTML = data['total_likes'];
                }
                else {
                    console.log(like_review.siblings('.tba_total_likes'));
                    like_review[0].innerHTML = '<i class="fa fa-thumbs-up" aria-hidden="true"></i> Like';

                    total_likes[0].innerHTML = data['total_likes'];
                }


            }
        );

    })

    $('.approve-topic').on('click', function (evt) {

        $('#card-' + $(this).data('id')).hide();
        var data = {
            action: 'tba_approve_topic',
            topic_id: $(this).data('id'),
            approve:true
        }

        $.post(tba.ajax_url, data,
            function (data) {
                if (data === false) {
                    $('.card-' + $(this).data('id')).show();
                }
            }
        );

    })
    
    $('.disapprove-topic').on('click', function (evt) {

        $('#card-' + $(this).data('id')).hide();
        var data = {
            action: 'tba_approve_topic',
            topic_id: $(this).data('id'),
            approve:false
        }

        console.log('#card-' + $(this).data('id'));

        $.post(tba.ajax_url, data,
            function (data) {
                if (data === false) {
                    $('.card-' + $(this).data('id')).show();
                }
            }
        );

    })

    $('#tba-settings-form').on('submit', function (evt) {
        evt.preventDefault();

        var data = $(this).serialize();

        $.post(tba.ajax_url, data,
            function (data) {
                if(data['status'] == 0)
                {
                    $('#ilg-product-success-message').html('<h3 class=" alert alert-danger" >There has been an error in the system.</h3>');
                }
                else if(data['status'] == 1)
                {
document.location.reload();
                }

            }
        );
      })
    
})(jQuery);