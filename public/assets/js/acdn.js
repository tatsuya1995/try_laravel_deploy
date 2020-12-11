// .acdn_one
$(function(){
    //.acdn_oneの中の.acdn_headerがクリックされたら
    $('.acdn_one .acdn_header').click(function(){
      //クリックされた.acdn_oneの中の.acdn_headerに隣接する.acdn_innerが開閉。
      $(this).next('.acdn_inner').slideToggle();
      $(this).toggleClass("open");
    });
  });