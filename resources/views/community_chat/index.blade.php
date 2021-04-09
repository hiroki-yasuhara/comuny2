@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/vuejs-paginate@2.1.0"></script>
<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.css">
<?php
$id = session()->get('community_id');
$name = App\Models\Community::select('community_name')->where('id', $id)->first();
$auth_id = Auth::id();
?>
<h3>コミュニティ名：{{$name->community_name}}</h3>
<div id="appp" class="col-md-8 col-md-offset-2">
  <!--<div v-for="m in messages">-->
  <div v-for="m in getItems">
    <div v-if="m.user_id === {{$auth_id}}" style="text-align:right">
      <!-- 登録された日時 -->
      <span v-text="m.created_at"></span>：&nbsp;
      <!-- メッセージ内容 -->
      <span v-text="m.message"></span>
    </div>
    <div v-else>
      <!-- 登録された日時 -->
      <span v-text="m.created_at"></span>：&nbsp;
      <!-- メッセージ内容 -->
      <span v-text="m.message"></span>
    </div>
  </div>
  <div>
    <textarea v-model="message" style="width:100%"></textarea>
    <br>
    <button @click="send()">送信</button>
  </div>
  <paginate
    :page-count="getPageCount"
    :page-range="3"
    :margin-pages="2"
    :click-handler="clickCallback"
    :prev-text="'＜'"
    :next-text="'＞'"
    :container-class="'pagination'"
    :page-class="'page-item'">
  </paginate>
</div>
  <script>
    Vue.component('paginate', VuejsPaginate)
    var appp = new Vue({
      el: "#appp",
      data: {
        message: '',
        messages: [],
        parPage: 25,
      currentPage: 1
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
          const params = {
            message: this.message
          };
          axios.post(url, params)
            .then((response) => {
              // 成功したらメッセージをクリア
              this.message = '';
            });
        },
        clickCallback: function (pageNum) {
          this.currentPage = Number(pageNum);
        }
      },
      mounted() {
        this.getMessages();
        Echo.channel('chat')
          .listen('MessageCreated', (e) => {

            this.getMessages(); // 全メッセージを再読込

          });
      },
      computed: {
     getItems: function() {
       let current = this.currentPage * this.parPage;
       let start = current - this.parPage;
       return this.messages.slice(start, current);
     },
     getPageCount: function() {
       return Math.ceil(this.messages.length / this.parPage);
     }
   }
    });
  </script>
  @endsection