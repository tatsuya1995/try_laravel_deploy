@extends('layouts.common')

@section('content')
<!-- 送信フォーム -->
<form enctype="multipart/form-data" action="" method="POST" class="form-horizontal">
  {{ csrf_field() }}
  <div class="form-group">
    <div class="col-sm-6">
      <textarea name="comment"  cols="30" rows="10"  class="form-control" placeholder="入力してください" id="comment"></textarea>
    </div>
  </div>
  
  <!-- 登録ボタン -->
  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-6">
  <button type="submit" class="btn btn-primary" id="submit">投稿</button>
</form> 

<!-- 表示される部分 -->
<td class="table-text" id="board">
  <div><label for="comment">内容：</label></td>


  
@endsection
