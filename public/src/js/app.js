var postId = 0;
var postBodyElement = null;

 $('.post').find('.interaction').find('.edit').on('click', function (event) {
    event.preventDefault();

    postBodyElement = event.target.parentNode.parentNode.childNodes[1];
    var postBody = postBodyElement.textContent;
    postId = event.target.parentNode.parentNode.dataset['postid'];
    $('#post-body').val(postBody);
     $('#edit-modal').modal();
});

$('#modal-save').on('click', function(){
    $.ajax({
       method: 'POST',
        url: urlEdit,
        data: { body: $('#post-body').val(), postId: postId, _token: token}
    }).done(function(msg){
            $(postBodyElement).text(msg['new_body']);
            $('#edit-modal').modal('hide');
        });
});

$('.like').on('click', function(event){ // like onclick
    event.preventDefault();
    postId = event.target.parentNode.parentNode.dataset['postid'];
    var isLike = event.target.previousElementSibling == null;
    var likesElement = event.currentTarget.parentNode.parentNode.querySelector(".info").querySelector(".likes");
    var dislikesElement = event.currentTarget.parentNode.parentNode.querySelector(".info").querySelector(".dislikes");
    var likes = +likesElement.innerText;
    var dislikes = +dislikesElement.innerText;
<<<<<<< HEAD
    $.ajax({
        method:'POST',
        url: urlLike,
        data: {isLike: isLike, postId: postId, _token: token}
    }).done(function(){
        var clickedLike = event.target.innerText === 'You like this post' || event.target.innerText === 'Like';
        var clickeddislike= !clickedLike;
        var wasLiked = event.target.parentNode.querySelector(".increase").innerText === 'You like this post';
        var wasDisliked = event.target.parentNode.querySelector(".decrease").innerText === 'You don\'t like this post';

        //debugger;
        if (clickedLike) {
            if (wasLiked) {
                event.target.parentNode.querySelector(".increase").innerText = 'Like';
                likesElement.innerText = likes - 1;
            } else if (!wasLiked) {
                event.target.parentNode.querySelector(".increase").innerText = 'You like this post';
                likesElement.innerText = likes + 1;
            }

            if (!wasLiked && wasDisliked) {
                dislikesElement.innerText = dislikes - 1;
                event.target.parentNode.querySelector(".decrease").innerText = 'Dislike';
            }
        } else if (clickeddislike) {
            if (wasDisliked) {
                event.target.parentNode.querySelector(".decrease").innerText = 'Dislike';
                dislikesElement.innerText = dislikes - 1;
            } else if (!wasDisliked) {
                event.target.parentNode.querySelector(".decrease").innerText = 'You don\'t like this post';
                dislikesElement.innerText = dislikes + 1;
            }

            if (wasLiked && !wasDisliked) {
                likesElement.innerText = likes - 1;
                event.target.parentNode.querySelector(".increase").innerText = 'Like';
            }
        }


    });
=======
   $.ajax({
        method:'POST',
        url: urlLike,
       data: {isLike: isLike, postId: postId, _token: token}
   }).done(function(){
       var clickedLike = event.target.innerText === 'You like this post' || event.target.innerText === 'Like';
       var clickeddislike= !clickedLike;
       var wasLiked = event.target.parentNode.querySelector(".increase").innerText === 'You like this post';
       var wasDisliked = event.target.parentNode.querySelector(".decrease").innerText === 'You don\'t like this post';

       //debugger;
       if (clickedLike) {
           if (wasLiked) {
               event.target.parentNode.querySelector(".increase").innerText = 'Like';
               likesElement.innerText = likes - 1;
           } else if (!wasLiked) {
               event.target.parentNode.querySelector(".increase").innerText = 'You like this post';
               likesElement.innerText = likes + 1;
           }

           if (!wasLiked && wasDisliked) {
               dislikesElement.innerText = dislikes - 1;
               event.target.parentNode.querySelector(".decrease").innerText = 'Dislike';
           }
       } else if (clickeddislike) {
           if (wasDisliked) {
               event.target.parentNode.querySelector(".decrease").innerText = 'Dislike';
               dislikesElement.innerText = dislikes - 1;
           } else if (!wasDisliked) {
               event.target.parentNode.querySelector(".decrease").innerText = 'You don\'t like this post';
               dislikesElement.innerText = dislikes + 1;
           }

           if (wasLiked && !wasDisliked) {
               likesElement.innerText = likes - 1;
               event.target.parentNode.querySelector(".increase").innerText = 'Like';
           }
       }


   });
>>>>>>> calendar
});

$('#menu-toggle').click(function (e) {
   e.preventDefault();
   $('#wrapper').toggleClass('menuDisplayed');

});

$('.glyphicon .glyphicon-menu-hamburger').on('click', function(event) { // category onclick
    event.preventDefault();
});
