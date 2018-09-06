$(document).ready( ()=> {
  console.log('jquery done.!!');

  // 使用 ajax 送 request 給後端
  $('#comment_ajax').submit( (e)=> {
    e.preventDefault()
    console.log('submit evnet !');
    let mainCommentDom = $('.sticky-top')

    // 從前端拿到資料，傳到後端
    let authorId =  parseInt ( $('#comment_ajax > input[type="hidden"]').val() )
    let comment = $('#main_comment').val()
    // 從前端拿到資料，傳到後端

    let newCommentDom = $(`<h1>New comment TEST block: ${authorId}      ${comment}</h1>`)

    $('html, body').animate({
      scrollTop: 0
    }, 300);

    mainCommentDom.after(newCommentDom)
    newCommentDom.hide().fadeIn(2000)
    $('#main_comment').val("")
  })


})