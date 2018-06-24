$(".navbar-form").keyup(function () {
    var that = this,
        value = $('.ajax_val').val();

    if (value.length >= 0  ) {
            setTimeout(()=>{
                $.ajax({
                type: "POST",
                url: "/person/search",
                data: {
                    'term' : value
                },
                success: function(msg){
                    $('.ajax-table').html(msg['data']);
                }
            });
        },100)

    }
});