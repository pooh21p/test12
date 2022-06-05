function init_rest() {

    let elements = document.querySelectorAll('ul#db_list > li > a');

    for (let elem of elements) {

        elem.onclick = function() {
            

            let li = this.closest('li');

            let key = this.closest('li').querySelector('strong').innerText;

            const url = "api/redis/" + key;
            const request = new XMLHttpRequest();

            request.open('DELETE', url);
            //request.setRequestHeader('Content-Type', 'application/x-www-form-url');
            request.setRequestHeader('Content-type', 'application/json; charset = utf-8');

            request.addEventListener("readystatechange", () => {
            if (request.readyState === 4 && request.status === 200) {
                let ans = JSON.parse(request.responseText)
                    if (ans.code == '200') {
                        li.style.display = 'none'
                    } else  {
                        alert( ans.data.message );
                    };    
                }
            });
            request.send();            
            return false;
        }
    }    
        
    document.querySelector('#reload_list').onclick = function() {
            
            const url = "api/redis";
            const request = new XMLHttpRequest();

            request.open('GET', url);
            request.setRequestHeader('Content-Type', 'application/x-www-form-url');
            //request.setRequestHeader('Content-type', 'application/json; charset = utf-8');

            request.addEventListener("readystatechange", () => {
            if (request.readyState === 4 && request.status === 200) {
                let ans = JSON.parse(request.responseText)
                    if (ans.code == '200') {
                        let ul = ''
                        for (let elem in ans.data) {
                            ul = ul + '<li><strong>'+elem+'</strong>: '+ans.data[elem]+' <a href = "#" class = "remove">delete</a></li>'
                        }    
                        document.querySelector('#db_list').innerHTML = ul
                        init_rest()        
                            
                    } else  {
                        alert('Unknown error');
                    };    
                }
            });
            request.send();            
            return false;
        }
    
}

window.onload = function () {
    init_rest()
}
