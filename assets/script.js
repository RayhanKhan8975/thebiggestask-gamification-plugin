(function($){
  
    $('.like-review').on('click', function (evt) {

        data = {
            action : 'tba_like_reply',
            _wpnonce: $(this).data('_wpnonce'),
            reply_id : $(this).data('reply-id'),
            _wp_http_referer: $(this).data('_wp_http_referer')
        }

        var like_review = $(this);

        $.post(tba.ajax_url, data,
            function (data) {
                if(data['user_liked'] === true)
                {
                    console.log(like_review);
                   like_review[0].innerHTML ='<i class="fa fa-thumbs-up" aria-hidden="true"></i>You liked this ';
                }
                else
                {
                    console.log(like_review);
                    like_review[0].innerHTML = '<i class="fa fa-thumbs-up" aria-hidden="true"></i> Like';
                }


            }
        );

      })

})(jQuery);