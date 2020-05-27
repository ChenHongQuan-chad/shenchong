
    window.onload = function () {
        let a = document.querySelectorAll('.single-blogs [id^=tag]')
        console.log(a);
        // < div class="article-nav-list-box" > <h4>Quick Navigation :</h4><ul class="article-nav-list"> </ul><section class="article-share-wrap"><ul class="article-share-btn-list"><li class="col-4-1 facebook" ></li><li class="col-4-1 twitter"></li><li class="col-4-1 linkedin"></li><li class="col-4-1 reddit"></li></ul></section ></div >
        let b = document.getElementsByClassName('content_wrap')
        console.log(b)
    }
    