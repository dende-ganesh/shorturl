const form = document.querySelector("form"),
fullURL = form.querySelector("input"),
shortenBtn = form.querySelector("button");
form.onsubmit = (e)=>{
    e.preventDefault();
}

shortenBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/url-control.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState == 4 && xhr.status == 200){
            let data = xhr.response;
            console.log(data);
            if(data.length <= 5){
                let domain = "localhost:8080?u=";
                document.getElementById('short').innerHTML = domain + data;
                    let xhr2 = new XMLHttpRequest();
                    xhr2.open("POST", "php/save-url.php", true);
                    xhr2.onload = ()=>{
                        if(xhr2.readyState == 4 && xhr2.status == 200){
                            let data = xhr2.response;
                            if(data == "success"){
                                location.reload();
                            }
                        }
                    }
                    let shorten_url1 =  document.getElementById('short').innerHTML;
                    let hidden_url = data;
                    xhr2.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhr2.send("shorten_url="+shorten_url1+"&hidden_url="+hidden_url);
                    document.getElementById('short').innerHTML = domain + data;
                }
            }else{
                alert(data);
            }
        }
    let formData = new FormData(form);
    xhr.send(formData);
}
