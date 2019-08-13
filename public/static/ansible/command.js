function showResult(str){
    $.ajax({
        type: "GET",
        url : "/host_group/group_search",
        datatype : 'json',
        data: {'q':str} ,
        success :function (data) {
            console.log(data);
            var datas=eval(data);
            document.getElementById('livesearch').innerHTML = "";
            for (x in datas)  // x 为属性名
            {
                item = document.createElement('li');
                // item.id = datas[x]['id'];
                item.setAttribute('id',datas[x]['id']);
                item.innerHTML = datas[x]['name'];
                document.getElementById('livesearch').appendChild(item);
            }
            document.getElementById('livesearch').style.border="1px solid #A5ACB2";
            $('ul').on('click','li',function () {
                document.getElementById('group').value=this.innerHTML;
                document.getElementById('livesearch').innerHTML = "";
            });
        }
    })
}

function showHostResult(str){
    $.ajax({
        type: "GET",
        url : "/host/host_search",
        datatype : 'json',
        data: {'q':str} ,
        success :function (data) {
            console.log(data);
            var datas=eval(data);
            document.getElementById('host_search').innerHTML = "";
            for (x in datas)  // x 为属性名
            {
                item = document.createElement('li');
                // item.id = datas[x]['id'];
                item.setAttribute('id',datas[x]['id']);
                item.innerHTML = datas[x]['name'];
                document.getElementById('host_search').appendChild(item);
            }
            document.getElementById('host_search').style.border="1px solid #A5ACB2";
            $('ul').on('click','li',function () {
                document.getElementById('host').value=this.innerHTML;
                document.getElementById('host_search').innerHTML = "";
            });
        }
    })
}

function showIPResult(str){
    $.ajax({
        type: "GET",
        url : "/host/ip_search",
        datatype : 'json',
        data: {'q':str} ,
        success :function (data) {
            console.log(data);
            var datas=eval(data);
            document.getElementById('ip_search').innerHTML = "";
            for (x in datas)  // x 为属性名
            {
                item = document.createElement('li');
                // item.id = datas[x]['id'];
                item.setAttribute('id',datas[x]['id']);
                item.innerHTML = datas[x]['ip'];
                document.getElementById('ip_search').appendChild(item);
            }
            document.getElementById('ip_search').style.border="1px solid #A5ACB2";
            $('ul').on('click','li',function () {
                document.getElementById('ip').value=this.innerHTML;
                document.getElementById('ip_search').innerHTML = "";
            });
        }
    })
}