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

      // var oli = document.getElementById('livesearch').getElementsByTagName("li");
      // for(var i=0; i<oli.length; i++){
      //   oli[i].onclick = function () {
      //     alert(i);
      //   }}
      $('ul').on('click','li',function () {
        // console.log(.val());
        // var value = $(this).val;
        document.getElementById('g_id').value=this.innerHTML;
        document.getElementById('livesearch').innerHTML = "";
      });

      }


    })



}

