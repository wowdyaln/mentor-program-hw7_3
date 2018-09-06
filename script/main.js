$(document).ready( ()=> {
  console.log('jquery done.!!');

  // 使用 ajax 送 request 給後端
  $('#comment_ajax').submit( (e)=> {
    e.preventDefault()
    console.log('submit evnet !');
    let mainCommentDom = $('.sticky-top')
    let newCommentDom = $('<h1>New comment TEST block</h1>')

    $('html, body').animate({
      scrollTop: 0
    }, 300);

    mainCommentDom.after(newCommentDom)
    newCommentDom.hide().fadeIn(2000)
    $('#main_comment').val("")
  })


})