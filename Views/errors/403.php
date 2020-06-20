<!DOCTYPE html>
  <html>
    <meta charset="utf-8">
<?= csrf_meta() ?>
    <style>
      @import url('https://fonts.googleapis.com/css?family=IBM+Plex+Mono|Sedgwick+Ave+Display');

:root {
  --font-display: 'Sedgwick Ave Display';
  --font-sans-serif: 'IBM Plex Mono';
  --box-shadow: 0px 21px 34px 0px rgba(0, 0, 0, 0.89);
  --color-bg: linear-gradient(to bottom, rgba(35,37,38,1) 0%,rgba(32,38,40,1) 100%);
  --scene-width: 400px;
  --scene-height: 400px;
  --delay-base: 500ms;
  --delay-added: 100ms;
  --acc-back: cubic-bezier(0.390, 0.575, 0.565, 1.000);
}

*,
*:before,
*:after{
  box-sizing:border-box;
  -webkit-tap-highlight-color: rgba(255,255,255,0);
}

body{
  width: 100vw; height: 100vh;
  margin: 0;
  padding: 0;
  background: var(--color-bg);
  display: flex;
  align-items: center;
  justify-content: center;
  color: #fff;
  overflow: hidden;
}

.scene{
  position: relative;
  width: var(--scene-width);
  height: var(--scene-height);
  transition: transform 600ms var(--acc-back);
  display: flex;
  align-items: center;
}

.scene:hover{
  transform: scale(.98) skewY(-1deg);
}

.scene > *{
  transition: transform 600ms var(--acc-back);
}

.text{
  transition: transform 600ms var(--acc-back), opacity 100ms ease-in;
  height: inherit;
  width: 100%; 
  height: 100%;
  z-index: 7;
  position: relative;
  pointer-events: none;
}

.scene:hover .text{
  opacity: 1;
  transform: scale(.91);
}

@keyframes popInImg{
  0%{
    transform: skewY(5deg) scaleX(.89) scaleY(.89);
    opacity: 0;
  }
  100%{
    opacity: 1;    
  }
}

.text span{
  display: block;
  font-family: var(--font-sans-serif);
  text-align: center;
  text-shadow: var(--box-shadow);
  animation: popIn 600ms var(--acc-back) 1 forwards;
  opacity: 0;
}

@keyframes popIn{
  0%,13%{
    transform: scaleX(.89) scaleY(.75);
    opacity: 0;
  }
  100%{

    opacity: 1;    
  }
}

.bg-403{
  font-size: 440px;
  font-family: var(--font-display);
  animation-delay: calc(var(--delay-base) + 2 * var(--delay-added));
  z-index: 0;
  background: linear-gradient(to top, rgba(32,38,40,0) 25%,rgba(49,57,61,1) 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  transform: translateX(-25%) translateZ(-100px) skewY(-3deg);
  position: absolute;
  pointer-events: none;
  transition: transform 1200ms var(--acc-back);
}

.msg{
  bottom: -38px; right: -21px;
  font-size: 34px;
  animation-delay: calc(var(--delay-base) + 3 * var(--delay-added));
  color: #8b8b8b;
  margin-top: 144px;
  letter-spacing: 2px;
}

.msg span{
  transform: skewX(-13deg);
  display: inline-block;
  color: #fff;
  letter-spacing: -1px;
}

.support{
  bottom: -50px; right: -21px;
  font-size: 21px;
  animation-delay: calc(var(--delay-base) + 4 * var(--delay-added)); 
  display: block;
  margin-top: 89px;
  color: #686a6b;
}

.support span{
  margin-bottom: 5px;
}

.support a{
  display: inline-block;
  color: #b2b3b4;
  text-decoration: none;
  pointer-events: initial;
}

.support a:after{
  content: '';
  width: 110%; margin-left: -5%;
  height: 5px;
  display: block;
  background: #fff;
  opacity: .55;
  margin-top: 13px;
  outline: 1px solid transparent;
}

.support a:hover:after{
   opacity: 1;
}

.support a:focus,
.support a:active{
  outline: none;
}

@media screen and (max-width: 539px){
  
}

.overlay{
  display: block;
  position: absolute;
  cursor: pointer;
  width: 50%;
  height: 50%;
  z-index: 1;
  transform: translateZ(34px);
}

.overlay:nth-of-type(1){
  left: 0;
  top: 0;
}

.overlay:nth-of-type(2){
  right: 0;
  top: 0;
}

.overlay:nth-of-type(3){
  bottom: 0;
  right: 0;
}

.overlay:nth-of-type(4){
  bottom: 0;
  left: 0;
}

.overlay:nth-of-type(1):hover ~ .lock,
.overlay:nth-of-type(1):focus ~ .lock{
  transform-origin: right top;
  transform:  translateY(-3px) translateX(5px) rotateX(-13deg) rotateY(3deg) rotateZ(-2deg) translateZ(0) scale(.89);
}

.overlay:nth-of-type(1):hover ~ .bg-403,
.overlay:nth-of-type(1):focus ~ .bg-403{
  transform: translateX(-27%) skewY(-3deg) rotateX(-13deg) rotateY(3deg) translateZ(-100px) scale(.89);
}

.overlay:nth-of-type(2):hover ~ .lock,
.overlay:nth-of-type(2):focus ~ .lock{
  transform-origin: left top;
  transform: translateY(-3px) translateX(5px) rotateX(13deg) rotateY(3deg) rotateZ(2deg) translateZ(0) scale(1.03);
}

.overlay:nth-of-type(2):hover ~ .bg-403,
.overlay:nth-of-type(2):focus ~ .bg-403{
  transform: translateX(-21%) skewY(-3deg) rotateX(13deg) rotateY(3deg) translateZ(-100px);
}

.overlay:nth-of-type(3):hover ~ .lock,
.overlay:nth-of-type(3):focus ~ .lock{
  transform-origin: left bottom;
  transform: translateY(3px) translateX(-5px) rotateX(-13deg) rotateY(3deg) rotateZ(-2deg) translateZ() scale(.96);
}

.overlay:nth-of-type(3):hover ~ .bg-403,
.overlay:nth-of-type(3):focus ~ .bg-403{
  transform: translateX(-23%)  rotateX(-13deg) rotateY(3deg) translateZ(-100px);
}

.overlay:nth-of-type(4):hover ~ .lock,
.overlay:nth-of-type(4):focus ~ .lock{
  transform-origin: right bottom;
  transform: translateY(3px) translateX(5px) rotateX(-13deg) rotateY(-3deg) rotateZ(2deg) translateZ(0) scale(.89);
}

.overlay:nth-of-type(4):hover ~ .bg-403,
.overlay:nth-of-type(4):focus ~ .bg-403{
  transform: translateX(-19%) rotateX(-13deg) rotateY(-3deg) translateZ(-100px);
}

.lock{
  box-shadow: 32px 8px 0 0 #e4e4e4, 40px 8px 0 0 #e4e4e4, 48px 8px 0 0 #e4e4e4, 56px 8px 0 0 #e4e4e4, 24px 16px 0 0 #cbcbcb, 32px 16px 0 0 #cbcbcb, 40px 16px 0 0 #909090, 48px 16px 0 0 #909090, 56px 16px 0 0 #cbcbcb, 64px 16px 0 0 #e4e4e4, 16px 24px 0 0 #cbcbcb, 24px 24px 0 0 #cbcbcb, 32px 24px 0 0 #909090, 56px 24px 0 0 #909090, 64px 24px 0 0 #cbcbcb, 72px 24px 0 0 #e4e4e4, 16px 32px 0 0 #cbcbcb, 24px 32px 0 0 #909090, 64px 32px 0 0 #909090, 72px 32px 0 0 #cbcbcb, 16px 40px 0 0 #cbcbcb, 24px 40px 0 0 #909090, 64px 40px 0 0 #909090, 72px 40px 0 0 #cbcbcb, 16px 48px 0 0 #909090, 24px 48px 0 0 #909090, 64px 48px 0 0 #909090, 72px 48px 0 0 #909090, 8px 56px 0 0 #fbec79, 16px 56px 0 0 #fbec79, 24px 56px 0 0 #fbec79, 32px 56px 0 0 #fbec79, 40px 56px 0 0 #fbec79, 48px 56px 0 0 #fbec79, 56px 56px 0 0 #fbec79, 64px 56px 0 0 #fbec79, 72px 56px 0 0 #fbec79, 80px 56px 0 0 #fbec79, 8px 64px 0 0 #ffc107, 16px 64px 0 0 #ffc107, 24px 64px 0 0 #ffc107, 32px 64px 0 0 #ffc107, 40px 64px 0 0 #ffc107, 48px 64px 0 0 #ffc107, 56px 64px 0 0 #ffc107, 64px 64px 0 0 #ffc107, 72px 64px 0 0 #ffc107, 80px 64px 0 0 #ffc107, 8px 72px 0 0 #ffc107, 16px 72px 0 0 #ffc107, 24px 72px 0 0 #ffc107, 32px 72px 0 0 #ffc107, 40px 72px 0 0 #ffc107, 48px 72px 0 0 #ffc107, 56px 72px 0 0 #ffc107, 64px 72px 0 0 #ffc107, 72px 72px 0 0 #ffc107, 80px 72px 0 0 #ffc107, 8px 80px 0 0 #ff9800, 16px 80px 0 0 #ffc107, 24px 80px 0 0 #ffc107, 32px 80px 0 0 #ffc107, 40px 80px 0 0 #ffc107, 48px 80px 0 0 #ff9800, 56px 80px 0 0 #ff9800, 64px 80px 0 0 #ff9800, 72px 80px 0 0 #ff9800, 16px 88px 0 0 #ff9800, 24px 88px 0 0 #ff9800, 32px 88px 0 0 #ff9800, 40px 88px 0 0 #ff9800, 48px 88px 0 0 #ff9800, 56px 88px 0 0 #ff9800, 64px 88px 0 0 #ff9800, 72px 88px 0 0 #ff9800, 24px 96px 0 0 #ff9800, 32px 96px 0 0 #ff9800, 40px 96px 0 0 #ff9800, 48px 96px 0 0 #ff9800, 56px 96px 0 0 #ff9800, 64px 96px 0 0 #ff9800;
  height: 8px;
  width: 8px;
  position: absolute;
  left: calc(50% - 48px);
  top: 0;
  transform-style: preserve-3d;
  backface-visibility: hidden;
  pointer-events: none;
  outline: 1px solid transparent;
}
#clockdiv{
  font-family: sans-serif;
  color: #fff;
  display: inline-block;
  font-weight: 100;
  text-align: center;
  font-size: 30px;
}

#clockdiv > div{
  padding: 10px;
  border-radius: 3px;
  background: #00BF96;
  display: inline-block;
}

#clockdiv div > span{
  padding: 15px;
  border-radius: 3px;
  background: #00816A;
  display: inline-block;
}

.smalltext{
  padding-top: 5px;
  font-size: 16px;
}
      </style>
    <body>
      <div class="scene">
  <div class="overlay"></div>
  <div class="overlay"></div>
  <div class="overlay"></div>
  <div class="overlay"></div>
  <span class="bg-403">403</span>
  <div class="text">
    <span class="hero-text"></span>
    <span class="msg">can not let <span>you</span> in.</span>
    <?php foreach ($data as $ban) : ?>
    <h3 class="msg">Your ip : <strong><?= esc($ban->ip) ?></strong></h3>
    <div id="clockdiv">
  <div>
    <span class="days"></span>
    <div class="smalltext">Days</div>
  </div>
  <div>
    <span class="hours"></span>
    <div class="smalltext">Hours</div>
  </div>
  <div>
    <span class="minutes"></span>
    <div class="smalltext">Minutes</div>
  </div>
  <div>
    <span class="seconds"></span>
    <div class="smalltext">Seconds</div>
  </div>
</div>
  <script>
    function getTimeRemaining(endtime) {
  const total = Date.parse(endtime) - Date.parse(new Date());
  const seconds = Math.floor((total / 1000) % 60);
  const minutes = Math.floor((total / 1000 / 60) % 60);
  const hours = Math.floor((total / (1000 * 60 * 60)) % 24);
  const days = Math.floor(total / (1000 * 60 * 60 * 24));
  
  return {
    total,
    days,
    hours,
    minutes,
    seconds
  };
}

function initializeClock(id, endtime) {
  const clock = document.getElementById(id);
  const daysSpan = clock.querySelector('.days');
  const hoursSpan = clock.querySelector('.hours');
  const minutesSpan = clock.querySelector('.minutes');
  const secondsSpan = clock.querySelector('.seconds');

  function updateClock() {
    const t = getTimeRemaining(endtime);

    daysSpan.innerHTML = t.days;
    hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
    minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
    secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

    if (t.total <= 0) {
      clearInterval(timeinterval);
    }
  }

  updateClock();
  const timeinterval = setInterval(updateClock, 1000);
}

const deadline = "<?= $ban->until ?>";
initializeClock('clockdiv', deadline);
</script>
      <p class="msg">
      <?= esc($ban->cause) ?></p>
      <?php endforeach; ?>
    <span class="support">
      <span>unexpected?</span>
    </span>
  </div>
  <div class="lock"></div>
</div>
      </body>
    </html>