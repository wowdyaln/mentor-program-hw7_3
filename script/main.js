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

    // 要到後端拿到 剛生出來 main comment 的 id , created_at / 還有作者的 nickname
    let last_id = undefined
    let nickname = undefined
    let created_at = undefined

    // append to
    // let newCommentDom = undefined

    $.ajax({
      type: "POST",
      url: "./action/create_comment.php",
      data: {
        user_id: authorId,
        main_comment: comment
      },
      // dataType: "text",
      success: function (resp) {
        let res = JSON.parse(resp)
        last_id = res.last_id
        nickname = res.nickname
        created_at = res.created_at
        console.log(last_id, nickname, created_at);
     


    // let newCommentDom = $(`<h1>New comment TEST block: ${authorId}      ${comment}</h1>`)

    
    let newCommentDom = $(`<div class='card border-success mt-3'>
                              <div class=card-header>
                                main comment ${last_id}。Post at : ${created_at}
                              </div>
                              <div class=card-body>
                                <h4 class=card-title>暱稱：${nickname}</h4>
                                <h5>${comment}</h5>
                              </div>

                              <div class='d-flex justify-content-around'>
                            <div>
                            <!-- Button trigger modal -->
                            <button type=button class='btn btn-outline-warning' data-toggle='modal' data-target='#editModal'>編輯主留言</button>
                            </button>

                            <!-- Modal -->
                            <div class='modal fade' id='editModal' tabindex='-1' role='dialog' aria-labelledby='editModalLabel' aria-hidden='true'>
                              <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                  <div class='modal-header'>
                                    <h5 class='modal-title' id='editModalLabel'>編輯 主留言</h5>
                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                      <span aria-hidden='true'>&times;</span>
                                    </button>
                                  </div>
                                <form action=./action/edit_comment.php method=post>
                                  <div class='modal-body'>
                                      <input type=hidden name=comment_id value=${last_id}>
                                      <label for=main_comment class=mb-0>主留言</label>
                                      <textarea class=form-control rows=2 name=main_comment id=main_comment required>${comment}</textarea>
                                  </div>
                                      <div class='modal-footer'>
                                      <button type=submit class='btn btn-primary'>送出</button>
                                      <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                                  </div>
                                </form>
                                  </div>
                              </div>
                            </div>
                          </div>   
                        <div>
                            <!-- Button trigger modal -->
                            <button type=button class='btn btn-outline-danger' data-toggle='modal' data-target='#deleteModal'>刪除主留言</button>
                            </button>

                            <!-- Modal -->
                            <div class='modal fade' id='deleteModal' tabindex='-1' role='dialog' aria-labelledby='deleteModalLabel' aria-hidden='true'>
                              <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                  <div class='modal-header'>
                                    <h5 class='modal-title' id='deleteModalLabel'>確定刪除 主留言？</h5>
                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                      <span aria-hidden='true'>&times;</span>
                                    </button>
                                  </div>
                                <form action=./action/delete_comment.php method=post>
                                  <div class='modal-body'>
                                      <p>${comment}</p>
                                      <span aria-hidden='true'>刪除之後無法復原，確定嗎？</span>
                                      <input type=hidden name=comment_id value=${last_id}>
                                  </div>
                                      <div class='modal-footer'>
                                      <button type=submit class='btn btn-danger'>確定</button>
                                      <button type='button' class='btn btn-info' data-dismiss='modal'>取消</button>
                                  </div>
                                </form>
                                </div>
                              </div>
                            </div>
                      </div>
                            
                  </div>
                            `)

        mainCommentDom.after(newCommentDom)
        newCommentDom.hide().fadeIn(2000)
      }   //  success function
    })    // $.ajax
                            

    $('html, body').animate({
      scrollTop: 0
    }, 300);


    $('#main_comment').val("")
  })


})