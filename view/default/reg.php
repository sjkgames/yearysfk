<?php require_once 'head.php' ?>

<link rel="stylesheet" href="/static/default/reg/css/app.css">
<link rel="stylesheet" href="/static/default/reg/css/amazeui.datatables.min.css">
</head>
<body data-type="login" class="theme-white">

<div class="am-g tpl-g">

    <div class="tpl-login">
        <div class="tpl-login-content">
            <?php if($this->config['sw_reg'] == 1):?>
            <div class="tpl-login-title"><?php echo $this->config['sitename'] ?>-注册用户</div>
            <?php else:?>
            <div class="tpl-login-title"><?php echo $this->config['sitename'] ?>-已关闭注册！请勿提交！</div>
            <?php endif;?>
            <span class="tpl-login-content-info">
                  创建一个新的用户
              </span>


            <form class="am-form tpl-form-line-form form-ajax" action="/reg/save" method="post" style="cursor: pointer;">
                <div class="am-form-group">
                    <input type="email" name="uemail" class="tpl-form-input"  placeholder="邮箱" required>

                </div>

                <div class="am-form-group">
                    <input type="text" name="uname" class="tpl-form-input"  placeholder="用户名：请输入3个字符以上" required>
                </div>

                <div class="am-form-group">
                    <input type="password" name="upasswd" class="tpl-form-input"  placeholder="请输入密码：6位字符以上" required>
                </div>

                <div class="am-form-group">
                    <input type="password" name="rpasswd" class="tpl-form-input"  placeholder="再次输入密码" required>
                </div>

                <div class="am-form-group tpl-login-remember-me">
                    <input id="remember-me" name="ckmember" type="checkbox">
                    <label for="remember-me">

                        我已阅读并同意 <a href="javascript:;" onclick="userCheck()">《用户注册协议》</a>
                    </label>

                </div>






                <div class="am-form-group">

                    <button type="submit" class="am-btn am-btn-primary  am-btn-block tpl-btn-bg-color-success tpl-login-btn">提交</button>

                </div>
            </form>
        </div>
    </div>
</div>
<div class="userCheckTxt" style="display: none">
    <p><span style="font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;欢迎您使用<?php echo $this->config['sitename'] ?>全自动发卡平台（专业虚拟数字产品交易平台服务产品）。以下所述条款和条件即构成您与<?php echo $this->config['sitename'] ?>虚拟数字产品交易平台所达成的协议（以下简称“本协议”）。以下协议根据《中华人民共和国合同法》、《中华人民共和国计算机信息网络国际互联网管理暂行规定》、邮电部《中国公用计算机互联网国际网管理办法》等有关规定制定。</span></p>

    <p><span style="font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;一、承诺&nbsp;　　</span></p>

    <p><span style="font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1. 您确认，在您成为我们的用户之前已充分阅读、理解并接受本协议的全部内容，一旦您使用本服务，即表示您同意遵循本协议之所有约定。</span></p>

    <p><span style="font-size:14px;">　　&nbsp;&nbsp;&nbsp;&nbsp;2. 您同意，本公司有权随时对本协议内容进行单方面的变更，并以在本网站公告的方式予以公布，无需另行单独通知您；若您在本协议内容公告变更后继续使用本服务的，表示您已充分阅读、理解并接受修改后的协议内容，也将遵循修改后的协议内容使用本服务；若您不同意修改后的协议内容，您应停止使用本服务。</span></p>

    <p><span style="font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;二、<?php echo $this->config['sitename'] ?>--专业虚拟数字产品交易平台服务使用的责任和义务　　</span></p>

    <p><span style="font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1. 您在使用本服务时应遵守中华人民共和国相关法律法规、您所在国家或地区之法令及相关国际惯例，不将本服务用于任何非法目的，也不以任何非法方式使用本服务。</span></p>

    <p><span style="font-size:14px;">　　&nbsp;&nbsp;&nbsp;&nbsp;2. 您不得利用本服务从事侵害他人合法权益之行为，否则本公司有权拒绝提供本服务，且您应承担所有相关法律责任，因此导致本公司或本公司用户受损的，您应承担赔偿责任。上述行为包括但不限于：</span></p>

    <p><span style="font-size:14px;">　　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(1)侵害他人名誉权、隐私权、商业秘密、商标权、著作权、专利权等合法权益。</span></p>

    <p><span style="font-size:14px;">　　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(2)违反依法定或约定之保密义务。</span></p>

    <p><span style="font-size:14px;">　　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(3)冒用他人名义使用本服务。</span></p>

    <p><span style="font-size:14px;">　　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(4)从事不法行为，如制作色情、赌博、病毒、挂马、反动、外挂、私服、钓鱼以及为私服提供任何服务(比如支付)的类似网站。</span></p>

    <p><span style="font-size:14px;">　　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(5)提供赌博资讯或以任何方式引诱他人参与赌博。</span></p>

    <p><span style="font-size:14px;">　　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(6)从事任何可能含有电脑病毒或是可能侵害本服务系统、资料之行为。</span></p>

    <p><span style="font-size:14px;">　　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(7)其他本公司有正当理由认为不适当之行为。</span></p>

    <p><span style="font-size:14px;">　　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3. 您理解并同意，本公司不对因下述任一情况导致的任何损害赔偿承担责任，包括但不限于流量、访问、数据等方面的损失或其他无形损失的损害赔偿 (无论本公司是否已被告知该等损害赔偿的可能性)：</span></p>

    <p><span style="font-size:14px;">　　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(1)本公司有权基于单方判断，包含但不限于本公司认为您已经违反本协议的明文规定及精神，暂停、中断或终止向您提供本服务或其任何部分，并移除您的资料。</span></p>

    <p><span style="font-size:14px;">　　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(2) 本公司在发现非法网站或有疑义或有违反法律规定或本协议约定之虞时，有权不经通知先行暂停或终止该域名的解析，并拒绝您使用本服务之部分或全部功能。</span></p>

    <p><span style="font-size:14px;">　　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(3) 在必要时，本公司无需事先通知即可终止提供本服务，并暂停、关闭或删除该账户及您账号中所有相关资料及档案，如遇到非法域名被关闭，所涉及到的款项将不会退款给您。</span></p>

    <p><span style="font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;三、&nbsp;隐私与保护　　</span></p>

    <p><span style="font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;一旦您同意本协议或使用本服务，您即同意本公司按照以下条款来使用和披露您的个人信息。</span></p>

    <p><span style="font-size:14px;">　　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(1) 用户名和密码 　　在您注册为<?php echo $this->config['sitename'] ?>--专业虚拟数字产品交易平台用户时，我们会要求您设置用户名和密码，以便在您丢失密码时用以确认您的身份。请确保您的账号安全防止泄露密码，如果您发现发现账号和密码有泄露的嫌疑，请及时联系我司处理，在我司采取行动之前，本司对此不负任何责任。</span></p>

    <p><span style="font-size:14px;">　　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(2)注册信息 　　我们有义务保证您在注册我们系统时填写的真实姓名、电话号码、电子邮件地址、身份证号码的其隐私性，并且您同意我们通过电子邮件或者电话号码通知您有关我司有关优惠活动和您在我们系统上面设置的告警通知。</span></p>

    <p><span style="font-size:14px;">　　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(3)为了更好的向您提供服务，您同意，本公司有权将您在注册及在使用我们服务的过程中所产生的信息，提供给本司的关联公司。除本协议另有规定外，本公司不对外公开或向第三方提供您的信息，但以下情况除外：</span></p>

    <p><span style="font-size:14px;">　　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A、事先获得您的明确授权；</span></p>

    <p><span style="font-size:14px;">　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;　&nbsp;B、按照本协议的要求进行的披露；</span></p>

    <p><span style="font-size:14px;">　　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C、根据法律法规的规定；</span></p>

    <p><span style="font-size:14px;">　　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;D、由国家相关部门开具证明，需要调阅您的信息</span></p>

    <p><span style="font-size:14px;">　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;　&nbsp;E、您使用<?php echo $this->config['sitename'] ?>--专业虚拟数字产品交易平台账户成功登录过的其他网站。</span></p>

    <p><span style="font-size:14px;">　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;　&nbsp;F、为维护本公司及其关联公司的合法权益；</span></p>

    <p><span style="font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;四、安全&nbsp;　　</span></p>

    <p><span style="font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;本司仅以现有技术提供相应的安全措施来保证您的信息不丢失、泄露。尽管有这些安全措施，但本司不保证这些信息的100%安全。</span></p>

    <p><span style="font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;五、免责条款</span></p>

    <p><span style="font-size:14px;">　　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;因下列状况无法正常运作，使您无法使用各项服务时，本公司不承担损害赔偿责任，该状况包括但不限于：</span></p>

    <p><span style="font-size:14px;">　　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1. 由于系统升级或调整期间需要停机维护且停机维护之前做过广告的</span></p>

    <p><span style="font-size:14px;">　　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2. 用户违反本协议条款的约定，导致第三方主张的任何损失或索赔。</span></p>

    <p><span style="font-size:14px;">　　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3. 因台风、地震、海啸、洪水、停电、战争、恐怖袭击等不可抗力之因素，造成本公司系统障碍不能执行业务的。</span></p>

    <p><span style="font-size:14px;">　　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4. 由于黑客攻击、电信部门技术调整或故障、网站升级、银行方面的问题等原因而造成的服务中断或者延迟。</span></p>

    <p><span style="font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;六、责任范围及责任限制</span></p>

    <p><span style="font-size:14px;">　　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1. 本公司仅对本协议中列明的责任承担范围负责。</span></p>

    <p><span style="font-size:14px;">　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;　2. 由于服务服务器故障给您造成大范围无法正常销售超过72小时的，除VIP外您无权要求本公司给予经济赔偿。</span></p>

    <p><span style="font-size:14px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;七、法律及争议解决</span></p>

    <p><span style="font-size:14px;">　　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.本协议适用中华人民共和国法律。如遇本协议有关的某一特定事项缺乏明确法律规定，则应参照通用国际商业惯例和（或）行业惯例。</span></p>

    <p><span style="font-size:14px;">　　&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.因双方就本协议的签订、履行或解释发生争议，双方应努力友好协商解决。如协商不成，任何一方均有权将争议递交当地人民法院。</span></p>

</div>

</body>

</html>
<?php require_once 'foot.php' ?>
<script>

    function userCheck() {
        layer.open({
            title:'用户注册协议',
            type: 1,
            skin: 'layui-layer-rim', //加上边框
            area: ['80%', '60%'], //宽高
            content: $('.userCheckTxt').html()
        });
    }

</script>