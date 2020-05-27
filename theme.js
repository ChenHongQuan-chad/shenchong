
   

    // 获取h2中含有id的dom节点
    let arr = document.querySelectorAll('h2[id]')
    if(arr.length > 0){
        
        let div = document.createElement('div')
        div.setAttribute('class', 'article-nav-list-box')
        div.innerHTML = '<h4>Quick Navigation :</h4>'
        let ulDiv = document.createElement('ul')
        ulDiv.setAttribute('class', 'article-nav-list')

        let li = ''
        for (let i = 0; i < arr.length; i++) {
            li += '<li><a class="js-article-nav-item" href="#' + arr[i].getAttribute('id') + '">' + arr[i].innerText + '</a></li >'
        }
        // 将字符串添加到uldiv中
        ulDiv.innerHTML = li
        div.appendChild(ulDiv) //将两个dom拼接

        let tag = document.getElementsByClassName('content_wrap')[0]
        tag.appendChild(div)

        let content = document.querySelectorAll('.content_wrap')[0].offsetWidth
        let bodyWidth = document.body.clientWidth

        //body的宽度减去中间版心宽度 / 2
        div.style.right = (bodyWidth - content) / 2 + 'px'

        window.onscroll = function () {
            // 滚动条的兼容性问题
            let osTop = document.documentElement.scrollTop || document.body.srcollTop;
            let maxlang = document.getElementsByTagName('footer')[0].offsetTop - window.screen.availHeight / 2

            if (osTop > 350 && osTop < maxlang) {
                div.style.opacity = '1'
                div.style.visibility = 'visible'
            } else {
                div.style.opacity = '0'
                div.style.visibility = 'hidden'
            }

        }
    }
   
