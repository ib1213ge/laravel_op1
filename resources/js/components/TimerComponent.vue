<template>
    <div class="container-fluid py-4 vh-100" :class="{'dark-mode': darkFlg}">
        <div class="row justify-content-center" :class="[{'dark-mode': darkFlg}, {'nomal-mode': !darkFlg}]">

            <div class="col-sm-1 i-section pr-4 pb-1 order-sm-2">
                <i class="fa fa-bars fa-2x icon-open mr-3" @click="onShowFlg" v-if="!showFlg" aria-hidden="true"></i>
                <i class="fa fa-times fa-2x icon-close-s mr-3 d-sm-none" @click="onShowFlg" v-if="showFlg" aria-hidden="true"></i>
            </div>
            <div class="col-xs-12 col-sm-4 col-lg-3 w-100 order-sm-3" v-if="showFlg">
                <div class="row">
                    <i class="fa fa-times fa-2x icon-close-l d-none d-sm-block" @click="onShowFlg" v-if="showFlg"></i>
                    <div class="col-xs-12 w-100 mt-sm-5">
                        <h1 class="display-4 text-center mb-0">{{ timerMin }} : {{ timerSec }}</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 col-sm-12 w-100 py-3 order-sm-3">
                        <button type="button" class="btn btn-secondary w-100 h-100" @click="onReset">リセット</button>
                    </div>
                    <div class="col-6 col-sm-12 w-100 py-3 order-sm-1">
                        <button type="button" class="btn btn-primary w-100 h-100" @click="timerStart" v-if="!timerFlg" :disabled="isEnd">スタート</button>
                        <button type="button" class="btn btn-stop w-100 h-100" @click="timerStop" v-if="timerFlg">ストップ</button>
                    </div>
                    <div class="col-6 col-sm-12 w-100 py-3 order-sm-4">
                        <a href="#" class="btn btn-primary w-100 h-100" onclick="javascript:window.history.back(-1); return false;">設定画面へ</a>
                    </div>
                    <div class="col-6 col-sm-12 w-100 py-3 order-sm-2">
                        <button type="button" class="btn btn-secondary w-100 h-100" @click="onAlarmFlg" v-if="!alarmFlg">アラーム OFF</button>
                        <button type="button" class="btn btn-alarm w-100 h-100" @click="onAlarmFlg" v-if="alarmFlg">アラーム ON</button>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-5 col-lg-4 main order-sm-1">
                <div class="col-xs-12 top-section">
                    <img :src="timer.picture" class="img-section w-100 h-100" :class="{'d-none': !timer.picture}" alt="背景画像">
                    <div class="w-100 h-100 top-color" :class="[timerFlg ? 'is-top-color' : 'is-top-paused', {'is-top-reset' : isReset}]" :style="timerStyle" :hidden="isEnd"></div>
                </div>
                <i class="fa fa-2x icon-anime" :class="[{'is-icon-anime': timerFlg}, timerIcon]" :style="{ color: timerColor }" aria-hidden="true"></i>
                <div class="col-xs-12 center-section">
                </div>
                <div class="col-xs-12 bottom-section" :hidden="isReset">
                    <div class="h-100" :class="[timerFlg ? 'is-bottom-color' : 'is-bottom-paused', {'is-bottom-reset' : isReset}]" :style="timerStyle">
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            timer: {
                type: Object,
            },
        },
        data: function() {
            return {
                timerObj: '',
                darkFlg: false, // モード切り替え
                timerColor: this.timer.color, // 選んだ色
                timerMin: 0, // タイマー分表示
                timerSec: 0, // タイマー秒表示
                timerIcon: '', // アイコンの形
                countDown: 0, // 計算用に時間を秒数にする
                timerFlg: false, // タイマー動いているのか
                showFlg: true, // 操作エリア表示・非表示
                alarmFlg: false, // アラーム音ON/OFF
                isReset: false, // リセットされたか
                isEnd: false, // タイマー終了
                endSound: '', // アラーム音
                timerStyle: {
                    'background-color': this.timer.color, //タイマーの色
                    'animation-duration': '', // アニメーションの時間
                }
            }
        },
        created() {

            // アイコンの形
            switch (Number(this.timer.icon_id)) {
            case 1:
                this.timerIcon = 'fa-square'
                break
            case 2:
                this.timerIcon = 'fa-heart'
                break
            case 3:
                this.timerIcon = 'fa-tint'
                break
            case 4:
                this.timerIcon = 'fa-star'
                break
            default:
                this.timerIcon = 'fa-square'
                break
            }

            //モード設定
            if((this.timer.mode_id) == 2) {
                this.darkFlg = true
            }else{
                this.darkFlg = false
            }

            // 画像があったら表示する
            if(this.timer.picture) {
                this.timer.picture = 'https://181417690029.signin.aws.amazon.com/console/' + this.timer.picture
            }else{
                this.timer.picture = false
            }

            // タイマー設定用
            this.timerMin = this.timer.min
            this.timerSec = '00'.slice(-2)
            this.countDown = this.timer.min * 60

            // アニメーションの時間設定
            this.timerStyle['animation-duration'] = (this.timer.min * 60) + 's'

            // アラーム音設定
            this.endSound = new Audio('../sounds/VSQSE_0616_clock_alarm.mp3')
        },
        methods: {
            timerStart: function() {
                this.timerFlg = true
                this.isReset = false
                this.countTimer()
            },
            timerStop: function() {
                this.timerFlg = false
                window.clearInterval(this.timerObj)
            },
            countTimer: function() {

                this.timerObj = window.setInterval(() => {
                    this.countDown -= 1

                    this.timerMin = Math.floor(this.countDown / 60)
                    this.timerSec = ('00' + this.countDown % 60).slice(-2)

                    if(this.countDown < 1) {
                        // タイマー終了
                        window.clearInterval(this.timerObj)
                        this.isEnd = true
                        this.timerFlg = false

                        if(this.alarmFlg == true) {
                            // アラームONの場合音鳴らす
                            this.endSound.play()
                        }
                    }
                }, 1000)
            },
            onReset: function() {
                // リセットボタンを押された時
                window.clearInterval(this.timerObj)
                this.timerFlg = false
                this.alarmFlg = false
                this.isReset = true
                this.isEnd = false
                this.timerMin = this.timer.min
                this.timerSec = '00'.slice(-2)
                this.countDown = this.timer.min * 60
                this.timerStyle['animation-duration'] = (this.timer.min * 60) + 's'
                this.endSound.pause()
                this.endSound.currentTime = 0
            },
            onShowFlg: function() {
                // 操作部分を表示・非表示
                if(this.showFlg == true){
                    this.showFlg = false
                }else{
                    this.showFlg = true
                }
            },
            onAlarmFlg: function() {
                // アラーム音
                if(this.alarmFlg == false){
                    this.alarmFlg = true
                }else{
                    this.alarmFlg = false
                    this.endSound.pause()
                    this.endSound.currentTime = 0
                }
            }
        }
    }
</script>

<style scoped>
.main {
    height: 600px;
}
.nomal-mode {
    color: #6c757d;
}
.dark-mode {
    background-color: #343a40;
    color: #f8f9fa;
}
.top-section, .bottom-section {
    height: 280px;
    overflow: hidden;
}
.top-section {
    position: relative;
}
.img-section {
    object-fit: cover;
}
.top-color {
    position: absolute;
    top: 0;
    left: 0;
}
.center-section {
    height: 20px;
}
.i-section {
    text-align: right;
}
.icon-close-l {
    right: 16px;
    position: absolute;
}
.icon-anime {
    opacity: 0;
    position: absolute;
    top: 250px;
    left: 80px;
}
.btn-stop {
    background-color: #FB6B94;
}
.btn-alarm {
    background-color: #A0DC32;
}

</style>
