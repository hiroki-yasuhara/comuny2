@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<div id="appp">
<textarea v-model="message"></textarea>
        <br>
        <button @click="send()">送信</button>
        <div v-for="m in messages">

        <!-- 登録された日時 -->
        <span v-text="m.created_at"></span>：&nbsp;
        <!-- メッセージ内容 -->
        <span v-text="m.message"></span>

</div>
   </div>

    <script>
        var appp = new Vue({
            el: "#appp",
            data: {
                now: "00:00:00",
                count:0,
                message:'',
                messages:[]
            },
            methods: {
              getMessages() {
              const url = '/ajax/chat';
              axios.get(url)
              .then((response) => {
              this.messages = response.data;
              });
              },
                send() {
                  this.count++
                  const url = '/ajax/chat';
                  const params = { message: this.message };
                  axios.post(url, params)
                  .then((response) => {
                    // 成功したらメッセージをクリア
                    this.message = '';
                  });
                }
            },
            mounted() {
              this.getMessages();
              Echo.channel('chat')
              .listen('MessageCreated', (e) => {

            this.getMessages(); // 全メッセージを再読込

        });
            }
        });
    </script>
@endsection
