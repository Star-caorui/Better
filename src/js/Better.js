/* 主题施工中 */
mdui.snackbar({
    message: '欢迎访问本站！',
    position: 'right-top',
    timeout:'3000'
});

mdui.snackbar({
    message: '本站近期主题正在施工，请不要到处乱点哦！',
    position: 'right-top',
    timeout:'3000'
});

/* Enable HighLight */
hljs.initHighlightingOnLoad();

/* Site RunTime */
function show_runtime(){
    window.setTimeout("show_runtime()",1000);
    Birthday=new Date("4/11/2020 00:00:00");
    Nowday=new Date();
    LiveTime=(Nowday.getTime()-Birthday.getTime());
    M=24*60*60*1000;
    a=LiveTime/M;
    A=Math.floor(a);
    b=(a-A)*24;
    B=Math.floor(b);
    c=(b-B)*60;
    C=Math.floor((b-B)*60);
    D=Math.floor((c-C)*60);
    document.getElementById("RunTime").innerHTML = "本站已安全运行"+A+"天"+B+"小时"+C+"分"+D+"秒";
}
show_runtime() ;

/* Lazy loading */
