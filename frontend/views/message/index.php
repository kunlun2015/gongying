<?php
/**
 * 消息页面
 * @authors Amos (szhcool1129@sina.com)
 * @date    2018-03-03 22:01:12
 * @version 1.0
 */
    $this->title = '消息';
    use yii\helpers\Url;
?>
<style>
    .weui-media-box__hd{position: relative;}
</style>
<div class="weui-panel weui-panel_access message-list">
        <div class="weui-panel__bd">
          <a href="javascript:void(0);" class="weui-media-box weui-media-box_appmsg">
            <div class="weui-media-box__hd">
              <img class="weui-media-box__thumb" src="./static/images/avatar.jpg" alt="">
              <span class="weui-badge" style="position: absolute;top: -.4em;right: -.4em;">8</span>
            </div>
            <div class="weui-media-box__bd">
              <h4 class="weui-media-box__title">
                刘亦菲
                <span class="weui-media-box__title-after">下午8:12</span>
              </h4>
              <p class="weui-media-box__desc">小李明天早上帮我带两个包子，一个猪肉粉丝和一个奶黄包</p>
            </div>
          </a>
          <a href="javascript:void(0);" class="weui-media-box weui-media-box_appmsg">
            <div class="weui-media-box__hd">
              <img class="weui-media-box__thumb" src="./static/images/avatar.jpg" alt="">
              <span class="weui-badge" style="position: absolute;top: -.4em;right: -.4em;">3</span>
            </div>
            <div class="weui-media-box__bd">
              <h4 class="weui-media-box__title">
                Baby
                <span class="weui-media-box__title-after">下午7:23</span>
              </h4>
              <p class="weui-media-box__desc">晚上约吗？</p>
            </div>
          </a>
          <a href="javascript:void(0);" class="weui-media-box weui-media-box_appmsg">
            <div class="weui-media-box__hd">
              <img class="weui-media-box__thumb" src="./static/images/avatar.jpg" alt="">
              <span class="weui-badge" style="position: absolute;top: -.4em;right: -.4em;">99+</span>
            </div>
            <div class="weui-media-box__bd">
              <h4 class="weui-media-box__title">
                江户川-元芳
                <span class="weui-media-box__title-after">上午10:15</span>
              </h4>
              <p class="weui-media-box__desc">真相只有一个</p>
            </div>
          </a>
          <a href="javascript:void(0);" class="weui-media-box weui-media-box_appmsg">
            <div class="weui-media-box__hd">
              <img class="weui-media-box__thumb" src="./static/images/avatar.jpg" alt="">
            </div>
            <div class="weui-media-box__bd">
              <h4 class="weui-media-box__title">
                刘亦菲
                <span class="weui-media-box__title-after">下午8:12</span>
              </h4>
              <p class="weui-media-box__desc">小李明天早上帮我带两个包子，一个猪肉粉丝和一个奶黄包</p>
            </div>
          </a>
          <a href="javascript:void(0);" class="weui-media-box weui-media-box_appmsg">
            <div class="weui-media-box__hd">
              <img class="weui-media-box__thumb" src="./static/images/avatar.jpg" alt="">
            </div>
            <div class="weui-media-box__bd">
              <h4 class="weui-media-box__title">
                Baby
                <span class="weui-media-box__title-after">下午7:23</span>
              </h4>
              <p class="weui-media-box__desc">晚上约吗？</p>
            </div>
          </a>
          <a href="javascript:void(0);" class="weui-media-box weui-media-box_appmsg">
            <div class="weui-media-box__hd">
              <img class="weui-media-box__thumb" src="./static/images/avatar.jpg" alt="">
            </div>
            <div class="weui-media-box__bd">
              <h4 class="weui-media-box__title">
                江户川-元芳
                <span class="weui-media-box__title-after">上午10:15</span>
              </h4>
              <p class="weui-media-box__desc">真相只有一个</p>
            </div>
          </a>
          <a href="javascript:void(0);" class="weui-media-box weui-media-box_appmsg">
            <div class="weui-media-box__hd">
              <img class="weui-media-box__thumb" src="./static/images/avatar.jpg" alt="">
            </div>
            <div class="weui-media-box__bd">
              <h4 class="weui-media-box__title">
                刘亦菲
                <span class="weui-media-box__title-after">下午8:12</span>
              </h4>
              <p class="weui-media-box__desc">小李明天早上帮我带两个包子，一个猪肉粉丝和一个奶黄包</p>
            </div>
          </a>
          <a href="javascript:void(0);" class="weui-media-box weui-media-box_appmsg">
            <div class="weui-media-box__hd">
              <img class="weui-media-box__thumb" src="./static/images/avatar.jpg" alt="">
            </div>
            <div class="weui-media-box__bd">
              <h4 class="weui-media-box__title">
                Baby
                <span class="weui-media-box__title-after">下午7:23</span>
              </h4>
              <p class="weui-media-box__desc">晚上约吗？</p>
            </div>
          </a>
          <a href="javascript:void(0);" class="weui-media-box weui-media-box_appmsg">
            <div class="weui-media-box__hd">
              <img class="weui-media-box__thumb" src="./static/images/avatar.jpg" alt="">
            </div>
            <div class="weui-media-box__bd">
              <h4 class="weui-media-box__title">
                江户川-元芳
                <span class="weui-media-box__title-after">上午10:15</span>
              </h4>
              <p class="weui-media-box__desc">真相只有一个</p>
            </div>
          </a>
          <a href="javascript:void(0);" class="weui-media-box weui-media-box_appmsg">
            <div class="weui-media-box__hd">
              <img class="weui-media-box__thumb" src="./static/images/avatar.jpg" alt="">
            </div>
            <div class="weui-media-box__bd">
              <h4 class="weui-media-box__title">
                刘亦菲
                <span class="weui-media-box__title-after">下午8:12</span>
              </h4>
              <p class="weui-media-box__desc">小李明天早上帮我带两个包子，一个猪肉粉丝和一个奶黄包</p>
            </div>
          </a>
          <a href="javascript:void(0);" class="weui-media-box weui-media-box_appmsg">
            <div class="weui-media-box__hd">
              <img class="weui-media-box__thumb" src="./static/images/avatar.jpg" alt="">
            </div>
            <div class="weui-media-box__bd">
              <h4 class="weui-media-box__title">
                Baby
                <span class="weui-media-box__title-after">下午7:23</span>
              </h4>
              <p class="weui-media-box__desc">晚上约吗？</p>
            </div>
          </a>
          <a href="javascript:void(0);" class="weui-media-box weui-media-box_appmsg">
            <div class="weui-media-box__hd">
              <img class="weui-media-box__thumb" src="./static/images/avatar.jpg" alt="">
            </div>
            <div class="weui-media-box__bd">
              <h4 class="weui-media-box__title">
                江户川-元芳
                <span class="weui-media-box__title-after">上午10:15</span>
              </h4>
              <p class="weui-media-box__desc">真相只有一个</p>
            </div>
          </a>
        </div>
      </div>
<?=$this->render('/layouts/footerMenu');?>