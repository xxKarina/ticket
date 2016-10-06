/**
 * Created by yxx on 2016/8/14.
 */
window.onload=function(){
    code();
    //表单验证
    var fm=document.getElementsByTagName('form')[0];
    fm.onsubmit=function() {
        //密码验证
        if (fm.password.value != '') {
            if (fm.password.value.length < 6) {
                alert('密码不得小于6位');
                fm.password.value = '';//清空
                fm.password.focus();//将焦点移至表单字段
                return false;
            }
        }
        //邮箱验证
        if (!/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/.test(fm.email.value)) {
            alert('邮箱格式不正确');
            fm.email.value = '';//清空
            fm.email.focus();//将焦点移至表单字段
            return false;
        }
        //QQ验证
        if(fm.qq.value!='') {
            if (!/^[1-9]{1}[0-9]{4,9}$/.test(fm.qq.value)) {
                alert('QQ号码不正确');
                fm.qq.value = '';//清空
                fm.qq.focus();//将焦点移至表单字段
                return false;
            }
        }
        //网址验证
        if(fm.url.value!=''){
            if (!/^(http(s)?:\/\/(\w+\.)?)?[\w\-\.]+(\.\w+)+$/.test(fm.url.value)) {
                alert('网址不合法');
                fm.url.value = '';//清空
                fm.url.focus();//将焦点移至表单字段
                return false;
            }
        }//验证码验证(简单的验证其必须是4位就可以了)
        if(fm.code.value.length!=4){
            alert('验证码必须4位');
            fm.code.value = '';//清空
            fm.code.focus();//将焦点移至表单字段
            return false;
        }
        return true;
    };
};