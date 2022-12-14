<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/knockout/3.4.2/knockout-min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


<h1>ログイン成功</h1>

<h3>
    <?php
     foreach ($data as $datum) {
        $user = $datum['username'];
        $posted_at = $datum['posted_at'];
        $content = $datum['content'];
        echo "$user $posted_at";
        echo '<br>';
        echo $content;
        echo '<br>';
        echo '<br>';
        
    }
    ?>
</h3>


<!-- <form method="POST" action="/message/post">
    <input type="text" name='message'>
    <button type="submit">送信</button>

</form> -->



<!-- <form method="POST" action="/message/post" data-bind="submit: addItem">
    <input type="text" name='message' data-bind='value: itemToAdd, valueUpdate: "afterkeydown"'>
    <button type="submit" data-bind="enable: itemToAdd().length > 0">送信</button>
    <p>メッセージ一覧</p>
    <select multiple="multiple" width="50" data-bind="options: items"> </select>

</form> -->


<!-- =============================================== -->


<form action="" method="post" data-bind="submit: addItem">
    <!-- <input type="text" name="username" data-bind='value: itemToAdd, valueUpdate: "afterkeydown"'> -->
    <input type="text" name="content" data-bind='value: itemToAdd, valueUpdate: "afterkeydown"'>
    <button onclick="submitForm();" data-bind="enable: itemToAdd().length > 0">送信</button>
    <p multiple="multiple" width="50" data-bind="text: items"> </p>
    
</form>

<script type="text/javascript">


    function submitForm(){
        var username = "user1";
        var content = $('input[name=content]').val();
        var formData = {
            username: username,
            content: content
        };
        console.log(formData);

        $.ajax({
            url: "http://localhost/chat/chat_post.json",
            type: 'POST',
            cache: false,
            dataType : 'json',
            data: formData,

        }).done(function(data) {
            // alert('成功');

        }).fail(function() {
            // alert('失敗');
        });
    }

    // 表示するためにゴリ押ししてます…
    var json = 
    '<?php
      $json=json_encode($contents);
      echo $json;
    ?>'
    
    const obj = JSON.parse(json);
    console.log(obj['content']);

    var chat = [];

    obj.forEach(function(element){
        // console.log(element['content']);
        chat.push(element['content']);

    });
    console.log(chat);

// 

    var items = chat;

    var SimpleListModel = function(items) {
        
        this.items = ko.observableArray(items);
        this.itemToAdd = ko.observable("");
        this.addItem = function() {
            if (this.itemToAdd() != "") {
                this.items.push(this.itemToAdd()); // Adds the item. Writing to the "items" observableArray causes any associated UI to update.
                this.itemToAdd(""); // Clears the text box, because it's bound to the "itemToAdd" observable
            }
        }.bind(this);  // Ensure that "this" is always this view model
    };
 

ko.applyBindings(new SimpleListModel([items]));

</script>

<!-- =============================================== -->